<?php

$host = 'localhost';
$dbname = 'productlists';
$user = 'root';
$password = '';

$pdo = new PDO('mysql:host=localhost;dbname=productlists', 'root', '');


$dsn = "mysql:host=$host;dbname=$dbname";
$conn = new PDO($dsn, $user, $password);



$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
