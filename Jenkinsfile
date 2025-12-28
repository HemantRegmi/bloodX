pipeline {
  agent any

  triggers {
    pollSCM '* * * * *'
  }

  environment {
    AWS_REGION = "ap-south-1"
    ECR_REPO = "821214029068.dkr.ecr.ap-south-1.amazonaws.com/bloodx"
  }

  stages {

    stage('Checkout') {
      steps {
        git branch: 'main', url: 'https://github.com/HemantRegmi/bloodX.git'
      }
    }

    stage('Build Docker Image') {
      steps {
        sh 'docker build -t bloodx .'
      }
    }

    stage('Login to ECR') {
      steps {
        sh '''
          REGISTRY=$(echo $ECR_REPO | cut -d'/' -f1)
          aws ecr get-login-password --region $AWS_REGION \
          | docker login --username AWS --password-stdin $REGISTRY
        '''
      }
    }

    stage('Push Image') {
      steps {
        sh '''
          docker tag bloodx:latest $ECR_REPO:latest
          docker push $ECR_REPO:latest
        '''
      }
    }

    stage('Deploy to Production') {
      steps {
        sh '''
          echo "Starting Zero-Downtime Deployment..."
          
          # 1. Scale Up to 2 Instances
          echo "[1/3] Scaling Up to 2 Instances..."
          aws autoscaling update-auto-scaling-group --auto-scaling-group-name bloodx-asg --desired-capacity 2 --region $AWS_REGION

          # 2. Wait for BOTH instances to be Healthy in ALB
          echo "[2/3] Waiting for New Instance to handle traffic..."
          TG_ARN=$(aws elbv2 describe-target-groups --names bloodx-blue --query "TargetGroups[0].TargetGroupArn" --output text --region $AWS_REGION)
          
          MAX_RETRIES=40 # 40 * 10s = 400s Timeout
          COUNT=0
          while [ $COUNT -lt $MAX_RETRIES ]; do
            # Count healthy targets using JMESPath length()
            HEALTHY_COUNT=$(aws elbv2 describe-target-health --target-group-arn $TG_ARN --region $AWS_REGION --query "length(TargetHealthDescriptions[?TargetHealth.State=='healthy'])" --output text)
            
            echo "Healthy Targets: $HEALTHY_COUNT / 2"
            
            if [ "$HEALTHY_COUNT" -ge 2 ]; then
              echo "SUCCESS: Both instances are healthy!"
              break
            fi
            
            sleep 10
            COUNT=$((COUNT+1))
          done

          if [ $COUNT -ge $MAX_RETRIES ]; then
             echo "TIMEOUT: New instance failed to become healthy. Rolling back..."
             aws autoscaling update-auto-scaling-group --auto-scaling-group-name bloodx-asg --desired-capacity 1 --region $AWS_REGION
             exit 1
          fi

          # 3. Scale Down to 1 (Oldest will be terminated)
          echo "[3/3] Scaling Down to 1 (Terminating Old Instance)..."
          aws autoscaling update-auto-scaling-group --auto-scaling-group-name bloodx-asg --desired-capacity 1 --region $AWS_REGION
          echo "Deployment Complete. Zero Downtime Achieved."
        '''
      }
    }
  }
}
