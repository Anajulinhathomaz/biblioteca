<?php
// Conexão PDO
$host = 'localhost';
$dbname = 'biblioteca';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Função para listar alunos
function listarAlunos($pdo) {
    $stmt = $pdo->query("SELECT * FROM alunos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Deletar aluno + empréstimos vinculados
if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);

    try {
        // Iniciar transação para garantir atomicidade
        $pdo->beginTransaction();

        // Deletar empréstimos relacionados ao aluno
        $stmt = $pdo->prepare("DELETE FROM emprestimos WHERE aluno_id = ?");
        $stmt->execute([$id]);

        // Deletar o aluno
        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
        $stmt->execute([$id]);

        // Confirmar transação
        $pdo->commit();

        // Redirecionar para a mesma página sem parâmetros GET
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Erro ao deletar: " . $e->getMessage());
    }
}

$alunos = listarAlunos($pdo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Alunos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    /* Seu CSS existente */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: url('https://wallpaper.forfun.com/fetch/35/35701c7bca9f48660192464f82f3468c.jpeg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 30px 20px;
      color: #F8F1FF;
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      backdrop-filter: blur(6px);
      width: 100%;
      max-width: 900px;
      overflow-x: auto;
    }

    h1 {
      text-align: center;
      color: #F8F1FF;
      margin-bottom: 25px;
      font-size: 2rem;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: rgba(255, 255, 255, 0.05);
      color: #fff;
    }

    th, td {
      padding: 12px 14px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    th {
      background-color: rgba(171, 70, 209, 0.9);
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    a.deletar {
      color: #e74c3c;
      font-weight: bold;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 6px;
      transition: all 0.3s ease;
      background-color: rgba(255, 255, 255, 0.1);
      display: inline-block;
    }

    a.deletar:hover {
      background-color: #e74c3c;
      color: #fff;
    }

    .sem-aluno {
      text-align: center;
      padding: 20px;
      margin-top: 20px;
      background: rgba(255,255,255,0.05);
      border-radius: 10px;
      font-size: 16px;
      color: #eee;
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }

      table {
        font-size: 14px;
      }

      th, td {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Lista de Alunos</h1>
    <?php if (count($alunos) > 0): ?>
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
          <?php foreach($alunos as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['nome']) ?></td>
              <td><?= htmlspecialchars($row['serie']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td>
                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este aluno?');">Deletar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="sem-aluno">Nenhum aluno encontrado.</div>
    <?php endif; ?>
  </div>
</body>
</html>
