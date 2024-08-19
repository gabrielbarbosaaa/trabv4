<?php
session_start();

if (!isset($_SESSION['userid']) || $_SESSION['perfil'] != 'admin') {
    header('Location: dashboard_public.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fundo escuro */
            color: #e0e0e0; /* Texto claro */
            padding: 20px;
            text-align: center;
            margin: 0;
        }

        .dashboard-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e; /* Cor de fundo do painel */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2); /* Sombra clara */
        }

        .dashboard-container h1 {
            margin-bottom: 20px;
            color: #ffffff; /* Cor do título */
        }

        .dashboard-container p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #cccccc; /* Cor do texto do parágrafo */
        }

        .dashboard-container a {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #4CAF50; /* Cor de fundo do botão */
            color: white;
            text-decoration: none;
            border-radius: 3px;
            margin-bottom: 10px;
            transition: background-color 0.3s; /* Efeito suave na mudança de cor */
        }

        .dashboard-container a:hover {
            background-color: #45a049; /* Cor do botão ao passar o mouse */
        }

        .dashboard-container .logout-link {
            background-color: #d9534f; /* Cor de fundo do botão de logout */
        }

        .dashboard-container .logout-link:hover {
            background-color: #c9302c; /* Cor do botão de logout ao passar o mouse */
        }
    </style>
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo ao Painel de Administração, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Aqui você pode gerenciar o sistema.</p>

        <a href="criar_backup.php">Criar Backup</a>
        <a href="logout.php" class="logout-link">Sair</a>
    </div>
</body>
</html>
