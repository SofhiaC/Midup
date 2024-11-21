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
        $nome = $todos['nome_usuario'];
        $email = $todos['email_usuario'];
        $idade = $todos['idade'];
        $objetivos = $todos['objetivos'];
        $biografia = $todos['biografia'];
        $foto = $todos['foto_usuario'];
    }
}


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
    <form action="update_usuario.php" method="post" id="caixa">
            <div id="foto">
                <label class="picture" for="foto_usuario" >
                    Sua foto aqui!
                    <input type="file"  hidden accept="imagen/*"  id="foto_usuario" name="foto_usuario" value="<?php echo $foto; ?>">
                    <span class="aqui_foto"><?php echo  $todos['foto_usuario'] ;?></span>

                </label>
            </div>

            <div id="caixa2">

                <p class="nome">Nome:</p>
                <div id="nome" class="conteudo">
                    <input type="text" value="<?php echo $nome; ?>">
                </div>

                <p class="email">e-mail:</p>
                <div id="email" class="conteudo">
                <input type="text" value="<?php echo $email; ?>">
                </div>

                <p class="pa">idade:</p>
                <p class="pe">objetivo:</p>

                <div id="idade" class="conteudo">
                <input type="text" value="<?php echo $idade; ?>">
                </div >
                
                <div id="objetivos1" class="conteudo">
                <select class="input-box" name="objetivos" id="dificuldade" required style="color: rgb(132, 136, 136);" value="<?php echo $objetivos; ?>">
                        <option value="" selected disabled >Qual seu objetivo?</option>
                        <option value="Emagrecimento">Emagrecimento</option>
                        <option value="Cuidar da saúde">Cuidar da saúde</option>
                        <option value="Otimizar o tempo">Otimizar o tempo</option>
                        <option value="Evitar desperdicios">Evitar desperdicios</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <p class="biografia">biografia:</p>
                <div id="biografia" class="conteudo" >
                <input type="text" value="<?php echo $biografia; ?>">
                </div>
            </div>
            <hr>
            <div id="botoes">
                

                    <button class="bts" name="excluir_conta" type ><a href="delete_usuario.php">Deletar Conta</a></button>
                    <button class="bts" name="salvar_conta" type="submit"><a href="usuaro.php">Salvar</a></button>
                            
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