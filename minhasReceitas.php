<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReVirado</title>
    <link rel="stylesheet" href="minhasReceitas.css">
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


    </div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="cardheader">
                        <h4>Minhas Receitas</h4>
                        <button id="botao_publicar">
                        <a href="publicar.html" class="btn btn-primary float-end">Publicar Receita</a>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table-body">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Dificuldade</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = 'SELECT * FROM tb_receita';
                                $receitas = mysqli_query($conexao, $sql);
                                if (mysqli_num_rows($receitas) > 0){
                                    foreach ($receitas as $receita) {
                                ?>
                                <tr>
                                    <td><?=$receita['nome_receita'] ?> </td>
                                    <td><?=$receita['dificuldade'] ?> </td>
                                    <td><?=$receita['tipo_receita'] ?> </td>
                                    <td class="td_acoes">
                                        <button id="read">
                                        <a href="usuario-view.php?dificuldade=<?=$receita['dificuldade']?>" class="botaoread">Visualizar</a>
                                        </button>
                                        <button id="update">
                                        <a href="receita-edit.php?dificuldade=<?=$receita['dificuldade']?>" class="botaoupdate" >Editar</a>
                                        </button>
                                        <form action="deletar_receita.php" method="POST">
                                            <button onclick="return confirm('Tem certeza que deseja excluir a receita?')" name="delete_receita" id="delete" type="submit" value="<?=$receita['dificuldade']?>" >Excluir</button>
                                        </form>
                                  
                                    </td>
                                </tr>
                                <?php 
                                } 
                            } else{
                                    echo '<h5> Nenhuma receita encontrada </h5>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



<footer>
    <div class="redes_sociais"> 
        <img src="imagens/redes_sociais.png" alt="Outras redes sociais do ReVirado.">
        <p>Todos os direitos reservados - Midup</p>
    </div>
</footer>

</body>
</html>