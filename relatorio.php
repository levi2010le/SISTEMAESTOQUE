<?php
session_start();
include("inc/conexao.php");
if (!isset($_SESSION['email'])) {
   header("Location: index.php");
   exit;
}

$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatório de Compras e Vendas</title>
<style>
   * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
   }

   body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
      padding: 30px;
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

   .link-grafico {
      display: inline-block;
      margin-top: 20px;
      background-color: #667eea;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
   }

   .link-grafico:hover {
      background-color: #5568d3;
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

   <div class="container">
      <h1>📋 Relatório de Compras e Vendas</h1>
      
      <!-- RELATÓRIO DE COMPRAS -->
      <h2>🛒 Compras</h2>
      <table>
         <tr>
            <th>Produto</th>
            <th>Quantidade Comprada</th>
         </tr>
         <?php
            $sql_compras = "
                SELECT
                    p.nm_produto,
                    c.qt_compra
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
         </tr>
         <?php
            $sql_vendas = "
                SELECT
                    p.nm_produto,
                    v.qt_venda
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
                echo "</tr>";
            }
         ?>
      </table>
      
      <a href="grafico.php" class="link-grafico">📊 Ver gráfico de Compras x Vendas</a>
   </div>
</body>
</html>
