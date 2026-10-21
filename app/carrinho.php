<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

require_once __DIR__ . '/../includes/footer.php';
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$acao = $_GET['acao'] ?? '';
$id = (int)($_GET['id'] ?? 0);

// Adicionar produto
if ($acao === 'add' && $id > 0) {
    $nome = 'Produto Moda Mirim';
    $preco = 89.90;

    // 1. Procura no banco de dados se houver conexão
    if (isset($conn) && $conn) {
        try {
            $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $prod = $stmt->fetch();
            if ($prod) {
                $nome = $prod['nome'];
                $preco = (float)$prod['preco'];
            }
        } catch (PDOException $e) {}
    } else {
        // 2. Mapeamento de fallback de produtos estáticos
        $produtosExemplo = [
            1 => ['nome' => 'Maiô Infantil Sereia Proteção UV50+', 'preco' => 89.90],
            2 => ['nome' => 'Maiô Floral Babados Moda Praia', 'preco' => 79.90],
            3 => ['nome' => 'Biquíni Infantil Estampa Limão Siciliano', 'preco' => 69.90],
            4 => ['nome' => 'Sunga Infantil Masculina 2 Anos', 'preco' => 49.90],
            5 => ['nome' => 'Conjunto Praia Infantil Proteção UV 50+', 'preco' => 89.90]
        ];
        if (isset($produtosExemplo[$id])) {
            $nome = $produtosExemplo[$id]['nome'];
            $preco = $produtosExemplo[$id]['preco'];
        }
    }

    // Grava no carrinho
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['qtd'] += 1;
    } else {
        $_SESSION['carrinho'][$id] = [
            'id'    => $id,
            'nome'  => $nome,
            'preco' => $preco,
            'qtd'   => 1
        ];
    }

    header("Location: /app/carrinho.php");
    exit();
}

// Remover item
if ($acao === 'remove' && $id > 0) {
    unset($_SESSION['carrinho'][$id]);
    header("Location: /app/carrinho.php");
    exit();
}

// Limpar carrinho
if ($acao === 'limpar') {
    $_SESSION['carrinho'] = [];
    header("Location: /app/carrinho.php");
    exit();
}

$totalGeral = 0;
?>

<div class="container">
    <h2>Seu Carrinho de Compras</h2>

    <?php if (!empty($_SESSION['carrinho'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th style="text-align: center;">Qtd</th>
                    <th>Subtotal</th>
                    <th style="text-align: center;">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrinho'] as $item): 
                    if (!is_array($item)) continue;
                    $subtotal = $item['preco'] * $item['qtd'];
                    $totalGeral += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']); ?></td>
                        <td><?= formatarPreco($item['preco']); ?></td>
                        <td style="text-align: center;"><?= $item['qtd']; ?></td>
                        <td><?= formatarPreco($subtotal); ?></td>
                        <td style="text-align: center;">
                            <a href="/app/carrinho.php?acao=remove&id=<?= $item['id']; ?>" style="color: #C81912; font-weight: bold;">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: right; margin-top: 2rem;">
            <h3>Total: <span style="color: #802A41;"><?= formatarPreco($totalGeral); ?></span></h3>
            <br>
            <a href="/app/carrinho.php?acao=limpar" class="btn btn-danger" style="margin-right: 10px;">Esvaziar Carrinho</a>
            <a href="/app/checkout.php" class="btn">Ir para o Pagamento</a>
        </div>
    <?php else: ?>
        <p style="margin-top: 1.5rem; color: #555;">O seu carrinho está vazio.</p>
        <br>
        <a href="/app/select.php" class="btn">Ver Produtos</a>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>