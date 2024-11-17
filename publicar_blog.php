<?php

$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($conexao->connect_errno){
    echo "Falha ao conectar: (". $conexao->connect_errno . ")" . $conexao->connect_error;
} else {
    echo "Conectado";
}

function create($conexao){
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $subtitulo = isset($_POST['subtitulo']) ? $_POST['subtitulo'] : '';
    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';
    $topico = isset($_POST['topico']) ? $_POST['topico'] : '';
    $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : '';    
    $id_usuario = 1;

    $stm = $conexao->prepare("INSERT INTO tb_blog (id_usuario, titulo_blog, subtitulo, imagem_blog, topico_blog, txt_blog) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stm) {
        echo "Erro ao preparar o statement: " . $conexao->error . "<br>";
        return;
    }
    $stm->bind_param("isssss", $id_usuario, $titulo, $subtitulo, $imagem, $topico, $conteudo);

    if ($stm->execute()) {
        echo "Dados inseridos com sucesso!<br>";
    } else {
        echo "Erro ao inserir dados: " . $stm->error . "<br>";
    }
    $stm->close();
}

function read($conexao) {
    $result = $conexao->query("SELECT * FROM tb_blog");

    if ($result) {
        echo "Dados recuperados";
    } else {
        echo "Erro ao recuperar dados: " . $conexao->error . "<br>";
    }
}

function update($conexao) {
    if (isset($_POST['id_blog'])) {
        $id_blog = $_POST['id_blog'];
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $subtitulo = isset($_POST['subtitulo']) ? $_POST['subtitulo'] : '';
        $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';
        $topico = isset($_POST['topico']) ? $_POST['topico'] : '';
        $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : '';

        $stm = $conexao->prepare("UPDATE tb_blog SET titulo_blog = ?, subtitulo = ?, imagem_blog = ?, topico_blog = ?, txt_blog = ? WHERE id_blog = ?");
        if (!$stm) {
            echo "Erro ao preparar o statement: " . $conexao->error . "<br>";
            return;
        }

        $stm->bind_param("sssssi", $titulo, $subtitulo, $imagem, $topico, $conteudo, $id_blog);

        if ($stm->execute()) {
            echo "Dados atualizados com sucesso!<br>";
        } else {
            echo "Erro ao atualizar dados: " . $stm->error . "<br>";
        }
        $stm->close();
    }
}

function delete($conexao) {
    if (isset($_POST['id_blog'])) {
        $id_blog = $_POST['id_blog'];

        $stm = $conexao->prepare("DELETE FROM tb_blog WHERE id_blog = ?");
        if (!$stm) {
            echo "Erro ao preparar o statement: " . $conexao->error . "<br>";
            return;
        }

        $stm->bind_param("i", $id_blog);

        if ($stm->execute()) {
            echo "Blog excluído com sucesso!<br>";
        } else {
            echo "Erro ao excluir dados: " . $stm->error . "<br>";
        }
        $stm->close();
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