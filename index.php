<?php
require_once 'database/conexao.php';
require_once 'includes/header.php';

?>


<section class="hero-banner">
    <div class="hero-content">
        <div class="hero-subtitle">Summer</div>
        <h1 class="hero-title">2026 COLLECTION<span></span></h1>
        <p class="hero-desc">GET UP TO 50% OFFER FOR ORDER OVER R$199</p>
        <a href="/app/select.php" class="btn-black" style="background: #ff5252; color: #fff; border-radius: 0; padding: 12px 28px;">VER COLEÇÃO</a>
    </div>

    <div class="hero-image-box">
        <!-- imagem -->
        <img src="https://via.placeholder.com/450x420?text=Moda+Praia+Infantil" alt="Moda Praia Infantil">
    </div>
</section>

<section class="features-bar">
    <div class="feature-item">
        <div class="feature-text">
            <h5>(19) 3000-0000</h5>
            <p>Atendimento 24/7</p>
        </div>
    </div>
    <div class="feature-item">
        <div class="feature-text">
            <h5>FRETE GRÁTIS</h5>
            <p>Em compras acima de R$199</p>
        </div>
    </div>
    <div class="feature-item">
        <div class="feature-text">
            <h5>20% DE DESCONTO</h5>
            <p>Na primeira compra</p>
        </div>
    </div>
    <div class="feature-item">
        <div class="feature-text">
            <h5>TROCA FÁCIL</h5>
            <p>Até 30 dias após compra</p>
        </div>
    </div>
</section>


<div class="container">
    <h3 style="text-align: center; font-size: 20px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 30px;">
        Lançamentos Moda Praia
    </h3>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 25px;">
    <?php if (!empty($produtos) && is_array($produtos)): ?>
        <?php foreach ($produtos as $p): ?>
            <div style="background: #fff; border: 1px solid #eee; padding: 15px; text-align: center;">
                <div style="background: #f9f9f9; height: 180px; margin-bottom: 15px; display:flex; align-items:center; justify-content:center; color:#aaa; font-weight: bold;">
                    PRODUTO
                </div>
                <h4 style="font-size: 14px; text-transform: uppercase; margin-bottom: 5px; color: #222;">
                    <?= htmlspecialchars($p['nome'] ?? ''); ?>
                </h4>
                <p style="font-size: 12px; color: #888; margin-bottom: 8px;">
                    Tamanho: <?= htmlspecialchars($p['tamanho'] ?? ''); ?>
                </p>
                <p style="font-weight: 800; font-size: 16px; color: #ff5252; margin-bottom: 12px;">
                    <?= function_exists('formatarPreco') ? formatarPreco($p['preco'] ?? 0) : 'R$ ' . number_format($p['preco'] ?? 0, 2, ',', '.'); ?>
                </p>
                <a href="#" class="btn-black" style="background: #222; color: #fff; font-size: 11px; padding: 8px 16px; text-transform: uppercase; border-radius: 0;">COMPRAR</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="grid-column: 1 / -1; text-align: center; color: #666;">Nenhum produto encontrado no momento.</p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>