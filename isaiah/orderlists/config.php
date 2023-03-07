<?php
// Database configuration
$host = 'localhost';
$dbname = 'orderlists';
$user = 'root';
$password = '';

$pdo = new PDO('mysql:host=localhost;dbname=productlists', 'root', '');

// Establish a database connection using PDO
$dsn = "mysql:host=$host;dbname=$dbname";
$conn = new PDO($dsn, $user, $password);


// Set PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
