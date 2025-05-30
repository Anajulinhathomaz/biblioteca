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
      padding: 40px 20px;
      text-align: center;
    }

    h1 {
      color: #333;
      font-weight: 700;
      margin-bottom: 40px;
    }

    .link-box {
      background: white;
      margin: 20px auto;
      padding: 20px 0;
      width: 300px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      font-weight: 600;
      font-size: 18px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .link-box a {
      text-decoration: none;
      color: #333;
      display: block;
    }

    .link-box:hover {
      background-color: #4CAF50;
    }

    .link-box:hover a {
      color: white;
    }
  </style>
</head>
<body>
  <h1>Cadastros</h1>

  <div class="link-box">
    <a href="cadastrar_aluno.php">Cadastrar Aluno</a>
  </div>


  <div class="link-box">
    <a href="novo_professor.php">Cadastrar Professor</a>
  </div>

  <div class="link-box">
    <a href="buscar_cadastrar_livro.php">Cadastrar e buscar Livro</a>
  </div>
</body>
</html>
