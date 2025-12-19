# BloodX - Cloud-Native Blood Donation System

BloodX is a modern, scalable Blood Donation Management System deployed on **AWS** using **Terraform** (Infrastructure as Code) and **Jenkins** (CI/CD). It connects donors with patients in need, featuring a robust admin dashboard and real-time monitoring.

---

## 🏗️ Architecture
This project demonstrates a complete real-world **DevOps** lifecycle:
- **Cloud Provider:** AWS (VPC, Public/Private Subnets, IGW, NAT Gateway).
- **Compute:** Auto Scaling Group (EC2 t3.micro) behind an Application Load Balancer.
- **Database:** Amazon RDS (MySQL 8) in a private subnet.
- **CI/CD:** Jenkins Pipeline with Docker & Amazon ECR.
- **Monitoring:** Prometheus & Grafana for real-time system metrics.
- **Security:** Strict Security Groups, Bastion Host for SSH access.

![Architecture Diagram](docs/images/architecture.png)

---

## 📸 Project Screenshots

### 1. Live Application
A responsive, user-friendly interface for donors and seekers.
![Home Page](docs/images/bloodx-website.png)

### 2. AWS Infrastructure
Fully automated infrastructure provisioning using Terraform.
![AWS Instances](docs/images/aws-infrastructure.png)

### 3. CI/CD Pipeline
Automated build, test, and deploy via Jenkins.
![Jenkins Pipeline](docs/images/jenkins-pipeline.png)

### 4. System Monitoring
Real-time observability of CPU, RAM, and Network trafffic using Grafana.
![Grafana Dashboard](docs/images/grafana-monitoring.png)

---





