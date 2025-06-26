<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastros</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjS8l6-NhHf5adBiLhey16nlOHzk-OPO8ek5RVT43-DDkAI2qcCRNEuM5GwqMBdtxaXAAIDRuBmxEFRpuuU_bbAMlGJ9i7wRHcjKMtg0elJKkQQsjcEyAQvBlw3eT-mGHkNkQkm0HwiB6Ut/s1600/1292856811_50_123rgb.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 20px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #F8F1FF;
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      width: 320px;
      backdrop-filter: blur(5px);
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      margin-bottom: 30px;
      color: #F8F1FF;
      font-weight: 700;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
      text-align: center;
    }

    .link-box {
      display: block;
      background: rgba(255, 255, 255, 0.85);
      margin: 12px 0;
      padding: 15px 0;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
      font-weight: 600;
      font-size: 18px;
      transition: background-color 0.3s ease, transform 0.3s ease;
      backdrop-filter: blur(5px);
      text-align: center;
      cursor: pointer;
      color: #6C3483;
      text-decoration: none;
    }

    .link-box:hover {
      background-color: rgba(171, 70, 209, 0.9);
      transform: scale(1.05);
      color: white;
    }

    @media (max-width: 420px) {
      .container {
        width: 100%;
        border-radius: 0;
        box-shadow: none;
        height: 100vh;
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Cadastros</h1>

    <a class="link-box" href="cadastrar_aluno.php">Cadastrar Aluno</a>
    <a class="link-box" href="novo_professor.php">Cadastrar Professor</a>
    <a class="link-box" href="buscar_cadastrar_livro.php">Cadastrar e Buscar Livro</a>
  </div>

</body>
</html>
