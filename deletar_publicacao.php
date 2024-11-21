<?php
$hostname = "localhost"; 
$bancodedados = "revirado";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conexao->connect_errno) {
    die("Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
}

$id_blog = (int)($_GET['id'] ?? 0);

if ($id_blog <= 0) {
    die("ID inválido.");
}

$sql = "DELETE FROM tb_blog WHERE id_blog = ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$stmt->bind_param("i", $id_blog);

if ($stmt->execute()) {
    header("Location: blog_alternativo.php?mensagem=Postagem excluída com sucesso.");
    exit();
} else {
    echo "Erro ao excluir a postagem: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>