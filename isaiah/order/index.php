<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orderlists";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['productid']) && !empty($_POST['quantity'])) {
      
        $name = $_POST['name'];
        $email = $_POST['email'];
        $productid = $_POST['productid'];
        $quantity = $_POST['quantity'];

      
        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, quantity) VALUES (:name, :email, :productid, :quantity)");
        
        for ($i = 0; $i < count($name); $i++) {
            $stmt->bindParam(':name', $name[$i]);
            $stmt->bindParam(':email', $email[$i]);
            $stmt->bindParam(':productid', $productid[$i]);
            $stmt->bindParam(':quantity', $quantity[$i]);

            if (!$stmt->execute()) {
                echo "<script>alert('Error inserting record into the database');</script>";
            }
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
        <div style="padding-left:650px">
            <h1>Input Orders</h1>
        </div>

        <div style="padding-left:400px">
            <form method="POST" action="index.php?page=order">
                <table bgcolor="white" border="2">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name[]" value="" ></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="name[]" value=""></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="name[]" value=""></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                        </tr>
                        <tr>
                        <td><input type="text" name="name[]" value=""></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="name[]" value=""></td>
                        <td><input type="text" name="email[]" value="" ></td>
                        <td><input type="text" name="productid[]" value="" ></td>
                        <td><input type="text" name="quantity[]" value="" ></td>
                    </tr>
</table><br>
<input type="submit" value="Submit Order">
</form>
</div>
</body>

</html>