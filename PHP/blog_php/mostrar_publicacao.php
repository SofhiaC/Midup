<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($conexao->connect_errno){
    echo "Falha ao conectar: (". $conexao->connect_errno . ")" . $conexao->connect_error;
} else {
    echo "Conectado";
}

function read($conexao) {
    $result = $conexao->query("SELECT * FROM tb_blog");

    if ($result) {
        echo "Dados recuperados";
    } else {
        echo "Erro ao recuperar dados: " . $conexao->error . "<br>";
    }
}

read($conexao);
$conexao->close();

?>