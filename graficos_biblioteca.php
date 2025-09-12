<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca Mágica - Relatórios</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        /* === Estilo Princesinha === */
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: linear-gradient(to bottom, #ffe6f0, #fff0f5);
            color: #4b2e83;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #d63384;
            font-size: 3em;
            margin-bottom: 0.2em;
        }

        h2 {
            color: #a83279;
            margin-bottom: 1em;
        }

        .chart-container {
            display: inline-block;
            width: 400px;
            height: 400px;
            margin: 20px;
            background-color: #fff0f5;
            border: 3px solid #f8c1d8;
            border-radius: 20px;
            box-shadow: 0px 5px 15px rgba(216, 112, 185, 0.5);
            padding: 20px;
        }

        .chart-container h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #d63384;
        }

        @media(max-width: 900px) {
            .chart-container {
                width: 90%;
                height: 350px;
            }
        }
    </style>
</head>

<body>

    <h1>📚 Biblioteca Mágica</h1>
    <h2>Relatórios de Leitura</h2>

    <div class="chart-container">
        <h3>Top 10 Alunos</h3>
        <div id="chartAlunos"></div>
    </div>

    <div class="chart-container">
        <h3>Top 10 Livros</h3>
        <div id="chartLivros"></div>
    </div>

    <div class="chart-container">
        <h3>Top 10 Turmas</h3>
        <div id="chartSeries"></div>
    </div>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        async function drawCharts() {
            // Chama o backend
            const response = await fetch('graficos_dados.php'); // ajuste o nome do seu arquivo PHP
            const data = await response.json();

            // === Top Alunos ===
            const alunosData = new google.visualization.DataTable();
            alunosData.addColumn('string', 'Aluno');
            alunosData.addColumn('number', 'Livros Lidos');
            data.top_alunos.forEach(aluno => {
                alunosData.addRow([aluno.nome, parseInt(aluno.total_emprestimos)]);
            });
            const alunosOptions = {
                pieHole: 0.4,
                colors: ['#ffb6c1', '#ff69b4', '#ff1493', '#db7093', '#ffc0cb', '#f8b8dc', '#f4a6d7', '#e48fbf', '#d87fa6', '#c7618e'],
                fontName: 'Comic Sans MS',
                legend: {
                    position: 'right',
                    textStyle: {
                        fontSize: 14
                    }
                }
            };
            const chartAlunos = new google.visualization.PieChart(document.getElementById('chartAlunos'));
            chartAlunos.draw(alunosData, alunosOptions);

            // === Top Livros ===
            const livrosData = new google.visualization.DataTable();
            livrosData.addColumn('string', 'Livro');
            livrosData.addColumn('number', 'Vezes Lido');
            data.top_livros.forEach(livro => {
                livrosData.addRow([livro.titulo, parseInt(livro.total_emprestimos)]);
            });
            const livrosOptions = {
                pieHole: 0.4,
                colors: ['#ffd1dc', '#ffb3c6', '#ff8fb1', '#ff669c', '#ff4d8a', '#ff3390', '#e62e89', '#cc297f', '#b32275', '#991c6b'],
                fontName: 'Comic Sans MS',
                legend: {
                    position: 'right',
                    textStyle: {
                        fontSize: 14
                    }
                }
            };
            const chartLivros = new google.visualization.PieChart(document.getElementById('chartLivros'));
            chartLivros.draw(livrosData, livrosOptions);

            // === Top Series ===
            const seriesData = new google.visualization.DataTable();
            seriesData.addColumn('string', 'Série');
            seriesData.addColumn('number', 'Alunos');
            data.top_series.forEach(serie => {
                seriesData.addRow([serie.serie, parseInt(serie.total_alunos)]);
            });
            const seriesOptions = {
                pieHole: 0.4,
                colors: ['#ffccf9', '#ffb3f0', '#ff99e6', '#ff80dd', '#ff66d4', '#ff4dc9', '#e644c2', '#cc3aa6', '#b32e8a', '#991f6f'],
                fontName: 'Comic Sans MS',
                legend: {
                    position: 'right',
                    textStyle: {
                        fontSize: 14
                    }
                }
            };
            const chartSeries = new google.visualization.PieChart(document.getElementById('chartSeries'));
            chartSeries.draw(seriesData, seriesOptions);
        }
    </script>

</body>

</html>