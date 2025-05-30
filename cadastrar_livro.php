<?php

include'conexao.php';
// // Arquivo: cadastrar_livro.php
// // Arquivo único para conexão PDO, CRUD e formulário para cadastro de livros

// // Configuração do banco de dados - ajuste as credenciais conforme seu ambiente
// $host = 'localhost';
// $dbname = 'biblioteca';
// $username = 'root'; // Ajustado para 'root', usuário padrão em muitos ambientes locais
// $password = '';     // Senha vazia, ajuste conforme seu ambiente

// try {
//     // Criar conexão PDO com UTF8
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Criar banco de dados caso não exista
//     $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
//     // Conecta especificamente ao banco criado (útil no caso de executar pela primeira vez)
//     $pdo->exec("USE `$dbname`");

//     // Criar tabela 'livros' se não existir
//     $sqlCreate = "CREATE TABLE IF NOT EXISTS livros (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         titulo VARCHAR(255) NOT NULL,
//         autor VARCHAR(255) NOT NULL,
//         isbn VARCHAR(20) NOT NULL UNIQUE
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
//     $pdo->exec($sqlCreate);

// } catch (PDOException $e) {
//     die("Erro na conexão com o banco: " . $e->getMessage());
// }

// Inicializa variáveis de mensagem
$mensagem = '';
$erro = '';

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtra e valida os dados recebidos
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');

    if (!$titulo || !$autor || !$isbn) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Insere o livro no banco
        try {
            $sqlInsert = "INSERT INTO livros (titulo, autor, isbn) VALUES (:titulo, :autor, :isbn)";
            $stmt = $conn->prepare($sqlInsert);
            $stmt->execute([
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':isbn' => $isbn
            ]);
            $mensagem = "Livro cadastrado com sucesso!";
        } catch (PDOException $ex) {
            if ($ex->getCode() == 23000) { // Violação de chave única (ISBN duplicado)
                $erro = "Erro: ISBN já cadastrado.";
            } else {
                $erro = "Erro ao cadastrar o livro: " . $ex->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Livro - Biblioteca</title>
    <style>
        /* Reset e fonte */
        body, html {
            margin: 0; padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #E5CCFF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 0.4rem;
            color: #34495e;
            font-weight: 600;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1.2rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
        }
        button {
            width: 100%;
            padding: 0.7rem;
            background: #3498db;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background: #2980b9;
        }
        .message {
            margin-top: 1rem;
            padding: 0.7rem;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
        }
        .success {
            background: #2ecc71;
            color: white;
        }
        .error {
            background: #e74c3c;
            color: white;
        }
        /* Responsividade para dispositivos menores */
        @media (max-width: 400px) {
            .container {
                margin: 1rem;
                padding: 1rem 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container" role="main">
        <h1>Cadastro de Livro</h1>
        <?php if($mensagem): ?>
            <div class="message success" role="alert"><?= htmlspecialchars($mensagem) ?></div>
        <?php elseif($erro): ?>
            <div class="message error" role="alert"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        <form action="" method="post" novalidate>
            <label for="titulo">Título do Livro</label>
            <input type="text" id="titulo" name="titulo" required maxlength="255" value="<?= isset($titulo) ? htmlspecialchars($titulo) : '' ?>" />

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" required maxlength="255" value="<?= isset($autor) ? htmlspecialchars($autor) : '' ?>" />

            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" required maxlength="20" value="<?= isset($isbn) ? htmlspecialchars($isbn) : '' ?>" />

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #E5CCFF;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px 25px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #2980b9;
    }

    .message {
        padding: 10px;
        border-radius: 4px;
        text-align: center;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .success {
        background-color: #2ecc71;
        color: white;
    }

    .error {
        background-color: #e74c3c;
        color: white;
    }
</style>
