<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
    // Limpa todas as variáveis de sessão
    session_unset();

    // Destrói a sessão
    session_destroy();
}

// Redireciona para a página de login
header("Location: login.php");
exit;
?>
