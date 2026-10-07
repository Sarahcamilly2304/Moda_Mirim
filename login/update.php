<?php
require_once '../database/conexao.php';
require_once 'verifica_user.php';

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $telefone = sanitizar($_POST['telefone']);

    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, telefone = ? WHERE id = ?");
    $stmt->execute([$nome, $telefone, $id]);
    $_SESSION['user_nome'] = $nome;
    $sucesso = "Perfil atualizado com sucesso!";
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

require_once '../includes/header.php';
?>

<div class="container" style="max-width: 500px;">
    <h3>Atualizar Perfil do Cliente</h3>
    <?php if (isset($sucesso)): ?>
        <p style="color: green; margin: 10px 0;"><?= $sucesso; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-input" value="<?= htmlspecialchars($cliente['nome']); ?>" required>
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-input" value="<?= htmlspecialchars($cliente['telefone']); ?>" required>
        <button type="submit" class="btn-black">Atualizar</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>