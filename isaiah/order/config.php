<?php

$host = 'localhost';
$dbname = 'orderlists';
$user = 'root';
$password = '';


$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $user, $password);
?>