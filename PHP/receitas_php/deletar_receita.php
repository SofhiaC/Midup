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
    $id_receita = isset($_POST['id_receita']) ? $_POST['id_receita'] : '';

    if ($id_receita) {
        $stm = $conexao->prepare("DELETE FROM tb_receita WHERE id_receita = ?");
        $stm->bind_param("i", $id_receita);
        if ($stm->execute()) {
            echo "Receita excluída com sucesso!";
        } else {
            echo "Falha na exclusão: " . mysqli_error($conexao);
        }
        $stm->close();
    } else {
        echo "ID da receita não fornecido.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_receita'])) {
    delete($conexao);
}

$conexao->close();

?>