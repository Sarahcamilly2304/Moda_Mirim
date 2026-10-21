<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/functions.php';

$qtd_carrinho = 0;
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $item) {
        if (is_array($item)) {
            $qtd_carrinho += $item['qtd'];
        } else {
            $qtd_carrinho += (int)$item;
        }
    }
}
?>

<!-- Estrutura do Cabeçalho -->
<header style="background-color: #dfb8b3; padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; box-sizing: border-box; width: 100%;">
    
    <!-- Logo -->
    <div class="logo">
        <a href="/index.php" style="text-decoration: none; color: #802A41; font-size: 1.8rem; font-weight: bold;">Moda Mirim</a>
    </div>

    <!-- Navegação Principal -->
    <nav style="display: flex; gap: 25px; align-items: center;">
        <a href="/index.php" style="text-decoration: none; color: #333; font-weight: 600; text-transform: uppercase; font-size: 0.9rem;">HOME</a>
        <a href="/app/select.php" style="text-decoration: none; color: #333; font-weight: 600; text-transform: uppercase; font-size: 0.9rem;">PRODUTOS ▾</a>
        <a href="#" style="text-decoration: none; color: #333; font-weight: 600; text-transform: uppercase; font-size: 0.9rem;">SOBRE NÓS</a>
        <a href="#" style="text-decoration: none; color: #333; font-weight: 600; text-transform: uppercase; font-size: 0.9rem;">CONTATO</a>
    </nav>

    <!-- Área da Direita: Busca, Login/Usuário e Carrinho -->
    <div style="display: flex; align-items: center; gap: 20px;">
        
        <!-- Pesquisa -->
        <span style="font-size: 1.1rem; cursor: pointer;">🔍</span>

        <!-- Menu do Utilizador (Login / Nome do Utilizador) -->
        <div class="user-menu" style="position: relative; display: inline-block;">
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <!-- Se estiver logado, exibe o nome com menu suspenso -->
                <span id="userDropdownBtn" style="font-weight: bold; color: #802A41; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                    Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?> ▾
                </span>
                
                <div id="userDropdownMenu" style="display: none; position: absolute; right: 0; top: 120%; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border-radius: 8px; padding: 8px 0; min-width: 150px; z-index: 1000;">
                    <a href="/login/logout.php" style="display: block; padding: 8px 16px; color: #333; text-decoration: none; font-size: 0.9rem; transition: background 0.2s;">
                        🚪 Sair
                    </a>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 4px 0;">
                    <a href="/login/deletar.php" onclick="return confirm('Tem certeza absoluta que deseja apagar a sua conta? Esta ação não pode ser desfeita.');" style="display: block; padding: 8px 16px; color: #d9534f; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
                        🗑️ Deletar Conta
                    </a>
                </div>
            <?php else: ?>
                <!-- Se NÃO estiver logado, exibe o link normal -->
                <a href="/login/login.php" style="text-decoration: none; color: #333; font-weight: 500; font-size: 0.95rem;">login/cadastro</a>
            <?php endif; ?>
        </div>

        <!-- Carrinho -->
        <a href="/app/select.php" style="text-decoration: none; color: #333; font-weight: 500; font-size: 0.95rem;">
            carrinho <?php if ($qtd_carrinho > 0): ?><span style="background: #802A41; color: white; padding: 2px 6px; border-radius: 50%; font-size: 0.8rem;"><?php echo $qtd_carrinho; ?></span><?php endif; ?>
        </a>

    </div>
</header>

<!-- Script para o menu do utilizador abrir/fechar ao clicar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('userDropdownBtn');
    const menu = document.getElementById('userDropdownMenu');
    
    if (btn && menu) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function() {
            menu.style.display = 'none';
        });
    }
});
</script>