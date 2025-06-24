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
    <meta charset="UTF-8">
    <title>Busca e Cadastro de Livros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', serif;
        }

        body {
            background: url('./imagens/enrolados_biblioteca5.png') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background: rgba(255, 248, 220, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            max-width: 90%;
            text-align: center;
            margin: 20px auto 30px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #4b2e15;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #bfa17b;
            border-radius: 5px;
            background-color: #fffbe6;
        }

        #resultados {
            width: 1500px;
            max-width: 100%;
            max-height: 600px;
            overflow-y: auto;
            padding: 20px;
            background: rgba(255, 248, 220, 0.9);
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            display: none;
        }

        .livro {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background: #fffdf7;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            gap: 20px;
        }

        .livro img {
            width: 180px;
            height: auto;
            border-radius: 5px;
            flex-shrink: 0;
        }

        .livro div {
            text-align: left;
            flex: 1;
        }

        .descricao {
            margin-top: 10px;
            font-size: 0.95em;
            color: #5c4328;
        }

        button {
            padding: 10px 20px;
            background: #6b4226;
            color: #fff8dc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #c1975f;
            color: #3a2a1a;
            transform: scale(1.05);
        }

        /* Mensagem central */
        .mensagem {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 30px;
            border-radius: 12px;
            background: rgba(255, 248, 220, 0.95);
            color: #4b2e15;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 10000;
            display: none;
            max-width: 80%;
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        .mensagem.sucesso {
            border: 2px solid #4b2e15;
        }

        .mensagem.erro {
            border: 2px solid #b22222;
            color: #b22222;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Buscar e Cadastrar Livro</h1>
    <input type="text" id="busca" placeholder="Digite o nome do livro">
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
                        <img src="${imagem}" alt="Capa">
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

    fetch('', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(response => {
            exibirMensagem(response.message, response.status);
        });
}

function exibirMensagem(msg, tipo) {
    mensagem.textContent = msg;
    mensagem.className = 'mensagem ' + tipo;
    mensagem.style.display = 'block';

    setTimeout(() => {
        mensagem.style.display = 'none';
    }, 3000);
}
</script>

</body>
</html>
