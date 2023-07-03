<?php

$host = "127.0.0.1";
$db_name = "db_eventos";
$username = "root";
$password = "";

// Criar conexão
$conn = new mysqli($host, $username, $password, $db_name);

// Checar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>