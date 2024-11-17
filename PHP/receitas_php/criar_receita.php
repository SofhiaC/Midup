<?php

session_start();
require "conexao.php";


function create($conexao) {
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $imagem = isset($_POST['imagem_carregada']) ? $_POST['imagem_carregada'] : '';
    $introducao = isset($_POST['introducao']) ? $_POST['introducao'] : '';
    $ingredientes = isset($_POST['ingredientes']) ? $_POST['ingredientes'] : '';
    $modo_prep = isset($_POST['modo_prep']) ? $_POST['modo_prep'] : '';
    $porcoes = isset($_POST['porcoes']) ? $_POST['porcoes'] : '';
    $dificuldade = isset($_POST['dificuldade']) ? $_POST['dificuldade'] : '';
    $categoria = isset($_POST['cat']) ? $_POST['cat'] : '';
    $tempo_preparo = isset($_POST['tempo']) ? $_POST['tempo'] : '';
    $id_usuario = 1;

    $stm = $conexao->prepare("INSERT INTO tb_receita (id_usuario, tempo_preparo, dificuldade, tipo_receita, quant_porcoes, modo_de_preparo, nome_receita, imagem_receita, ingredientes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->bind_param("issssssss", $id_usuario, $tempo_preparo, $dificuldade, $categoria, $porcoes, $modo_prep, $titulo, $imagem, $ingredientes);
    if ($stm->execute()){
        echo "Receita inserida com sucesso";
    }else{
        echo "falha na inserção: ". mysqli_error($conexao);
    };
    $stm->close();
};

?>