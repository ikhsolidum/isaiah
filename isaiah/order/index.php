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
        $quantity = $_POST['quantity'];
        $prices = $_POST['price'];

        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, quantity, price) VALUES (:name, :email, :productid, :quantity, :price)");

        for ($i = 0; $i < count($name); $i++) {
   
    $price = floatval(str_replace(',', '.', $prices[$i]));
    $stmt->bindParam(':name', $name[$i]);
    $stmt->bindParam(':email', $email[$i]);
    $stmt->bindParam(':productid', $productid[$i]);
    $stmt->bindParam(':quantity', $quantity[$i]);
    $stmt->bindParam(':price', $price);
    $stmt->execute();
}


        echo "<script>alert('Order/s created successfully');</script>";
        exit;
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>

<html>
    <head>
      <title>Order</title>
      <style>
          table {
            color: black;
          }
      </style>
    </head>
    <body>
        <div style="padding-left:700px">
            <h1>Input Orders</h1>
        </div>

        <div style="padding-left:375px">
            <form method="POST" action="index.php?page=order">
                <table bgcolor="white" border="2">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name[]" value="" ></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                        <td><input type="text" name="price[]" value="" ></td>
                    </tr>
                </table><br>
                <input type="submit" value="Submit Order">
            </form>
        </div>
    </body>
</html>
