<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/functions.php';

$qtd_carrinho = 0;
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $item) {
        if (is_array($item)) {
            $qtd_carrinho += $item['qtd'];
        } else {
            $qtd_carrinho += (int)$item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moda Mirim - Moda Praia Infantil</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="top-bar">
    <span>conectato!</span>
    <div class="top-socials"></div>
</div>

<header class="main-header">
    <div class="logo">
        <a href="/index.php">Moda Mirim</a>
    </div>

<nav class="nav-menu">
    <a href="/index.php">HOME</a>
    <div class="dropdown">
        <a href="/app/select.php" class="dropbtn">PRODUTOS ▾</a>
        <div class="dropdown-content">
            <a href="/app/select.php">Todos os Produtos</a>
            <a href="/produtos/maio.php">Maiôs</a>
            <a href="/produtos/biquini.php">Biquínis</a>
            <a href="/produtos/sunga.php">Sungas</a>
            <a href="/produtos/Protecaouv.php">Camisas UV</a>
        </div>
    </div>
    <a href="/app/sobre.php">SOBRE NÓS</a>
    <a href="/app/contato.php">CONTATO</a>
</nav>

    <div class="header-icons">
        <a href="#"><i class="fas fa-search"></i></a>
        <a href="/login/login.php"><i class="far fa-user"></i></a>
        <a href="/app/carrinho.php" class="cart-icon">
            <i class="fas fa-shopping-bag"></i>
            <?php if ($qtd_carrinho > 0): ?>
                <span class="badge"><?= $qtd_carrinho; ?></span>
            <?php endif; ?>
        </a>
    </div>
</header>