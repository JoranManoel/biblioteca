<?php 

    include "conexao.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM leitor WHERE email = '$email' AND senha = '$senha'";

    $resultado = $conn->query($sql)->fetch_assoc();

    if($resultado){
        session_start();
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['nome'] = $resultado['nome'];
        header("Location: index.php");
    }else{
        header("Location: login.php?msg=Erro ao logar");
    }

?>