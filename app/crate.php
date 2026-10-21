<?php
require_once '../database/connect.php';
require_once '../login/verifica_user.php';
verificarAdmin();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $descricao = sanitizar($_POST['descricao']);
    $categoria = sanitizar($_POST['categoria']);
    $tamanho = sanitizar($_POST['tamanho']);
    $preco = (float)$_POST['preco'];
    $estoque = (int)$_POST['estoque'];

    if (!empty($nome) && !empty($categoria) && $preco > 0) {
        $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, categoria, tamanho, preco, estoque) VALUES (:nome, :descricao, :categoria, :tamanho, :preco, :estoque)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':tamanho', $tamanho);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);

        if ($stmt->execute()) {
            header("Location: select_w.php?msg=produto_criado");
            exit();
        } else {
            $mensagem = "Erro ao cadastrar produto.";
        }
    } else {
        $mensagem = "Preencha todos os campos obrigatórios!";
    }
}

require_once '../includes/header.php';
?>

<div class="form-box">
    <h2>Cadastrar Novo Produto Moda Praia</h2>
    <?php if ($mensagem): ?>
        <div class="alert alert-error"><?= $mensagem; ?></div>
    <?php endif; ?>
    <form action="create.php" method="POST">
        <div class="form-group">
            <label>Nome do Produto:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria" required>
                <option value="Maiô">Maiô</option>
                <option value="Sunga">Sunga</option>
                <option value="Biquíni">Biquíni</option>
                <option value="Proteção UV">Proteção UV</option>
                <option value="Acessórios">Acessórios</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tamanho:</label>
            <input type="text" name="tamanho" placeholder="Ex: PP, P, M, 2, 4, 6" required>
        </div>
        <div class="form-group">
            <label>Preço (R$):</label>
            <input type="number" step="0.01" name="preco" required>
        </div>
        <div class="form-group">
            <label>Quantidade em Estoque:</label>
            <input type="number" name="estoque" value="10" required>
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" rows="3"></textarea>
        </div>
        <button type="submit" class="btn">Cadastrar Produto</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>