<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Público</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fundo escuro */
            color: #e0e0e0; /* Texto claro */
            padding: 20px;
            text-align: center;
        }

        .dashboard-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e; /* Fundo do container */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .dashboard-container h1 {
            margin-bottom: 20px;
            color: #ffffff; /* Cor do título */
        }

        .dashboard-container p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #b0b0b0; /* Cor do texto do parágrafo */
        }

        .dashboard-container a {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff; /* Cor de fundo do link */
            color: #ffffff; /* Cor do texto do link */
            text-decoration: none;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .dashboard-container a:hover {
            background-color: #0056b3; /* Cor do link ao passar o mouse */
        }

        .dashboard-container .logout-link {
            background-color: #d9534f; /* Cor de fundo do link de logout */
        }

        .dashboard-container .logout-link:hover {
            background-color: #c9302c; /* Cor do link de logout ao passar o mouse */
        }
    </style>
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo ao Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Você está na área pública do sistema.</p>

        <a href="logout.php" class="logout-link">Sair</a>
    </div>
</body>
</html>
