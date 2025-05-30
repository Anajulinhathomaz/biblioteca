<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Conexão com o banco
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para listar livros
function listarLivros($conn) {
    $sql = "SELECT * FROM livros";
    return $conn->query($sql);
}

// Função para deletar livro
if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);
    $sql = "DELETE FROM livros WHERE id=$id";
    $conn->query($sql);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Listar livros
$livros = listarLivros($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Livros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E5CCFF;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #3498db;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a.deletar {
            color: #e74c3c;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }
        a.deletar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Livros</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($livros->num_rows > 0): ?>
                    <?php while($row = $livros->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['titulo']) ?></td>
                            <td><?= htmlspecialchars($row['autor']) ?></td>
                            <td><?= htmlspecialchars($row['isbn']) ?></td>
                            <td>
                                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este livro?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum livro encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
