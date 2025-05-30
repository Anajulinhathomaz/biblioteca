<?php
include "conexao.php";
session_start();

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

$professor_id = $_SESSION['professor_id'];

if (isset($_POST["cadastrar_aluno"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $serie = $_POST["serie"];

    $sql = "INSERT INTO alunos (nome, email, serie) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$nome, $email, $serie])) {
        echo "<script>alert('Aluno cadastrado com sucesso!');</script>";
        header("Location: painel.php");
        exit();
    } else {
        echo "<script>alert('Erro ao cadastrar aluno!');</script>";
    }
}

$sql_alunos = "SELECT * FROM alunos";
$result_alunos = $conn->query($sql_alunos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Cadastrar Aluno</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('https://images5.alphacoders.com/680/thumb-1920-680432.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(12px) saturate(150%);
            padding: 40px 50px;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            text-align: center;
            color: #E0CFFD;
            margin-bottom: 30px;
            font-size: 28px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: #F0E9FF;
            margin-bottom: 6px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
            backdrop-filter: blur(5px);
            transition: border 0.3s ease, background 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border: 1px solid #A29BFE;
            background: rgba(255, 255, 255, 0.15);
            outline: none;
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #8e44ad, #6c5ce7, #2980b9);
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
            transition: background 0.4s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #6c5ce7, #8e44ad, #3498db);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Aluno</h2>
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required />

            <label for="serie">Série:</label>
            <input type="text" id="serie" name="serie" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <button type="submit" name="cadastrar_aluno">Cadastrar Aluno</button>
        </form>
    </div>
</body>
</html>

<?php $conn = null; ?>
