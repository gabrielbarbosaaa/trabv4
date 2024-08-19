<?php
session_start();
require_once 'db.php';
require_once 'utils.php'; // Inclua a função de log

// Gera o token CSRF se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($mysqli, $_POST['username']);
    $password = sanitize_input($mysqli, $_POST['senha']);
    $csrf_token = $_POST['csrf_token'];

    // Verifica o token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error'] = "Token CSRF inválido.";
        log_activity("Tentativa de login falhou: CSRF inválido para usuário '$username'.");
        header('Location: login.php');
        exit();
    }

    // Prepara a query usando prepared statements
    $stmt = $mysqli->prepare("SELECT id, senha, perfil, autenticacao_habilitada FROM usuarios WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['senha'])) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['perfil'] = $user['perfil']; // Adiciona o perfil à sessão

            // Regenera o token CSRF após login bem-sucedido
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            log_activity("Usuário '$username' logado com sucesso.");

            // Redireciona para o local apropriado com base no perfil e autenticação em duas etapas
            if ($user['autenticacao_habilitada']) {
                header('Location: autenticacao.php');
            } else {
                $redirect_page = ($user['perfil'] === 'admin') ? 'dashboard.php' : 'dashboard_public.php';
                header('Location: ' . $redirect_page);
            }
            exit();
        } else {
            $_SESSION['error'] = "Credenciais incorretas.";
            log_activity("Tentativa de login falhou: Credenciais incorretas para usuário '$username'.");
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
        log_activity("Tentativa de login falhou: Usuário '$username' não encontrado.");
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #121212; /* Fundo escuro para a página */
    color: #e0e0e0; /* Cor clara para o texto */
    text-align: center;
    padding-top: 50px;
}

.login-container {
    max-width: 300px;
    margin: 0 auto;
    background-color: #1e1e1e; /* Fundo escuro para o container de login */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Sombra mais intensa */
}

.login-container h2 {
    margin-bottom: 20px;
    color: #ffffff; /* Cor do título */
}

.login-container form {
    text-align: left;
}

.login-container label {
    display: block;
    margin-bottom: 10px;
    color: #e0e0e0; /* Cor clara para os labels */
}

.login-container input[type="text"],
.login-container input[type="password"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #333; /* Borda escura */
    border-radius: 3px;
    background-color: #2c2c2c; /* Fundo escuro para inputs */
    color: #e0e0e0; /* Texto claro para inputs */
}

.login-container input[type="submit"],
.login-container .btn-back {
    width: 100%;
    padding: 10px;
    background-color: #007bff; /* Cor do botão de login */
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
    margin-bottom: 10px;
}

.login-container .btn-back {
    background-color: #6c757d; /* Cor do botão de voltar */
}

.login-container input[type="submit"]:hover,
.login-container .btn-back:hover {
    opacity: 0.8; /* Menos opacidade no hover */
}

.error-message {
    color: #f44336; /* Cor vermelha para mensagens de erro */
    margin-top: 10px;
}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Nome de Usuário:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br><br>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <input type="submit" value="Login">
        </form>
        <form action="index.php">
            <button type="submit" class="btn-back">Voltar para Index</button>
        </form>
    </div>
</body>
</html>
