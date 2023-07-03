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

// Filtrar por pesquisa e categorias
$pesquisa = isset($_GET['search']) ? $_GET['search'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$res = $eventos->searchAndFilter($pesquisa, $categoria, $page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eventos</title>
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
        <div class="search-container">
            <form action="eventList.php" method="GET">
                <select class="categoria-select" name="categoria"> <!-- Adiciona a classe categoria-select aqui -->
                    <option value="">Todas as categorias</option>
                    <option value="1" <?php if ($categoria == "1") echo "selected"; ?>>Festa</option>
                    <option value="2" <?php if ($categoria == "2") echo "selected"; ?>>Feira</option>
                    <option value="3" <?php if ($categoria == "3") echo "selected"; ?>>Curso</option>
                </select>
                <input type="text" name="search" placeholder="Digite aqui" value="<?php echo htmlentities($pesquisa); ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </section>

    <br>

    <?php
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
            echo ("<a href='eventList.php?page=$i'>" . ($i + 1) . "</a>&nbsp;&nbsp;");
        }
        echo '
            </div>
        </section>';
    ?>
</body>

</html>
