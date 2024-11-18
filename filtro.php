<?php
session_start();
if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha_usuario'])==true)){
    echo "<script>
        unset($_SESSION['email_usuario']);
        unset($_SESSION['senha_usuario']);
        document.getElementById('user-name').textContent = username || 'Login';
    </script>"
} else {
    $logado = $_SESSION['email_usuario'];
}
?>