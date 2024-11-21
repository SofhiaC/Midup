<?php
if (!isset($_SESSION)) {
    session_start();
}
include "conexao.php";
$id = $_SESSION['id'];
$sqli = "SELECT * FROM tb_usuario WHERE $id";
$resultado = $mysqli->query($sqli);

if($resultado->num_rows > 0){
    while($todos = mysqli_fetch_assoc($resultado)){
        $sqlDelete = "DELETE FROM `tb_usuario` WHERE id_usuario='$id'";
        $resultadoDe = $mysqli->query($sqlDelete);
    }
}
header('Location: filtro.html');
?>