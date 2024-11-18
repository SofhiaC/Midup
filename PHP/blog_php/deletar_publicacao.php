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

function delete($conexao) {
    if (isset($_POST['id_blog'])) {
        $id_blog = $_POST['id_blog'];

        $stm = $conexao->prepare("DELETE FROM tb_blog WHERE id_blog = ?");
        if (!$stm) {
            echo "Erro ao preparar o statement: " . $conexao->error . "<br>";
            return;
        }

        $stm->bind_param("i", $id_blog);

        if ($stm->execute()) {
            echo "Blog excluído com sucesso!<br>";
        } else {
            echo "Erro ao excluir dados: " . $stm->error . "<br>";
        }
        $stm->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_blog'])) {
    delete($conexao);
}

$conexao->close();
?>