<?php
session_start();
session_unset();
session_destroy();
header("location: /Dashboard/login.php?msg=sessionClosed");
?>
