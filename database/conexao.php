
<?php

$localhost = '192.168.10.69';
$usuario = 'moda_mirim';
$senha = 'moda_mirim';
$banco = 'moda_mirim';

try {
    $conexao = new PDO(
        "pgsql:host=$localhost;
        dbname=$banco",
        $usuario,
        $senha
    );
    echo "Conexão realizada com sucesso!";
    return $conexao;
} catch (PDOException $e){
    echo "Erro: ". $e->getMessage();
}
?>