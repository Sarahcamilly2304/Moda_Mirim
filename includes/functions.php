<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function sanitizar($dado) {
    return htmlspecialchars(strip_tags(trim($dado)));
}

function formatarPreco($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>