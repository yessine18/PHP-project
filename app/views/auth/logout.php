<?php
session_start();
session_destroy();
ob_start(); // Clear any previous output
header("Location: /app/views/auth/login.php");
exit();

?>
