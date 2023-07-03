<?php
session_start();
class Review {
    private $id;
    private $pontuacao;
    private $comentario;
    private $id_user;
    private $id_event;

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($post) {
        $id_user = $_SESSION['id'];
        $pontuacao = $this->conn->real_escape_string($post['nota']);
        $comentario = $this->conn->real_escape_string($post['comentario']);
        $id_event = $this->conn->real_escape_string($post['id_event']);

        $sql = "INSERT INTO reviews (pontuacao, comentario, id_user, id_event) VALUES ('$pontuacao', '$comentario', '$id_user', '$id_event')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Erro: $sql<br>".$this->conn->error."<br>";
            return false;
        }
    }
}


?>