<?php
require_once '../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $email = sanitizar($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = sanitizar($_POST['telefone']);

    try {
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $telefone]);
        header("Location: login.php?msg=cadastrado");
        exit;
    } catch (PDOException $e) {
        $erro = "Erro ao cadastrar: e-mail já existe ou dados inválidos.";
    }
}

require_once '../includes/header.php';
?>

<div class="container" style="max-width: 500px;">
    <h3 style="margin-bottom: 20px; text-align:center;">Criar Conta de Cliente</h3>
    <?php if (isset($erro)): ?>
        <p style="color: red; text-align:center; margin-bottom: 10px;"><?= $erro; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="nome" class="form-input" placeholder="Nome Completo" required>
        <input type="email" name="email" class="form-input" placeholder="E-mail" required>
        <input type="password" name="senha" class="form-input" placeholder="Senha" required>
        <input type="text" name="telefone" class="form-input" placeholder="Telefone / WhatsApp" required>
        <button type="submit" class="btn-black" style="width:100%;">Cadastrar</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>