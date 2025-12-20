resource "tls_private_key" "pk" {
  algorithm = "RSA"
  rsa_bits  = 4096
}

resource "aws_key_pair" "kp" {
  key_name   = var.ssh_key_name
  public_key = tls_private_key.pk.public_key_openssh
}

resource "local_file" "pem_file" {
  filename = "${path.module}/${var.ssh_key_name}.pem"
  content  = tls_private_key.pk.private_key_pem
  file_permission = "0400"
}
