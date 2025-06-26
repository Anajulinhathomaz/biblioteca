<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      color: #F8F1FF;
      position: relative;
    }

    .botao-voltar {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      text-decoration: none;
      color: #ffffff;
      background-color: rgba(130, 50, 180, 0.25);
      padding: 10px 14px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }

    .botao-voltar:hover {
      background-color: rgba(130, 50, 180, 0.5);
      transform: scale(1.1);
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      border-radius: 20px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      margin-bottom: 30px;
      font-size: 30px;
      color: #F8F1FF;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .cadastro-link {
      background: rgba(255, 255, 255, 0.85);
      margin: 12px 0;
      padding: 14px 0;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
      font-weight: 600;
      font-size: 17px;
      transition: all 0.3s ease;
      backdrop-filter: blur(4px);
      text-align: center;
    }

    .cadastro-link a {
      text-decoration: none;
      color: #5D3A91;
      display: block;
      width: 100%;
      height: 100%;
    }

    .cadastro-link:hover {
      background-color: rgba(171, 70, 209, 0.9);
      transform: scale(1.05);
    }

    .cadastro-link:hover a {
      color: white;
    }

    @media (max-width: 480px) {
      .container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<a href="painel.php" class="botao-voltar" title="Voltar">&#8592;</a>

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

    <div class="cadastro-link">
      <a href="graficos_biblioteca.php">Lista de Gráficos</a>
    </div>
  </div>

</body>
</html>
