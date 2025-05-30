<?php 
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "biblioteca"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function listarAlunos($conn) {
    $sql = "SELECT * FROM alunos";
    $result = $conn->query($sql);
    return $result;
}

if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);
    $sql = "DELETE FROM alunos WHERE id=$id";
    $conn->query($sql);
    header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
    exit;
}

$alunos = listarAlunos($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('https://c4.wallpaperflare.com/wallpaper/156/861/196/movies-tangled-disney-rapunzel-wallpaper-preview.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 900px;
            backdrop-filter: blur(5px);
        }

        h1 {
            text-align: center;
            color: #f0e6ff;
            margin-bottom: 20px;
            font-size: 26px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            backdrop-filter: blur(2px);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
            color: #fff;
        }

        table th {
            background: linear-gradient(45deg, #a76cfd, #ff89e9);
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        a.deletar {
            display: inline-block;
            padding: 8px 12px;
            background: linear-gradient(45deg, #e57373, #ff6f61);
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        a.deletar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .sem-aluno {
            text-align: center;
            padding: 20px;
            background: rgba(0,0,0,0.3);
            border-radius: 10px;
            margin-top: 20px;
            font-size: 16px;
            color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Alunos</h1>
        <?php if ($alunos->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Série</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $alunos->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= htmlspecialchars($row['serie']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este aluno?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="sem-aluno">Nenhum aluno encontrado.</div>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
