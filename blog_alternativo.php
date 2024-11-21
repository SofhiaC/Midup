<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);


function read($conexao) {
    $query = "SELECT id_blog, titulo_blog, subtitulo, txt_blog, imagem_blog FROM tb_blog";
    $result = $conexao->query($query);
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC); // Retorna os dados em um array associativo
    }
    return []; // Retorna vazio se não houver dados
}
   
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="blog_alternativo.css">
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
    <form  method="get" action="cadastro.php"></form>
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
            <a>Receita</a>
            <a href="blog.html">Blog</a>
        </div>
        <div class="usuario">
            <h3> Usuário </h3>
            <img src="imagens/foto_usuario.png" alt="Foto de perfil">
        </div>
    </div>
    <!-- Barra de pesquisa -->
    <div class="barra_geral">
        <form action="/pesquisar" method="post">
            <label for="ingrediente"></label>
            <input type="text" id="ingrediente" name="ingrediente" placeholder="Insira um ingrediente" required>
            <button type="submit"><img src="imagens/lupa_pesquisa.png"></button>
        </form>
    </div>
    <br>
    <br>

    <div class="introducao"> 
        <div class="infos">
            <h2>O saber da culinária vai além de seu sabor</h2>
            <br> 
            <p>A culinária é mais do que a combinação de ingredientes; é uma arte que transcende o simples ato de cozinhar. Em cada prato preparado, há uma história, um pedaço da cultura e um toque de tradição que atravessa gerações. O sabor é apenas uma das dimensões da gastronomia – o que ela realmente oferece vai além disso. A experiência culinária envolve texturas, cores, aromas e uma conexão que desperta memórias e sentimentos. Cada receita carrega o carinho de quem a prepara, seja para nutrir, celebrar ou confortar. Cozinhar é, muitas vezes, uma forma de amor em ação, um gesto que toca a alma de quem compartilha a refeição.</p>
        </div>
        <div class="imagem_info">
            <img src="imagens/fazendo_massa.png">
        </div>
    </div>

    <br>
    <br>

    <h2 class="melh_av"> Mais Apreciados </h2>

    <main class="container-post">
    <?php $lista = read($conexao); ?>
    <?php if (!empty($lista)): ?>
        <?php foreach ($lista as $post): ?>
            <div class="post">
                <a href="mostrar_publicacao.php?id=<?= urlencode($post['id_blog']) ?>">
                    <div class="content-post">
                        <h3><?= htmlspecialchars($post['titulo_blog']) ?></h3>
                        <h4><?= htmlspecialchars($post['subtitulo']) ?></h4>

                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Não há posts disponíveis no momento.</p>
    <?php endif; ?>
</main>


    <footer>
        <div class="redes_sociais"> 
            <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
            <p>Todos os direitos reservados - Midup</p>
        </div>
    </footer>

</body>
</html>