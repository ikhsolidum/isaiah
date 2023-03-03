<?php
include 'config.php';

$pdo = new PDO("mysql:host=localhost;dbname=orderlists", "root", "");
$sql = "SELECT * FROM orders ORDER BY id ASC";
$result = $pdo->query($sql);
$total_price = 0;
?>
<?php
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
?>
<html>
  <head>
    <title>Order Lists</title>
    <style>
      table {
        color: black;
      }
    </style>
  </head>
  <body>
    <div style="padding-left:855px">
      <h1>Order Lists</h1>
    </div>
    <div style="padding-left: 700px">
  <table bgcolor="white" border="2">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Product ID</th>
      <th>Quantity</th>
      <th>Price</th>

    </tr>
    <?php
    if ($result->rowCount() > 0) {
        foreach ($result as $row) {
          $total_price += $row['price'];
    ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['productid']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo number_format($row['price'], 2); ?></td>

          </tr>
    <?php
        }
    } else {
    ?>
      <tr>
        <td colspan="5">No records found</td>
      </tr>
    <?php
    }
    ?>
    
    <tr>
      <td colspan="5" align="right"><b>Total:</b></td>
      <td><?php echo number_format($total_price, 2); ?></td>
    </tr>
  </table>
  <br>
  </body>
</html>