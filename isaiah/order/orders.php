<?php
require_once 'config.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orderlists";

try {
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $productid = $_POST['productid'];
        $productname = $_POST['productname'];
        $quantity = $_POST['quantity'];

        
        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, productname, quantity) VALUES (:name, :email, :productid, :productname, :quantity)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':productid', $productid);
        $stmt->bindParam(':productname', $productname);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
        header('Location: http://localhost/isaiah/index.php?page=orderlists');
        exit;
    }
} catch(PDOException $e) {
    
    echo "Connection failed: " . $e->getMessage();
    exit;
}


$pdo = null;
?>