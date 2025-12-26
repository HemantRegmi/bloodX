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
          
          # 1. Cancel any existing refresh (Cleanup)
          aws autoscaling cancel-instance-refresh --auto-scaling-group-name bloodx-asg --region $AWS_REGION || true
          
          # 2. Wait for it to clear
          while true; do
            STATUS=$(aws autoscaling describe-instance-refreshes --auto-scaling-group-name bloodx-asg --region $AWS_REGION --query "InstanceRefreshes[0].Status" --output text)
            if [[ "$STATUS" == "InProgress" ]] || [[ "$STATUS" == "Cancelling" ]]; then
              echo "ASG is busy ($STATUS). Waiting 10s..."
              sleep 10
            else
              break
            fi
          done

          # 3. Start New Refresh
          aws autoscaling start-instance-refresh --auto-scaling-group-name bloodx-asg --preferences '{"MinHealthyPercentage": 100, "InstanceWarmup": 300}' --region $AWS_REGION
        '''
      }
    }
  }
}
