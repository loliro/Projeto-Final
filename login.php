<?php
session_start();
include "connect.inc.php";
include "authentication.class.php";
include "user.class.php";
include "registration.class.php";

$auth = new Authentication($conn);
$user = new User($conn);
$registration = new Registration($conn);

// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    if ($_SESSION['tipo_usuario'] == 1) { #administrador
        header("Location: admDashboard.php");
    }
    if ($_SESSION['tipo_usuario'] == 3) { #participante
        header("Location: perfil.php");
    }
    exit;
}

$error = "";

// Verifique as credenciais no seu sistema de autenticação
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($auth->verifyCredentials($username, $password)) {
            // Autenticação bem-sucedida, defina as variáveis de sessão
            $_SESSION['username'] = $username;
            $userData = $user->get_personal_data($username);
            $_SESSION['id'] = $userData['id'];
            $_SESSION['tipo_usuario'] = $userData['tipo_usuario'];
            if ($_SESSION['tipo_usuario'] == 1) { #administrador
                header("Location: admDashboard.php");
            }
            if ($_SESSION['tipo_usuario'] == 3) { #participante
                header("Location: perfil.php");
            }
            exit;
        } else {
            $error = "Credenciais inválidas. Por favor, tente novamente.";
        }
    } elseif ($action === 'signup') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Você pode adicionar mais campos aqui, como nome, email, etc.

        // Faça a validação dos campos aqui, se necessário
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>
        <div class="logo">
            <a href="home.php"><img src="imagem_eventos/logo.png" alt="StarEvents"></a>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="eventList.php">Eventos</a></li>
            </ul>
        </nav>
    </header>

    <section class="container">
        <div class="login">
            <h2>Login</h2>
            <?php if ($error !== ""): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label for="username">Nome de usuário:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
            <button id="signupBtn" onclick="goToSignup()">Signup</button>
        </div>
    </section>

    <script>
        function goToSignup() {
            window.location.href = "cadastro.php";
        }
    </script>

</body>

</html>