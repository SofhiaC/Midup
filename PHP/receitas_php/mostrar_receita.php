<?php

session_start();
require "conexao.php";


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

$conexao->close();

?>