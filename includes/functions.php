<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function sanitizar($dado) {
    return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
}

function formatarPreco($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>