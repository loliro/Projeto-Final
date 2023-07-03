<?php
// Inclua os arquivos necessários e inicialize a sessão, se necessário
session_start();
include "connect.inc.php";
include "user.class.php";
include "registration.class.php";

$user = new User($conn);
$registration = new Registration($conn);
$error = "";

// Verifique se o usuário já está logado
if (isset($_SESSION['username'])) {
    if ($_SESSION['tipo_usuario'] == 1) { //administrador
        header("Location: admDashboard.php");
    } elseif ($_SESSION['tipo_usuario'] == 3) { //participante
        header("Location: perfil.php");
    }
    exit;
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $country = $_POST['country'];
    $cep = $_POST['cep'];
    $nome = $_POST['nome'];
    // Faça a validação dos campos aqui, se necessário

    // Crie o novo usuário
    $result = $registration->create_user($username, $password, $tipo_usuario, $email, $data_nascimento, $endereco, $country, $cep, $nome);
    if ($result) {
        // Usuário criado com sucesso, redirecione para a página de login
        header("Location: login.php");
        exit;
    } else {
        $error = "Erro ao criar o usuário. Por favor, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
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
        <div class="signup">
            <h2>Cadastro</h2>
            <?php if ($error !== ""): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="username">Nome de usuário:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="tipo_usuario">Tipo de Usuário:</label>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                        <option value="1">Administrador</option>
                        <option value="2">Outro Tipo</option>
                        <option value="3">Participante</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="country">País:</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </section>

</body>

</html>
