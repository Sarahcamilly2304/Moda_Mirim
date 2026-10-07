<?php
require_once __DIR__ . '/../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login/login.php");
    exit;
}
?>