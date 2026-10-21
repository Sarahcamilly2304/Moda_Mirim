<?php
require_once '../includes/functions.php';
session_destroy();
header("Location: /login/login.php");
exit();
?>