<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($conexao->connect_errno){
    echo "Falha ao conectar: (". $conexao->connect_errno . ")" . $conexao->connect_error;
} else {
    echo"Conectado";
}

?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receita</title>
    <link rel="stylesheet" href="usuario_view.css">
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


    <section class="section">

        <br>


        <img src="imagens/flecha_voltar.png" alt="Flecha Voltar" id="flecha_volta">
        
        

        <h1>Visualizar Receita</h1>
        
        <br>
        <br>


    <div>
        <div class="geral">
            <?php 
                if (isset($_GET['dificuldade'])){
                    $dificuldade = mysqli_real_escape_string($conexao, $_GET['dificuldade']);
                    $sql = "SELECT * FROM tb_receita WHERE dificuldade='$dificuldade'";
                    $query = mysqli_query($conexao, $sql);


                    if (mysqli_num_rows($query) > 0){
                        $receita = mysqli_fetch_array($query);
                    
            ?>
            <h3 id="titulo"> <strong>Geral</strong></h3>

                    <div>
                        <label for="input_titulo"> Título: </label>
                        <div class="simulacao_inputtitulo">
                            <p id="nomereceita" class="form-control">
                                <?=$receita['nome_receita']; ?>
                            </p>
                        </div>
                    </div>

                    <br>

                    <div>
                        <label for="input_titulo"> Imagem: </label>
                        <p class="form-control">
                            <?=$receita['imagem_receita']; ?>
                        </p>
                    </div>

        </div>

        <br>
        <br>

        <div class="cont_principal">
            <h3 id="titulo"> <strong>Conteúdo Principal </strong></h3>

                    <div>
                        <label for="input_titulo"> Introdução: </label>
                        <div class="simulacao_inputintro">
                            <p class="form-control" id="introo">
                                <?=$receita['introducao']; ?>
                            </p>
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>

                    <div>
                        <label for="input_titulo"> Ingredientes: </label>
                        <div class="simulacao_inputingre">
                            <p id="ingre" class="form-control">
                                <?=$receita['ingredientes']; ?>
                            </p>
                        ]</div>
                    </div>

                    <br>
                    <br>

                    <div>
                        <label for="input_titulo"> Modo de Preparo: </label>
                        <div class="simulacao_inputmodo">
                            <p id="modo" class="form-control">
                                <?=$receita['modo_de_preparo']; ?>
                            </p>
                        </div>
                    </div>

        </div>

        <br>
        <br>

        <div class="complementares">
            <h3 id="titulo"> <strong>Complementares</strong></h3>

                    <div>
                        <label for="input_titulo"> Porções: </label>
                        <div class="simulacao_inputporcoes">
                            <p id="quant" class="form-control">
                                <?=$receita['quant_porcoes']; ?>
                            </p>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div>
                        <label for="input_titulo"> Dificuldade: </label>
                        <div class="simulacao_inputdific">
                            <p  id="dific" class="form-control">
                                <?=$receita['dificuldade']; ?>
                            </p>
                        </div>
                    </div>

                    <br>
                    <br>


                    <div>
                        <label for="input_titulo"> Categoria: </label>
                        <div class="simulacao_inputcat">
                            <p id="categ" class="form-control">
                                <?=$receita['tipo_receita']; ?>
                            </p>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div>
                        <label for="input_titulo"> Tempo de Preparo: </label>
                        <div class="simulacao_input">
                            <p id="tempo" class="form-control">
                                <?=$receita['tempo_preparo']; ?>
                            </p>
                        </div>
                    </div>

        </div>
        <?php

                } else{
                    echo '<h5> Receita não encontrada </h5>';
                }
            }
            ?>
    
    </div>



    </section>

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