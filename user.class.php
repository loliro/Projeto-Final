<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_personal_data($username) {
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row; // Dados pessoais encontrados
        } else {
            return null; // Usuário não encontrado ou erro na consulta
        }
    }
}
?>
