<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    include 'conexao.php'; // Inclua seu arquivo de conexão PDO

    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $isbn = $_POST['isbn'] ?? '';

    if (empty($titulo) || empty($autor)) {
        echo json_encode(['message' => 'Título e autor são obrigatórios!']);
        exit;
    }

    try {
        $sql = "INSERT INTO livros (titulo, autor, isbn) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo, $autor, $isbn]);

        echo json_encode(['message' => 'Livro cadastrado com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Erro ao cadastrar: ' . $e->getMessage()]);
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
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            text-align: center;
            margin: 20px auto 30px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #resultados {
            width: 1500px;
            max-width: 100%;
            max-height: 600px;
            overflow-y: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            display: none; /* escondido inicialmente */
        }

        .livro {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background: #f9f9f9;
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
            color: #555;
        }

        button {
            padding: 8px 16px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Buscar e Cadastrar Livro</h1>
    <input type="text" id="busca" placeholder="Digite o nome do livro">
</div>

<div id="resultados"></div>

<script>
const input = document.getElementById('busca');
const resultados = document.getElementById('resultados');

input.addEventListener('keyup', function() {
    const termo = input.value.trim();
    if (termo.length < 3) {
        resultados.innerHTML = '';
        resultados.style.display = 'none'; // esconde quando vazio
        return;
    }

    fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(termo)}`)
        .then(res => res.json())
        .then(data => {
            resultados.innerHTML = '';

            if (data.items) {
                resultados.style.display = 'block'; // mostra resultados
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
                resultados.style.display = 'block'; // mostra a mensagem
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
            alert(response.message);
        });
}
</script>

</body>
</html>
