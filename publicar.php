<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if($conexao -> connect_errno){
    echo "Falha ao conectar: (". $conexao->connect_errno . ")" .conexao->connect_error;
} else {
    echo "Conectado";
}

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

    $stm = $conexao->prepare("INSERT INTO tb_receita (tempo_preparo, dificuldade, tipo_receita, quant_porcoes, modo_de_preparo, nome_receita, imagem_receita, ingredientes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->bind_param("ssssssss", $tempo_preparo, $dificuldade, $categoria, $porcoes, $modo_prep, $titulo, $imagem, $ingredientes);
    $stm->execute();
    $stm->close();
};

function read($conexao){
    $result = mysqli_query($conexao, "SELECT * FROM tb_receita" );
    return $result;
};

function update($conexao, $dificuldade, $titulo){
    $stm = $conexao->prepare("UPDATE tb_receita SET dificuldade = ? WHERE nome_receita = ?");
    $stm->bind_param("ss", $dificuldade, $titulo);
    $stm->execute();
    $stm->close();
};


function delete($conexao, $nome){
    $stm = $conexao->prepare("DELETE FROM tb_receita WHERE nome_receita = ?");
    $stm->bind_param("s", $nome);
    $stm->execute();
    $stm->close();
};

$conexao->close();
?>