<?php
// Establish a database connection using PDO
$pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
// Get the search query from the GET parameters
$query = $_GET['q'] ?? '';
// Select products that match the search query and order them by price ascending
$sql = "SELECT * FROM products WHERE name LIKE ? OR brand LIKE ? OR description LIKE ? ORDER BY price ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$query%", "%$query%", "%$query%"]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Send the search results as JSON
header('Content-Type: application/json');
echo json_encode($products);
