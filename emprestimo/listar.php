<?php 
    include "../conexao.php";

    // CORREÇÃO DA QUERY SQL: Sintaxe do INNER JOIN ajustada para trazer os dados reais (nomes e títulos)
    $sql = "SELECT 
                e.id, 
                e.data,
                l.nome AS nome_leitor, 
                lv.titulo AS titulo_livro 
            FROM emprestimo AS e
            INNER JOIN leitor AS l ON e.id_leitor = l.id
            INNER JOIN livro AS lv ON e.id_livro = lv.id
            ORDER BY e.data DESC";
            
    $resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos Realizados</title>
    <!-- Importação de fonte moderna -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        /* Barra de Navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 16px 40px;
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar .logo {
            font-size: 22px;
            font-weight: 700;
            color: #2563eb;
            letter-spacing: -0.5px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        /* Conteúdo Principal */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .header-actions h1 {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .btn-add {
            background-color: #2563eb;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s ease;
        }

        .btn-add:hover {
            background-color: #1d4ed8;
        }

        /* Tabela Responsiva */
        .table-container {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 16px 24px;
            font-size: 15px;
        }

        th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        /* Estilização dos Links de Ação */
        .actions-links {
            display: flex;
            gap: 16px;
        }

        .action-edit {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .action-edit:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .action-delete {
            color: #ef4444;
            text-decoration: none;
            font-weight: 500;
        }

        .action-delete:hover {
            color: #dc2626;
            text-decoration: underline;
        }

        /* Crachá/Badge de Data */
        .date-badge {
            background-color: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="../index.php">Voltar</a></li>
        </ul>
    </nav>

    <!-- Conteúdo da Tabela -->
    <main class="container">
        <div class="header-actions">
            <h1>Empréstimos Realizados</h1>
            <a href="inserir.php" class="btn-add">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://w3.org"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Novo Empréstimo
            </a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Leitor</th>
                        <th>Livro</th>
                        <th>Devolução</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($resultado && $resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()) {
                            // Converte a data do banco para o padrão brasileiro (dd/mm/aaaa)
                            $dataFormatada = date('d/m/Y', strtotime($row["data"]));

                            echo "<tr>";
                            echo "<td><span style='color: #94a3b8;'>#" . $row["id"] . "</span></td>";
                            echo "<td><strong>" . htmlspecialchars($row["nome_leitor"]) . "</strong></td>"; 
                            echo "<td>" . htmlspecialchars($row["titulo_livro"]) . "</td>";
                            echo "<td><span class='date-badge'>" . $dataFormatada . "</span></td>";
                            echo "<td>
                                    <div class='actions-links'>
                                        <a href='editar.php?id=" . $row["id"] . "' class='action-edit'>Editar</a>
                                        <a href='apagar.php?id=" . $row["id"] . "' class='action-delete' onclick='return confirm(\"Deseja realmente excluir este empréstimo?\")'>Excluir</a>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center; color: #64748b; padding: 40px;'>Nenhum empréstimo registrado até o momento.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
