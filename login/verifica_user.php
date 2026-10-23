<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Caminho absoluto direto para a pasta do projeto (ajuste se necessário)
// Como o projeto está em 'moda_mirim/login/verifica_user.php', vamos procurar a pasta database:
$connect_path = __DIR__ . '/../database/connect.php';

if (file_exists($connect_path)) {
    require_once $connect_path;
} else {
    // Se o arquivo não for encontrado nesta pasta, tentamos o caminho alternativo
    $connect_path_alt = $_SERVER['DOCUMENT_ROOT'] . '/database/connect.php';
    if (file_exists($connect_path_alt)) {
        require_once $connect_path_alt;
    } else {
        die("Erro crítico: O ficheiro de conexão (connect.php) não foi encontrado em nenhum dos caminhos testados!");
    }
}

// Validação rigorosa para garantir que a conexão $pdo existe
if (!isset($pdo) || !$pdo instanceof PDO) {
    die("Erro crítico: A conexão com a base de dados falhou ou a variável \$pdo não foi iniciada no connect.php.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_perfil'] = $usuario['perfil'] ?? 'cliente';

                header("Location: /index.php");
                exit();
            } else {
                echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='login.php';</script>";
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro na base de dados: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Preencha todos os campos!'); window.location.href='login.php';</script>";
        exit();
    }
} else {
    header("Location: /login/login.php");
    exit();
}
?>