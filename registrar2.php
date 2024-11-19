<?php 
    
    var_dump($_GET); // Para verificar se o email está sendo passado corretamente
    var_dump($_POST);
    var_dump($_FILES);

    include "conexao.php";

    $email = isset($_GET['email']) ? urldecode($_GET['email']) : null;

    $biografia = $_POST['biografia'] ?? null;
    $caminho = null;

    if (isset($_FILES['foto_usuario'])) {
        $arquivo = $_FILES['foto_usuario'] ?? null;

        $pasta = "arquivos/";
        $nome_arquivo = pathinfo($arquivo['name'], PATHINFO_FILENAME);
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $nome_arquivo_completo = $nome_arquivo . "." . $extensao;
        $caminho = $pasta . $nome_arquivo_completo;

        $caminho = $pasta . $nome_arquivo . "." . $extensao;

        if (!move_uploaded_file($arquivo['tmp_name'], $caminho)) {
            $caminho = null; 
        }
    }

        if ($biografia || $caminho) {
            $stmt = $mysqli->prepare("UPDATE tb_usuario SET biografia = ?, foto_usuario = ? WHERE email_usuario = ?");
            $stmt->bind_param("sss", $biografia, $nome_arquivo_completo, $email);     

            $stmt->close();

        }
    $mysqli->close();



?><!DOCTYPE html>
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
        <form enctype="multipart/form-data" method="POST" action="registrar2.php?email=<?php echo urlencode($_GET['email']); ?>">

        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <h1>ReVirado</h1>
                <label class="picture" for="foto_usuario" >

                    <input type="file"  hidden accept="imagen/*"  id="foto_usuario" name="foto_usuario">
                    <span class="aqui_foto"></span>

                </label>

                <div class="input-box">
                    <input type="text" placeholder="Fale um pouco sobre si:" class="input-box" name="biografia">
                </div>

            <button type="submit" class="btn" name="submit">Continuar</button> 
        
        </form>
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

    <script>
       const inputFile = document.querySelector("#foto_usuario");
        const pictureImage = document.querySelector(".aqui_foto");
        const pictureImageTxt = "Adicione sua foto aqui!";
        pictureImage.innerHTML = pictureImageTxt;

        inputFile.addEventListener("change", function (e) {
        const inputTarget = e.target;
        const file = inputTarget.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            img.classList.add("picture__img");
            pictureImage.innerHTML = '';

            pictureImage.innerHTML = "";
            pictureImage.appendChild(img);
            });

            reader.readAsDataURL(file);
        } else {
            pictureImage.innerHTML = pictureImageTxt;
        }
        });
    </script>
</body>
</html>
