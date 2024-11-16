<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "fereluna15";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if($mysqli -> connect_errno){
    echo "Falha ao conectar: (". $mysqli->connect_errno . ")" .mysqli->connect_error;
} else {
    echo "Conectado"
};

$titulo = $_POST['titulo'];
$imagem = $_POST['imagem_carregada'];
$introducao = $_POST['introducao'];
$ingredientes = $_POST['ingredientes'];
$modo_prep = $_POST['modo_prep'];
$porcoes = $_POST['porcoes'];
$dificuldade = $_POST['dificuldade'];
$categoria = $_POST['cat'];
$tempo_preparo = $_POST['tempo'];

$result = mysqli_query($conexao, "INSERT INTO tb_usuario(tempo_preparo, dificuldade, tipo_receita, quant_porcoes, modo_de_preparo, nome_receita, imagem_receita) VALUES ('$tempo_preparo', '$dificuldade', '$categoria', '$porcoes', '$modo_prep', '$titulo', '$imagem')");

?>