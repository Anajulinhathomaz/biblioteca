<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Novo Professor</title>
    <style>
        /* Reset and base */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 700;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1.8px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 6px #007BFFaa;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-weight: 700;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        /* Responsive adjustments */
        @media (max-width: 420px) {
            .container {
                padding: 20px 25px;
                width: 100%;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container" role="main">
        <h1>Novo Professor</h1>
        <form action="salvar_professor.php" method="POST" autocomplete="off" novalidate>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required pattern=".{3,}" title="Por favor, insira pelo menos 3 caracteres" />

            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required pattern="\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}" title="Formato: 000.000.000-00" maxlength="14" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required />

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="********" required minlength="6" title="Senha deve ter ao menos 6 caracteres" />

            <button type="submit" aria-label="Salvar novo professor">Salvar</button>
        </form>
    </div>
</body>
</html>
