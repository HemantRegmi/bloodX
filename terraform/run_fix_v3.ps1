$ErrorActionPreference = "Stop"
$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $ScriptDir

$BastionIP = "52.66.176.18"
$PrivateIP = "10.0.11.20"

Write-Host "Auto-Fixer V3 (Line-Ending Fix)"
Write-Host "-------------------------------"

# 1. Identify Key
$KeyFile = "bloodx-deploy-key.pem"
if (-not (Test-Path $KeyFile)) {
    $KeyFile = "bloodx-key.pem"
}

if (-not (Test-Path $KeyFile)) {
    Write-Host "Error: No key file found in $ScriptDir"
    exit 1
}

Write-Host "Using Key: $KeyFile"
$AbsKeyPath = Convert-Path $KeyFile

# 2. Upload files to Bastion
Write-Host "Step 1: Uploading tools to Bastion Host..."
try {
    # Upload Key
    scp -i $AbsKeyPath -o StrictHostKeyChecking=no $AbsKeyPath ubuntu@${BastionIP}:/home/ubuntu/temp_deploy_key.pem
    if ($LASTEXITCODE -ne 0) { throw "SCP Key failed" }
    
    # Upload Script
    scp -i $AbsKeyPath -o StrictHostKeyChecking=no "$ScriptDir\install_fix.sh" ubuntu@${BastionIP}:/home/ubuntu/install_fix.sh
    if ($LASTEXITCODE -ne 0) { throw "SCP Script failed" }
} catch {
    Write-Host "Failed to upload files. Check connection/VPN."
    exit 1
}

# 3. Execute from Bastion
Write-Host "Step 2: Triggering installation from Bastion..."

# We construct the bash script but strictly force LF newlines and sanitize remote files
$RemoteCommands = @'
set -e
# Fix potentially broken line endings from upload
sed -i 's/\r$//' install_fix.sh
# Set strict permissions on key
chmod 600 temp_deploy_key.pem
chmod +x install_fix.sh

echo "Transferring script to Monitoring Server..."
scp -i temp_deploy_key.pem -o StrictHostKeyChecking=no install_fix.sh ubuntu@10.0.11.20:/home/ubuntu/install_fix.sh

echo "Executing script on Monitoring Server..."
ssh -i temp_deploy_key.pem -o StrictHostKeyChecking=no ubuntu@10.0.11.20 'sed -i "s/\r$//" /home/ubuntu/install_fix.sh && chmod +x /home/ubuntu/install_fix.sh && sudo /home/ubuntu/install_fix.sh'

# Cleanup
rm temp_deploy_key.pem install_fix.sh
echo "DONE"
'@

# Replace Windows CRLF with Unix LF for the command string itself
$RemoteCommandsUnix = $RemoteCommands -replace "`r`n", "`n"

try {
    # -T disables pseudo-tty allocation to avoid some interactions, though not strictly necessary here
    ssh -i $AbsKeyPath -o StrictHostKeyChecking=no -T ubuntu@${BastionIP} $RemoteCommandsUnix
} catch {
    Write-Host "Remote execution failed."
    Write-Host $_
    exit 1
}

Write-Host "-------------------------------"
Write-Host "Repair Complete. Please try your tunnel again."
