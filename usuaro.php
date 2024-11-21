<?php
if (!isset($_SESSION)) {
    session_start();
}
include "conexao.php";
$id = $_SESSION['id'];
$sqli = "SELECT * FROM tb_usuario WHERE $id";
$resultado = $mysqli->query($sqli);
$todos = mysqli_fetch_assoc($resultado);

$nome = $todos['nome_usuario'];
$email = $todos['email_usuario'];
$idade = $todos['idade'];
$objetivos = $todos['objetivos'];
$biografia = $todos['biografia'];
$foto = $todos['foto_usuario'];


?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="usuario.css">
    <!-- Fonte Calligrafitti usada no título -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">
    <!--Fonte jaldi-->
    <link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">
    <!--Fonte inter-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <h1 class="revirado">ReVirado</h1>
    
    <div class="botoes_salvos_e_notif">
        <a><img src="imagens/botao_notif.png" alt="Notificações" class="botao1"></a>
        <a><img src="imagens/botao_salvos.png" alt="Salvos" class="botao2"></a>
    </div>
    <!-- Esse hr é o responsável por fazer a linha horizontal -->
    <hr/>
    <div class="nav">
        <div class="navbar">
            <a>Home</a>
            <a href="filtro.html">Filtro</a>
            <a href="receitas.html">Receita</a>
            <a href="blog.html">Blog</a>
        </div>
    </div>
    <br>

    <div id="caixa">
        <div id="foto">
            <label class="picture" for="foto_usuario" >
                Sua foto aqui!
                <input type="file"  hidden accept="imagen/*"  id="foto_usuario" name="foto_usuario">
                <span class="aqui_foto"><?php echo  $todos['foto_usuario'] ;?></span>

            </label>
        </div>

        <div id="caixa2">
            <p class="nome">Nome:</p>
            <div id="nome" class="conteudo">
                <?php echo  $nome ;?>
            </div>
            <p class="email">e-mail:</p>
            <div id="email" class="conteudo">
            <?php echo  $todos['email_usuario'] ;?>
            </div>
            <p class="pa">idade:</p>
            <p class="pe">objetivo:</p>
            <div id="idade" class="conteudo">
            <?php echo  $todos['idade'] ;?>
            </div >
            
            <div id="objetivos1" class="conteudo">
            <?php echo  $todos['objetivos'] ;?>
            </div>
            <p class="biografia">biografia:</p>
            <div id="biografia" class="conteudo">
            <?php echo  $todos['biografia'] ;?>
            </div>
        </div>
        <hr>
        <div id="botoes">
            <form action="" method="post">

                <button class="bts" name="sair_conta" type >Sair da conta</button>
                <button class="bts" name="editar_conta"><a href="editar.php">Editar perfil</a></button>
                            
            </form>
        </div>

    </div>

    <br>
    <br>
    <footer>
        <div class="redes_sociais"> 
            <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
            <p>Todos os direitos reservados - Midup</p>
        </div>
    </footer>

    <script>
        const inputFile = document.querySelector("#foto_usuario");
         const pictureImage = document.querySelector(".aqui_foto");
         const pictureImageTxt = "";
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
 <

</body>
</html>