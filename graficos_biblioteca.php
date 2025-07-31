<?php
include 'conexao.php'; // certifique-se de que $pdo está definido aqui

// GRÁFICO 1 - Livros emprestados por série e período
$stmt1 = $pdo->query("
    SELECT serie, periodo, COUNT(*) AS total
    FROM alunos a
    JOIN emprestimos e ON e.aluno_id = a.id
    GROUP BY serie, periodo
");

// GRÁFICO 2 - Leitores em destaque (mais empréstimos por série e período)
$stmt2 = $pdo->query("
    SELECT nome, serie, periodo, COUNT(e.id) AS total
    FROM alunos a
    JOIN emprestimos e ON e.aluno_id = a.id
    GROUP BY a.id, serie, periodo
    ORDER BY total DESC
");

// GRÁFICO 3 - Livros mais lidos por bimestre
$stmt3 = $pdo->query("
    SELECT l.titulo, e.bimestre, COUNT(*) AS total
    FROM livros l
    JOIN emprestimos e ON l.id = e.livro_id
    GROUP BY l.id, e.bimestre
    ORDER BY e.bimestre, total DESC
");

$dados_bimestre = [];
while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $dados_bimestre[$row['bimestre']][] = [$row['titulo'], (int)$row['total']];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gráficos Biblioteca</title>
    <meta charset="utf-8">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body { font-family: Arial; padding: 30px; background: #f5f5f5; }
        h2 { margin-top: 50px; }
        .grafico { margin-bottom: 60px; }
    </style>
</head>
<body>
    <h1>📚 Painel de Estatísticas da Biblioteca</h1>

    <!-- Gráfico 1 -->
    <div id="grafico1" class="grafico"></div>
    <!-- Gráfico 2 -->
    <div id="grafico2" class="grafico"></div>
    <!-- Gráfico 3 -->
    <div id="grafico3" class="grafico"></div>

    <script>
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // GRÁFICO 1 - Empréstimos por Série e Período
        var data1 = google.visualization.arrayToDataTable([
            ['Série - Período', 'Quantidade'],
            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                echo "['{$row['serie']} - {$row['periodo']}', {$row['total']}],";
            } ?>
        ]);
        new google.visualization.ColumnChart(document.getElementById('grafico1'))
            .draw(data1, {
                title: 'Empréstimos por Série e Período',
                colors: ['#4285F4']
            });

        // GRÁFICO 2 - Leitores em Destaque
        var data2 = google.visualization.arrayToDataTable([
            ['Leitor', 'Livros Emprestados'],
            <?php while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $nome = "{$row['nome']} ({$row['serie']} - {$row['periodo']})";
                echo "['$nome', {$row['total']}],";
            } ?>
        ]);
        new google.visualization.BarChart(document.getElementById('grafico2'))
            .draw(data2, {
                title: 'Leitores em Destaque por Série e Período',
                colors: ['#DB4437']
            });

        // GRÁFICO 3 - Livros mais lidos no mes (exemplo)
        var data3 = google.visualization.arrayToDataTable([
            ['Livro', 'Empréstimos'],
            <?php
            foreach ($dados_mes[1] ?? [] as $item) {
                echo "['{$item[0]}', {$item[1]}],";
            }
            ?>
        ]);
        new google.visualization.PieChart(document.getElementById('grafico3'))
            .draw(data3, {
                title: 'Livros mais lidos no mes',
                is3D: true
            });
    }
    </script>
</body>
</html>
