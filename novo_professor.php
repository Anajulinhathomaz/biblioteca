<?php
session_start();

// Conexão PDO
$host = 'localhost';
$dbname = 'biblioteca';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $mensagem = "Erro na conexão: " . $e->getMessage();
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $nome = trim($_POST["nome"]);
    $cpf = trim($_POST["cpf"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($senha)) {
        $sql = "SELECT id FROM professores WHERE cpf = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);

        if ($stmt->rowCount() == 0) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO professores (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$nome, $cpf, $email, $senhaHash])) {
                $mensagem = "Professor cadastrado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar professor!";
            }
        } else {
            $mensagem = "CPF já cadastrado!";
        }
    } else {
        $mensagem = "Preencha todos os campos!";
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
            font-family: 'Segoe UI', sans-serif;
            background: url('https://wallpaper.dog/large/20407048.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        form {
            background: rgba(30, 30, 30, 0.85);
            padding: 30px 35px;
            border-radius: 15px;
            max-width: 450px;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.7);
        }

        h2 {
            color: #f5f0ff;
            margin-top: 0;
            text-align: center;
            text-shadow: 1px 1px 3px #000;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
            color: #ddddff;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            background-color: #2f2f2f;
            color: #fff;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #915eff;
            background-color: #3d3d3d;
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #915eff, #6c47c5);
            color: #fff;
            padding: 13px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #6c47c5, #915eff);
            transform: scale(1.03);
        }

        .mensagem {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            padding: 20px 40px;
            border-radius: 12px;
            font-weight: bold;
            color: #4b2e15;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 999;
            animation: fadeOut 4s ease forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            85% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }
    </style>
</head>
<body>

<?php if (!empty($mensagem)): ?>
    <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<form method="POST">
    <h2>Cadastro de Professor</h2>

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
