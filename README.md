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

![Architecture Diagram](docs/images/architecture_v13.png)

---

## 📸 Project Screenshots

### 1. Live Application
A responsive, user-friendly interface for donors and seekers.
![Home Page](docs/images/bloodx-website.png)

### 2. AWS Infrastructure
Fully automated infrastructure provisioning using Terraform.
![AWS Instances](docs/images/aws-infrastructure.png)

### 3. Database
<img width="1900" height="867" alt="Screenshot 2025-12-20 112608" src="https://github.com/user-attachments/assets/dbd64c93-9209-4fd9-bc04-c3697e612a21" />

### 4. AWS ECR
<img width="1907" height="867" alt="Screenshot 2025-12-20 112649" src="https://github.com/user-attachments/assets/79f26647-d9c5-4f32-bad2-1a05928f11cb" />

### 5. CI/CD Pipeline
Automated build, test, and deploy via Jenkins.
<img width="1899" height="913" alt="Screenshot 2025-12-20 154336" src="https://github.com/user-attachments/assets/9dffd036-9bb4-4a42-b936-b7cea49e929b" />


### 6. System Monitoring
Real-time observability of CPU, RAM, and Network trafffic using Grafana.
![Grafana Dashboard](docs/images/grafana-monitoring.png)


## 🛡️ Service Reliability & Persistence

To ensure high availability for mission-critical DevOps tools, we implement strict persistence strategies:

### 1. Jenkins Server (Systemd)
- **Mechanism:** Managed via `systemd` (Linux Service Manager).
- **Configuration:** Service is explicitly enabled (`sudo systemctl enable jenkins`) during provisioning.
- **Behavior:** Automatically starts on boot and restarts in case of process crashes.

### 2. Monitoring Stack (Docker Restart Policies)
- **Mechanism:** Docker Compose `restart` policies.
- **Configuration:** Prometheus and Grafana containers are configured with `restart: always`.
- **Behavior:** The Docker daemon ensures these containers are always running, even after a host reboot or daemon crash.






