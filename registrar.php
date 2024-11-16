<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado - Cadastro</title>
    <link rel="stylesheet" href="registrar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
</head>
<body>

    <div class="header">
        <a href="#" class="back-arrow"><i class='bx bx-arrow-back'></i></a>
    </div>

    <div class="wrapper">
        <?php
            include"conexao.php";

            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $senha = MD5($_POST['senha']);
            $verificar = $mysqli->prepare("SELECT email_usuario FROM tb_usuario WHERE email_usuario = ?");
            $verificar->bind_param("s", $email);  
            $verificar->execute();
            $resultado = $verificar->get_result();

            if ($resultado->num_rows > 0) {
                echo "<script>
                alert('Usuário já existe.'); window.location.href='registrar.html';
                </script>";
              die();
            } else 
            $sql = "INSERT INTO `tb_usuario`(`email_usuario`,`idade`, `nome_usuario`, `senha_usuario`) VALUES ('$email','$nome','$idade','$senha')";
            echo "<script>window.location.href='registrar2.php?email=" . urlencode($email) . "';</script>";

                    $verificar->close();
                    $mysqli->close();
                    
            
?>
            
            
            
    </div>
<br>
<br>
<br>
    <footer>
        <div class="social-icons">
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-discord'></i></a>
            <a href="#"><i class='bx bxl-pinterest'></i></a>
            <a href="#"><i class='bx bxl-twitch'></i></a>
            <a href="#"><i class='bx bxl-youtube'></i></a>
        </div>
        <p>Todos os direitos reservados - © 2024 Midup</p>
    </footer>

</body>
</html>
