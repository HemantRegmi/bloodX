# Bastion Host (Jump Server) for secure SSH access to private instances

# Security Group for Bastion Host
resource "aws_security_group" "bastion_sg" {
  name        = "bloodx-bastion-sg"
  description = "Security group for bastion host"
  vpc_id      = aws_vpc.this.id

  ingress {
    description = "SSH from anywhere (restrict to your IP in production)"
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = var.allowed_ssh_cidr 
  }

  egress {
    description = "Allow all outbound traffic"
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "bloodx-bastion-sg"
  }
}

# Bastion Host EC2 Instance
resource "aws_instance" "bastion" {
  ami                         = "ami-0f5ee92e2d63afc18" 
  instance_type               = "t3.micro"
  subnet_id                   = aws_subnet.public[0].id
  vpc_security_group_ids      = [aws_security_group.bastion_sg.id]
  key_name                    = var.ssh_key_name
  associate_public_ip_address = true

  user_data = base64encode(<<-EOF
              #!/bin/bash
              apt update -y
              apt install -y mysql-client
              
              # Create a welcome message
              echo "Welcome to BloodX Bastion Host" > /etc/motd
              echo "Use this host to access private instances" >> /etc/motd
              EOF
  )

  tags = {
    Name = "bloodx-bastion-host"
  }
}

# Elastic IP for Bastion Host (optional but recommended)
resource "aws_eip" "bastion" {
  instance = aws_instance.bastion.id
  domain   = "vpc"

  tags = {
    Name = "bloodx-bastion-eip"
  }

  depends_on = [aws_internet_gateway.this]
}

# Output Bastion Host Information
output "bastion_public_ip" {
  description = "Bastion host public IP address"
  value       = aws_eip.bastion.public_ip
}

output "bastion_ssh_command" {
  description = "SSH command to connect to bastion"
  value       = "ssh -i ${var.ssh_key_name}.pem ubuntu@${aws_eip.bastion.public_ip}"
}
