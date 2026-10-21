<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

$categoria = $_GET['categoria'] ?? '';

if (!empty($categoria)) {
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE categoria = :categoria ORDER BY id DESC");
    $stmt->bindParam(':categoria', $categoria);
    $stmt->execute();
} else {
    $stmt = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
}

$produtos = $stmt->fetchAll();

?>



<h2><?= !empty($categoria) ? htmlspecialchars($categoria) : 'Todos os Produtos'; ?></h2>
<p style="margin-bottom: 1.5rem; color: #666;">Confira a nossa seleção especial para os pequenos!</p>


<div class="filtros-categoria">
    <a href="/app/select.php" class="btn-filtro <?= empty($categoria) ? 'ativo' : ''; ?>">TODOS</a>
    <a href="/produtos/maio.php" class="btn-filtro">MAIÔS</a>
    <a href="/produtos/biquini.php" class="btn-filtro">BIQUÍNIS</a>
    <a href="/produtos/sunga.php" class="btn-filtro">SUNGAS</a>
    <a href="/produtos/Protecaouv.php" class="btn-filtro">CAMISAS UV</a>
</div>

<div class="grid-produtos">
    <?php if (count($produtos) > 0): ?>
        <?php foreach ($produtos as $p): 
            $precoOriginal = $p['preco'] * 1.2;
            $parcela = $p['preco'] / 5;
        ?>
            <div class="card-produto">
                <a href="/app/carrinho.php?acao=add&id=<?= $p['id']; ?>" style="text-decoration: none; color: inherit;">
                    <img src="/imagens/<?= htmlspecialchars($p['imagem'] ?? 'logo.jpg'); ?>" 
                         alt="<?= htmlspecialchars($p['nome']); ?>" 
                         class="card-produto-img">
                    
                    <h3><?= htmlspecialchars($p['nome']); ?></h3>
                    
                    <div>
                        <span class="preco-antigo"><?= formatarPreco($precoOriginal); ?></span>
                        <span class="preco-destaque"><?= formatarPreco($p['preco']); ?></span>
                    </div>
                    
                    <div class="parcelamento">5x de <?= formatarPreco($parcela); ?>*</div>
                </a>
                
                <a href="/app/carrinho.php?acao=add&id=<?= $p['id']; ?>" class="btn" style="width: 100%; text-align: center; text-decoration: none; margin-top: 10px; padding: 8px;">Adicionar ao Carrinho</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum produto encontrado nesta categoria.</p>
    <?php endif; ?>
</div>



<?php require_once '../includes/footer.php'; ?>