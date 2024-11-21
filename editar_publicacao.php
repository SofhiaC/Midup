<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conexao->connect_errno) {
    die("Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_blog = (int)$_POST['id'];
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $conteudo = $_POST['conteudo'];
    $topico = $_POST['topico'];
    $imagem = $_FILES['imagem']['name'];

    $sql_update = "UPDATE tb_blog SET titulo_blog=?, subtitulo=?, txt_blog=?, topico_blog=?, imagem_blog=? WHERE id_blog=?";
    $stmt_update = $conexao->prepare($sql_update);
    
    if (!$stmt_update) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt_update->bind_param("sssssi", $titulo, $subtitulo, $conteudo, $topico, $imagem, $id_blog);
    

    if ($stmt_update->execute()) {
        echo "<script>alert('Postagem atualizada com sucesso!');</script>";

    } else {
        echo "<script>alert('Erro ao atualizar postagem: " . $stmt_update->error . "');</script>";
    }

    $stmt_update->close();
}


$id_blog = (int)($_GET['id'] ?? 0);

if ($id_blog <= 0) {
    die("ID inválido.");
}

$sql = "SELECT id_blog, titulo_blog, subtitulo, txt_blog, imagem_blog, topico_blog FROM tb_blog WHERE id_blog = ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$stmt->bind_param("i", $id_blog);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    die("Postagem não encontrada.");
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

    <form action="" method="POST" enctype="multipart/form-data"> <!-- Adicionado enctype para upload de arquivos -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id_blog']) ?>">

        <section class="geral">

            <div>
                <label for="input_titulo"> Título: </label>
                <input type="text" name="titulo" id="input_titulo" placeholder="Digite o título da publicação" maxlength="100" value="<?= htmlspecialchars($post['titulo_blog']) ?>" required>
            </div>

            <div>
                <label for="input_subtitulo"> Subtítulo: </label>
                <input type="text" name="subtitulo" id="input_subtitulo" placeholder="Digite o subtítulo da publicação" maxlength="200" value="<?= htmlspecialchars($post['subtitulo']) ?>" required>
            </div>

            <div>
                <label for="text_conteudo"> Conteúdo: </label>
                <textarea name="conteudo" id="text_conteudo" maxlength="10000" required><?= htmlspecialchars($post['txt_blog']) ?></textarea>
            </div>

            <div>
                <label for="topico"> Tópico: </label>
                <input type="text" name="topico" id="input_topico" placeholder="Digite o tópico da publicação" value="<?= htmlspecialchars($post['topico_blog']) ?>">
            </div>

            <div>
                <label for="user"> Imagem: </label>
                <input type="file" id="input_img" name="imagem">
            </div>

        </section>

        <button id="botao_publicar" type="submit">Atualizar</button>
    </form>

<footer>
    <div class="redes_sociais"> 
        <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
        <p>Todos os direitos reservados - Midup</p>
    </div>
</footer>

</body>
</html>

<?php
$stmt->close();
$conexao->close();
?>