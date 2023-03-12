<?php
include 'config.php';

if (isset($_POST['remove'])) {
    $id = $_POST['remove'];
    $pdo = new PDO("mysql:host=localhost;dbname=orderlists", "root", "");
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: http://localhost/isaiah/index.php?page=orderlists");
exit;
?>
