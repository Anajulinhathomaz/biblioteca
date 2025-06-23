<?php
session_start();
include "conexao.php"; // Incluir o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $nome = trim($_POST["nome"]);
    $cpf = trim($_POST["cpf"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($senha)) {
        // Verificar se o CPF já está cadastrado
        $sql = "SELECT id FROM professores WHERE cpf = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);

        if ($stmt->rowCount() == 0) {
            // Hash da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Inserir novo professor
            $sql = "INSERT INTO professores (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$nome, $cpf, $email, $senhaHash])) {
                $sucesso = "Professor cadastrado com sucesso!";
            } else {
                $erro = "Erro ao cadastrar professor!";
            }
        } else {
            $erro = "CPF já cadastrado!";
        }
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Professor</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #E5CCFF;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }
        h2 {
            color: #333;
            margin-top: 0;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        p.error {
            color: red;
        }
        p.success {
            color: green;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Cadastro de Professor</h2>

        <?php if (isset($erro)) { echo "<p class='error'>$erro</p>"; } ?>
        <?php if (isset($sucesso)) { echo "<p class='success'>$sucesso</p>"; } ?>

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>CPF:</label>
        <input type="text" name="cpf" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>
</body>
</html>
