<?php
// Establish a database connection using PDO
$pdo = new PDO("mysql:host=localhost;dbname=orderlists", "root", "");

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the values from the form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $productid = $_POST['productid'];
  $quantity = $_POST['quantity'];
  $productname = $_POST['productname'];
  $price = $_POST['price'];

  // Insert the values into the orders table
  $sql = "INSERT INTO orders (name, email, productid, quantity, productname, price) VALUES (:name, :email, :productid, :quantity, :productname, :price)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':productid' => $productid,
    ':quantity' => $quantity,
    ':productname' => $productname,
    ':price' => $price
  ]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
</head>
<body>
  <h1>Order Confirmation</h1>

  <p>Thank you for your order!</p>

  <?php
  // Get the last inserted order
  $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1";
  $stmt = $pdo->query($sql);
  $order = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>

  <p>Order Details:</p>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Product ID</th>
      <th>Quantity</th>
      <th>Product Name</th>
      <th>Price</th>
    </tr>
    <tr>
      <td><?= $order['name'] ?></td>
      <td><?= $order['email'] ?></td>
      <td><?= $order['productid'] ?></td>
      <td><?= $order['quantity'] ?></td>
      <td><?= $order['productname'] ?></td>
      <td><?= $order['price'] ?></td>
    </tr>
  </table>

</body>
</html>
