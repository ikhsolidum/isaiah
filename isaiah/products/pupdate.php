<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $gender = $_POST['gender'];

    $pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
    $sql = "UPDATE products SET name=:name, description=:description, price=:price, brand=:brand, gender=:gender, type=:type WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':brand', $brand);

    if ($stmt->execute()) {
        header('Location: http://localhost/isaiah/loginlogout/index.php?page=products');
    } else {
        echo "Error updating product";
    }
}

?>
