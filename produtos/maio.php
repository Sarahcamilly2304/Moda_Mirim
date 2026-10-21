<?php
// 1. Garante que inclui o ficheiro correto de conexão (conexao.php)
require_once '../database/connect.php';
require_once '../includes/header.php';

$categoria = 'Maiô';

// 2. Tenta fazer a busca usando $pdo (se falhar ou não existir, usa $conn)
$conexao_db = isset($pdo) ? $pdo : (isset($conn) ? $conn : null);

if ($conexao_db) {
    $stmt = $conexao_db->prepare("SELECT * FROM produtos WHERE LOWER(categoria) LIKE LOWER(:categoria) ORDER BY id DESC");
    $stmt->bindValue(':categoria', '%' . $categoria . '%');
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $produtos = [];
}

if (empty($produtos)) {
    $produtos = [
        [
            'id' => 1,
            'nome' => 'Maiô Infantil Sereia Proteção UV50+',
            'preco' => 89.90,
            'imagem' => 'limao.jpg',
            'desconto' => '15% Off'
        ],
        [
            'id' => 2,
            'nome' => 'Maiô Floral Babados Moda Praia',
            'preco' => 79.90,
            'imagem' => '6ansmasc.fem.jpg',
            'desconto' => '20% Off'
        ],
        [
            'id' => 3,
            'nome' => 'Maiô Infantil Estampa Tropical',
            'preco' => 99.90,
            'imagem' => '2anosmasc.jpg',
            'desconto' => '10% Off'
        ]
    ];
}
?>

<h2>Maiôs Infantis</h2>
<p style="margin-bottom: 1.5rem; color: #666;">Confira nossos modelos fofos, confortáveis e com proteção UV!</p>

<!-- Botões de Categoria Navegando na Mesma Aba -->
<div class="filtros-categoria">
    <a href="../app/select.php" class="btn-filtro">TODOS</a>
    <a href="maio.php" class="btn-filtro ativo">MAIÔS</a>
    <a href="biquini.php" class="btn-filtro">BIQUÍNIS</a>
    <a href="sunga.php" class="btn-filtro">SUNGAS</a>
    <a href="Protecaouv.php" class="btn-filtro">CAMISAS UV</a>
</div>

<div class="grid-produtos">
    <?php foreach ($produtos as $p): 
        $preco = (float)$p['preco'];
        $precoOriginal = $preco * 1.25; // Simulação do preço antigo riscado
        $parcela = $preco / 5;
        $desconto = $p['desconto'] ?? '15% Off';
        $imagem = !empty($p['imagem']) ? $p['imagem'] : 'logo.jpg';
    ?>
        <div class="card-produto">
            <div style="position: relative;">
                <!-- Selo de Desconto igual ao exemplo -->
                <span style="position: absolute; top: 10px; left: 10px; background: rgba(255,255,255,0.9); padding: 4px 8px; font-size: 0.75rem; font-weight: bold; border-radius: 2px;">
                    ♥ <?= $desconto; ?>
                </span>

                <a href="../app/carrinho.php?acao=add&id=<?= $p['id']; ?>">
                    <img src="../imagens/<?= htmlspecialchars($imagem); ?>" 
                         alt="<?= htmlspecialchars($p['nome']); ?>" 
                         class="card-produto-img"
                         onerror="this.src='../imagens/logo.jpg';">
                </a>
            </div>

            <a href="../app/carrinho.php?acao=add&id=<?= $p['id']; ?>" style="text-decoration: none; color: inherit;">
                <h3><?= htmlspecialchars($p['nome']); ?></h3>
                <div>
                    <span class="preco-antigo"><?= formatarPreco($precoOriginal); ?></span>
                    <span class="preco-destaque"><?= formatarPreco($preco); ?></span>
                </div>
                <div class="parcelamento">5x de <?= formatarPreco($parcela); ?>*</div>
            </a>

            <a href="../app/carrinho.php?acao=add&id=<?= $p['id']; ?>" class="btn" style="width: 100%; text-align: center; text-decoration: none; margin-top: 12px; padding: 10px;">
                Adicionar ao Carrinho
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once '../includes/footer.php'; ?>