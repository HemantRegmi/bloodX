# ECR Repository for BloodX Application
resource "aws_ecr_repository" "bloodx" {
  name                 = "bloodx"
  image_tag_mutability = "MUTABLE"

  image_scanning_configuration {
    scan_on_push = true
  }

  tags = {
    Name = "bloodx-ecr"
  }
}

# ECR Lifecycle Policy
resource "aws_ecr_lifecycle_policy" "bloodx" {
  repository = aws_ecr_repository.bloodx.name

  policy = jsonencode({
    rules = [
      {
        rulePriority = 1
        description  = "Keep last 10 images"
        selection = {
          tagStatus     = "tagged"
          tagPrefixList = ["v"]
          countType     = "imageCountMoreThan"
          countNumber   = 10
        }
        action = {
          type = "expire"
        }
      },
      {
        rulePriority = 2
        description  = "Delete untagged images after 7 days"
        selection = {
          tagStatus   = "untagged"
          countType   = "sinceImagePushed"
          countUnit   = "days"
          countNumber = 7
        }
        action = {
          type = "expire"
        }
      }
    ]
  })
}

# ECR Repository Policy (allow pull from EC2 instances)
resource "aws_ecr_repository_policy" "bloodx" {
  repository = aws_ecr_repository.bloodx.name

  policy = jsonencode({
    Version = "2008-10-17"
    Statement = [
      {
        Sid    = "AllowPull"
        Effect = "Allow"
        Principal = {
          Service = "ec2.amazonaws.com"
        }
        Action = [
          "ecr:GetDownloadUrlForLayer",
          "ecr:BatchGetImage",
          "ecr:BatchCheckLayerAvailability"
        ]
      }
    ]
  })
}

# Output ECR Repository URL
output "ecr_repository_url" {
  description = "ECR repository URL"
  value       = aws_ecr_repository.bloodx.repository_url
}
