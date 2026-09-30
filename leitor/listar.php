<?php 
    // Seu código PHP de consulta
    include "../conexao.php";

    $sql = "SELECT * FROM leitor";
    $resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Leitores</title>
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        /* Tabela Responsiva */
        .table-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #eeeeee;
            font-size: 15px;
        }

        th {
            background-color: #f8f9fa;
            color: #555555;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #fafdff;
        }

        /* Tags de Status ou Texto Secundário */
        .text-muted {
            color: #888888;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação (Reaproveitada da Home) -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="../index.php">voltar</a></li>
        </ul>
    </nav>

    <!-- Conteúdo da Tabela -->
    <main class="container">
        <div class="header-actions">
            <h1>Lista de Leitores</h1>
            <a href="novo.php" class="btn-add">+ Novo Leitor</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Verifica se existem registros no banco
                    if ($resultado && $resultado->num_rows > 0) {
                        // Loop para listar cada linha do banco de dados
                        while($row = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>"; // Ajuste o nome da coluna se for diferente no seu banco
                            echo "<td><strong>" . $row["nome"] . "</strong></td>"; 
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>
                                    <a href='editar.php?id=" . $row["id"] . "' style='color: #007bff; text-decoration: none; margin-right: 10px;'>Editar</a>
                                    <a href='apagar.php?id=" . $row["id"] . "' style='color: #dc3545; text-decoration: none;'>Excluir</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        // Mensagem caso o banco esteja vazio
                        echo "<tr><td colspan='4' style='text-align: center; color: #888888;'>Nenhum leitor encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
