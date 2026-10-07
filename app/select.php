<?php
require_once '../database/conexao.php';
require_once '../includes/header.php';

$produtos = [];

if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        $produtos = [];
    }
}
?>

<div class="container">
    <h2>Listagem Geral de Produtos</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($p['nome'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($p['categoria'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($p['tamanho'] ?? ''); ?></td>
                        <td><?= function_exists('formatarPreco') ? formatarPreco($p['preco'] ?? 0) : 'R$ ' . number_format($p['preco'] ?? 0, 2, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($p['estoque'] ?? 0); ?></td>
                        <td>
                            <a href="update.php?id=<?= $p['id']; ?>">Editar</a> |
                            <a href="delete.php?id=<?= $p['id']; ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhum produto cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>