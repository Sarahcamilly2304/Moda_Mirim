<?php
require_once '../database/connect.php';
require_once '../login/verifica_user.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $categoria = sanitizar($_POST['categoria']);
    $tamanho = sanitizar($_POST['tamanho']);
    $preco = (float)$_POST['preco'];
    $estoque = (int)$_POST['estoque'];

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, categoria = ?, tamanho = ?, preco = ?, estoque = ? WHERE id = ?");
    $stmt->execute([$nome, $categoria, $tamanho, $preco, $estoque, $id]);

    header("Location: select.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    die("Produto não encontrado.");
}

require_once '../includes/header.php';
?>

<div class="container" style="max-width: 500px;">
    <h3>Editar Produto #<?= $produto['id']; ?></h3>
    <form method="POST" style="margin-top: 15px;">
        <input type="text" name="nome" class="form-input" value="<?= htmlspecialchars($produto['nome']); ?>" required>
        <select name="categoria" class="form-input" required>
            <option value="meninos" <?= $produto['categoria'] === 'meninos' ? 'selected' : ''; ?>>Meninos</option>
            <option value="meninas" <?= $produto['categoria'] === 'meninas' ? 'selected' : ''; ?>>Meninas</option>
            <option value="acessorios" <?= $produto['categoria'] === 'acessorios' ? 'selected' : ''; ?>>Acessórios</option>
        </select>
        <input type="text" name="tamanho" class="form-input" value="<?= htmlspecialchars($produto['tamanho']); ?>" required>
        <input type="number" step="0.01" name="preco" class="form-input" value="<?= $produto['preco']; ?>" required>
        <input type="number" name="estoque" class="form-input" value="<?= $produto['estoque']; ?>" required>
        <button type="submit" class="btn-black">Atualizar Produto</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>