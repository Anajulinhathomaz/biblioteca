<?php
include "./conexao.php"; // conexão PDO

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $stmt = $pdo->prepare("UPDATE professores SET status = 0 WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo "Erro ao atualizar status: " . $e->getMessage();
        exit;
    }

    header("Location: lista_professores.php"); // ou o nome da sua página principal
    exit;
}
?>
