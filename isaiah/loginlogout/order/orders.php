<?php
require_once 'config.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orderlists";

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $productid = $_POST['productid'];
        $quantity = $_POST['quantity'];

        // Insert the form data into the database
        $stmt = $pdo->prepare("INSERT INTO orders (name, email, productid, quantity) VALUES (:name, :email, :productid, :quantity)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':productid', $productid);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();

        // Redirect the user to a different page
        header('Location: orders.php');
        exit;
    }
} catch(PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Close the database connection
$pdo = null;
?>