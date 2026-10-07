<?php
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moda Mirim - Moda Praia </title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

    <header class="top-header">
        <div class="search-link">
        </div>

        <a href="/index.php" class="logo-brand">MODA MIRIM</a>

        <div class="user-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Olá, <?= htmlspecialchars($_SESSION['user_nome']); ?></span>
                <a href="/login/logout.php">SAIR</a>
            <?php else: ?>
                <a href="/login/login.php">LOGIN</a>
                <a href="/login/cadastrar.php">CADASTRE-SE</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- 2. Barra de Navegação Coral -->
    <nav class="main-nav-bar">
        <div class="nav-left">
            <button class="category-btn">
                CATEGORY ☰
            </button>

            <ul class="menu-links">
                <li><a href="/index.php">HOME</a></li>
                <li><a href="/app/select_w.php?categoria=meninas">MENINAS</a></li>
                <li><a href="/app/select_w.php?categoria=meninos">MENINOS</a></li>
                <li><a href="/app/select_w.php?categoria=acessorios">ACESSÓRIOS</a></li>
                <li><a href="/app/select.php">PRODUTOS</a></li>
            </ul>
        </div>

        <div class="cart-btn-top">
            🛒 CART - 0 ITEMS
        </div>
    </nav>

    <main class="main-content"></main>