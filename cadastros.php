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
      background: url('https://wallpapers.com/images/hd/tangled-1876-x-1080-background-lnu3xk3im6nl463z.jpg') no-repeat center center fixed;
      background-size: cover;
      background-color: #000;
    }

    h1 {
      color: #ffeabf;
      font-weight: 700;
      margin-bottom: 40px;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.85);
      font-size: 3rem;
    }

    .link-box {
      background: rgba(255, 240, 250, 0.2);
      margin: 20px auto;
      padding: 20px 0;
      width: 320px;
      border-radius: 25px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(8px);
      transition: transform 0.3s ease, background-color 0.3s ease;
      border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .link-box a {
      text-decoration: none;
      color: #fffbe6;
      font-weight: 700;
      font-size: 20px;
      display: block;
      padding: 14px 0;
      border-radius: 25px;
      background: linear-gradient(135deg, #f7c2ff, #c199ff);
      box-shadow: 0 4px 12px rgba(185, 125, 255, 0.4);
      transition: all 0.4s ease;
    }

    .link-box:hover {
      background-color: rgba(255, 255, 255, 0.25);
      transform: scale(1.07);
      border-color: rgba(255, 255, 255, 0.5);
    }

    .link-box:hover a {
      background: linear-gradient(135deg, #ffeabf, #ffc3a0);
      color: #5c3b2e;
      box-shadow: 0 6px 18px rgba(255, 194, 120, 0.8);
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
