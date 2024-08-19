<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <style>
         body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212; /* Fundo escuro */
            color: #e0e0e0; /* Texto claro */
            text-align: center;
            padding-top: 50px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e; /* Fundo da caixa de conteúdo escuro */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Sombra mais forte */
        }

        .container h2 {
            margin-bottom: 20px;
            color: #e0e0e0; /* Texto claro para o título */
        }

        .container a {
            display: block;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #333333; /* Botão escuro */
            color: #e0e0e0; /* Texto claro no botão */
            text-decoration: none;
            border-radius: 3px;
            font-size: 18px;
        }

        .container a:hover {
            background-color: #555555; /* Cor do botão ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bem-vindo!</h2>
        <a href="login.php">Login</a>
        <a href="register.php">Registrar</a>
    </div>
</body>
</html>
