# BloodX Deployment Guide (PowerShell Edition)

This guide provides a step-by-step procedure to deploy the BloodX Secure & Highly Available architecture on AWS using Terraform, tailored for **Windows PowerShell**.

## Prerequisites

Ensure you have the following installed by running these commands in PowerShell:
1.  **Terraform**: [Download & Install](https://developer.hashicorp.com/terraform/downloads)
    ```powershell
    terraform version
    ```
2.  **AWS CLI**: [Download & Install](https://aws.amazon.com/cli/)
    ```powershell
    aws --version
    ```

## Step 1: Configure Credentials

1.  Open PowerShell.
2.  Configure your AWS credentials:
    ```powershell
    aws configure
    ```
    - Enter your **AWS Access Key ID**.
    - Enter your **AWS Secret Access Key**.
    - Default region name: `ap-south-1`
    - Default output format: `json`

## Step 2: Prepare Infrastructure Keys

1.  Ensure you are in the `terraform` directory.
2.  Copy the key from the parent directory if it's not already there:
    ```powershell
    Copy-Item ..\bloodx-deploy-key.pem .\bloodx-deploy-key.pem -ErrorAction SilentlyContinue
    ```
    *If you don't have the key there, please ensure you have downloaded `bloodx-deploy-key.pem` from AWS to the `bloodX` folder.*

3.  **Critical Security Step**: Run this PowerShell command to secure the key:
    ```powershell
    # Reset permissions
    icacls bloodx-deploy-key.pem /reset

    # Grant read-only access to the current user
    icacls bloodx-deploy-key.pem /grant:r "$($env:USERNAME):R"

    # Remove inherited permissions
    icacls bloodx-deploy-key.pem /inheritance:r
    ```

## Step 3: Initialize and Apply Terraform

1.  Ensure you are in the `terraform` directory:
    ```powershell
    cd c:\Users\heman\Downloads\bloodX\terraform
    ```
2.  Initialize Terraform:
    ```powershell
    terraform init
    ```
3.  Review the plan:
    ```powershell
    terraform plan
    ```
4.  Apply the configuration:
    ```powershell
    terraform apply -auto-approve
    ```
    - **Note the Outputs**: At the end, look for `bastion_public_ip`, `jenkins_private_ip`, `monitoring_private_ip`, and `alb_dns_name`.

## Step 4: Access Bastion Host

1.  Use the SSH command (Windows 10/11 includes OpenSSH):
    ```powershell
    # Replace <BASTION_PUBLIC_IP> with the actual IP from outputs
    ssh -i bloodx-deploy-key.pem ubuntu@<BASTION_PUBLIC_IP>
    ```

## Step 5: Configure Jenkins

Since Jenkins is in a private subnet, you must tunnel through the Bastion.

1.  **Open an SSH Tunnel** (Open a **new** PowerShell window):
    ```powershell
    # Replace variables with actual values
    $BastionIP = "<BASTION_PUBLIC_IP>"
    $JenkinsIP = "<JENKINS_PRIVATE_IP>"
    
    ssh -i bloodx-deploy-key.pem -L 8080:${JenkinsIP}:8080 ubuntu@${BastionIP}
    ```
2.  Open your browser and go to `http://localhost:8080`.
3.  **Unlock Jenkins**:
    - Switch back to your **Bastion SSH** window (Step 4).
    - SSH from Bastion to Jenkins:
      ```bash
      ssh ubuntu@<JENKINS_PRIVATE_IP>
      sudo cat /var/lib/jenkins/secrets/initialAdminPassword
      ```
    - Paste the password into the browser.

## Step 6: Configure Monitoring (Prometheus/Grafana)

1.  **Open an SSH Tunnel** (Open a **new** PowerShell window):
    ```powershell
    # Replace variables with actual values
    $BastionIP = "<BASTION_PUBLIC_IP>"
    $MonitoringIP = "<MONITORING_PRIVATE_IP>"
    
    ssh -i bloodx-deploy-key.pem -L 3000:${MonitoringIP}:3000 -L 9090:${MonitoringIP}:9090 ubuntu@${BastionIP}
    ```
2.  **Access Grafana**: `http://localhost:3000` (Default: admin/admin).
3.  **Access Prometheus**: `http://localhost:9090`.

## Step 7: Finalize Application Deployment

1.  Go to Jenkins (`http://localhost:8080`).
2.  Create a new Pipeline job.
3.  Connect it to your GitHub repo: `https://github.com/HemantRegmi/bloodX.git`.
4.  Run the pipeline.
5.  Wait for the ASG to launch instances.
6.  Access: `https://bloodx.tech`.

