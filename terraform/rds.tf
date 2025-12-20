# RDS Subnet Group
resource "aws_db_subnet_group" "this" {
  name       = "bloodx-db-subnet-group"
  subnet_ids = aws_subnet.private[*].id

  tags = {
    Name = "bloodx-db-subnet-group"
  }
}

# RDS MySQL Instance
resource "aws_db_instance" "bloodx" {
  identifier              = "bloodx-db"
  engine                  = "mysql"
  engine_version          = "8.0"
  instance_class          = "db.t3.micro"
  allocated_storage       = 20
  storage_type            = "gp2"
  db_name                 = "blood_bank_database"
  username                = var.db_username
  password                = var.db_password
  parameter_group_name    = "default.mysql8.0"
  db_subnet_group_name    = aws_db_subnet_group.this.name
  vpc_security_group_ids  = [aws_security_group.rds_sg.id]
  skip_final_snapshot     = true
  publicly_accessible     = false
  backup_retention_period = 0
  multi_az                = false

  tags = {
    Name = "bloodx-mysql-db"
  }
}

# Output RDS Endpoint
output "rds_endpoint" {
  description = "RDS instance endpoint"
  value       = aws_db_instance.bloodx.address
}

output "rds_database_name" {
  description = "RDS database name"
  value       = aws_db_instance.bloodx.db_name
}
