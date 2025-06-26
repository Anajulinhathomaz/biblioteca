<?php
// Inclui o arquivo de conexão com PDO
include "./conexao.php"; // $conn deve ser uma instância de PDO

function listarProfessores($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM professores");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);
    $stmt = $conn->prepare("DELETE FROM professores WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$professores = listarProfessores($pdo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lista de Professores</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://wallpaper.forfun.com/fetch/35/35701c7bca9f48660192464f82f3468c.jpeg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 30px 20px;
      color: #F8F1FF;
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      width: 100%;
      max-width: 900px;
      overflow-x: auto;
    }

    h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 2rem;
      color: #F8F1FF;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
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

    @media (max-width: 600px) {
      table {
        font-size: 14px;
      }

      th, td {
        padding: 10px;
      }

      .container {
        padding: 20px;
      }
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
        <?php if (!empty($professores)): ?>
          <?php foreach ($professores as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['nome']) ?></td>
              <td><?= htmlspecialchars($row['cpf']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td>
                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este professor?');">Deletar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">Nenhum professor encontrado.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
