<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";


$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if($conexao -> connect_errno){
    echo "Falha ao conectar: (". $conexao->connect_errno . ")" . $conexao->connect_error;
} else {
    echo "Conectado";
}


function create($conexao) {
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $imagem = isset($_POST['imagem_carregada']) ? $_POST['imagem_carregada'] : '';
    $introducao = isset($_POST['introducao']) ? $_POST['introducao'] : '';
    $ingredientes = isset($_POST['ingredientes']) ? $_POST['ingredientes'] : '';
    $modo_prep = isset($_POST['modo_prep']) ? $_POST['modo_prep'] : '';
    $porcoes = isset($_POST['porcoes']) ? $_POST['porcoes'] : '';
    $dificuldade = isset($_POST['dificuldade']) ? $_POST['dificuldade'] : '';
    $categoria = isset($_POST['cat']) ? $_POST['cat'] : '';
    $tempo_preparo = isset($_POST['tempo']) ? $_POST['tempo'] : '';
    $id_usuario = 1;

    $stm = $conexao->prepare("INSERT INTO tb_receita (id_usuario, tempo_preparo, dificuldade, tipo_receita, quant_porcoes, modo_de_preparo, nome_receita, imagem_receita, ingredientes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->bind_param("issssssss", $id_usuario, $tempo_preparo, $dificuldade, $categoria, $porcoes, $modo_prep, $titulo, $imagem, $ingredientes);
    if ($stm->execute()){
        echo "Receita inserida com sucesso";
    }else{
        echo "falha na inserção: ". mysqli_error($conexao);
    };
    $stm->close();
};

function read($conexao) {
    $result = $conexao->query("SELECT * FROM tb_receita");

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<h2>Receitas Cadastradas:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h3>" . $row['nome_receita'] . "</h3>";
                echo "<p><strong>Introdução:</strong> " . $row['introducao'] . "</p>";
                echo "<p><strong>Ingredientes:</strong> " . $row['ingredientes'] . "</p>";
                echo "<p><strong>Modo de Preparo:</strong> " . $row['modo_de_preparo'] . "</p>";
                echo "<p><strong>Categoria:</strong> " . $row['tipo_receita'] . "</p>";
                echo "<p><strong>Tempo de Preparo:</strong> " . $row['tempo_preparo'] . " minutos</p>";
                echo "<p><strong>Porções:</strong> " . $row['quant_porcoes'] . "</p>";
                echo "<p><strong>Dificuldade:</strong> " . $row['dificuldade'] . "</p>";
                echo "<img src='" . $row['imagem_receita'] . "' alt='Imagem da receita' style='max-width: 150px;'>";
                echo "</div><hr>";
            }
        } else {
            echo "Nenhuma receita encontrada.<br>";
        }
    } else {
        echo "Erro ao recuperar receitas: " . $conexao->error . "<br>";
    }
}

function update($conexao){
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $imagem = isset($_POST['imagem_carregada']) ? $_POST['imagem_carregada'] : '';
    $introducao = isset($_POST['introducao']) ? $_POST['introducao'] : '';
    $ingredientes = isset($_POST['ingredientes']) ? $_POST['ingredientes'] : '';
    $modo_prep = isset($_POST['modo_prep']) ? $_POST['modo_prep'] : '';
    $porcoes = isset($_POST['porcoes']) ? $_POST['porcoes'] : '';
    $dificuldade = isset($_POST['dificuldade']) ? $_POST['dificuldade'] : '';
    $categoria = isset($_POST['cat']) ? $_POST['cat'] : '';
    $tempo_preparo = isset($_POST['tempo']) ? $_POST['tempo'] : '';
    $id_usuario = 1;

    if ($id_receita) {
        $stm = $conexao->prepare("UPDATE tb_receita SET tempo_preparo = ?, dificuldade = ?, tipo_receita = ?, quant_porcoes = ?, modo_de_preparo = ?, nome_receita = ?, imagem_receita = ?, ingredientes = ? WHERE id_receita = ?");
        $stm->bind_param("isssssssi", $tempo_preparo, $dificuldade, $categoria, $porcoes, $modo_prep, $titulo, $imagem, $ingredientes, $id_receita);

        if ($stm->execute()) {
            echo "Receita atualizada com sucesso!";
        } else {
            echo "Falha na atualização: " . mysqli_error($conexao);
        }
        $stm->close();
    } else {
        echo "ID da receita não fornecido.";
    }
}

function delete($conexao) {
    $id_receita = isset($_POST['id_receita']) ? $_POST['id_receita'] : '';

    if ($id_receita) {
        $stm = $conexao->prepare("DELETE FROM tb_receita WHERE id_receita = ?");
        $stm->bind_param("i", $id_receita);
        if ($stm->execute()) {
            echo "Receita excluída com sucesso!";
        } else {
            echo "Falha na exclusão: " . mysqli_error($conexao);
        }
        $stm->close();
    } else {
        echo "ID da receita não fornecido.";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_blog'])) {
        if ($_POST['acao'] === 'update') {
            update($conexao);
        } elseif ($_POST['acao'] === 'delete') {
            delete($conexao);
        }
    } else {
        create($conexao);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    read($conexao);
}

$conexao->close();
?>