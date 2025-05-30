<?php
$host = 'localhost'; // ou o endereço do seu servidor de banco de dados
$dbname = 'biblioteca';
$username = 'root'; // seu usuário do banco de dados
$password = ''; // sua senha do banco de dados

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
