<?php
session_start();

if(!isset($_SESSION['usuario_logado'])) {
    header('Location: index.php');
    exit();
}

include('inc/conexao.php');

$cd_produto = $_GET['cd_produto'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qt_venda = $_POST['qt_venda'];
    $vl_venda = $_POST['vl_venda'];

    // Insert na tabela de vendas
    $sql_venda = "INSERT INTO tb_vendas (cd_produto, qt_venda, vl_venda) VALUES ('$cd_produto', '$qt_venda', '$vl_venda')";
    $conexao->query($sql_venda);

    // Atualiza estoque (diminui)
    $sql_estoque = "UPDATE tb_produtos SET qt_estoque = qt_estoque - $qt_venda WHERE cd_produto = $cd_produto";
    $conexao->query($sql_estoque);

    $conexao->close();
    header('Location: produtos.php');
    exit();
}

// Buscar dados do produto
$sql = "SELECT * FROM tb_produtos WHERE cd_produto = $cd_produto";
$resultado = $conexao->query($sql);
$produto = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda - <?php echo $produto['nm_produto']; ?></title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button, a {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
        }

        .btn-salvar {
            background-color: #e74c3c;
            color: white;
        }

        .btn-salvar:hover {
            background-color: #c0392b;
        }

        .btn-cancelar {
            background-color: #95a5a6;
            color: white;
        }

        .btn-cancelar:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Venda - <?php echo $produto['nm_produto']; ?></h1>

        <form method="POST">
            <div class="form-group">
                <label>Quantidade:</label>
                <input type="number" name="qt_venda" required min="1">
            </div>

            <div class="botoes">
                <button type="submit" class="btn-salvar">Vender</button>
                <a href="produtos.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>

    <?php $conexao->close(); ?>

</body>
</html>