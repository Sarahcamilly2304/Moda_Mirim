<?php
require_once '../database/connect.php';
require_once '../login/verifica_user.php';
verificarAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

if ($id > 0) {
    if ($tipo === 'produto') {
        $stmt = $conn->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } elseif ($tipo === 'cliente') {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id AND perfil = 'cliente'");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

header("Location: select_w.php");
exit();
?>