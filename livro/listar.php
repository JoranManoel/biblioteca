<?php 
    // Adaptação da sua estrutura de conexão
    include "../conexao.php";

    // Consulta para buscar os livros
    $sql = "SELECT * FROM livro";
    $resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros</title>
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

        /* Conteúdo Principal */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-actions h1 {
            font-size: 24px;
            color: #222222;
        }

        .btn-add {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }

        /* Grade de Cards (Responsiva) */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        /* Estilo do Card */
        .book-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Capa Provisória do Livro (Gera uma cor sólida com o título) */
        .book-cover {
            height: 180px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 40px;
            font-weight: bold;
            border-bottom: 1px solid #eeeeee;
        }

        .book-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .book-title {
            font-size: 18px;
            font-weight: bold;
            color: #222222;
            margin-bottom: 8px;
        }

        .book-author {
            font-size: 14px;
            color: #666666;
            margin-bottom: 15px;
            font-style: italic;
        }

        .book-actions {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #eeeeee;
            padding-top: 15px;
        }

        .book-actions a {
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-edit {
            color: #007bff;
        }

        .btn-delete {
            color: #dc3545;
        }

        .no-results {
            text-align: center;
            color: #888888;
            grid-column: 1 / -1;
            padding: 40px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="../index.php">voltar</a></li>
        </ul>
    </nav>

    <!-- Catálogo de Cards -->
    <main class="container">
        <div class="header-actions">
            <h1>Catálogo de Livros</h1>
            <a href="#" class="btn-add">+ Novo Livro</a>
        </div>

        <div class="books-grid">
            <?php 
            if ($resultado && $resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    // Pega a primeira letra do título para usar como ícone/capa visual rápida
                    $primeira_letra = strtoupper(substr($row["titulo"], 0, 1));
                    ?>
                    
                    <div class="book-card">
                        <!-- Capa do Livro -->
                        <div class="book-cover">
                            <?= $primeira_letra ?>
                        </div>
                        
                        <!-- Detalhes do Livro -->
                        <div class="book-info">
                            <h2 class="book-title"><?= htmlspecialchars($row["titulo"]) ?></h2>
                            <p class="book-author">Por: <?= htmlspecialchars($row["autor"]) ?></p>
                            
                            <!-- Ações -->
                            <div class="book-actions">
                                <a href="editar.php?id=<?= $row["id"] ?>" class="btn-edit">Editar</a>
                                <a href="apagar.php?id=<?= $row["id"] ?>" class="btn-delete">Excluir</a>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<p class='no-results'>Nenhum livro encontrado no catálogo.</p>";
            }
            ?>
        </div>
    </main>

</body>
</html>
