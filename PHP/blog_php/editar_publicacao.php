<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conexao->connect_errno) {
    echo "Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error;
    exit();
}


$id_blog = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Busca o post correspondente no banco de dados
$sql = "SELECT * FROM tb_blog WHERE id_blog = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_blog);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Post não encontrado.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $txt_blog = $_POST['txt_blog'];

    $sql_update = "UPDATE tb_blog SET titulo_blog = ?, subtitulo = ?, txt_blog = ? WHERE id_blog = ?";
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("sssi", $titulo, $subtitulo, $txt_blog, $id_blog);
    
    if ($stmt_update->execute()) {
        echo "Post atualizado com sucesso!";
        header('Location: mostrar_publicacao.php?id=' . $id_blog);
        exit();
    } else {
        echo "Erro ao atualizar o post.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="publicar_blog.css">
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
            <h3> Usuário </h3>
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

    <form action="editar_post.php?id=<?= $id_blog ?>" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($post['titulo_blog']) ?>" required>
        
        <label for="subtitulo">Subtítulo:</label>
        <input type="text" id="subtitulo" name="subtitulo" value="<?= htmlspecialchars($post['subtitulo']) ?>" required>
        
        <label for="txt_blog">Texto:</label>
        <textarea id="txt_blog" name="txt_blog" required><?= htmlspecialchars($post['txt_blog']) ?></textarea>
        
        <button type="submit">Atualizar Post</button>
    </form>

<footer>
    <div class="redes_sociais"> 
        <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
        <p>Todos os direitos reservados - Midup</p>
    </div>
</footer>

</body>
</html>