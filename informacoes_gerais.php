<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Informações Gerais</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://wallpaper.forfun.com/fetch/35/35701c7bca9f48660192464f82f3468c.jpeg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .container {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h1 {
      margin-bottom: 30px;
      font-size: 32px;
      color: #fff0f5;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .cadastro-link {
      background: rgba(255, 255, 255, 0.2);
      margin: 15px auto;
      padding: 15px 0;
      border-radius: 12px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .cadastro-link a {
      text-decoration: none;
      color: #fffafc;
      font-weight: bold;
      font-size: 18px;
      display: block;
      transition: color 0.3s ease;
    }

    .cadastro-link:hover {
      background-color: rgba(255, 182, 193, 0.3);
      transform: translateY(-3px) scale(1.03);
    }

    .cadastro-link:hover a {
      color: #ffe0f0;
    }

    @media (max-width: 480px) {
      .container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
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
      <a href="ver_emprestimo.php">Lista de Empréstimos</a>
    </div>
  </div>

</body>
</html>
