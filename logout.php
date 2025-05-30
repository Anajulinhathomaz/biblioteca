<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (isset($_SESSION['usuario_id'])) {
    // Destrói a sessão
    session_unset(); // Remove todas as variáveis de sessão
    session_destroy(); // Destroi a sessão

    // Mensagem de logout bem-sucedido
    $_SESSION['mensagem'] = "Você saiu com sucesso!";

    // Redireciona para a página inicial ou página de login
    header("Location: login.php"); // Altere para a página desejada
    exit();
} else {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php"); // Altere para a página desejada
    exit();
}
?>
