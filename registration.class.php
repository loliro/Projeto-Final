<?php

class Registration {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create_user($username, $password, $tipo_usuario, $email, $data_nascimento, $endereco, $country, $cep, $nome) {
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);
        $tipo_usuario = $this->conn->real_escape_string($tipo_usuario);
        $email = $this->conn->real_escape_string($email);
        $data_nascimento = $this->conn->real_escape_string($data_nascimento);
        $endereco = $this->conn->real_escape_string($endereco);
        $country = $this->conn->real_escape_string($country);
        $cep = $this->conn->real_escape_string($cep);
        $nome = $this->conn->real_escape_string($nome);

        // Verifique se o nome de usuário já está em uso
        $existingUserQuery = "SELECT * FROM users WHERE username = '{$username}'";
        $existingUserResult = $this->conn->query($existingUserQuery);
        if ($existingUserResult && $existingUserResult->num_rows > 0) {
            return false; 
        }
      
        
        $insertQuery = "INSERT INTO users (nome, username, senha, tipo_usuario, email, data_nascimento, endereco, country, cep)
                VALUES ('{$nome}', '{$username}', '{$password}', '{$tipo_usuario}', '{$email}', '{$data_nascimento}', '{$endereco}', '{$country}', '{$cep}')";
        $insertResult = $this->conn->query($insertQuery);
        if ($insertResult) {
            return true; // Usuário criado com sucesso
        } else {
            return false; // Erro ao criar o usuário
        }
    }
}

?>