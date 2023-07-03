<?php
// Inclua os arquivos necessários e inicialize a sessão, se necessário
session_start();
include "connect.inc.php";
include "user.class.php";
include "event.class.php";

$user = new User($conn);
$event = new Event($conn);

// Verifique se o usuário não está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$error = "";

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $local_evento = $_POST['local_evento'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    // Faça a validação dos campos aqui, se necessário

        // Crie o novo usuário
    $result = $event->create($_POST);
    if ($result) {
        // Usuário criado com sucesso, redirecione para a página de login
        header("Location: eventList.php");
        exit;
    } else {
        $error = "Erro ao criar o evento. Por favor, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Criar Evento</title>
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
                <li><a href="admDashboard.php">Admin dashboard</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <section class="container">
        <h2>Criar Evento</h2>
        <?php if ($error !== ""): ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="createEvent.php">
            <div>
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div>
                <label for="data_evento">Data do Evento:</label>
                <input type="date" id="data_evento" name="data_evento" required>
            </div>
            <div>
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            </div>
            <div>
                <label for="local_evento">Local do Evento:</label>
                <input type="text" id="local_evento" name="local_evento" required>
            </div>
            <div>
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" required>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input type="text" id="preco" name="preco" required>
            </div>
            <button type="submit">Criar Evento</button>
        </form>
    </section>

</body>

</html>
