<?php
include 'config.php';

$pdo = new PDO("mysql:host=localhost;dbname=orderlists", "root", "");
$sql = "SELECT * FROM orders ORDER BY id ASC";
$result = $pdo->query($sql);
$total_price = 0;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Order Lists</title>
    <style>
      body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color: #f6f6f6;
      }

      h1 {
        text-align: center;
        margin-top: 50px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 50px;
      }

      th {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        padding: 10px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        text-align: center;
      }

      td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
        background-color: white;
      }

      td div {
        text-align: center;
      }

      input[type='submit'] {
        background-color: #2ecc71;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }

      input[type='submit']:hover {
        background-color: #27ae60;
      }
    </style>
  </head>
  <body>
    <h1>Order Lists</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->rowCount() > 0) {
          foreach ($result as $row) {
            if ($row['quantity'] > 1) {
              $total_price += ($row['price'] * $row['quantity']);
            } else {
              $total_price += $row['price'];
            }
            ?>
            <tr>
              <form method="POST" action="orderlists/remove_order.php">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['productid']; ?></td>
                <td><?php echo $row['productname']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo number_format($row['price'], 2); ?></td>
                <td><button type="submit" name="remove" value="<?php echo $row['id']; ?>">Remove</button></td>
              </form>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="7">No records found</td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <td colspan="6" align="right"><b>Total:</b></td>
          <td><?php echo number_format($total_price, 2); ?></td>
          </td>
</tr>
</tbody>
</table>

  </body>
</html> 

</tr>
  </table>
  <br>
  </body>
</html> 