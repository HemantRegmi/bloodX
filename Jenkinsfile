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
          echo "Triggering Auto Scaling Instance Refresh..."
          aws autoscaling start-instance-refresh --auto-scaling-group-name bloodx-asg
        '''
      }
    }
  }
}
