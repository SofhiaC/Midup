
<?php

include"conexao.php";

$email = $_POST['email'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$senha =($_POST['senha']);
$objetivos = $_POST['objetivos'];

$verificar = $mysqli->prepare("SELECT email_usuario FROM tb_usuario WHERE email_usuario = ?");
$verificar->bind_param("s", $email);  
$verificar->execute();
$resultado = $verificar->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>
    alert('Usuário já existe.'); window.location.href='registrar.html';
    </script>";
  die();
} else {
    $stmt = $mysqli->prepare("INSERT INTO tb_usuario (email_usuario, idade, nome_usuario, senha_usuario, objetivos) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $email, $idade, $nome, $senha, $objetivos);

    if ($stmt->execute()) {

        $id_usuario = $mysqli->insert_id;

        $sql = "SELECT id_usuario, nome_usuario FROM tb_usuario WHERE id_usuario = $id_usuario";
        $sql_query = $mysqli->query($sql);
    
        if ($sql_query) {
            $usuario = $sql_query->fetch_assoc();
            if (is_array($usuario)) {

                if (!isset($_SESSION)) {
                    session_start();
                }
    
                $_SESSION['id'] = $usuario['id_usuario'];
                $_SESSION['nome'] = $usuario['nome_usuario'];
                $_SESSION['email'] = $usuario['email_usuario'];
    
                header('Location: registrar2.html');
                exit();
            } else {
                echo "Nenhum usuário encontrado com o ID $id_usuario.";
            }
        } else {
            echo "Erro ao executar a consulta: " . $mysqli->error;
        }
    } 
        
     else {
        echo "Erro ao salvar no banco de dados: " . $stmt->error;
    }

    $stmt->close();
}

$verificar->close();
$mysqli->close();
        
?>
