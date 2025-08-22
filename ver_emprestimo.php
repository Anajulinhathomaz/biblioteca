<?php
include "conexao.php";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Alterar para "Devolvido"
  if (isset($_GET['acao']) && $_GET['acao'] == 'devolver' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmtUpdate = $pdo->prepare("UPDATE emprestimos SET status = 2 WHERE id = :id");
    $stmtUpdate->execute([':id' => $id]);
    $mensagem = "Empréstimo marcado como devolvido!";
  }

  // Excluir empréstimo
  if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmtDelete = $pdo->prepare("DELETE FROM emprestimos WHERE id = :id");
    $stmtDelete->execute([':id' => $id]);
    $mensagem = "Empréstimo excluído com sucesso!";
  }

  // Buscar dados
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

    .botao-voltar {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      text-decoration: none;
      color: #ffffff;
      background-color: rgba(130, 50, 180, 0.25);
      padding: 10px 14px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }

    .botao-voltar:hover {
      background-color: rgba(130, 50, 180, 0.5);
      transform: scale(1.1);
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      border-radius: 15px;
      padding: 30px;
      width: 100%;
      max-width: 1100px;
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
    }

    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    .mensagem {
      text-align: center;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 18px;
    }

    a.botao {
      padding: 5px 10px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }

    .devolvido {
      background: seagreen;
    }

    .excluir {
      background: crimson;
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

  <a href="informacoes_gerais.php" class="botao-voltar" title="Voltar">&#8592;</a>

  <div class="container">
    <h2>Lista de Empréstimos</h2>

    <?php if (isset($mensagem)): ?>
      <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
    <?php elseif (isset($erro)): ?>
      <div class="mensagem" style="background: rgba(255,0,0,0.5);"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if (!empty($emprestimos)): ?>
      <table>
        <tr>
          <th>Aluno</th>
          <th>Professor</th>
          <th>Livro</th>
          <th>Data de Empréstimo</th>
          <th>Data de Devolução</th>
          <th>Status</th>
          <th>Devolver</th>
          <th>Excluir</th>
        </tr>
        <?php
        $hoje = date('Y-m-d');
        foreach ($emprestimos as $emprestimo):
          $statusTexto = '';

          if ($emprestimo['status'] == 2) {
            $statusTexto = 'Devolvido';
          } else {
            if ($emprestimo['data_devolucao'] < $hoje) {
              $statusTexto = 'Atrasado';
            } else {
              $statusTexto = 'Em andamento';
            }
          }
        ?>
          <tr>
            <td><?= htmlspecialchars($emprestimo['al']) ?></td>
            <td><?= htmlspecialchars($emprestimo['nome']) ?></td>
            <td><?= htmlspecialchars($emprestimo['titulo']) ?></td>
            <td><?= htmlspecialchars($emprestimo['data_emprestimo']) ?></td>
            <td><?= htmlspecialchars($emprestimo['data_devolucao']) ?></td>
            <td><?= $statusTexto ?></td>
            <td>
              <?php if ($emprestimo['status'] != 2): ?>
                <a href="?acao=devolver&id=<?= $emprestimo['id'] ?>"
                  class="botao devolvido"
                  onclick="return confirm('Marcar como devolvido?')">Devolver</a>
              <?php else: ?>
                —
              <?php endif; ?>
            </td>
            <td>
              <a href="?acao=excluir&id=<?= $emprestimo['id'] ?>"
                class="botao excluir"
                onclick="return confirm('Tem certeza que deseja excluir este empréstimo?')">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p style="text-align:center; color:#ffd1e6;">Nenhum empréstimo encontrado.</p>
    <?php endif; ?>
  </div>
</body>

</html>