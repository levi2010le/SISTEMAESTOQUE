<?php
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['usuario_logado'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Estoque</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h1 {
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info span {
            font-size: 14px;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
            font-size: 28px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .menu-item {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            text-align: center;
            border: 2px solid transparent;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
        }

        .menu-item-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .menu-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .menu-item p {
            font-size: 14px;
            color: #666;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>📦 Sistema de Estoque</h1>
        <div class="user-info">
            <span>Bem-vindo, <?php echo htmlspecialchars($email); ?></span>
            <a href="encerrarsessao.php" class="btn-logout">Sair</a>
        </div>
    </div>

    <!-- Container Principal -->
    <div class="container">
        <h2>Painel de Controle</h2>

        <div class="menu-grid">
            <!-- Produtos -->
            <a href="produtos.php" class="menu-item">
                <div class="menu-item-icon">📦</div>
                <h3>Produtos</h3>
                <p>Gerenciar produtos do estoque</p>
            </a>

            <!-- Gráficos -->
            <a href="grafico.php" class="menu-item">
                <div class="menu-item-icon">📈</div>
                <h3>Gráficos</h3>
                <p>Visualizar gráficos de vendas</p>
            </a>

            <!-- Relatórios -->
            <a href="relatorio.php" class="menu-item">
                <div class="menu-item-icon">📋</div>
                <h3>Relatórios</h3>
                <p>Gerar relatórios do sistema</p>
            </a>
        </div>
    </div>


</body>
</html>