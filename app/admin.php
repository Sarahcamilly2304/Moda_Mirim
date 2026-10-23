<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se não estiver logado ou se o perfil não for 'admin', bloqueia o acesso
if (!isset($_SESSION['usuario_perfil']) || $_SESSION['usuario_perfil'] !== 'admin') {
    echo "<h2 style='text-align:center; padding: 3rem; color: #d9534f;'>Acesso Negado! Esta página é restrita apenas ao administrador.</h2>";
    echo "<p style='text-align:center;'><a href='/index.php'>Voltar para a Página Inicial</a></p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - Moda Mirim</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        header { background-color: #802A41; color: white; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1000px; margin: 40px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h1 { color: #802A41; margin-top: 0; }
        .menu-admin { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .card-admin { background: #dfb8b3; padding: 20px; border-radius: 6px; text-align: center; text-decoration: none; color: #333; font-weight: bold; transition: background 0.2s; }
        .card-admin:hover { background: #cf9b95; color: #802A41; }
        .btn-sair { background: #d9534f; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>

    <header>
        <h2>Painel do Administrador - Moda Mirim</h2>
        <a href="/login/logout.php" class="btn-sair">🚪 Sair</a>
    </header>

    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Administrador'); ?>!</h1>
        <p>A partir deste painel rápido, pode gerir os cadastros e os produtos da loja.</p>
        
        <div class="menu-admin">
            <a href="/admin/listar_produtos.php" class="card-admin">📦 Ver / Gerir Produtos</a>
            <a href="/admin/adicionar_produto.php" class="card-admin">➕ Adicionar Novo Produto</a>
            <a href="/admin/index.php" class="card-admin">🌐 Ver o Site</a>
        </div>
    </div>

</body>
</html>