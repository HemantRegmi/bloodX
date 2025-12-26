resource "aws_instance" "monitoring" {
  ami                    = "ami-0f5ee92e2d63afc18"
  instance_type          = "t3.micro"
  private_ip             = "10.0.11.20"
  subnet_id              = aws_subnet.private[0].id
  vpc_security_group_ids = [aws_security_group.monitoring.id]
  key_name               = var.ssh_key_name

  user_data = file("${path.module}/user_data/monitoring.sh")

  tags = {
    Name = "bloodx-monitoring-server"
  }

  depends_on = [aws_key_pair.kp]
}

output "monitoring_instance_id" {
  value = aws_instance.monitoring.id
}

output "monitoring_private_ip" {
  value = aws_instance.monitoring.private_ip
}
