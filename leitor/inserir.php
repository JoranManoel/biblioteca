<?php 

    include "../conexao.php";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO leitor (nome, email, senha) VALUES('$nome', '$email', '$senha')";

    $resultado = $conn->query($sql);

    header('Location: listar.php')


?>