<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if($mysqli -> connect_errno){
    echo "Falha ao conectar: (". $mysqli->connect_errno . ")" .mysqli->connect_error;
} else {
    echo "Conectado"
}


$titulo = $_POST['nome'];
$imagem_carregada = $_POST['imagem_carregada'];
$introducao = $_POST['introducao'];
$ingredientes = $_POST['ingredientes'];
$modo_prep = $_POST['modo_prep'];
$porcoes = $_POST['porcoes'];
$dificuldade = $_POST['dificuldade'];
$categorias = $_POST['cat'];
$tempo_preparo = $_POST['tempo'];

?>