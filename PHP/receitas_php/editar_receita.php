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

function update($conexao){
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

    if ($id_receita) {
        $stm = $conexao->prepare("UPDATE tb_receita SET tempo_preparo = ?, dificuldade = ?, tipo_receita = ?, quant_porcoes = ?, modo_de_preparo = ?, nome_receita = ?, imagem_receita = ?, ingredientes = ? WHERE id_usuario = 1");
        $stm->bind_param("isssssssi", $tempo_preparo, $dificuldade, $categoria, $porcoes, $modo_prep, $titulo, $imagem, $ingredientes);

        if ($stm->execute()) {
            echo "Receita atualizada com sucesso!";
        } else {
            echo "Falha na atualização: " . mysqli_error($conexao);
        }
        $stm->close();
    } else {
        echo "ID da receita não fornecido.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_receita'])) {
    update($conexao);
}

$conexao->close();

?>