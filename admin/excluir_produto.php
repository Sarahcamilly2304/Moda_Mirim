<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario_perfil']) || $_SESSION['usuario_perfil'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../database/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // Prepara e executa a exclusão do produto no PostgreSQL
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Redireciona de volta para a listagem com sucesso
        header("Location: listar_produtos.php?sucesso=excluido");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao excluir o produto: " . $e->getMessage();
    }
} else {
    header("Location: listar_produtos.php");
    exit();
}
?>