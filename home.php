<?php
session_start();

include "connect.inc.php";
include "event.class.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$tipo_usuario = $_SESSION['tipo_usuario'];

$eventos = new Event($conn);

$page = isset($_GET['page']) ? $_GET['page'] : 0;
$titulo = isset($_GET['search']) ? $_GET['search'] : "";


$total = $eventos->getNumRegistros($titulo);
$totalRegistros = $total[0]['total'];

$numPages = ceil($totalRegistros / 5);

$res_destaques = $eventos->featured_events();

if ($titulo !== "") {
    $res = $eventos->readPage($page, $titulo);
} else {
    $res = array(); // Define um array vazio se nenhum termo de pesquisa for fornecido
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
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
                <?php
                    if ($tipo_usuario == 1) {
                        echo '<li><a href="admDashboard.php">Admin dashboard</a></li>';
                    } else {
                        echo '<li><a href="perfil.php">Perfil</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>


    <section class="container">
        <div class="destaques-container">
            <div class="destaques-slides">
                <?php
                foreach ($res_destaques as $a) {
                    echo ("
                        <div class='destaque-slide'>
                            <h2>{$a['titulo']}</h2>
                            <a href='eventDetails.php?id={$a['id']}'><img class='slide-image' src='{$a['nome_imagem']}' alt='Imagem'></a>
                        </div>
                    ");
                }
                ?>
            </div>
            <a class="destaques-prev" onclick="changeSlide(-1)">&#10094;</a>
            <a class="destaques-next" onclick="changeSlide(1)">&#10095;</a>
        </div>
    </section>

    <section class="container">
        <div class="search-container">
            <form action="home.php" method="GET">
                <input type="text" name="search" placeholder="Digite aqui">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </section>

    <?php
    if ($titulo !== "") {
        // Exibe a div "lista" somente quando o formulário de pesquisa for enviado
        echo '
        <section class="container">
            <div class="lista">
                <table>
                    <tr>
                        <th>Evento</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>';

        foreach ($res as $a) {
            echo ("
                <tr>
                    <td>{$a['titulo']}</td>
                    <td>{$a['descricao']}</td>
                    <td>{$a['data_evento']}</td>
                    <td>{$a['local_evento']}</td>
                    <td><img src='{$a['nome_imagem']}' alt='Imagem'></td>
                    <td><a href='eventDetails.php?id={$a['id']}'>Detalhes</a></td>
                </tr>   
            ");
        }

        echo '
                </table>
            </div>
        </section>';

        echo '
        <section class="container">
            <div class="lista-paginacao">';
        for ($i = 0; $i < $numPages; $i++) {
            echo ("<a href='home.php?page=$i'>" . ($i + 1) . "</a>&nbsp;&nbsp;");
        }
        echo '
            </div>
        </section>';
    }
    ?>
    <script src="scripts.js"></script>
</body>

</html>
