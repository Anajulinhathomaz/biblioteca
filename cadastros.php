<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastros</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('./imagens/enrolados_cadastros2.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 40px 20px;
      text-align: center;
      color: #fff;
    }

    h1 {
      color: #FFD700; /* dourado, para destacar no fundo */
      font-weight: 700;
      margin-bottom: 40px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .link-box {
      background: rgba(255, 255, 255, 0.8);
      margin: 20px auto;
      padding: 20px 0;
      width: 300px;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
      font-weight: 600;
      font-size: 18px;
      backdrop-filter: blur(4px);
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .link-box a {
      text-decoration: none;
      color: #6A0DAD; /* roxo vibrante */
      display: block;
    }

    .link-box:hover {
      background-color: rgba(255, 215, 0, 0.9); /* amarelo dourado ao passar o mouse */
      transform: translateY(-5px);
    }

    .link-box:hover a {
      color: #fff;
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
    <a href="buscar_cadastrar_livro.php">Cadastrar e Buscar Livro</a>
  </div>
</body>
</html>
