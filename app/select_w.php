<?php
require_once '../database/conexao.php';
require_once '../includes/header.php';

$categoria = isset($_GET['categoria']) ? sanitizar($_GET['categoria']) : '';

$categoria = $_GET['categoria'] ?? '';
$produtos = [];

if (isset($pdo) && !empty($categoria)) {
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE LOWER(categoria) LIKE LOWER(:categoria) ORDER BY id DESC");
$stmt->execute(['categoria' => '%' . trim($categoria) . '%']);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($pdo)) {

    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container">
    <h2>Produtos Filtrados <?= $categoria ? '- ' . htmlspecialchars(ucfirst($categoria)) : ''; ?></h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nome'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($p['categoria'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($p['tamanho'] ?? ''); ?></td>
                        <td><?= function_exists('formatarPreco') ? formatarPreco($p['preco'] ?? 0) : 'R$ ' . number_format($p['preco'] ?? 0, 2, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($p['estoque'] ?? 0); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum produto encontrado nesta categoria.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>