<?php
session_start();

// Verifica se o professor está logado
if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

// Conexão PDO direta
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cadastrar_aluno"])) {
    $nome = $_POST["nome"] ?? '';
    $email = $_POST["email"] ?? '';
    $serie = $_POST["serie"] ?? '';

    if (empty($nome) || empty($email) || empty($serie)) {
        $mensagem = "Preencha todos os campos!";
    } else {
        $sql = "INSERT INTO alunos (nome, email, serie) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$nome, $email, $serie])) {
            $mensagem = "Aluno cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar aluno!";
        }
    }
}
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
            position: relative;
        }

        .mensagem {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(240, 248, 255, 0.95);
            color: #4b2e15;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            font-weight: bold;
            text-align: center;
            z-index: 1000;
            animation: fadeOut 4s ease forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; display: none; }
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

<?php if (!empty($mensagem)): ?>
    <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

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
