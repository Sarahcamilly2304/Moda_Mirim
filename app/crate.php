<?php
require_once '../database/conexao.php';
require_once '../login/verifica_user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $categoria = sanitizar($_POST['categoria']);
    $tamanho = sanitizar($_POST['tamanho']);
    $preco = (float)$_POST['preco'];
    $estoque = (int)$_POST['estoque'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, categoria, tamanho, preco, estoque) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $categoria, $tamanho, $preco, $estoque]);

    header("Location: select.php");
    exit;
}

require_once '../includes/header.php';
?>

<div class="container" style="max-width: 500px;">
    <h3>Cadastrar Produto Moda Praia</h3>
    <form method="POST" style="margin-top: 15px;">
        <input type="text" name="nome" class="form-input" placeholder="Nome do Produto (ex: Sunga Infantil)" required>
        <select name="categoria" class="form-input" required>
            <option value="">Selecione Categoria</option>
            <option value="meninos">Meninos</option>
            <option value="meninas">Meninas</option>
            <option value="acessorios">Acessórios</option>
        </select>
        <select name="tamanho" class="form-input" required>
            <option value="">Selecione Tamanho</option>
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="6">6</option>
            <option value="8">8</option>
            <option value="10">10</option>
        </select>
        <input type="number" step="0.01" name="preco" class="form-input" placeholder="Preço (R$)" required>
        <input type="number" name="estoque" class="form-input" placeholder="Estoque" required>
        <button type="submit" class="btn-black">Salvar Produto</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>