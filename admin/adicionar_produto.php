<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se é admin
if (!isset($_SESSION['usuario_perfil']) || $_SESSION['usuario_perfil'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../database/connect.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $desconto = trim($_POST['desconto'] ?? '15% Off');
    $imagem = trim($_POST['imagem'] ?? 'default.jpg'); // Nome do arquivo da imagem

    if (!empty($nome) && !empty($preco) && !empty($categoria)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, categoria, imagem, desconto) VALUES (:nome, :preco, :categoria, :imagem, :desconto)");
            $stmt->execute([
                'nome' => $nome,
                'preco' => str_replace(',', '.', $preco),
                'categoria' => $categoria,
                'imagem' => $imagem,
                'desconto' => $desconto
            ]);
            $mensagem = "Produto cadastrado com sucesso!";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar produto: " . $e->getMessage();
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto - Moda Mirim</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; color: white; background: #b76e79; cursor: pointer; }
        .btn-voltar { background: #6c757d; text-decoration: none; display: inline-block; padding: 8px 12px; margin-bottom: 15px; color: white; border-radius: 4px;}
        .msg { margin-bottom: 15px; color: green; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php" class="btn-voltar">← Voltar ao Painel</a>
    <h2>Adicionar Novo Produto</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="msg"><?= $mensagem ?></p>
    <?php endif; ?>

    <form action="adicionar_produto.php" method="POST">
        <div class="form-group">
            <label>Nome do Produto:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Preço (R$):</label>
            <input type="text" name="preco" placeholder="Ex: 89.90" required>
        </div>
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" name="categoria" placeholder="Ex: maio, biquini, sunga" required>
        </div>
        <div class="form-group">
            <label>Nome do Ficheiro da Imagem:</label>
            <input type="text" name="imagem" placeholder="Ex: limao.jpg" required>
        </div>
        <div class="form-group">
            <label>Desconto:</label>
            <input type="text" name="desconto" value="15% Off">
        </div>
        <button type="submit" class="btn">Registar Produto</button>
    </form>
</div>
</body>
</html>