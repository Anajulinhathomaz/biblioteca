<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastros</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 40px 20px;
      text-align: center;
      color: #fff;
      background: url('./imagens/enrolados_cadastro.jpg') no-repeat center center fixed;
      background-size: contain;
      background-color: #000; /* evita bordas brancas */
    }

    h1 {
      color: #FFD700; /* dourado */
      font-weight: 700;
      margin-bottom: 40px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
    }

    .link-box {
      background: rgba(102, 51, 153, 0.3); /* roxo/lilás translúcido */
      margin: 20px auto;
      padding: 20px 0;
      width: 320px;
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(6px);
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .link-box a {
      text-decoration: none;
      color: #fffbe6;
      font-weight: 700;
      font-size: 20px;
      display: block;
      padding: 12px 0;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .link-box:hover {
      background-color: rgba(102, 51, 153, 0.5); /* mais escuro ao passar o mouse */
      transform: scale(1.05);
    }

    .link-box:hover a {
      background-color: #228B22; /* verde vibrante */
      color: #FFD700; /* dourado */
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
