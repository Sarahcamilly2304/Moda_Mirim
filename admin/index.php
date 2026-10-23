<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteção de acesso: verifica se o usuário está logado e é 'admin'
if (!isset($_SESSION['usuario_perfil']) || $_SESSION['usuario_perfil'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? 'admin';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Moda Mirim</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #faf6f6;
            color: #333;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            color: #6b2131;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 1.05rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .card-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px;
            background-color: #e0bebe;
            color: #4a1c24;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border: 1px solid #d4aeae;
        }

        .card-btn:hover {
            background-color: #d1a8a8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .logout-container {
            margin-top: 30px;
            text-align: right;
        }

        .btn-logout {
            color: #cc0000;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?>!</h1>
        <p>A partir deste painel rápido, pode gerir os cadastros e os produtos da loja.</p>
    </div>

    <div class="actions-grid">
        <a href="listar_produtos.php" class="card-btn">
            <span>📦</span> Ver / Gerir Produtos
        </a>
        <a href="adicionar_produto.php" class="card-btn"> Adicionar Novo Produto</a>
        <a href="../index.php" class="card-btn">
            <span>🌐</span> Ver o Site
        </a>
    </div>

    <div class="logout-container">
        <a href="../login/logout.php" class="btn-logout">Sair da conta</a>
    </div>
</div>

</body>
</html>