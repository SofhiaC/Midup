<?php

    

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
            echo "<script>alert('email ou senha incorreto!'); window.location.href='cadastro.html';</script>";
        
        }
        else {
            header('Location: filtro.html');
        }

    }
    else {
        echo "<script>
        alert('email ou senha incorreto!'); window.location.href='registrar.html';
        </script>";
        header('Location: cadastro.html');
    }
    
?>