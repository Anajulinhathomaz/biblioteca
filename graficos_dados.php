<?php
include 'conexao.php';

function fetchData($pdo)
{
    // GRÁFICO 1
    $stmt1 = $pdo->query("SELECT serie, periodo, COUNT(*) AS total FROM alunos a JOIN emprestimos e ON e.aluno_id = a.id GROUP BY serie, periodo");

    // GRÁFICO 2
    $stmt2 = $pdo->query("SELECT nome, serie, periodo, COUNT(e.id) AS total FROM alunos a JOIN emprestimos e ON e.aluno_id = a.id GROUP BY a.id, serie, periodo ORDER BY total DESC");

    // GRÁFICO 3
    $stmt3 = $pdo->query("SELECT l.titulo, e.bimestre, COUNT(*) AS total FROM livros l JOIN emprestimos e ON l.id = e.livro_id GROUP BY l.id, e.bimestre ORDER BY e.bimestre, total DESC");

    $data = [
        'grafico1' => [],
        'grafico2' => [],
        'grafico3' => []
    ];

    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $data['grafico1'][] = ["{$row['serie']} - {$row['periodo']}", (int)$row['total']];
    }

    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $data['grafico2'][] = ["{$row['nome']} ({$row['serie']} - {$row['periodo']})", (int)$row['total']];
    }

    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        if (!isset($data['grafico3'][$row['bimestre']])) $data['grafico3'][$row['bimestre']] = [];
        $data['grafico3'][$row['bimestre']][] = [$row['titulo'], (int)$row['total']];
    }

    return $data;
}

header('Content-Type: application/json');
echo json_encode(fetchData($pdo));
exit;
