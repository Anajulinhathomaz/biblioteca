<?php
session_start();

// Verifica se o professor está logado
if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

// Conexão PDO
$host = 'localhost';
$dbname = 'biblioteca';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$mensagem = "";
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cadastrar_aluno"])) {
    $nome = trim($_POST["nome"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $serie = trim($_POST["serie"] ?? '');

    if (empty($nome) || empty($email) || empty($serie)) {
        $mensagem = "Preencha todos os campos!";
    } else {
        // Verifica se o e-mail já existe
        $verifica = $pdo->prepare("SELECT id FROM alunos WHERE email = ?");
        $verifica->execute([$email]);

        if ($verifica->rowCount() > 0) {
            $mensagem = "Este e-mail já está cadastrado!";
        } else {
            $sql = "INSERT INTO alunos (nome, email, serie) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$nome, $email, $serie])) {
                $mensagem = "Aluno cadastrado com sucesso!";
                $redirect = true; // marca para redirecionar
            } else {
                $mensagem = "Erro ao cadastrar aluno!";
            }
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
        }

        /* Botão seta voltar */
        .voltar {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 45px;
            height: 45px;
            background: url('https://cdn-icons-png.flaticon.com/512/271/271220.png') no-repeat center;
            background-size: contain;
            cursor: pointer;
            transition: transform 0.2s ease;
            z-index: 1001;
        }

        .voltar:hover {
            transform: scale(1.1);
        }

        .mensagem {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(240, 248, 255, 0.97);
            color: #4b2e15;
            padding: 16px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            font-weight: bold;
            z-index: 1000;
            animation: fadeOut 6s ease forwards;
        }

        @keyframes fadeOut {

            0%,
            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .container {
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            color: #E0CFFD;
            margin-bottom: 30px;
            font-size: 26px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: #F0E9FF;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        input:focus {
            border: 1px solid #A29BFE;
            background: rgba(255, 255, 255, 0.15);
            outline: none;
        }

        button {
            background: linear-gradient(135deg, #8e44ad, #6c5ce7, #2980b9);
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.4s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #6c5ce7, #8e44ad, #3498db);
            transform: scale(1.04);
        }
    </style>
</head>

<body>

    <!-- Botão voltar -->
    <a href="painel.php" class="voltar" title="Voltar para o painel"></a>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php if ($redirect): ?>
            <script>
                setTimeout(function() {
                    window.location.href = "cadastros.php";
                }, 2500);
            </script>
        <?php endif; ?>
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