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
    <title>Editar Receita</title>
    <link rel="stylesheet" href="publicar.css">
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
        
        

        <h1>Editar Receita</h1>
        
        <br>
        <br>


        <div class="geral">
            <h3 id="titulo"> <strong>Geral</strong></h3>
            <?php if(isset($_GET['dificuldade'])) {
                $dificuldade = mysqli_real_escape_string($conexao, $_GET['dificuldade']);
                $sql = "SELECT * FROM tb_receita WHERE dificuldade='$dificuldade'";
                $query = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($query) > 0){
                    $receitas = mysqli_fetch_array($query);
                }

            

             ?>
            <form method="post" action="editar_receita.php">

                    <div>
                        <label for="input_titulo"> Título: </label>
                        <input type="text" name="titulo" id="input_titulo" placeholder="Digite o título da sua receitas" value="<?=$receitas['nome_receita']?>" maxlength="100" required>
                    </div>

                    <br>

                    <div>
                        <label for="imagem_caregada"> Imagem: </label>
                        <input type="file" id="input_img" name="imagem_caregada" value="<?=$receitas['imagem_receita']?>">
                    </div>

        </div>

        <br>
        <br>

        <div class="cont_principal">
            <h3 id="titulo"> <strong>Conteúdo Principal </strong></h3>

                    <div>
                        <label for="input_intro"> Introdução: </label>
                        <input type="text" name="introducao" id="input_intro" value="<?=$receitas['introducao']?>" placeholder="Digite a introdução da sua receitas" required>
                    </div>

                    <br>

                    <div>
                        <label for="input_ingredientes"> Ingredientes: </label>
                        <input type="text" id="input_ingredientes" name="ingredientes" value="<?=$receitas['ingredientes']?>" placeholder="Digite os ingredientes da receitas" required>
                    </div>

                    <br>

                    <div>
                        <label for="input_modo_prep"> Modo de preparo: </label>
                        <input type="text" id="input_modo_prep" name="modo_prep" value="<?=$receitas['modo_de_preparo']?>" placeholder="Digite o modo de preparo da receitas" required maxlength="5500">
                    </div>

        </div>

        <br>
        <br>

        <div class="complementares">
            <h3 id="titulo"> <strong>Complementares</strong></h3>

                    <div>
                        <label for="input_porcoes"> Porções: </label>
                        <input type="number" name="porcoes" id="input_porcoes" value="<?=$receitas['quant_porcoes']?>" placeholder="Quantidade de porções da receitas" required>
                    </div>

                    <br>

                    <div>
                        <label for="dificuldade"> Dificuldade: </label>

                        <select name="dificuldade" id="dificuldade" required>
                            <option value="" selected disabled>Selecione</option>
                            <option value="Fácil">Fácil</option>
                            <option value="Média">Média</option>
                            <option value="Dificil">Difícil</option>
                        </select>
                    </div>

                    <br>

                    <div class="categorias">
                        <label for="Categoria">Categoria: </label>

                        <br>
                        <br>
                    
                        <label for="receitasrapidas">
                            <input type="radio" name="cat" value="Receitas Rápidas">Receitas Rápidas
                        </label>

                        <br>

                        <label for="cafe">
                            <input type="radio" name="cat" value="Cfé da Manhã">Café da manhã
                        </label>

                        <br>

                        <label for="almoco">
                            <input type="radio" name="cat" value="Almoço">Almoço
                        </label>

                        <br>

                        <label for="jantar">
                            <input type="radio" name="cat" value="Jantar">Jantar
                        </label>

                        <br>
                        
                        <label for="sobremesas">
                            <input type="radio" name="cat" value="Sobremesas">Sobremesas
                        </label>

                        <br>

                        <label for="Receitas Veganas">
                            <input type="radio" name="cat" value="Receitas Veganas">Receitas Veganas
                        </label>
                    </div>

                    <br>

                    <div>
                        <label for="input_tempo"> Tempo de preparo: </label>
                        <input type="text" name="tempo" id="input_tempo" value="<?=$receitas['tempo_preparo']?>" placeholder="Digite o tempo de preparo da receitas" required>
                    </div>

                    <button name="atualizar" type="submit" id="botao_publicar"> Atualizar </button>
            </form>
            <?php
                } else{
                    echo "<h5> Receita não encontrada </h5>";
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