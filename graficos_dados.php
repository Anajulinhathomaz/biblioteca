<?php
// Inclui a conexão
require_once 'conexao.php';

// 1. 10 alunos que mais leram livros
$sqlTopAlunos = "
    SELECT a.id, a.nome, a.serie, a.periodo, COUNT(e.id) AS total_emprestimos
    FROM alunos a
    JOIN emprestimos e ON e.aluno_id = a.id
    WHERE e.status = 2
    GROUP BY a.id
    ORDER BY total_emprestimos DESC
    LIMIT 10
";
$topAlunos = $pdo->query($sqlTopAlunos)->fetchAll(PDO::FETCH_ASSOC);

// 2. 10 livros mais lidos
$sqlTopLivros = "
    SELECT l.id, l.titulo, l.autor, l.isbn, COUNT(e.id) AS total_emprestimos
    FROM livros l
    JOIN emprestimos e ON e.livro_id = l.id
    WHERE e.status = 2
    GROUP BY l.id
    ORDER BY total_emprestimos DESC
    LIMIT 10
";
$topLivros = $pdo->query($sqlTopLivros)->fetchAll(PDO::FETCH_ASSOC);

// 3. 10 turmas (séries) com mais leitores
$sqlTopSeries = "
    SELECT a.serie, COUNT(DISTINCT a.id) AS total_alunos
    FROM alunos a
    JOIN emprestimos e ON e.aluno_id = a.id
    WHERE e.status = 2
    GROUP BY a.serie
    ORDER BY total_alunos DESC
    LIMIT 10
";
$topSeries = $pdo->query($sqlTopSeries)->fetchAll(PDO::FETCH_ASSOC);

// Retorna como JSON
header('Content-Type: application/json');
echo json_encode([
    'top_alunos' => $topAlunos,
    'top_livros' => $topLivros,
    'top_series' => $topSeries
], JSON_PRETTY_PRINT);
?>