<?php
require_once __DIR__ . '/../includes/functions.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /login/login.php");
    exit();
}

function verificarAdmin() {
    if ($_SESSION['usuario_perfil'] !== 'admin') {
        echo "<h2 style='text-align:center; padding: 2rem;'>Acesso restrito para Administradores.</h2>";
        exit();
    }
}
?>