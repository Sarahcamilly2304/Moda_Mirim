<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/login/verifica_user.php'; // Garante que o cliente esteja logado para pagar

if (empty($_SESSION['carrinho'])) {
    header("Location: select.php");
    exit();
}

// Calcular Total
$ids = implode(',', array_keys($_SESSION['carrinho']));
$stmt = $conn->query("SELECT * FROM produtos WHERE id IN ($ids)");
$produtos = $stmt->fetchAll();

$total = 0;
foreach ($produtos as $p) {
    $total += $p['preco'] * $_SESSION['carrinho'][$p['id']];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pagamento = $_POST['forma_pagamento'] ?? 'Pix';
    
    // Limpa o carrinho após finalizar o pedido
    unset($_SESSION['carrinho']);
    
    header("Location: confirmacao.php?metodo=" . urlencode($pagamento));
    exit();
}

require_once '../includes/header.php';
?>

<div class="form-box" style="max-width: 600px;">
    <h2>Finalizar Compra</h2>
    <p style="margin-bottom: 1.5rem;">Total do Pedido: <strong><?= formatarPreco($total); ?></strong></p>

    <form action="checkout.php" method="POST">
        <div class="form-group">
            <label>Escolha a Forma de Pagamento:</label>
            <div style="margin-top: 10px;">
                <label style="font-weight: normal; margin-bottom: 10px; display: block;">
                    <input type="radio" name="forma_pagamento" value="Pix" checked> ⚡ Pix (Aprovação Imediata)
                </label>
                <label style="font-weight: normal; margin-bottom: 10px; display: block;">
                    <input type="radio" name="forma_pagamento" value="Cartão de Crédito"> 💳 Cartão de Crédito (Até 6x sem juros)
                </label>
                <label style="font-weight: normal; margin-bottom: 10px; display: block;">
                    <input type="radio" name="forma_pagamento" value="Boleto Bancário"> 📄 Boleto Bancário
                </label>
            </div>
        </div>

        <button type="submit" class="btn" style="width: 100%; margin-top: 1rem;">Confirmar e Pagar</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>