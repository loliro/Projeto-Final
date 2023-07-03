<?php
session_start();

include "connect.inc.php";
include "event.class.php";
include "user.class.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$tipo_usuario = $_SESSION['tipo_usuario'];

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$evento = new Event($conn);
$detalhesEvento = $evento->readOne($id);

$id_user = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACc-XWRuAQ06jG5ka9MxzWUflqNiMTR8E"></script>
</head>

<body>
    <!-- Conteúdo -->
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

    <br>
    <!-- Detalhes do Evento -->
    <section class="container">
        <h2><?= $detalhesEvento[0]['titulo'] ?></h2>
        <p><?= $detalhesEvento[0]['descricao'] ?></p>
        <img src="<?= $detalhesEvento[0]['nome_imagem'] ?>" alt="<?= $detalhesEvento[0]['titulo'] ?>">
        <div class="event-details">
            <div class="event-info">
                <p><strong>Save the date:</strong> <?= $detalhesEvento[0]['data_evento'] ?> <?= $detalhesEvento[0]['hora'] ?></p>
                <p><strong>Local:</strong> <?= $detalhesEvento[0]['local_evento'] ?></p>
                <p><strong>Valor:</strong> <?= $detalhesEvento[0]['preco'] ?> R$</p>
            </div>
            <div class="button-container">
                <button id="inscreverBtn">Inscrever-se</button>
            </div>
        </div>
    </section>
    <br>
    <p style="font-size: 22px; margin-left: 20px; color: #ffc107;"><strong>Não sabe como chegar?</strong></p>
    <p style="font-size: 18px; margin-left: 20px; color: #ffc107;"><strong>Que o GoogleMaps esteja com você, guiando seus passos</strong></p>
    <p style="font-size: 18px; margin-left: 20px; color: #ffc107;"><strong>pela galáxia. Siga com determinação e coragem.</strong></p>
    <section class="container">
        <div id="map"></div>
    </section>
    <section class="container">
        <div class="evaluation">
            <h2 style="font-size: 22px; margin-left: 20px; color: #ffc107;">Avaliação do Evento</h2>
            <form action="formAction.php?window=review" method="post">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <input type="hidden" name="id_event" value="<?php echo $id; ?>">
                <div class="evaluation-row">
                    <div class="evaluation-col">
                        <label for="nota">Nota:</label>
                        <select id="nota" name="nota">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="evaluation-col">
                        <label for="comentario">Comentário:</label>
                        <textarea id="comentario" name="comentario" rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div class="evaluation-row">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function gerarMapa(endereco) {
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({ address: endereco }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();

                    var options = {
                        center: { lat: latitude, lng: longitude },
                        zoom: 12
                    };

                    var map = new google.maps.Map(document.getElementById('map'), options);
                    var marker = new google.maps.Marker({
                        position: { lat: latitude, lng: longitude },
                        map: map
                    });
                } else {
                    alert('Não foi possível encontrar o local: ' + endereco);
                }
            });
        }

        var localEvento = <?= json_encode($detalhesEvento[0]['local_evento']) ?>;
        gerarMapa(localEvento);
    </script>
</body>

</html>
