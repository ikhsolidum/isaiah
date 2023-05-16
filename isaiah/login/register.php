<?php
    include 'config/config.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_wbapp";
    $password_regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/";
    $email_regex = "/^[a-zA-Z]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/";
    
    if(isset($_POST['register_submit'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $user_lastname = $_POST['user_lastname'];
            $user_firstname = $_POST['user_firstname'];
            $user_email = $_POST['user_email'];
            $user_password = md5($_POST['user_password']);
            $user_status = $_POST['user_status'];

// Password validation
if (!preg_match($password_regex, $_POST['user_password'])) {
    throw new Exception("Password should be at least 8 characters with a mix of uppercase and lowercase letters and numbers");
}

// Email validation
if (!preg_match($email_regex, $_POST['user_email'])) {
    throw new Exception("Email should only contain letters with no symbols and numbers");
}

$sql = "INSERT INTO tbl_users (user_lastname, user_firstname, user_email, user_password, user_status) VALUES (:user_lastname, :user_firstname, :user_email, :user_password, :user_status)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_lastname', $user_lastname);
$stmt->bindParam(':user_firstname', $user_firstname);
$stmt->bindParam(':user_email', $user_email);
$stmt->bindParam(':user_password', $user_password);
$stmt->bindParam(':user_status', $user_status);

$stmt->execute();

            header("Location: login.php");
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } catch(Exception $e) {
            $error_message = $e->getMessage();
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
            color: white;
            text-shadow: 0 0 10px black;
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
            <?php if (isset($error_message)): ?>
                <p id="error_notif"><?= $error_message ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="user_lastname">Last Name</label>
                <input type="text" name="user_lastname" required>
                <label for="user_firstname">First Name</label>
                <input type="text" name="user_firstname" required>
                <label for="user_email">Email</label>
                <input type="text" name="user_email" required>
<p>Email should only contain letters with no symbols and numbers.</p>
<label for="user_password">Password</label>
<input type="password" name="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
<p>Password should be at least 8 characters with a mix of uppercase and lowercase letters and numbers.</p>
<label for="user_status">Access</label>
<select name="user_status">
    <option value="Staff">Staff</option>
    <option value="Manager">Manager</option>
</select>
<input type="submit" name="register_submit" value="Register">
<p>Already have an account? <button onclick="location.href='login.php'">Login here</button></p>
</form>
</div>
</div>
</body>
</html>
