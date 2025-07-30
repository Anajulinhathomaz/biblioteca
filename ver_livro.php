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
    <h1>Lista de Livros</h1>
    <?php if ($livros->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $livros->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['titulo']) ?></td>
              <td><?= htmlspecialchars($row['autor']) ?></td>
              <td><?= htmlspecialchars($row['isbn']) ?></td>
              <td>
                <a class="deletar" href="?deletar=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este livro?');">Deletar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div style="margin-top: 20px; text-align: center;">Nenhum livro encontrado.</div>
    <?php endif; ?>
  </div>

  <?php $conn->close(); ?>
</body>
</html>
