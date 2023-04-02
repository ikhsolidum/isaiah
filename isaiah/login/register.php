<?php
include 'config/config.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_wbapp";

if(isset($_POST['register_submit'])) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO tbl_users (user_lastname, user_firstname, user_email, user_password) VALUES (:user_lastname, :user_firstname, :user_email, :user_password)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_lastname', $_POST['user_lastname']);
        $stmt->bindParam(':user_firstname', $_POST['user_firstname']);
        $stmt->bindParam(':user_email', $_POST['user_email']);
        $stmt->bindParam(':user_password', $_POST['user_password']);

        $stmt->execute();
        header("Location: login.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('loginbackground.png');
        }
        h1 {
            color: black;
        }
        #error_notif {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h1>Register</h1>
            <form method="post">
                <label for="user_lastname">Last Name</label>
                <input type="text" name="user_lastname" required>
                <label for="user_firstname">First Name</label>
                <input type="text" name="user_firstname" required>
                <label for="user_email">Email</label>
                <input type="email" name="user_email" required>
                <label for="user_password">Password</label>
                <input type="password" name="user_password" required>
                <input type="submit" name="register_submit" value="Register">
                <p>Already have an account? <button onclick="location.href='login.php'">Login here</button></p>
            </form>
            
        </div>
    </div>
</body>
</html>
