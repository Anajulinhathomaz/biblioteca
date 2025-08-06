<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gráficos Biblioteca - Enrolados 🌸</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background: linear-gradient(to top left, #fdf6f0, #fce1ec);
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 30px;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #6a4e77;
            margin-bottom: 30px;
        }

        .grafico {
            margin-bottom: 50px;
        }

        a.voltar {
            font-size: 28px;
            text-decoration: none;
            color: #fff;
            background: #d9a5c0;
            padding: 10px 15px;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            left: 20px;
            transition: background 0.3s;
        }

        a.voltar:hover {
            background: #c188a8;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <a href="informacoes_gerais.php" class="voltar" title="Voltar">&#8592;</a>
    <div class="container">
        <h1>📊 Painel da Biblioteca</h1>
        <div id="grafico1" class="grafico"></div>
        <div id="grafico2" class="grafico"></div>
        <div id="grafico3" class="grafico"></div>
    </div>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            fetchAndRender();

            setInterval(fetchAndRender, 10000); // Atualiza a cada 10 segundos
        }

        function fetchAndRender() {
            fetch('graficos_dados.php')
                .then(response => response.json())
                .then(data => {
                    renderPieChart('grafico1', 'Empréstimos por Série e Período', data.grafico1);
                    renderPieChart('grafico2', 'Leitores em Destaque', data.grafico2);
                    renderPieChart('grafico3', 'Livros Mais Lidos (Bimestre 1)', data.grafico3["1"] || []);
                });
        }

        function renderPieChart(elementId, title, chartData) {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Categoria');
            data.addColumn('number', 'Valor');
            data.addRows(chartData);

            const options = {
                title: title,
                is3D: true,
                backgroundColor: 'transparent',
                animation: {
                    duration: 1000,
                    easing: 'out',
                    startup: true
                },
                colors: ['#f8c8dc', '#fddde6', '#e6b0aa', '#f7cac9', '#ecd9c6', '#d4a5a5', '#ffe0ac', '#cdb4db']
            };

            const chart = new google.visualization.PieChart(document.getElementById(elementId));
            chart.draw(data, options);
        }
    </script>
</body>

</html>