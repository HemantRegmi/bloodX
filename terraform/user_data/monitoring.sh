#!/bin/bash
sudo apt update -y
sudo apt install -y docker.io docker-compose-v2

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
    ports:
      - "9090:9090"

  grafana:
    image: grafana/grafana
    ports:
      - "3000:3000"
EOF

# Start services
docker compose up -d
