#!/bin/bash
set -e

echo "Starting automated repair of Monitoring Server..."

# 1. Install Docker
echo "Installing Docker..."
sudo apt-get update -y
sudo apt-get install -y docker.io docker-compose-v2

# 2. Setup Configs
echo "Configuring Grafana and Prometheus..."
mkdir -p /home/ubuntu/monitoring
cd /home/ubuntu/monitoring

# Prometheus Config
cat <<EOF > prometheus.yml
global:
  scrape_interval: 15s

scrape_configs:
  - job_name: 'node'
    static_configs:
      - targets: ['localhost:9100']
EOF

# Docker Compose
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

  node-exporter:
    image: prom/node-exporter:latest
    network_mode: "host"
    restart: always
EOF

# 3. Start Services
echo "Starting Containers..."
sudo usermod -aG docker ubuntu
sudo docker compose up -d

echo "Repair Complete! Grafana should be running."
