<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";


$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conexao->connect_errno) {
    die("Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
}


$id_blog = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$sql = "SELECT titulo_blog, subtitulo, txt_blog, imagem_blog, topico_blog FROM tb_blog WHERE id_blog = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_blog);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    die("Post não encontrado.");
}
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="mostrar_publicação.css">
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

    <div id="oPost">
        <h1 id= "tituloPost"><?= htmlspecialchars($post['titulo_blog']) ?></h1>
        <h2 id= "subTitulo" ><?= htmlspecialchars($post['subtitulo']) ?></h2>
        
        <?php if (!empty($post['imagem_blog'])): ?>
            <img src="<?= htmlspecialchars($post['imagem_blog']) ?>" alt="Imagem do post" style="width:100%;max-height:400px;object-fit:cover;">
        <?php endif; ?>
        
        <p id="corpoTexto"><?= nl2br(htmlspecialchars($post['txt_blog'])) ?></p>
        <p id="topicos"><?= nl2br(htmlspecialchars($post['topico_blog'])) ?></p>

    </div>
    
    <div id="botoesBlog"> 
        <form action="editar_publicacao.php" method="GET">
            <input type="hidden" name="id" value="<?= $id_blog ?>">
            <button type="submit" class="btn-editar">Editar</button>
        </form>
        
        <form action="deletar_publicacao.php" method="GET">
            <input type="hidden" name="id" value="<?= $id_blog ?>">
            <button type="submit" class="btn-deletar">Deletar</button>
        </form>

    </div>

    <footer>
        <div class="redes_sociais"> 
            <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
            <p>Todos os direitos reservados - Midup</p>
        </div>
    </footer>


</body>
</html>