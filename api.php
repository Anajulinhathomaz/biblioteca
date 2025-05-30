<?php

function buscarLivrosGoogle($termo) {
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($termo);
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Exemplo de como buscar um livro
if (isset($_POST["buscar_livro"])) {
    $termo = $_POST["termo_busca"];
    $livros = buscarLivrosGoogle($termo);

    if (isset($livros['items'])) {
        foreach ($livros['items'] as $livro) {
            echo "Título: " . $livro['volumeInfo']['title'] . "<br>";
            echo "Autor: " . implode(", ", $livro['volumeInfo']['authors']) . "<br>";
            echo "ISBN: " . implode(", ", $livro['volumeInfo']['industryIdentifiers'][0]) . "<br>";
            echo "Descrição: " . $livro['volumeInfo']['description'] . "<br>";
        }
    } else {
        echo "Nenhum livro encontrado.";
    }
}
?>