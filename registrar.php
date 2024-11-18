
        <?php

        
    var_dump($_GET); // Para verificar se o email está sendo passado corretamente
    var_dump($_POST);
            include"conexao.php";

            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $senha =($_POST['senha']);
            $objetivos = $_POST['objetivos'];
            $biografia = $_POST['biografia'] ;
            $caminho = null;
        
            if (isset($_FILES['foto_usuario'])) {
                $arquivo = $_FILES['foto_usuario'] ;
        
                $pasta = "arquivos/";
                $nome_arquivo = pathinfo($arquivo['name'], PATHINFO_FILENAME);
                $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
                $nome_arquivo_completo = $nome_arquivo . "." . $extensao;
                $caminho = $pasta . $nome_arquivo_completo;
        
                $caminho = $pasta . $nome_arquivo . "." . $extensao;
        
                if (!move_uploaded_file($arquivo['tmp_name'], $caminho)) {
                    $caminho = null; 
                }
            }
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
                    var_dump($email);
                    header('Location: filtro.html');    
                } else {
                    echo "Erro ao salvar no banco de dados: " . $stmt->error;
                }

                $stmt->close();
            }

            $verificar->close();
            $mysqli->close();
                    
?>
