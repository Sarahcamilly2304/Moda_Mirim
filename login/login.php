<?php
require_once '../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizar($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];
        header("Location: /index.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}

require_once '../includes/header.php';
?>

<div class="container">
    <div class="auth-grid">
        <div>
            <h3 style="margin-bottom: 15px;">faça o seu login</h3>
            <?php if (isset($erro)): ?>
                <p style="color: red; font-size: 12px; margin-bottom: 8px;"><?= $erro; ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="email" name="email" class="form-input" placeholder="E-mail" required>
                <input type="password" name="senha" class="form-input" placeholder="Senha" required>
                <button type="submit" class="btn-black" style="width:100%;">Entrar</button>
            </form>
        </div>

        <div style="text-align:center; font-weight:bold; color:#888;">ou</div>

        <div>
            <h3 style="margin-bottom: 15px;">cadastre-se</h3>
            <p style="margin-bottom: 15px; font-size: 13px;">Ainda não tem conta? Crie uma para aproveitar ofertas exclusivas da Moda Mirim.</p>
            <a href="cadastrar.php" class="btn-black" style="width:100%;">Criar uma conta</a>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>