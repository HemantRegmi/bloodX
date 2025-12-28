# IAM Role for EC2 Instances
data "aws_region" "current" {}

resource "aws_iam_role" "ec2_role" {
  name = "bloodx-ec2-role"

  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Action = "sts:AssumeRole"
        Effect = "Allow"
        Principal = {
          Service = "ec2.amazonaws.com"
        }
      }
    ]
  })

  tags = {
    Name = "bloodx-ec2-role"
  }
}

# IAM Policy for ECR Access
resource "aws_iam_role_policy" "ecr_policy" {
  name = "bloodx-ecr-policy"
  role = aws_iam_role.ec2_role.id

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Effect = "Allow"
        Action = [
          "ecr:GetAuthorizationToken",
          "ecr:BatchCheckLayerAvailability",
          "ecr:GetDownloadUrlForLayer",
          "ecr:BatchGetImage",
          "ecr:PutImage",
          "ecr:InitiateLayerUpload",
          "ecr:UploadLayerPart",
          "ecr:CompleteLayerUpload"
        ]
        Resource = "*"
      }
    ]
  })
}

# IAM Policy for ASG Control (Jenkins Deployment)
resource "aws_iam_role_policy" "asg_policy" {
  name = "bloodx-asg-policy"
  role = aws_iam_role.ec2_role.id

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Effect = "Allow"
        Action = [
          "autoscaling:StartInstanceRefresh",
          "autoscaling:CancelInstanceRefresh",
          "autoscaling:DescribeInstanceRefreshes",
          "autoscaling:CompleteLifecycleAction",
          "autoscaling:UpdateAutoScalingGroup"
        ]
        Resource = "*"
      }
    ]
  })
}

# IAM Instance Profile
resource "aws_iam_instance_profile" "ec2_profile" {
  name = "bloodx-ec2-profile"
  role = aws_iam_role.ec2_role.name
}

# Launch Template
resource "aws_launch_template" "app" {
  name_prefix   = "bloodx-"
  image_id      = "ami-0f5ee92e2d63afc18" # Ubuntu 22.04 LTS in ap-south-1
  instance_type = "t3.micro"
  key_name      = var.ssh_key_name

  iam_instance_profile {
    arn = aws_iam_instance_profile.ec2_profile.arn
  }

  vpc_security_group_ids = [aws_security_group.app_sg.id]

  user_data = base64encode(<<-EOF
              #!/bin/bash
              
              # Helper function for retrying commands
              retry_command() {
                  local n=1
                  local max=5
                  local delay=10
                  while true; do
                    "$@" && break || {
                      if [[ $n -lt $max ]]; then
                        ((n++))
                        echo "Command failed. Attempt $n/$max:"
                        sleep $delay;
                      else
                        echo "The command has failed after $max attempts."
                        return 1
                      fi
                    }
                  done
              }

              # Wait for internet
              sleep 30

              retry_command apt update -y
              retry_command apt install -y docker.io awscli
              systemctl start docker
              systemctl enable docker
              usermod -aG docker ubuntu

              REGION=${data.aws_region.current.name}
              ECR_REPO=${aws_ecr_repository.bloodx.repository_url}
              REGISTRY=$(echo ${aws_ecr_repository.bloodx.repository_url} | cut -d'/' -f1)

              cat >/etc/bloodx.env <<EOT
              DB_HOST=${aws_db_instance.bloodx.address}
              DB_NAME=${aws_db_instance.bloodx.db_name}
              DB_USER=${var.db_username}
              DB_PASSWORD=${var.db_password}
              DB_PORT=3306
              EOT

              # Login to ECR (login to registry root, not repo URL)
              aws ecr get-login-password --region ${data.aws_region.current.name} | docker login --username AWS --password-stdin $${REGISTRY}

              # Pull and run the container
              docker pull ${aws_ecr_repository.bloodx.repository_url}:latest || true
              docker rm -f bloodx || true
              docker run -d --name bloodx --restart unless-stopped -p 80:80 --env-file /etc/bloodx.env ${aws_ecr_repository.bloodx.repository_url}:latest || true
              EOF
  )

  tag_specifications {
    resource_type = "instance"
    tags = {
      Name = "bloodx-app-instance"
    }
  }
}

# Auto Scaling Group
resource "aws_autoscaling_group" "app" {
  name                = "bloodx-asg"
  desired_capacity    = 1
  max_size            = 2
  min_size            = 1
  vpc_zone_identifier = aws_subnet.private[*].id
  target_group_arns   = [aws_lb_target_group.blue.arn]
  termination_policies = ["OldestInstance"]

  launch_template {
    id      = aws_launch_template.app.id
    version = "$Latest"
  }

  health_check_type         = "ELB"
  health_check_grace_period = 300

  tag {
    key                 = "Name"
    value               = "bloodx-asg-instance"
    propagate_at_launch = true
  }
}

# Auto Scaling Policy - Scale Up
resource "aws_autoscaling_policy" "scale_up" {
  name                   = "bloodx-scale-up"
  scaling_adjustment     = 1
  adjustment_type        = "ChangeInCapacity"
  cooldown               = 300
  autoscaling_group_name = aws_autoscaling_group.app.name
}

# Auto Scaling Policy - Scale Down
resource "aws_autoscaling_policy" "scale_down" {
  name                   = "bloodx-scale-down"
  scaling_adjustment     = -1
  adjustment_type        = "ChangeInCapacity"
  cooldown               = 300
  autoscaling_group_name = aws_autoscaling_group.app.name
}

# CloudWatch Alarm - High CPU
resource "aws_cloudwatch_metric_alarm" "high_cpu" {
  alarm_name          = "bloodx-high-cpu"
  comparison_operator = "GreaterThanThreshold"
  evaluation_periods  = 2
  metric_name         = "CPUUtilization"
  namespace           = "AWS/EC2"
  period              = 120
  statistic           = "Average"
  threshold           = 70

  dimensions = {
    AutoScalingGroupName = aws_autoscaling_group.app.name
  }

  alarm_actions = [aws_autoscaling_policy.scale_up.arn]
}

# CloudWatch Alarm - Low CPU
resource "aws_cloudwatch_metric_alarm" "low_cpu" {
  alarm_name          = "bloodx-low-cpu"
  comparison_operator = "LessThanThreshold"
  evaluation_periods  = 2
  metric_name         = "CPUUtilization"
  namespace           = "AWS/EC2"
  period              = 120
  statistic           = "Average"
  threshold           = 30

  dimensions = {
    AutoScalingGroupName = aws_autoscaling_group.app.name
  }

  alarm_actions = [aws_autoscaling_policy.scale_down.arn]
}
