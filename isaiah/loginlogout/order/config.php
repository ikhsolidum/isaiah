<?php
// Database configuration
$host = 'localhost';
$dbname = 'orderlists';
$user = 'root';
$password = '';

// Establish a database connection using PDO
$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $user, $password);
?>