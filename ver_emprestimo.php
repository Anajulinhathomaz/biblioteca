<?php
include "conexao.php";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT 
        e.id AS id, 
        a.nome AS al, 
        p.nome AS nome, 
        l.titulo AS titulo,
        MIN(e.data_emprestimo) AS data_emprestimo, 
        MAX(e.data_devolucao) AS data_devolucao,
        e.status
        FROM emprestimos e
        INNER JOIN alunos a ON e.aluno_id = a.id
        INNER JOIN professores p ON e.professor_id = p.id
        INNER JOIN livros l ON e.livro_id = l.id
        GROUP BY e.id, a.nome, p.nome, l.titulo;";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $erro = "Erro na conexão: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lista de Empréstimos</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://wallpaper.forfun.com/fetch/35/35701c7bca9f48660192464f82f3468c.jpeg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      color: #f9f9f9;
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      border-radius: 15px;
      padding: 30px;
      width: 100%;
      max-width: 1000px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      color: #ffeaff;
      font-size: 28px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 12px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    th {
      background-color: rgba(171, 70, 209, 0.9);
      color: #fff;
      font-weight: 600;
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    p {
      color: #ffd1e6;
      text-align: center;
      font-size: 18px;
      margin-top: 20px;
    }

    @media (max-width: 600px) {
      table {
        font-size: 14px;
      }

      th,
      td {
        padding: 10px;
      }

      h2 {
        font-size: 22px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Lista de Empréstimos</h2>
    <?php if (isset($erro)): ?>
      <p><?= htmlspecialchars($erro) ?></p>
    <?php elseif (!empty($emprestimos)): ?>
      <table>
        <tr>
          <th>Aluno</th>
          <th>Professor</th>
          <th>Livro</th>
          <th>Data de Empréstimo</th>
          <th>Data de Devolução</th>
          <th>Status</th>
        </tr>
        <?php foreach ($emprestimos as $emprestimo): ?>
          <tr>
            <td><?= htmlspecialchars($emprestimo['al']) ?></td>
            <td><?= htmlspecialchars($emprestimo['nome']) ?></td>
            <td><?= htmlspecialchars($emprestimo['titulo']) ?></td>
            <td><?= htmlspecialchars($emprestimo['data_emprestimo']) ?></td>
            <td><?= htmlspecialchars($emprestimo['data_devolucao']) ?></td>
            <td>
              <?php
              if ($emprestimo['status'] == 0) {
                echo 'Em andamento';
              } elseif ($emprestimo['status'] == 1) {
                echo 'Atrasado';
              } elseif ($emprestimo['status'] == 2) {
                echo 'Devolvido';
              } else {
                echo 'Desconhecido';
              }
              ?>
            </td>
            <td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>Nenhum empréstimo encontrado.</p>
    <?php endif; ?>
  </div>
</body>
</html>