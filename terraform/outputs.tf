# Outputs for the infrastructure

output "vpc_id" {
  description = "VPC ID"
  value       = aws_vpc.this.id
}

output "public_subnet_ids" {
  description = "Public subnet IDs"
  value       = aws_subnet.public[*].id
}

output "private_subnet_ids" {
  description = "Private subnet IDs"
  value       = aws_subnet.private[*].id
}

output "alb_dns_name" {
  description = "DNS name of the Application Load Balancer"
  value       = aws_lb.app.dns_name
}

output "alb_zone_id" {
  description = "Zone ID of the Application Load Balancer"
  value       = aws_lb.app.zone_id
}

output "jenkins_instance_id" {
  description = "Jenkins EC2 instance ID"
  value       = aws_instance.jenkins.id
}

output "jenkins_private_ip" {
  description = "Jenkins EC2 private IP"
  value       = aws_instance.jenkins.private_ip
}

output "asg_name" {
  description = "Auto Scaling Group name"
  value       = aws_autoscaling_group.app.name
}

output "blue_target_group_arn" {
  description = "Blue target group ARN"
  value       = aws_lb_target_group.blue.arn
}

output "green_target_group_arn" {
  description = "Green target group ARN"
  value       = aws_lb_target_group.green.arn
}

output "route53_nameservers" {
  description = "Route 53 nameservers for the domain"
  value       = aws_route53_zone.main.name_servers
}

output "app_url" {
  description = "Application URL"
  value       = "https://${var.domain_name}"
}
