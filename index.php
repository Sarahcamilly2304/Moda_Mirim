<?php include 'includes/header.php'; ?>

<!-- Banner sem bordas arredondadas -->
<div style="max-width: 1100px; margin: 40px auto; background-color: #fdfbfb; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <!-- Lado Esquerdo: Textos e Chamada para Ação -->
    <div style="flex: 1; min-width: 300px; padding: 50px 40px; box-sizing: border-box;">
        <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: bold; background: #802A41; color: white; padding: 6px 14px; display: inline-block; margin-bottom: 15px;">Nova Coleção</span>
        
        <h1 style="font-size: clamp(2rem, 3.5vw, 2.8rem); line-height: 1.15; color: #222; font-weight: 800; margin: 0 0 15px 0;">
            Moda Praia com Estilo e Conforto
        </h1>
        
        <p style="color: #666; font-size: 1.05rem; margin-bottom: 25px; line-height: 1.5; font-weight: 400;">
            Vista-os de confiança e estilo com as nossas peças exclusivas. Proteção UV e elegância para os dias de sol dos pequenos.
        </p>
        
        <a href="/app/select.php" style="background-color: #802A41; color: #fff; padding: 14px 32px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-block;">
            Ver Produtos
        </a>
    </div>

    <!-- Lado Direito: Imagem de Destaque -->
    <div style="flex: 1; min-width: 300px; height: 420px; overflow: hidden;">
        <img src="/imagens/maiofloral.jpg" alt="Moda Praia Infantil" style="width: 100%; height: 100%; object-fit: cover; display: block;">
    </div>

</div>

<?php include 'includes/footer.php'; ?>