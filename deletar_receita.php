<?php 

$hostname = "localhost";
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conexao->connect_errno) {
    die("Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
} 

echo "Conectado<br>";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_receita'])) {

    $dificuldade = mysqli_real_escape_string($conexao, $_POST['delete_receita']);

    if (!empty($dificuldade)) {

        $sql = "DELETE FROM tb_receita WHERE dificuldade = '$dificuldade'";
        

        if (mysqli_query($conexao, $sql)) {
            if (mysqli_affected_rows($conexao) > 0) {
                header("Location: minhasReceitas.php?status=sucesso");
                exit;
            } else {
                echo "Nenhuma receita encontrada para excluir.<br>";
            }
        } else {
            echo "Erro ao excluir a receita: " . mysqli_error($conexao) . "<br>";
        }
    } else {
        echo "Valor de dificuldade inválido.<br>";
    }
}


$conexao->close();
?>