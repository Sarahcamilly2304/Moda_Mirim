<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../database/connect.php';

// Lógica de manipulação do carrinho
$acao = $_GET['acao'] ?? '';
$id = $_GET['id'] ?? null;

if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar produto
if ($acao === 'add' && $id) {
    if (isset($_SESSION['carrinho'][$id])) {
        if (is_array($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id] = (int)$_SESSION['carrinho'][$id] + 1;
        }
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
    $backUrl = $_SERVER['HTTP_REFERER'] ?? '/app/select.php';
    header("Location: " . $backUrl);
    exit;
}

// Remover produto
if ($acao === 'del' && $id) {
    unset($_SESSION['carrinho'][$id]);
    header("Location: /app/carrinho.php");
    exit;
}

// Limpar carrinho
if ($acao === 'limpar') {
    $_SESSION['carrinho'] = [];
    header("Location: /app/carrinho.php");
    exit;
}

// Lista base de produtos para consulta do carrinho
$produtosMock = [
    1 => ['nome' => 'Maiô Infantil Sereia Proteção UV50+', 'preco' => 89.90, 'imagem' => 'limao.jpg'],
    2 => ['nome' => 'Maiô Floral Babados Moda Praia', 'preco' => 79.90, 'imagem' => '6ansmasc.fem.jpg'],
    3 => ['nome' => 'Biquíni Infantil Estampa Limão Siciliano', 'preco' => 69.90, 'imagem' => '2anosmasc.jpg'],
    4 => ['nome' => 'Sunga Infantil Masculina 2 Anos', 'preco' => 49.90, 'imagem' => 'meninoskit.jpg'],
    5 => ['nome' => 'Conjunto Camisa UV Infantil Especial', 'preco' => 89.90, 'imagem' => 'limao.jpg']
];

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container" style="padding: 30px 20px; max-width: 1000px; margin: 0 auto; min-height: 65vh;">
    <h2 style="color: #802A41; margin-bottom: 20px; text-align: center;">Seu Carrinho de Compras</h2>

    <?php if (!empty($_SESSION['carrinho'])): ?>
        <div style="background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 20px; border: 1px solid #e2e2e2; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #802A41; color: #802A41;">
                        <th style="padding: 12px;">Produto</th>
                        <th style="padding: 12px;">Preço</th>
                        <th style="padding: 12px; text-align: center;">Qtd</th>
                        <th style="padding: 12px;">Subtotal</th>
                        <th style="padding: 12px; text-align: center;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalGeral = 0;
                    foreach ($_SESSION['carrinho'] as $prodId => $qtd): 
                        if (!is_numeric($qtd) || $qtd <= 0) continue;
                        
                        $item = $produtosMock[$prodId] ?? ['nome' => "Produto #$prodId", 'preco' => 50.00, 'imagem' => 'logo.jpg'];
                        $subtotal = $item['preco'] * $qtd;
                        $totalGeral += $subtotal;
                    ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px; display: flex; align-items: center; gap: 12px;">
                                <img src="/imagens/<?= htmlspecialchars($item['imagem']); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;" onerror="this.src='/imagens/logo.jpg';">
                                <span style="font-weight: bold; color: #333;"><?= htmlspecialchars($item['nome']); ?></span>
                            </td>
                            <td style="padding: 12px; color: #555;"><?= formatarPreco($item['preco']); ?></td>
                            <td style="padding: 12px; text-align: center; font-weight: bold;"><?= $qtd; ?></td>
                            <td style="padding: 12px; color: #802A41; font-weight: bold;"><?= formatarPreco($subtotal); ?></td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="/app/carrinho.php?acao=del&id=<?= $prodId; ?>" style="color: #dc3545; text-decoration: none; font-weight: bold; font-size: 1.2rem;" title="Remover">✕</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="text-align: right; margin-top: 25px; padding-top: 15px; border-top: 1px solid #ddd;">
                <h3 style="margin-bottom: 15px; color: #333;">Total: <span style="color: #802A41; font-size: 1.5rem; font-weight: bold;"><?= formatarPreco($totalGeral); ?></span></h3>
                
                <div style="display: flex; justify-content: flex-end; gap: 10px; flex-wrap: wrap;">
                    <a href="/app/carrinho.php?acao=limpar" class="btn" style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">Esvaziar Carrinho</a>
                    <a href="/app/select.php" class="btn" style="background: #D3A79A; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">Continuar Comprando</a>
                    <a href="/app/checkout.php" class="btn" style="background: #802A41; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; box-shadow: 0 3px 6px rgba(128,42,65,0.25);">Ir para o Pagamento</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div style="text-align: center; background: #fff; padding: 40px; border-radius: 8px; border: 1px solid #e2e2e2;">
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 20px;">O seu carrinho está vazio.</p>
            <a href="/app/select.php" class="btn" style="background: #802A41; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">Ver Produtos</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>