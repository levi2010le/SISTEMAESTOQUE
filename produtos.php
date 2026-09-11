<?php
session_start();

if(!isset($_SESSION['usuario_logado'])) {
    header('Location: index.php');
    exit();
}

include('inc/conexao.php');

$sql = "SELECT * FROM tb_produtos";
$resultado = $conexao->query($sql);
$produtos = $resultado->fetch_all(MYSQLI_ASSOC);

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Sistema de Estoque</title>
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

        .btn {
            background-color: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #5568d3;
        }

        .btn-logout {
            background-color: #e74c3c;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .products-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-container {
            width: 100%;
            height: 150px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: bold;
        }

        .card p {
            font-size: 12px;
            margin: 4px 0;
            color: #666;
            flex-grow: 1;
        }

        .preco {
            font-size: 15px;
            font-weight: bold;
            color: #27ae60;
            margin: 10px 0;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .botoes a {
            flex: 1;
            padding: 8px;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-compra {
            background-color: #3498db;
            color: white;
        }

        .btn-compra:hover {
            background-color: #2980b9;
        }

        .btn-venda {
            background-color: #e74c3c;
            color: white;
        }

        .btn-venda:hover {
            background-color: #c0392b;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        @media (max-width: 1200px) {
            .products-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .products-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>📦 Sistema de Estoque</h1>
        <div class="user-info">
            <a href="home.php" class="btn">Home</a>
            <a href="encerrarsessao.php" class="btn btn-logout">Sair</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h2>Produtos</h2>

        <div class="products-container">
            <?php if(!empty($produtos)): ?>
                <?php foreach($produtos as $produto): ?>
                    <div class="card">
                        <div class="card-img-container">
                            <img src="img/produtos/<?php echo $produto['cd_produto']; ?>.jpg" alt="<?php echo $produto['nm_produto']; ?>" onerror="this.src='img/placeholder.png'">
                        </div>
                        <div class="card-content">
                            <h3><?php echo $produto['nm_produto']; ?></h3>
                            <p><?php echo $produto['ds_produto']; ?></p>
                            <p><strong>Estoque:</strong> <?php echo $produto['qt_estoque']; ?> un.</p>
                            <p class="preco">R$ <?php echo number_format($produto['vl_produto'], 2, ',', '.'); ?></p>
                            <div class="botoes">
                                <a href="compras.php?cd_produto=<?php echo $produto['cd_produto']; ?>" class="btn-compra">Compra</a>
                                <a href="vendas.php?cd_produto=<?php echo $produto['cd_produto']; ?>" class="btn-venda">Venda</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado!</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Sistema de Estoque</p>
    </div>

</body>
</html>