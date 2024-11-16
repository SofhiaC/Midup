<?php 
    include "conexao.php";
    $objetivos = $_POST['objetivos'];
    $biografia = $_POST['biografia'];
    if (isset($_FILES['avatar'])) {
        $arquivo = $_FILES['avatar'];
        $pasta = "arquivos/";
        $envio = move_uploaded_file($arquivo['avatar'], $pasta);

    $sql = "INSERT INTO `tb_usuario`(`foto_usuario`,`objetivos`, `biografia`) VALUES ('$avatar','$objetivos','$biografia')";

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro finalizado com sucesso!'); window.location.href='filtro.html';</script>";
    } else {
        echo "<script>alert('Erro ao finalizar o cadastro.');</script>";
    }

    $stmt->close();
    $mysqli->close();

    }

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
        <form method="POST" action="registrar2.php">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <h1>ReVirado</h1>
                <label class="picture" for="avatar" >

                    <input type="file"  hidden accept="imagens/*"  id="avatar" name="avatar">
                    <span class="aqui_foto"></span>

                </label>

                <select class="nput-box" name="objetivos" id="dificuldade" required>
                
                            <option value="" selected disabled>Qual seu objetivo?</option>
                            <option value="Emagrecimento">Emagrecimento</option>
                            <option value="Cuidar da saúde">Cuidar da saúde</option>
                            <option value="Otimizar o tempo">Otimizar o tempo</option>
                            <option value="Evitar desperdicios">Evitar desperdicios</option>
                            <option value="Outro">Outro</option>
                </select>

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
       const inputFile = document.querySelector("#avatar");
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
