<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);


function update($conexao){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $introducao = $_POST['introducao'];
        $ingredientes = $_POST['ingredientes'];
        $modo_prep = $_POST['modo_prep'];
        $porcoes = $_POST['porcoes'];
        $dificuldade = $_POST['dificuldade'];
        $categoria = $_POST['cat'];
        $tempo_preparo = $_POST['tempo'];
        $id_receita = $_POST['id_receita'];
    
        // Preparar a query de atualização
        $sql = "UPDATE tb_receita SET 
                    nome_receita = ?, 
                    introducao = ?, 
                    ingredientes = ?, 
                    modo_de_preparo = ?, 
                    quant_porcoes = ?, 
                    dificuldade = ?, 
                    tipo_receita = ?, 
                    tempo_preparo = ?
                WHERE id_receita = ?";
    
        $stm = $conexao->prepare($sql);
        $stm->bind_param("ssssssssi", $titulo, $introducao, $ingredientes, $modo_prep, $porcoes, $dificuldade, $categoria, $tempo_preparo, $id_receita);
        
        if ($stm->execute()) {
            header("Location: minhasReceitas.php");
            exit;
        } else {
            echo "Erro na atualização: " . $stm->error;
        }
    }


}

if (mysqli_affected_rows($conexao) > 0){
    header("Location: minhasReceitas.php");
    exit;
} else {
    header("Location: minhasReceitas.php");
    exit;
}

$conexao->close();

?>