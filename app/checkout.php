<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

// Simulador de conclusão de pedido
$pedidoFinalizado = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedidoFinalizado = true;
    $_SESSION['carrinho'] = []; // Limpa o carrinho simulado
}

// Cálculo do total fictício do carrinho
$totalGeral = 0;
if (!empty($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
    $precosMock = [1 => 89.90, 2 => 79.90, 3 => 69.90, 4 => 49.90, 5 => 89.90];
    foreach ($_SESSION['carrinho'] as $id => $qtd) {
        $preco = $precosMock[$id] ?? 50.00;
        $totalGeral += $preco * $qtd;
    }
} else {
    $totalGeral = 159.80; // Valor demonstrativo caso abra o checkout direto
}
?>

<div class="container" style="padding: 30px 20px; max-width: 900px; margin: 0 auto; min-height: 70vh;">

    <?php if ($pedidoFinalizado): ?>
        <!-- Tela demonstrativa de sucesso -->
        <div style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); text-align: center; border: 1px solid #e2e2e2;">
            <div style="font-size: 3rem; color: #28a745; margin-bottom: 10px;">✓</div>
            <h2 style="color: #c44768; margin-bottom: 10px;">Pedido entregue com Sucesso!</h2>
            <p style="color: #555; font-size: 1.05rem; margin-bottom: 20px;">
                 Nenhum valor real será cobrado.
            </p>
            <p style="font-weight: bold; color: #333; margin-bottom: 25px;">Número do Pedido: #<?= rand(10000, 99999); ?></p>
            <a href="/app/select.php" class="btn" style="background: #802A41; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">Voltar para a Loja</a>
        </div>

    <?php else: ?>

        <h2 style="color: #802A41; text-align: center; margin-bottom: 25px;">Finalizar Compra </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
            
    
            <div style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #e2e2e2; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <h3 style="color: #333; font-size: 1.1rem; margin-bottom: 15px; border-bottom: 2px solid #80c5d2; padding-bottom: 8px;">
                 Dados de Entrega 
                </h3>

                <form method="POST" action="checkout.php" id="form-checkout" style="display: flex; flex-direction: column; gap: 12px;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: bold; color: #555; margin-bottom: 4px;">Nome Completo</label>
                        <input type="text" required placeholder="Ex: elisandra Silva" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: bold; color: #555; margin-bottom: 4px;">CEP</label>
                        <input type="text" required placeholder="00000-000" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: bold; color: #555; margin-bottom: 4px;">Endereço e Número</label>
                        <input type="text" required placeholder="Rua numero " style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                    </div>

                    <h3 style="color: #333; font-size: 1.1rem; margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #80c5d2; padding-bottom: 8px;">
                         Forma de Pagamento 
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px;">
                        <label style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="pagamento" value="pix" checked>
                            <strong>Pix</strong>
                        </label>

                        <label style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="pagamento" value="cartao">
                            <strong>Cartão de Crédito</strong> (Até 5x)
                        </label>

                        <label style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="pagamento" value="boleto">
                            <strong>Boleto Bancário</strong>
                        </label>
                    </div>

                    <button type="submit" style="background: #80c5d2; color: white; border: none; padding: 14px; border-radius: 6px; font-weight: bold; font-size: 1.05rem; cursor: pointer; box-shadow: 0 3px 6px rgba(128,42,65,0.25);">
                        Concluir Pedido
                    </button>
                </form>
            </div>

            <!-- Resumo do Pedido -->
            <div style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #e2e2e2; box-shadow: 0 4px 12px rgba(0,0,0,0.05); height: fit-content;">
                <h3 style="color: #333; font-size: 1.1rem; margin-bottom: 15px; border-bottom: 2px solid #80c5d2; padding-bottom: 8px;">
                    Resumo do Pedido
                </h3>

                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                    <span>Subtotal</span>
                    <span><?= formatarPreco($totalGeral); ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                    <span>Frete</span>
                    <span style="color: #76e590; font-weight: bold;">GRÁTIS</span>
                </div>

                <hr style="border: none; border-top: 1px dashed #ccc; margin: 15px 0;">

                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: bold; color: #000000;">
                    <span>Total</span>
                    <span><?= formatarPreco($totalGeral); ?></span>
                </div>

                <p style="font-size: 0.8rem; color: #777; margin-top: 20px; text-align: center;">
                 Ambiente 100% seguro.
                </p>
            </div>

        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>