<?php 

    session_start();

    if(!$_SESSION['email']){
        header("Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333333;
        }

        /* Barra de Navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #666666;
            font-size: 16px;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #007bff;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-logout:hover {
            background-color: #bd2130;
        }

        /* Conteúdo Principal */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .welcome-card h1 {
            font-size: 28px;
            color: #222222;
            margin-bottom: 15px;
        }

        .welcome-card p {
            color: #666666;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="leitor/listar.php">Leitores</a></li>
            <li><a href="livro/listar.php">Livros</a></li>
            <li><a href="emprestimo/listar.php">Emprestimos</a></li>
            <li><a href="logout.php" class="btn-logout" style="color: white;">Sair</a></li>
        </ul>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container">
        <div class="welcome-card">
            <h1>Bem-vindo, <?= $_SESSION['nome'] ?>!</h1>
            <p>Seu login foi realizado com sucesso. Este é o seu painel de controle principal. Daqui você pode navegar pelas seções do sistema utilizando o menu superior.</p>
        </div>
    </main>

</body>
</html>
