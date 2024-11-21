<?php
include_once('conexao.php');
session_start()

if(isset($_POST('salvar_conta'))){
        $id = $_SESSION['id'];
        $nome = $_POST['nome_usuario'];
        $email = $_POST['email_usuario'];
        $idade = $_POST['idade'];
        $objetivos = $_POST['objetivos'];
        $biografia = $_POST['biografia'];
        $foto = $_POST['foto_usuario'];

        $sqlUpdate ="UPDATE tb_usuario SET nome_usuario='$nome',email_usuario='$email',idade='$idade',objetivos='$objetivos',biografia='$biografia',foto_usuario='$foto' WHERE id_usuario='$id'";

        $resultado = $mysqli->query($sqlUpdate);
}
header('Location: usuaro.php');

?>