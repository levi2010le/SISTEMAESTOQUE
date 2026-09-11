<?php
session_start();
include("inc/conexao.php");
if (!isset($_SESSION['email'])) {
   header("Location: index.php");
   exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatório de Compras e Vendas</title>
<style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f4f4f4;
           margin: 0;
           padding: 30px;
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

       .container {
           max-width: 1100px;
           margin: auto;
           background-color: white;
           padding: 30px;
           border-radius: 10px;
           box-shadow: 0 0 10px #ccc;
       }
       h1 {
           text-align: center;
           margin-bottom: 30px;
       }
       h2 {
           margin-top: 30px;
       }
       table {
           width: 100%;
           border-collapse: collapse;
           margin-top: 15px;
       }
       th,
       td {
           border: 1px solid #ddd;
           padding: 12px;
           text-align: center;
       }
       th {
           background-color: #222;
           color: white;
       }
       tr:nth-child(even) {
           background-color: #f2f2f2;
       }
</style>
</head>
<body>
<div class="container">
<h1>📋 Relatório de Compras e Vendas</h1>
<!-- RELATÓRIO DE COMPRAS -->
<h2>🛒 Compras</h2>
<table>
<tr>
<th>Produto</th>
<th>Quantidade Comprada</th>
<th>Valor da Compra</th>
</tr>
<?php
           $sql_compras = "
               SELECT
                   p.nm_produto,
                   c.qt_compra,
                   c.vl_compra
               FROM tb_compras c
               INNER JOIN tb_produtos p
                   ON c.cd_produto = p.cd_produto
               ORDER BY p.nm_produto
           ";
           $resultado_compras = mysqli_query($conexao, $sql_compras);
           while ($compra = mysqli_fetch_assoc($resultado_compras)) {
               echo "<tr>";
               echo "<td>" . $compra['nm_produto'] . "</td>";
               echo "<td>" . $compra['qt_compra'] . "</td>";
               echo "<td>R$ " . number_format(
                   $compra['vl_compra'],
                   2,
                   ',',
                   '.'
               ) . "</td>";
               echo "</tr>";
           }
           ?>
</table>

<!-- RELATÓRIO DE VENDAS -->
<h2>💰 Vendas</h2>
<table>
<tr>
<th>Produto</th>
<th>Quantidade Vendida</th>
<th>Valor da Venda</th>
</tr>
<?php
           $sql_vendas = "
               SELECT
                   p.nm_produto,
                   v.qt_venda,
                   v.vl_venda
               FROM tb_vendas v
               INNER JOIN tb_produtos p
                   ON v.cd_produto = p.cd_produto
               ORDER BY p.nm_produto
           ";
           $resultado_vendas = mysqli_query($conexao, $sql_vendas);
           while ($venda = mysqli_fetch_assoc($resultado_vendas)) {
               echo "<tr>";
               echo "<td>" . $venda['nm_produto'] . "</td>";
               echo "<td>" . $venda['qt_venda'] . "</td>";
               echo "<td>R$ " . number_format(
                   $venda['vl_venda'],
                   2,
                   ',',
                   '.'
               ) . "</td>";
               echo "</tr>";
           }
           ?>
</table>
<br>
<a href="grafico.php">
           📊 Ver gráfico de Compras x Vendas
</a>
</div>
</body>
</html>