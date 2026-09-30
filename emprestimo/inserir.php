<?php

include "../conexao.php";

$leitores = $conn->query("SELECT * FROM leitor");
$livros = $conn->query("SELECT * FROM livro");

if (isset($_POST['leitor'])) {
    $leitor = $_POST['leitor'];
    $livro = $_POST['livro'];
    $data = $_POST['data'];

    $sql = "INSERT INTO emprestimo (id_leitor, id_livro, data) VALUES($leitor, $livro, $data)";

    $resultado = $conn->query($sql);

    header('Location: listar.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Empréstimo</title>
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
            max-width: 480px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .form-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
        }

        .form-card h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 28px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .input-group {
            margin-bottom: 22px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }

        /* Estilização universal para inputs e selects */
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            color: #334155;
            background-color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
            appearance: none; /* Remove seta padrão em alguns navegadores */
        }

        /* Adiciona uma seta customizada sutil para as caixas de seleção */
        .input-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://w3.org' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
            cursor: pointer;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-submit {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .btn-cancel {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .btn-cancel:hover {
            background-color: #f8fafc;
            color: #334155;
            border-color: #cbd5e1;
        }
    </style>
</head>

<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="listar.php">Empréstimos realizados</a></li>
        </ul>
    </nav>

    <!-- Formulário de Cadastro -->
    <main class="container">
        <div class="form-card">
            <h1>Realizar empréstimo</h1>

            <form action="" method="POST">

                <!-- Campo Leitor -->
                <div class="input-group">
                    <label for="leitor">Leitor</label>
                    <select name="leitor" id="leitor" required>
                        <option value="" disabled selected>Selecione um leitor...</option>
                        <?php 
                            foreach($leitores as $leitor){
                                echo "<option value='".$leitor['id']."'>".$leitor['nome']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Campo Livro -->
                <div class="input-group">
                    <label for="livro">Livro</label>
                    <select name="livro" id="livro" required>
                        <option value="" disabled selected>Selecione um livro...</option>
                        <?php 
                            foreach($livros as $livro){
                                echo "<option value='".$livro['id']."'>".$livro['titulo']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Campo Data -->
                <div class="input-group">
                    <label for="data">Data de devolução</label>
                    <input type="date" id="data" name="data" required>
                </div>

                <!-- Botões de Ação -->
                <div class="btn-group">
                    <a href="listar.php" class="btn btn-cancel">Cancelar</a>
                    <button type="submit" class="btn btn-submit">Confirmar Empréstimo</button>
                </div>

            </form>
        </div>
    </main>

    <script>
        // Impede a seleção de datas passadas no calendário
        const dataInput = document.getElementById('data');
        const hoje = new Date().toISOString().split('T')[0];
        dataInput.min = hoje;
    </script>

</body>

</html>
