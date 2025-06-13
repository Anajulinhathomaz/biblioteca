<?php
session_start();

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

include "conexao.php";

$nomeProfessor = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Painel do Professor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjGXZ5rSImI36XCdko8tiDNt-q-1mT_gsVBtmTN1bB39EKDqV9mzPe2ca78fESYhUZxQaXPzHezyQvf5E-HKVmr2b42nn0CEU33I5FItDOIRmmpEFVGIAxnxk5oSByfeof-FHXRCGKlSnTb/s1600/disney-tangled-rapunzels-tower-wallpaper.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #F8F1FF;
        }

        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            width: 320px;
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-bottom: 40px;
            color: #F8F1FF;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
            text-align: center;
        }

        .link-box {
            display: block;
            background: rgba(255, 255, 255, 0.85);
            margin: 15px 0;
            padding: 15px 0;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            font-weight: 600;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            backdrop-filter: blur(5px);
            text-align: center;
            cursor: pointer;
            color: #6C3483;
            text-decoration: none;
        }

        .link-box:hover {
            background-color: rgba(171, 70, 209, 0.9);
            transform: scale(1.05);
            color: white;
        }

        .logout {
            display: inline-block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 600;
            color: #E74C3C;
            text-decoration: none;
            transition: color 0.3s ease;
            background: rgba(255,255,255,0.85);
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .logout:hover {
            color: white;
            background-color: #C0392B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo htmlspecialchars($nomeProfessor); ?>!</h2>

        <a class="link-box" href="cadastros.php">Cadastros</a>
        <a class="link-box" href="registrar_emprestimo.php">Registrar Empréstimo</a>
        <a class="link-box" href="informacoes_gerais.php">Informações Gerais</a>

        <a class="logout" href="logout.php">Sair</a>
    </div>
</body>
</html>
