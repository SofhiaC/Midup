<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $introducao = $_POST['introducao'];
    $ingredientes = $_POST['ingredientes'];
    $modo_prep = $_POST['modo_prep'];
    $porcoes = $_POST['porcoes'];
    $dificuldade = $_POST['dificuldade'];
    $categoria = $_POST['cat'];
    $tempo_preparo = $_POST['tempo'];


    $sql_update = "UPDATE tb_receita SET nome_receita=?, introducao=?, ingredientes=?, modo_de_preparo=?, quant_porcoes=?, dificuldade=?, tipo_receita=?, tempo_preparo=? WHERE dificuldade=?";
    $stmt_update = $conexao->prepare($sql_update);
    
    if (!$stmt_update) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt_update->bind_param(
        "sssssssss",
        $titulo,
        $introducao,
        $ingredientes,
        $modo_prep,
        $porcoes,
        $dificuldade,
        $categoria,
        $tempo_preparo,
        $dificuldade_antiga
    );

    if ($stmt_update->execute()) {
        echo "<script>alert('Postagem atualizada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao atualizar postagem: " . $stmt_update->error . "');</script>";
    }

    $stmt_update->close();
}

if (mysqli_affected_rows($conexao) > 0) {
    header("Location: minhasReceitas.php");
    exit;
} else {
    header("Location: minhasReceitas.php");
    exit;
}

?>
