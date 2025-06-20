<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["entrar"])) {
    $cpf = trim($_POST["cpf"]);
    $senha = trim($_POST["senha"]);

    if (!empty($cpf) && !empty($senha)) {
        $sql = "SELECT * FROM professores WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cpf]);

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['professor_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                header("Location: painel.php");
                exit();
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuário não encontrado!";
        }
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('https://wallpapers.com/images/hd/rapunzel-night-sky-aonvd6cfoi0kqc3t.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .login-box {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            width: 320px;
            backdrop-filter: blur(5px);
        }

        h2 {
            text-align: center;
            color: #f0e6ff;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #f5f5f5;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #a76cfd, #ff89e9);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .erro {
            margin-top: 15px;
            padding: 10px;
            background-color: rgba(231, 76, 60, 0.8);
            color: #fff;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
    </style> -->
</head>
<body>
    <div class="login-box">
        <h2>Login de Professor</h2>
        <?php if (isset($erro)) { echo "<div class='erro'>" . htmlspecialchars($erro) . "</div>"; } ?>
        <form method="POST">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" name="entrar">Entrar</button>
        </form>
    </div>
</body>
</html>
