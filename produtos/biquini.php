<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

$categoria = 'biquini';
$tituloCategoria = 'Biquínis Infantis';
$produtos = [];

if (isset($conn) && $conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE LOWER(categoria) LIKE LOWER(:cat) ORDER BY id DESC");
        $stmt->bindValue(':cat', '%' . $categoria . '%');
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $produtos = [];
    }
}

if (empty($produt)) {
    $produtos = [
        ['id' => 3, 'nome' => 'Biquíni Infantil Estampa Limão Siciliano', 'preco' => 69.90, 'categoria' => 'biquini', 'imagem' => 'bqlimao.jpg', 'desconto' => '12% Off']
    ];
}
?>

<div class="container" style="padding: 30px 20px; max-width: 1200px; margin: 0 auto;">
    <h2><?= $tituloCategoria; ?></h2>
    <p style="margin-bottom: 2rem; color: #555;">Confira os nossos modelos fofos, confortáveis e com proteção UV!</p>

    <?php if (!empty($produtos)): ?>
        <div class="grid-produtos" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
            <?php foreach ($produtos as $p): 
                $preco = (float)$p['preco'];
                $precoOriginal = $preco * 1.25;
                $parcela = $preco / 5;
                $desconto = $p['desconto'] ?? '15% Off';
                $imagem = !empty($p['imagem']) ? $p['imagem'] : 'maiofloral.jpg';
                
                $precoStr = 'R$ ' . number_format($preco, 2, ',', '.');
                $precoOrigStr = 'R$ ' . number_format($precoOriginal, 2, ',', '.');
                $parcelaStr = 'R$ ' . number_format($parcela, 2, ',', '.');
            ?>
                <div class="card-produto" style="background: #fff; padding: 20px; border: 1px solid #e2e2e2; text-align: center; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="position: relative; margin-bottom: 15px; background: #f9f9f9; border-radius: 6px; overflow: hidden;">
                            <span style="position: absolute; top: 12px; left: 12px; background: rgba(255,255,255,0.95); color: #802A41; padding: 6px 12px; font-size: 0.8rem; font-weight: bold; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 2;">
                                ♥ <?= htmlspecialchars($desconto); ?>
                            </span>
                            <a href="/app/carrinho.php?acao=add&id=<?= $p['id']; ?>">
                                <img src="/imagens/<?= htmlspecialchars($imagem); ?>" 
                                     alt="<?= htmlspecialchars($p['nome']); ?>" 
                                     style="width: 100%; height: 280px; object-fit: cover; display: block; border-radius: 6px;" 
                                     onerror="this.onerror=null; this.src='/imagens/maiofloral.jpg';">
                            </a>
                        </div>
                        
                        <h3 style="font-size: 1.1rem; margin-bottom: 12px; color: #222; font-weight: bold; height: 48px; overflow: hidden; text-overflow: ellipsis; line-height: 1.3;">
                            <?= htmlspecialchars($p['nome']); ?>
                        </h3>
                        
                        <div style="margin-bottom: 6px;">
                            <span style="text-decoration: line-through; color: #888; font-size: 0.9rem; margin-right: 8px;"><?= $precoOrigStr; ?></span>
                            <span style="color: #802A41; font-weight: bold; font-size: 1.25rem;"><?= $precoStr; ?></span>
                        </div>
                        
                        <div style="font-size: 0.85rem; color: #666; margin-bottom: 20px;">5x de <?= $parcelaStr; ?>*</div>
                    </div>

                    <a href="/app/carrinho.php?acao=add&id=<?= $p['id']; ?>" class="btn" style="width: 100%; display: block; padding: 12px 0; background: #802A41; color: white; text-align: center; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 1rem; box-shadow: 0 3px 6px rgba(128,42,65,0.25); box-sizing: border-box;">
                        Adicionar ao Carrinho
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="margin-top: 2rem; color: #555;">Nenhum produto encontrado nesta categoria.</p>
    <?php endif; ?>
</div>


<?php require_once __DIR__ . '/../includes/footer.php'; ?>