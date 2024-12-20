<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once('conexao.php');

    $id = $_SESSION['id'];
    $sqli = "SELECT * FROM tb_usuario WHERE $id";
    $resultado = $mysqli->query($sqli);
    $todos = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="filtro.css">
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
            <a>Filtro</a>
            <a>Receita</a>
            <a href="blog.html">Blog</a>
        </div>
        <div class="usuario">
            <a href="usuaro.php"> <?php echo "<h3>". $todos['nome_usuario'] ."</he>"; ?></a>
            <img src="imagens/foto_usuario.png" alt="Foto de perfil">
        </div>
    </div>
    <!-- Barra de pesquisa -->
    <div class="barra_geral">
        <form action="/pesquisar" method="get">
            <div id="pesquisa_filtro">
                <input type="text" id="txtBusca" placeholder="Insira um ingrediente..."/>
                <button><img src="imagens/lupa_pesquisa.png" id="btnBusca" alt="Buscar"/></button>  
            </div>
        </form>
    </div>
    <br>
    <h2>- Melhores Avaliações -</h2>
    <br>

    <!--Aqui começa as melhores avaliações em uma linha, porém ainda tem que ver o esquema das avaliações estarem alinhadas-->
    <div class="carrossel">
        <div class="comida1">
            <img src="carrossel/carrossel_imagem1.png" alt="Carbonara com bacon e queijo ralado" class="foto">
            <h4>Carbonara com bacon e queijo ralado</h4>
            <!--Aqui vou colocar a avaliação como uma imagem das estrelas, porém acredito que a gente vai ter que pegar de alguma forma os dados das avaliações e colocar aqui de uma forma mais dinâmica.-->
            <img src="carrossel/5estrelas.png" alt="5 estrelas" class="estrelas">
        </div>
        <div class="comida2">
            <img src="carrossel/carrossel_imagem2.png" alt="Salada Cesar" class="foto">
            <h4>Salada Cesar</h4>
            <!--avaliação a rever formato também-->
            <img src="carrossel/5estrelas.png" alt="5 estrelas" class="estrelas">
        </div>
        <div class="comida3">
            <img src="carrossel/carrossel_imagem3.png" alt="Nhoque com molho de tomate" class="foto">
            <h4>Nhoque com molho de tomate</h4>
            <img src="carrossel/5estrelas.png" alt="5 estrelas" class="avaliacao">
        </div>
        <div class="comida4">
            <img src="carrossel/carrossel_imagem4.png" alt="Hambúrguer de frango caseiro" class="foto">
            <h4>Hambúrguer de frango caseiro</h4>
            <img src="carrossel/5estrelas.png" alt="5 estrelas" class="avaliacao">
        </div>
        <div class="comida5">
            <img src="carrossel/carrossel_imagem5.png" alt="Salada de forno cremosa com legumes" class="foto">
            <h4>Salada de forno cremosa com legumes</h4>
            <img src="carrossel/5estrelas.png" alt="5 estrelas" class="avaliacao">
        </div>
    </div>

    <br><br>
    <h2>Confira receitas filtradas que melhor se encaixam no seu momento!</h2>
    <br><br>

    <div class="receitas_filtradas">
        <div class="linha1">
            <div class="receitas_rapidas">
                <h3>Receitas Rápidas</h3>
                <p>Ideias para você gastar  em média 15 minutos para preparar</p>
                <img src="receitas_filtradas/receitas_rapidas.png">
            </div>
            <div class="cafe_da_manha">
                <h3>Café da Manhã</h3>
                <p>Opções de refeições para acompanhar sua rotina matinal</p>
                <img src="receitas_filtradas/cafe_da_manha.png">
            </div>
        </div>
        <br>
        <br>
        <div class="linha2">
            <div class="almoco">
                <h3>Almoço</h3>
                <p>Refeições saborosas e fáceis para combinar com o seu dia</p>
                <img src="receitas_filtradas/almoco.png">
            </div>
            <div class="jantar">
                <h3>Jantar</h3>
                <p>Pratos leves e fáceis para finalizar seu dia com qualidade e inovação</p>
                <img src="receitas_filtradas/jantar.png">
            </div>
        </div>
        <br>
        <br>
        <div class="linha3">
            <div class="sobremesas">
                <h3>Sobremesas</h3>
                <p>Doçuras para alegrar e melhorar seu dia</p>
                <img src="receitas_filtradas/sobremesas.png">
            </div>
            <div class="receitas_veganas">
                <h3>Receitas Veganas</h3>
                <p>Pratos nutritivos e saborosos apenas com ingredientes de origem natural</p>
                <img src="receitas_filtradas/receitas_veganas.png">
            </div>
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
        document.getElementById('user-name').textContent = username || 'Login';
    </script>
</body>
</html>