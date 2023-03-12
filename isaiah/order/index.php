<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orderlists";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['productid']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $productid = $_POST['productid'];
        $productname = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $prices = $_POST['price'];

        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, productname, quantity, price) 
        VALUES (:name, :email, :productid, :productname, :quantity, :price)");
        

        for ($i = 0; $i < count($name); $i++) {
   
    $price = floatval(str_replace(',', '.', $prices[$i]));
    $stmt->bindParam(':name', $name[$i]);
    $stmt->bindParam(':email', $email[$i]);
    $stmt->bindParam(':productid', $productid[$i]);
    $stmt->bindParam(':productname', $productname[$i]);
    $stmt->bindParam(':quantity', $quantity[$i]);
    $stmt->bindParam(':price', $price);
    $stmt->execute();
}
        echo "<script>alert('Order/s created successfully');</script>";
        header("Location: http://localhost/isaiah/index.php?page=orderlists");
        exit;
    }
    
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Order</title>
    <style>
      body {
  font-family: 'Helvetica Neue', sans-serif;
  background-color: #f6f6f6;
}

h1 {
  text-align: center;
  margin-top: 50px;
}

form {
  max-width: 600px;
  margin: 0 auto;
  margin-top: 50px;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
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
   width: calc(100% - 20px);
}

td div {
  text-align: center;
}

input[type='text'],
input[type='number'] {
  width: calc(100% - 20px);
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  margin-bottom: 10px;
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
  <div id="header" style="text-align: center; padding-left: 25px;">
  <h1>Input Order/s</h1>
</div>


    <form method="POST" action="index.php?page=order">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="name[]" value=""></td>
            <td><input type="text" name="email[]" value=""></td>
            <td><input type="text" name="productid[]" value=""></td>
            <td><input type="text" name="productname[]" value=""></td>
            <td><input type="number" name="quantity[]" value=""></td>
            <td><input type="text" name="price[]" value=""></td>
          </tr>
        </tbody>
      </table>
      <input type="submit" value="Submit Order">
    </form>
  </body>
</html>
