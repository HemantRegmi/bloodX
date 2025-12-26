resource "aws_autoscaling_lifecycle_hook" "draining" {
  name                   = "bloodx-connection-draining"
  autoscaling_group_name = aws_autoscaling_group.app.name
  default_result         = "CONTINUE"
  heartbeat_timeout      = 300
  lifecycle_transition   = "autoscaling:EC2_INSTANCE_TERMINATING"
}
