<?php
header('Content-Type: text/plain'); // Mostra como texto puro para facilitar copiar e colar

$nomes = ["Ana", "Bruno", "Carlos", "Daniela", "Eduardo", "Fernanda", "Gabriel", "Helena", "Igor", "Juliana", "Kaio", "Larissa", "Marcos", "Nina", "Otávio", "Paula", "Quésia", "Rafael", "Sofia", "Tiago", "Ursula", "Vanessa", "Wagner", "Xuxa", "Yuri", "Zuleide"];
$sobrenomes = ["Silva", "Souza", "Oliveira", "Lima", "Santos", "Ferreira", "Almeida", "Gomes", "Barbosa", "Rodrigues"];

// echo "-- Script SQL para inserir 50 usuários\n";
// echo "USE nome_do_seu_banco;\n\n"; // <- Altere para o seu banco
echo "CREATE TABLE IF NOT EXISTS professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40),
    cpf VARCHAR(11),
    senha VARCHAR(255),
    email VARCHAR(60)
);\n\n";

for ($i = 1; $i <= 50; $i++) {
    $nome = $nomes[array_rand($nomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)];
    $cpf = str_pad(mt_rand(10000000000, 99999999999), 11, '0', STR_PAD_LEFT);
    $email = strtolower(str_replace(' ', '.', $nome)) . rand(1, 999) . '@teste.com';
    $senhaHash = password_hash("123", PASSWORD_DEFAULT); // criptografia PHP

    // Escapar aspas para evitar erro no SQL
    $nomeEsc = addslashes($nome);
    $emailEsc = addslashes($email);
    $senhaEsc = addslashes($senhaHash);

    echo "INSERT INTO professores (nome, cpf, senha, email) VALUES ('$nomeEsc', '$cpf', '$senhaEsc', '$emailEsc');\n";
}
