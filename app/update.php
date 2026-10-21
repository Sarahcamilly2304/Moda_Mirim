<?php
require_once '../database/connect.php';
require_once '../login/verifica_user.php';
verificarAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $descricao = sanitizar($_POST['descricao']);
    $categoria = sanitizar($_POST['categoria']);
    $tamanho = sanitizar($_POST['tamanho']);
    $preco = (float)$_POST['preco'];
    $estoque = (int)$_POST['estoque'];

    $stmt = $conn->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, categoria = :categoria, tamanho = :tamanho, preco = :preco, estoque = :estoque WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':tamanho', $tamanho);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: select_w.php");
        exit();
    } else {
        $mensagem = "Erro ao atualizar produto.";
    }
}

$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$produto = $stmt->fetch();

if (!$produto) {
    die("Produto não encontrado!");
}

require_once '../includes/header.php';
?>

<div class="form-box">
    <h2>Editar Produto</h2>
    <?php if ($mensagem): ?>
        <div class="alert alert-error"><?= $mensagem; ?></div>
    <?php endif; ?>
    <form action="update.php?id=<?= $id; ?>" method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" name="categoria" value="<?= htmlspecialchars($produto['categoria']); ?>" required>
        </div>
        <div class="form-group">
            <label>Tamanho:</label>
            <input type="text" name="tamanho" value="<?= htmlspecialchars($produto['tamanho']); ?>" required>
        </div>
        <div class="form-group">
            <label>Preço (R$):</label>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco']; ?>" required>
        </div>
        <div class="form-group">
            <label>Estoque:</label>
            <input type="number" name="estoque" value="<?= $produto['estoque']; ?>" required>
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" rows="3"><?= htmlspecialchars($produto['descricao']); ?></textarea>
        </div>
        <button type="submit" class="btn">Atualizar Produto</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>