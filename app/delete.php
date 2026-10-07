<?php
require_once '../database/conexao.php';
require_once '../login/verifica_user.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: select.php");
exit;
?>