<?php
session_start();

// Se o usuário estiver logado
if (isset($_SESSION['usuario_id'])) {
    // Encerra a sessão
    session_unset();
    session_destroy();

    // Redireciona com parâmetro de confirmação
    header("Location: login.php?logout=ok");
    exit();
} else {
    // Se não estiver logado, redireciona direto
    header("Location: login.php");
    exit();
}
?>
