<?php
require_once '../database/connect.php';
require_once 'verifica_user.php';

$usuario_id = $_SESSION['usuario_id'];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $telefone = sanitizar($_POST['telefone']);

    $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, telefone = :telefone WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':id', $usuario_id);

    if ($stmt->execute()) {
        $_SESSION['usuario_nome'] = $nome;
        $mensagem = "Dados atualizados com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar dados.";
    }
}

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch();

require_once '../includes/header.php';
?>

<div class="form-box">
    <h2>Atualizar Meu Perfil</h2>
    <?php if ($mensagem): ?>
        <div class="alert alert-success"><?= $mensagem; ?></div>
    <?php endif; ?>
    <form action="update.php" method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label>E-mail (Não editável):</label>
            <input type="email" value="<?= htmlspecialchars($usuario['email']); ?>" disabled>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone']); ?>">
        </div>
        <button type="submit" class="btn">Salvar Alterações</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>