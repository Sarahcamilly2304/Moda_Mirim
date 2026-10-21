<?php
require_once '../database/connect.php';
require_once '../includes/header.php';

$metodo = $_GET['metodo'] ?? 'Pix';
?>

<div style="text-align: center; padding: 3rem 1rem;">
    <h1 style="color: #802A41; font-size: 2.5rem; margin-bottom: 1rem;">Pedido Realizado com Sucesso! 🎉</h1>
    <p style="font-size: 1.2rem; margin-bottom: 1.5rem;">Obrigado por comprar na Moda Mirim.</p>
    
    <div class="form-box" style="max-width: 400px; margin: 0 auto; text-align: left;">
        <p><strong>Forma de Pagamento:</strong> <?= htmlspecialchars($metodo); ?></p>
        <p><strong>Status:</strong> Aguardando Confirmação</p>
        <br>
        <?php if ($metodo === 'Pix'): ?>
            <p style="text-align: center; background: #eee; padding: 10px;">[ QR CODE PIX SIMULADO ]</p>
        <?php endif; ?>
    </div>

    <br><br>
    <a href="/index.php" class="btn" style="text-decoration: none;">Voltar para a Página Inicial</a>
</div>

<?php require_once '../includes/footer.php'; ?>