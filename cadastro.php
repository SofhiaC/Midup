<?php
session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $entrar =$_POST['entrar'];

    if (isset($_POST['entrar']) && !empty($_POST['email']) && !empty($_POST['senha'])){

        include_once('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email' and senha_usuario = '$senha'";
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['email_usuario']);
            unset($_SESSION['senha_usuario']);
            echo "<script>alert('email ou senha incorreto!'); window.location.href='cadastro.html';</script>";
        
        }
        else {
            $_SESSION['email_usuario'] = $email;
            $_SESSION['senha_usuario'] = $senha;
            header('Location: filtro2.php');
        }

    }
    else {
        echo "<script>
        alert('email ou senha incorreto!'); window.location.href='registrar.html';
        </script>";
        header('Location: cadastro.html');
    }
    
?>