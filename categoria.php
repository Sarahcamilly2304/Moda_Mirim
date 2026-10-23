<?php
include 'includes/header.php';
require_once __DIR__ . '/database/connect.php';

// Pega a categoria da URL (ex: categoria.php?tipo=biquini)
$tipoCategoria = $_GET['tipo'] ?? '';

try {
    // Busca os produtos que correspondem exatamente à categoria escolhida
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE LOWER(TRIM(categoria)) = LOWER(TRIM(:tipo)) ORDER BY id DESC");
    $stmt->execute(['tipo' => $tipoCategoria]);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produtos = [];
}
?>

<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h2 style="font-size: 2rem; color: #222; margin-bottom: 25px; text-align: center; text-transform: capitalize;">
        Categoria: <?= htmlspecialchars($tipoCategoria) ?>
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
                <div style="background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                    
                    <!-- Imagem sem cortes -->
                    <div style="width: 100%; height: 220px; overflow: hidden; border-radius: 6px; background: #f0f0f0; margin-bottom: 15px; display: flex; align-items: center; justify-content: center;">
                        <img src="/imagens/<?= htmlspecialchars($produto['imagem'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>

                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="background-color: #b76e79; color: #fff; font-size: 0.75rem; padding: 3px 8px; border-radius: 4px;"><?= htmlspecialchars($produto['desconto'] ?? '15% Off') ?></span>
                            <span style="font-size: 0.8rem; color: #666; text-transform: uppercase;"><?= htmlspecialchars($produto['categoria']) ?></span>
                        </div>
                        <h3 style="font-size: 1.1rem; color: #333; margin-bottom: 10px;"><?= htmlspecialchars($produto['nome']) ?></h3>
                    </div>

                    <div>
                        <p style="font-size: 1.2rem; font-weight: 700; color: #802A41; margin-bottom: 15px;">
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </p>
                        <a href="#" style="display: block; text-align: center; background-color: #333; color: #fff; padding: 10px; text-decoration: none; border-radius: 4px; font-weight: 600; font-size: 0.9rem;">
                            Comprar
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #666; grid-column: 1 / -1; padding: 40px;">Nenhum produto encontrado nesta categoria.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>