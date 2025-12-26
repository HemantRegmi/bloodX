#!/bin/bash
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

# Wait for network to be fully establishing
sleep 10

retry_command sudo apt update -y

# Wait for any existing apt locks to release
while sudo fuser /var/lib/dpkg/lock >/dev/null 2>&1; do sleep 5; done
while sudo fuser /var/lib/apt/lists/lock >/dev/null 2>&1; do sleep 5; done

retry_command sudo apt install -y docker.io docker-compose-v2 prometheus-node-exporter

# Add ubuntu user to docker group
sudo usermod -aG docker ubuntu
sudo systemctl enable docker
sudo systemctl restart docker

# Create directory structure
mkdir -p /home/ubuntu/monitoring
cd /home/ubuntu/monitoring

# Create Prometheus Config
cat <<EOF > prometheus.yml
global:
  scrape_interval: 15s

scrape_configs:
  - job_name: 'node'
    static_configs:
      - targets: ['localhost:9100']
EOF

# Create Docker Compose
cat <<EOF > docker-compose.yml
version: '3'
services:
  prometheus:
    image: prom/prometheus
    volumes:
      - ./prometheus.yml:/etc/prometheus/prometheus.yml
    network_mode: "host"
    restart: always

  grafana:
    image: grafana/grafana
    network_mode: "host"
    restart: always
EOF

# Start services
docker compose up -d
