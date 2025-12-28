#!/bin/bash
sudo apt update -y
# Wait for any existing apt locks to release
while sudo fuser /var/lib/dpkg/lock >/dev/null 2>&1; do sleep 5; done
while sudo fuser /var/lib/apt/lists/lock >/dev/null 2>&1; do sleep 5; done
# Function to retry commands
retry_command() {
  local -i max_attempts=5
  local -i attempt=1
  local -i sleep_time=10

  until "$@"; do
    if (( attempt == max_attempts )); then
      echo "Command '$@' failed after $max_attempts attempts. Exiting."
      exit 1
    fi
    echo "Command '$@' failed. Retrying in $sleep_time seconds... (Attempt $attempt/$max_attempts)"
    sleep $sleep_time
    ((attempt++))
  done
}

# Wait for network
sleep 30

retry_command sudo apt update -y

# Install Java
retry_command sudo apt install -y openjdk-17-jre-headless fontconfig java-common
curl -fsSL https://pkg.jenkins.io/debian-stable/jenkins.io-2023.key | sudo tee \
  /usr/share/keyrings/jenkins-keyring.asc > /dev/null
echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] \
  https://pkg.jenkins.io/debian-stable binary/ | sudo tee \
  /etc/apt/sources.list.d/jenkins.list > /dev/null
sudo apt-get update -y
sudo apt-get install -y jenkins prometheus-node-exporter

# Install Docker
sudo apt-get install -y docker.io
sudo usermod -aG docker jenkins
sudo usermod -aG docker ubuntu
sudo systemctl restart docker
sudo systemctl enable jenkins
sudo systemctl restart jenkins

# Install AWS CLI
sudo apt install -y awscli
