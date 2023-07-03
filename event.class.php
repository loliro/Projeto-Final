<?php

class Event {
    private $id;
    private $titulo;
    private $descricao;
    private $data_evento;
    private $hora;
    private $local_evento;
    private $categoria;
    private $preco;
    private $nome_imagem;

    
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function delete($id) {
        $sql = "DELETE FROM events WHERE id = $id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Erro: $sql<br>".$this->conn->error."<br>";
            return false;
        }
    }
    public function updateEvent($id, $post) {
        $nomeImagem = '';
        switch ($post['categoria']) {
            case 1:
                $nomeImagem = 'imagem_eventos/festa.jpg';
                break;
            case 2:
                $nomeImagem = 'imagem_eventos/feira.jpg';
                break;
            case 3:
                $nomeImagem = 'imagem_eventos/curso.jpg';
                break;
            default:
                // Categoria inválida
                break;
        }
    
        $sql = "UPDATE events SET 
                    titulo = '{$post['titulo']}',
                    descricao = '{$post['descricao']}',
                    data_evento = '{$post['data_evento']}',
                    hora = '{$post['hora']}',
                    local_evento = '{$post['local_evento']}',
                    categoria = {$post['categoria']},
                    preco = {$post['preco']},
                    nome_imagem = '{$nomeImagem}'
                WHERE id = {$id}";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Erro: $sql<br>".$this->conn->error."<br>";
            return false;
        }
    }
    
    public function create($post) {
        $nomeImagem = '';
        switch ($post['categoria']) {
            case 1:
                $nomeImagem = 'imagem_eventos/festa.jpg';
                break;
            case 2:
                $nomeImagem = 'imagem_eventos/feira.jpg';
                break;
            case 3:
                $nomeImagem = '"imagem_eventos/curso.jpg"';
                break;
            default:
                // Categoria inválida
                break;
        }
        $sql = "INSERT INTO events (titulo, descricao, data_evento, hora, local_evento,  categoria, preco, nome_imagem) VALUES 
        ('{$post['titulo']}', '{$post['descricao']}', '{$post['data_evento']}', '{$post['hora']}', '{$post['local_evento']}', {$post['categoria']}, {$post['preco']}, '{$nomeImagem}')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Erro: $sql<br>".$this->conn->error."<br>";
            return false;
        }
    }

    public function searchAndFilter($titulo, $categoria, $page) {
        $offset = $page * 5;
        if ($titulo == "" AND $categoria == ""){
            $sql = "SELECT * FROM events LIMIT 5 OFFSET $offset";
        } else {
            if ($titulo !== "" AND $categoria == ""){
                $sql = "SELECT * FROM events WHERE titulo LIKE '%{$titulo}%' LIMIT 5 OFFSET $offset";
            } else {
                if ($titulo == "" AND $categoria !== ""){
                    $sql = "SELECT * FROM events WHERE categoria LIKE '{$categoria}' LIMIT 5 OFFSET $offset";
                } else {
                    $sql = "SELECT * FROM events WHERE titulo LIKE '%{$titulo}%' AND categoria LIKE '{$categoria}' LIMIT 5 OFFSET $offset";
                }
            }
        }
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function featured_events() {
        // Função para filtrar pelos 5 eventos mais próximos de acontecer
        $sql = "SELECT * FROM events WHERE data_evento >= CURDATE() ORDER BY data_evento ASC LIMIT 5";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readPage($page, $titulo) {
        $offset = $page * 5;
        $sql = "SELECT * FROM events WHERE titulo LIKE '%{$titulo}%' LIMIT 5 OFFSET $offset";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readOne($id) {
        $sql = "SELECT * FROM events JOIN categories ON events.categoria = categories.id WHERE events.id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumRegistros($titulo) {
        $sql = "SELECT count(id) as total FROM events WHERE titulo LIKE '%{$titulo}%'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>