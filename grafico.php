<?php
session_start();
include("inc/conexao.php");
if (!isset($_SESSION['email'])) {
   header("Location: index.php");
   exit;
}
/* CONSULTA DE COMPRAS */
$sql_compras = "
   SELECT
       p.nm_produto,
       SUM(c.qt_compra) AS total_compras
   FROM tb_produtos p
   LEFT JOIN tb_compras c
       ON p.cd_produto = c.cd_produto
   GROUP BY p.cd_produto, p.nm_produto
   ORDER BY p.nm_produto
";
$result_compras = mysqli_query($conexao, $sql_compras);
$produtos = [];
$compras = [];
while ($row = mysqli_fetch_assoc($result_compras)) {
   $produtos[] = $row['nm_produto'];
   $compras[] = (int) $row['total_compras'];
}
/* CONSULTA DE VENDAS */
$sql_vendas = "
   SELECT
       p.nm_produto,
       SUM(v.qt_venda) AS total_vendas
   FROM tb_produtos p
   LEFT JOIN tb_vendas v
       ON p.cd_produto = v.cd_produto
   GROUP BY p.cd_produto, p.nm_produto
   ORDER BY p.nm_produto
";
$result_vendas = mysqli_query($conexao, $sql_vendas);
$vendas = [];
while ($row = mysqli_fetch_assoc($result_vendas)) {
   $vendas[] = (int) $row['total_vendas'];
}

$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gráfico de Compras e Vendas</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      max-width: 1000px;
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

   .grafico {
      position: relative;
      height: 500px;
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
      <h1>📊 Compras x Vendas</h1>
      <div class="grafico">
         <canvas id="graficoComprasVendas"></canvas>
      </div>
   </div>

<script>
   const produtos = <?php echo json_encode($produtos); ?>;
   const compras = <?php echo json_encode($compras); ?>;
   const vendas = <?php echo json_encode($vendas); ?>;
   const ctx = document
       .getElementById('graficoComprasVendas')
       .getContext('2d');
   new Chart(ctx, {
       type: 'bar',
       data: {
           labels: produtos,
           datasets: [
               {
                   label: 'Compras',
                   data: compras
               },
               {
                   label: 'Vendas',
                   data: vendas
               }
           ]
       },
       options: {
           responsive: true,
           maintainAspectRatio: false,
           plugins: {
               legend: {
                   position: 'top'
               },
               title: {
                   display: true,
                   text: 'Quantidade de produtos comprados e vendidos'
               }
           },
           scales: {
               y: {
                   beginAtZero: true,
                   title: {
                       display: true,
                       text: 'Quantidade'
                   }
               },
               x: {
                   title: {
                       display: true,
                       text: 'Produtos'
                   }
               }
           }
       }
   });
</script>
</body>
</html>
