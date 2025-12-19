<?php
session_start();
session_unset();
session_destroy();
usleep(500000);
header("Location: home.php?logged_out=1");
exit;
?> 