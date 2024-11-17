<?php

include"conexao.php";

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
?>