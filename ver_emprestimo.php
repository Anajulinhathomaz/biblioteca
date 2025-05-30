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
        MAX(e.data_devolucao) AS data_devolucao
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empréstimos</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #E5CCFF;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        p {
            color: #f44336;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Empréstimos</h2>
        <?php if (isset($erro)): ?>
            <p><?php echo $erro; ?></p>
        <?php elseif (!empty($emprestimos)): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Professor</th>
                    <th>Livro</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                </tr>
                <?php foreach ($emprestimos as $emprestimo): ?>
                    <tr>
                        <td><?= htmlspecialchars($emprestimo['id']) ?></td>
                        <td><?= htmlspecialchars($emprestimo['al']) ?></td>
                        <td><?= htmlspecialchars($emprestimo['nome']) ?></td>
                        <td><?= htmlspecialchars($emprestimo['titulo']) ?></td>
                        <td><?= htmlspecialchars($emprestimo['data_emprestimo']) ?></td>
                        <td><?= htmlspecialchars($emprestimo['data_devolucao']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Nenhum empréstimo encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
