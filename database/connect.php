
<?php

$localhost = '192.168.10.69';
$usuario = 'moda_mirim';
$senha = 'modamirim';
$banco = 'moda_mirim';

try {
    $conn = new PDO("pgsql:host=$localhost;dbname=$banco", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}