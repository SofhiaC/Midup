<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include "conexao.php";

    $id = $_SESSION['id'];
    $biografia = $_POST['biografia'] ?? null;
    $caminho = null;

    if (isset($_FILES['foto_usuario'])) {
        $arquivo = $_FILES['foto_usuario'] ?? null;

        $pasta = "arquivos/";
        $nome_arquivo = pathinfo($arquivo['name'], PATHINFO_FILENAME);
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $nome_arquivo_completo = $nome_arquivo . "." . $extensao;
        $caminho = $pasta . $nome_arquivo_completo;

        if (!move_uploaded_file($arquivo['tmp_name'], $caminho)) {
            $caminho = null; 
        }
    }

        if ($biografia || $caminho) {
            $stmt = $mysqli->prepare("UPDATE tb_usuario SET biografia = ?, foto_usuario = ? WHERE id_usuario = ?");
            $stmt->bind_param("sss", $biografia, $nome_arquivo_completo, $id);     

            if ($stmt->execute()) {
                header('Location: filtro.php');
            }else {
                echo "Erro ao salvar no banco de dados: " . $stmt->error;
            }

            $stmt->close();

        }
    $mysqli->close();



?>