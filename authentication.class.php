<?php

class Authentication {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verifyCredentials($username, $password) {
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);
        $sql = "SELECT * FROM users WHERE username = '{$username}' AND senha = '{$password}'";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            return true; // Usuário e senha válidos
        } else {
            return false; // Usuário ou senha inválidos
        }
    }
}
?>