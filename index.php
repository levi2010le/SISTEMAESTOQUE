<?php
session_start();

if (isset($_SESSION['usuario_logado'])) {
    header('Location: home.php');
    exit();
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    
    // Credenciais pré-definidas
    $email_correto = 'levi.antoniassi@aluno.cps.sp.gov.br';
    $senha_correta = 'estoque05';
    
    if ($email === $email_correto && $senha === $senha_correta) {
        $_SESSION['usuario_logado'] = true;
        $_SESSION['email'] = $email;
        header('Location: home.php');
        exit();
    } else {
        $erro = 'Email ou senha incorretos!';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Estoque</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-login {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .titulo-subtitulo {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .info-credenciais {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            padding: 12px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 12px;
            color: #004085;
        }

        .info-credenciais strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <div class="container-login">
        <h1> Sistema de Estoque</h1>
        <p class="titulo-subtitulo">Acesse sua conta</p>

        <?php if ($erro): ?>
            <div class="erro">
                 <?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit">Entrar</button>
        </form>

        <div class="info-credenciais">
            <strong>Credenciais de Teste:</strong>
            Email: levi.antoniassi@aluno.cps.sp.gov.br<br>
            Senha: estoque05
        </div>
    </div>

</body>
</html>
