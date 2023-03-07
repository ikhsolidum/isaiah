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
        $quantity = $_POST['quantity'];

        
        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, quantity) VALUES (:name, :email, :productid, :quantity)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':productid', $productid);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();

        
        header('Location: orders.php');
        exit;
    }
} catch(PDOException $e) {
    
    echo "Connection failed: " . $e->getMessage();
    exit;
}


$pdo = null;
?>