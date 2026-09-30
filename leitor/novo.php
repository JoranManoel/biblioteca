<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Leitor</title>
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
            max-width: 500px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .form-card {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .form-card h1 {
            font-size: 24px;
            color: #222222;
            margin-bottom: 25px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-size: 14px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .input-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #f8f9fa;
            color: #666666;
            border: 1px solid #cccccc;
        }

        .btn-cancel:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="logo">Biblioteca</div>
        <ul class="nav-links">
            <li><a href="listar.php">Leitores</a></li>
        </ul>
    </nav>

    <!-- Formulário de Cadastro -->
    <main class="container">
        <div class="form-card">
            <h1>Cadastrar Novo Leitor</h1>
            
            <!-- O formulário envia os dados via POST para o arquivo que processará o banco -->
            <form action="inserir.php" method="POST">
                
                <!-- Campo Nome -->
                <div class="input-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome do leitor" required>
                </div>
                
                <!-- Campo E-mail -->
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                </div>
                
                <!-- Campo Senha -->
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha de acesso" required>
                </div>

                <!-- Botões de Ação -->
                <div class="btn-group">
                    <a href="listar.php" class="btn btn-cancel">Cancelar</a>
                    <button type="submit" class="btn btn-submit">Salvar Cadastro</button>
                </div>

            </form>
        </div>
    </main>

</body>
</html>
