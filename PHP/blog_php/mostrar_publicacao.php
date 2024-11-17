<?php

include"conexao.php";

function read($conexao) {
    $result = $conexao->query("SELECT * FROM tb_blog");

    if ($result) {
        echo "Dados recuperados";
    } else {
        echo "Erro ao recuperar dados: " . $conexao->error . "<br>";
    }
}

$conexao->close();

?>