<?php
include "connect.inc.php";
include "user.class.php";

$user = new User($conn);

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Obtém os dados do usuário
$username = $_SESSION['username'];

// Obtém os dados pessoais do usuário usando o método get_personal_data
$userData = $user->get_personal_data($username);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
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
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <section class="container">
        <div class="profile">
            <?php
            if ($userData) {
                echo '<p style="font-size: 24px;"><strong>Que a Força esteja com você nesta jornada, <span style="color: #ffc107;">' . htmlspecialchars($userData['nome']) . '</span>, bem-vindo(a) à galáxia de Star Wars.</strong></p>';
                echo "<p><strong>Nome de usuário:</strong> " . htmlspecialchars($userData['username']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($userData['email']) . "</p>";
                echo "<p><strong>Data de Nascimento:</strong> " . htmlspecialchars($userData['data_nascimento']) . "</p>";
                echo "<p><strong>Endereço:</strong> " . htmlspecialchars($userData['endereco']) . "</p>";
                echo "<p><strong>País:</strong> " . htmlspecialchars($userData['country']) . "</p>";
                echo "<p><strong>CEP:</strong> " . htmlspecialchars($userData['cep']) . "</p>";
            } else {
                echo "<p>Dados pessoais não encontrados.</p>";
            }
            ?>
        </div>
    </section>

</body>

</html>
