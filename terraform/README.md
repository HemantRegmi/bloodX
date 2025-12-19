# BloodX Infrastructure - Terraform

This directory contains all Terraform configurations for deploying the BloodX application infrastructure on AWS.

## Architecture Overview

- **VPC**: Custom VPC with public and private subnets across 2 availability zones
- **Networking**: Internet Gateway, NAT Gateways, Route Tables
- **Compute**: Auto Scaling Group with EC2 instances running Docker containers
- **Load Balancing**: Application Load Balancer with Blue/Green deployment support
- **Database**: RDS MySQL instance in private subnets
- **Container Registry**: ECR for Docker images
- **CI/CD**: Jenkins server for continuous integration
- **Monitoring**: CloudWatch alarms for auto-scaling

## File Structure

```
terraform/
├── provider.tf         # AWS provider configuration
├── variables.tf        # Input variables
├── terraform.tfvars    # Variable values (DO NOT COMMIT)
├── main.tf            # VPC, subnets, networking
├── security.tf        # Security groups
├── alb.tf             # Application Load Balancer
├── asg.tf             # Auto Scaling Group and Launch Template
├── blue_green.tf      # Blue/Green target groups
├── jenkins.tf         # Jenkins server
├── ecr.tf             # Elastic Container Registry
├── rds.tf             # RDS MySQL database
├── outputs.tf         # Output values
└── .gitignore         # Git ignore file
```

## Prerequisites

1. **AWS CLI** configured with appropriate credentials
2. **Terraform** >= 1.0 installed
3. **AWS Account** with appropriate permissions

## Variables

Edit `terraform.tfvars` to customize:

```hcl
db_username  = "admin"           # Database username
db_password  = "YourPassword"    # Database password (change this!)
environment  = "production"      # Environment name
project_name = "bloodx"          # Project name
```

## Deployment Steps

### 1. Initialize Terraform

```bash
terraform init
```

### 2. Validate Configuration

```bash
terraform validate
```

### 3. Plan Infrastructure

```bash
terraform plan
```

### 4. Apply Configuration

```bash
terraform apply
```

Type `yes` when prompted to create the infrastructure.

### 5. Get Outputs

```bash
terraform output
```

## Important Outputs

- `alb_dns_name`: Load balancer URL for accessing the application
- `ecr_repository_url`: ECR repository for pushing Docker images
- `rds_endpoint`: Database endpoint for application configuration
- `jenkins_instance_id`: Jenkins server instance ID

## Blue/Green Deployment

The infrastructure supports blue/green deployments:

1. **Blue Target Group**: Initial deployment target
2. **Green Target Group**: New version deployment target
3. Switch traffic between groups using ALB listener rules

## Security Features

- Private subnets for application and database
- Security groups with least privilege access
- RDS in private subnet with no public access
- ALB in public subnet with restricted ingress

## Cleanup

To destroy all resources:

```bash
terraform destroy
```

Type `yes` when prompted.

## Cost Optimization

**Estimated Monthly Cost**: ~$100-150 USD

- 2x t2.micro instances: ~$15
- 2x NAT Gateways: ~$65
- 1x ALB: ~$20
- 1x RDS t3.micro: ~$15
- 1x Jenkins t2.medium: ~$35

**To reduce costs**:
- Use 1 NAT Gateway instead of 2
- Use db.t3.micro for RDS
- Stop Jenkins when not in use

## Troubleshooting

### Issue: Terraform state locked

```bash
terraform force-unlock <LOCK_ID>
```

### Issue: Resource already exists

```bash
terraform import <resource_type>.<resource_name> <resource_id>
```

### Issue: Permission denied

Ensure your AWS credentials have the following permissions:
- EC2, VPC, RDS, ECR, IAM, CloudWatch, Auto Scaling

## Next Steps

1. Push Docker image to ECR
2. Configure Jenkins pipeline
3. Set up database schema
4. Configure application environment variables
5. Set up monitoring and logging
6. Configure domain and SSL certificate

## Support

For issues, refer to:
- [Terraform AWS Provider Documentation](https://registry.terraform.io/providers/hashicorp/aws/latest/docs)
- [AWS Documentation](https://docs.aws.amazon.com/)
