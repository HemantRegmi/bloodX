resource "aws_instance" "jenkins" {
  ami                    = "ami-0f5ee92e2d63afc18"
  instance_type          = "t3.small"
  private_ip             = "10.0.11.10"
  subnet_id              = aws_subnet.private[0].id
  vpc_security_group_ids = [aws_security_group.jenkins.id]
  key_name               = var.ssh_key_name
  iam_instance_profile   = "bloodx-ec2-profile"

  user_data = file("${path.module}/user_data/jenkins.sh")

  tags = {
    Name = "bloodx-jenkins-server"
  }
}
