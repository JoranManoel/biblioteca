<?php 

    include "../conexao.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM leitor WHERE id = $id";

    $resultado = $conn->query($sql);

    header('Location: listar.php');

?>