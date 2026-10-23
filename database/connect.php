
<?php

$localhost = '192.168.10.69';
$usuario = 'moda_mirim';
$senha = 'modamirim';
$banco = 'moda_mirim';

try {
    
    $dsn = "pgsql:host=$localhost;dbname=$banco";
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro crítico na conexão com o PostgreSQL: " . $e->getMessage());
}