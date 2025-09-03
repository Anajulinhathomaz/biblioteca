<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Conexão PDO com banco MySQL
    $host = 'localhost';
    $dbname = 'biblioteca';
    $user = 'root';
    $pass = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Erro na conexão: ' . $e->getMessage(), 'status' => 'erro']);
        exit;
    }

    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $isbn = $_POST['isbn'] ?? '';

    if (empty($titulo) || empty($autor)) {
        echo json_encode(['message' => 'Título e autor são obrigatórios!', 'status' => 'erro']);
        exit;
    }

    try {
        $sql = "INSERT INTO livros (titulo, autor, isbn) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo, $autor, $isbn]);

        echo json_encode(['message' => 'Livro cadastrado com sucesso!', 'status' => 'sucesso']);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Erro ao cadastrar: ' . $e->getMessage(), 'status' => 'erro']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Busca e Cadastro de Livros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: url('./imagens/enrolados_biblioteca5.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            color: #eee;
        }

        .container {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 30px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #f0e6ff;
            margin-bottom: 30px;
        }

        h1 {
            margin-bottom: 25px;
            font-size: 26px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #eee;
            box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s ease;
        }

        input[type="text"]::placeholder {
            color: #ccc;
        }

        input[type="text"]:focus {
            background-color: rgba(255, 255, 255, 0.25);
            outline: none;
            box-shadow: 0 0 8px rgba(171, 70, 209, 0.9);
        }

        #resultados {
            width: 100%;
            max-height: 600px;
            overflow-y: auto;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.5);
            padding: 20px;
            display: none;
            color: #f0e6ff;
        }

        .livro {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(25, 0, 35, 0.6);
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(171, 70, 209, 0.6);
            transition: background 0.3s ease;
        }

        .livro:hover {
            background: rgba(171, 70, 209, 0.25);
            box-shadow: 0 0 20px rgba(171, 70, 209, 0.9);
        }

        .livro img {
            width: 120px;
            height: auto;
            border-radius: 8px;
            flex-shrink: 0;
            box-shadow: 0 0 12px rgba(171, 70, 209, 0.8);
        }

        .livro div {
            text-align: left;
            flex: 1;
        }

        .livro h3 {
            margin-bottom: 8px;
            color: #ddaaff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .descricao {
            margin-top: 10px;
            font-size: 0.95em;
            color: #d3c4e3;
            line-height: 1.3;
            max-height: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        button {
            margin-top: 10px;
            padding: 10px 25px;
            background: rgba(171, 70, 209, 0.9);
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1em;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(171, 70, 209, 0.7);
            transition: background 0.3s ease, transform 0.15s ease;
        }

        button:hover {
            background: rgba(171, 70, 209, 1);
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(171, 70, 209, 1);
            color: #fff;
        }

        /* Mensagem central */
        .mensagem {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 30px;
            border-radius: 14px;
            background: rgba(171, 70, 209, 0.9);
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 10px 30px rgba(171, 70, 209, 0.7);
            z-index: 10000;
            display: none;
            max-width: 80%;
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        .mensagem.sucesso {
            border: 2px solid #b3a0ff;
        }

        .mensagem.erro {
            border: 2px solid #ff4c4c;
            background: rgba(255, 76, 76, 0.9);
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Buscar e Cadastrar Livro</h1>
        <input type="text" id="busca" placeholder="Digite o nome do livro" autocomplete="off" />
    </div>

    <div id="resultados"></div>
    <div id="mensagem" class="mensagem"></div>

    <script>
        const input = document.getElementById('busca');
        const resultados = document.getElementById('resultados');
        const mensagem = document.getElementById('mensagem');

        input.addEventListener('keyup', function() {
            const termo = input.value.trim();
            if (termo.length < 3) {
                resultados.innerHTML = '';
                resultados.style.display = 'none';
                return;
            }

            fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(termo)}`)
                .then(res => res.json())
                .then(data => {
                    resultados.innerHTML = '';

                    if (data.items) {
                        resultados.style.display = 'block';
                        data.items.forEach(item => {
                            const info = item.volumeInfo;
                            const titulo = info.title || 'Sem título';
                            const autores = info.authors ? info.authors.join(', ') : 'Desconhecido';
                            const descricao = info.description || 'Sem descrição disponível.';
                            const imagem = info.imageLinks ? info.imageLinks.thumbnail : 'https://via.placeholder.com/100x150?text=Sem+Capa';
                            const isbn = info.industryIdentifiers ? info.industryIdentifiers[0].identifier : '';

                            const div = document.createElement('div');
                            div.className = 'livro';
                            div.innerHTML = `
                        <img src="${imagem}" alt="Capa do livro">
                        <div>
                            <h3>${titulo}</h3>
                            <p><strong>Autor(es):</strong> ${autores}</p>
                            ${isbn ? `<p><strong>ISBN:</strong> ${isbn}</p>` : ''}
                            <p class="descricao">${descricao}</p>
                            <button onclick="cadastrarLivro('${titulo.replace(/'/g, "\\'")}', '${autores.replace(/'/g, "\\'")}', '${isbn}')">Cadastrar</button>
                        </div>
                    `;
                            resultados.appendChild(div);
                        });
                    } else {
                        resultados.style.display = 'block';
                        resultados.innerHTML = '<p>Nenhum livro encontrado.</p>';
                    }
                });
        });

        function cadastrarLivro(titulo, autor, isbn) {
            const formData = new FormData();
            formData.append('titulo', titulo);
            formData.append('autor', autor);
            formData.append('isbn', isbn);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(response => {
                    exibirMensagem(response.message, response.status);
                });
        }

        function exibirMensagem(msg, tipo) {
            mensagem.textContent = msg;
            mensagem.className = 'mensagem ' + tipo;
            mensagem.style.display = 'block';

            if (tipo === 'sucesso') {
                setTimeout(() => {
                    window.location.href = "cadastros.php"; // Redireciona após sucesso
                }, 2500);
            } else {
                setTimeout(() => {
                    mensagem.style.display = 'none';
                }, 3000);
            }
        }
    </script>

</body>

</html>