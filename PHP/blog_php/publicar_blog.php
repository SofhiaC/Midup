<?php

session_start();
require "conexao.php";

function create($conexao){
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $subtitulo = isset($_POST['subtitulo']) ? $_POST['subtitulo'] : '';
    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';
    $topico = isset($_POST['topico']) ? $_POST['topico'] : '';
    $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : '';    
    $id_usuario = 1;

    $stm = $conexao->prepare("INSERT INTO tb_blog (id_usuario, titulo_blog, subtitulo, imagem_blog, topico_blog, txt_blog) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stm) {
        echo "Erro ao preparar o statement: " . $conexao->error . "<br>";
        return;
    }
    $stm->bind_param("isssss", $id_usuario, $titulo, $subtitulo, $imagem, $topico, $conteudo);

    if ($stm->execute()) {
        echo "Dados inseridos com sucesso!<br>";
    } else {
        echo "Erro ao inserir dados: " . $stm->error . "<br>";
    }
    $stm->close();
}

$conexao->close();
?>