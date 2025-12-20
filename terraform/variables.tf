variable "vpc_cidr" {
  description = "CIDR block for VPC"
  default     = "10.0.0.0/16"
}

variable "public_subnets" {
  description = "CIDR blocks for public subnets"
  default     = ["10.0.1.0/24", "10.0.2.0/24"]
}

variable "private_subnets" {
  description = "CIDR blocks for private subnets"
  default     = ["10.0.11.0/24", "10.0.12.0/24"]
}

variable "azs" {
  description = "Availability zones"
  default     = ["ap-south-1a", "ap-south-1b"]
}

variable "db_username" {
  description = "Database administrator username"
  type        = string
  default     = "admin"
  sensitive   = true
}

variable "db_password" {
  description = "Database administrator password"
  type        = string
  sensitive   = true
}

variable "environment" {
  description = "Environment name"
  type        = string
  default     = "production"
}

variable "project_name" {
  description = "Project name"
  type        = string
  default     = "bloodx"
}

variable "ssh_key_name" {
  description = "SSH key pair name for EC2 instances"
  type        = string
  default     = "bloodx-auto-key"
}

variable "allowed_ssh_cidr" {
  description = "CIDR blocks allowed to SSH into bastion host"
  type        = list(string)
  default     = ["0.0.0.0/0"] # Restrict to your IP in production
}

variable "domain_name" {
  description = "Domain name for the application"
  type        = string
  default     = "bloodx.tech"
}

variable "acm_certificate_arn" {
  description = "ARN of the ACM certificate for HTTPS"
  type        = string
  default     = "arn:aws:acm:ap-south-1:821214029068:certificate/53d88623-c068-42f9-98f4-c105a1e60edb"
}