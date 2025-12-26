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
          echo "Deploying to Production Environment..."
           
          # 1. Scale Out to 2 Instances
          aws autoscaling update-auto-scaling-group --auto-scaling-group-name bloodx-asg --desired-capacity 2 --region $AWS_REGION
          
          echo "Waiting for 2nd instance to START and pass HEALTH CHECKS..."
          
          # 2. Wait for ALB to report 2 Healthy Hosts
          # Fetch ARN using AWS CLI since Terraform is not installed on the agent
          TG_ARN=$(aws elbv2 describe-target-groups --names bloodx-blue --region $AWS_REGION --query "TargetGroups[0].TargetGroupArn" --output text)
          
          while true; do
            HEALTHY_COUNT=$(aws elbv2 describe-target-health --target-group-arn $TG_ARN --region $AWS_REGION --query "TargetHealthDescriptions[?TargetHealth.State=='healthy'].length(@)" --output text)
            echo "Current Healthy Hosts: $HEALTHY_COUNT"
            
            if [ "$HEALTHY_COUNT" -ge 2 ]; then
              echo "Success! Both instances are healthy. Traffic is safe."
              break
            fi
            
            echo "Waiting for new instance to be healthy..."
            sleep 10
          done

          # 3. Scale In (Remove Old Instance)
          echo "Scaling down to 1 instance..."
          aws autoscaling update-auto-scaling-group --auto-scaling-group-name bloodx-asg --desired-capacity 1 --region $AWS_REGION
        '''
      }
    }
  }
}
