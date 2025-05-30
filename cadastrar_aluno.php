<?php
// Incluir o arquivo de conexão
include "conexao.php";

// Iniciar a sessão para recuperar o professor_id
session_start();

// Verificar se o professor está logado
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
            font-family: Arial, sans-serif;
            background-image: url('https://images5.alphacoders.com/680/thumb-1920-680432.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            padding: 30px 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 26px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: border 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border: 1px solid #6c5ce7;
            outline: none;
        }

        button {
            width: 100%;
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #a29bfe, #6c5ce7);
            transform: scale(1.03);
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
