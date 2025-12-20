#!/bin/bash
sudo apt update -y
# Wait for any existing apt locks to release
while sudo fuser /var/lib/dpkg/lock >/dev/null 2>&1; do sleep 5; done
while sudo fuser /var/lib/apt/lists/lock >/dev/null 2>&1; do sleep 5; done
sudo apt install -y docker.io docker-compose-v2 prometheus-node-exporter

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
    ports:
      - "3000:3000"
EOF

# Start services
docker compose up -d
