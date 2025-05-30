<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Cadastros</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #E5CCFF;
    margin: 0;
    padding: 20px;
    text-align: center;
  }

  h1 {
    margin-bottom: 40px;
    color: #333;
    font-weight: 700;
  }

  .cadastro-link {
    background: white;
    margin: 20px auto;
    padding: 20px 0;
    width: 250px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    font-weight: 600;
    font-size: 18px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .cadastro-link a {
    text-decoration: none;
    color: #333;
    display: block;
  }

  .cadastro-link:hover {
    background-color: #4CAF50;
  }

  .cadastro-link:hover a {
    color: white;
  }
</style>
</head>
<body>

  <h1>Informações Gerais</h1>

  <div class="cadastro-link">
    <a href="ver_alunos.php">Lista de Alunos</a>
  </div>

  <div class="cadastro-link">
    <a href="ver_livro.php">Lista de Livros</a>
  </div>
  

  <div class="cadastro-link">
    <a href="ver_professores.php">Lista de Professores</a>
  </div>

  <div class="cadastro-link">
    <a href="ver_emprestimo.php">Lista de Emprestimos</a>
  </div>

</body>
</html>
