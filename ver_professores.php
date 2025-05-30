<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para listar professores
function listarProfessores($conn) {
    $sql = "SELECT * FROM professores";
    return $conn->query($sql);
}

// Deletar professor
if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);
    $conn->query("DELETE FROM professores WHERE id=$id");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$professores = listarProfessores($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Professores</title>
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
        <h1>Lista de Professores</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($professores->num_rows > 0): ?>
                    <?php while($row = $professores->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= htmlspecialchars($row['cpf']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este professor?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum professor encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
