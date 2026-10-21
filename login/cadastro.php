<?php
require_once '../database/connect.php';
require_once '../includes/functions.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome']);
    $email = sanitizar($_POST['email']);
    $senha = $_POST['senha'];
    $telefone = sanitizar($_POST['telefone']);

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, perfil) VALUES (:nome, :email, :senha, :telefone, 'cliente')");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->bindParam(':telefone', $telefone);
            
            if ($stmt->execute()) {
                header("Location: login.php?msg=cadastrado");
                exit();
            }
        } catch (PDOException $e) {
            $mensagem = "Erro: Este e-mail já está cadastrado.";
        }
    } else {
        $mensagem = "Preencha todos os campos obrigatórios!";
    }
}

require_once '../includes/header.php';
?>

<div class="form-box">
    <h2>Cadastro de Cliente</h2>
    <?php if ($mensagem): ?>
        <div class="alert alert-error"><?= $mensagem; ?></div>
    <?php endif; ?>
    <form action="cadastrar.php" method="POST">
        <div class="form-group">
            <label>Nome Completo:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit" class="btn">Cadastrar</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>