<?php
include 'index.php';
?>
<html>
    <title>Orders</title>
    <head>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$productid = $_POST['productid'];
$quantity = $_POST['quantity'];

// Insert the form data into the database
$sql = "INSERT INTO orders (name, email, productid, quantity) VALUES ('$name', '$email', '$productid', '$quantity')";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

include 'pdb.php';
// Close the database connection
mysqli_close($conn);
?>