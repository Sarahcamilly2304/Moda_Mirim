<?php 
// 1. Inclui o cabeçalho e a conexão com o PostgreSQL
include 'includes/header.php'; 
require_once __DIR__ . '/database/connect.php';

// 2. Busca todos os produtos cadastrados na base de dados
try {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produtos = [];
}
?>

<!-- Banner sem bordas arredondadas -->
<div style="max-width: 1100px; margin: 40px auto; background-color: #fdfbfb; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <!-- Lado Esquerdo: Textos e Chamada para Ação -->
    <div style="flex: 1; min-width: 300px; padding: 50px 40px; box-sizing: border-box;">
        
        <h1 style="font-size: clamp(2rem, 3.5vw, 2.8rem); line-height: 1.15; color: #222; font-weight: 800; margin: 0 0 15px 0;">
            Moda Praia com Estilo e Conforto
        </h1>
        
        <p style="color: #666; font-size: 1.05rem; margin-bottom: 25px; line-height: 1.5; font-weight: 400;">
            Vista-os de confiança e estilo com as nossas peças exclusivas. Proteção UV e elegância para os dias de sol dos pequenos.
        </p>
        
        <a href="#produtos-destaque" style="background-color: #802A41; color: #fff; padding: 14px 32px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-block;">
            Ver Produtos
        </a>
    </div>

    <!-- Lado Direito: Imagem de Destaque -->
    <div style="flex: 1; min-width: 300px; height: 420px; overflow: hidden;">
        <img src="/imagens/maiofloral.jpg" alt="Moda Praia Infantil" style="width: 100%; height: 100%; object-fit: cover; display: block;">
    </div>

</div>

<!-- 3. Secção Dinâmica de Produtos Cadastrados pelo Admin -->
<div id="produtos-destaque" style="max-width: 1100px; margin: 50px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h2 style="font-size: 1.8rem; color: #222; margin-bottom: 25px; text-align: center;">Nossos Produtos em Destaque</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
                <div style="background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                    
                    <!-- Imagem do produto -->
                    <div style="width: 100%; height: 220px; overflow: hidden; border-radius: 6px; background: #f0f0f0; margin-bottom: 15px;">
                        <img src="/imagens/<?= htmlspecialchars($produto['imagem'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div>
                        <!-- Etiqueta de Desconto / Categoria -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="background-color: #b76e79; color: #fff; font-size: 0.75rem; padding: 3px 8px; border-radius: 4px;"><?= htmlspecialchars($produto['desconto'] ?? '15% Off') ?></span>
                            <span style="font-size: 0.8rem; color: #666; text-transform: uppercase;"><?= htmlspecialchars($produto['categoria']) ?></span>
                        </div>

                        <!-- Nome do Produto -->
                        <h3 style="font-size: 1.1rem; color: #333; margin-bottom: 10px;"><?= htmlspecialchars($produto['nome']) ?></h3>
                    </div>

                    <div>
                        <!-- Preço -->
                        <p style="font-size: 1.2rem; font-weight: 700; color: #802A41; margin-bottom: 15px;">
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </p>

                        <!-- Botão Comprar -->
                        <a href="#" style="display: block; text-align: center; background-color: #333; color: #fff; padding: 10px; text-decoration: none; border-radius: 4px; font-weight: 600; font-size: 0.9rem;">
                            Comprar
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #666; grid-column: 1 / -1; padding: 20px;">Nenhum produto cadastrado no momento. Adicione novos produtos através do painel administrativo.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>