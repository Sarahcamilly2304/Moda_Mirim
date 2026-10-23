<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o PostgreSQL
require_once __DIR__ . '/../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $telefone = trim($_POST['telefone'] ?? '');

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        try {
            // Verifica se o e-mail já existe
            $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
            $stmtCheck->execute(['email' => $email]);
            
            if ($stmtCheck->fetch()) {
                echo "<script>alert('Este e-mail já está registado!'); window.location.href='cadastro.php';</script>";
                exit();
            }

            // Encripta a senha com segurança
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere o novo utilizador na base de dados (perfil padrão 'cliente')
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, telefone, perfil) VALUES (:nome, :email, :senha, :telefone, 'cliente')");
            $stmt->execute([
                'nome' => $nome,
                'email' => $email,
                'senha' => $senhaHash,
                'telefone' => $telefone
            ]);

            echo "<script>alert('Cadastro realizado com sucesso! Faça login.'); window.location.href='login.php';</script>";
            exit();

        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Preencha todos os campos obrigatórios!'); window.location.href='cadastro.php';</script>";
        exit();
    }
} else {
    header("Location: cadastro.php");
    exit();
}
?>