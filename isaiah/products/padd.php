<?php
include 'config.php';
include '../index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['submit'] === 'Add') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $gender = $_POST['gender'];
        $type = $_POST['type'];

        $sql = "INSERT INTO products (name, description, price, type, gender, brand) VALUES (:name, :description, :price, :type, :gender, :brand)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':brand', $brand);

        if ($stmt->execute()) {
            header('Location: http://localhost/isaiah/index.php?page=products');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->errorInfo();
        }
    }
}

?>

<style>
body {
    background-image: url('../images/homebackground.png');
}

form {
    color: white;
}
</style>

<div style="padding-left:850px">
    <h1>Add Product</h1>
</div>

<div style="padding-left:850px">
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Brand:</label><br>
        <input type="text" name="brand"><br>
        <label>Description:</label><br>
        <textarea name="description"></textarea><br>
        <label>Type:</label><br>
        <input type="text" name="type"><br>
        <label>Gender:</label><br>
        <input type="text" name="gender"><br>
        <label>Price:</label><br>
        <input type="number" name="price"><br><br>
        <input type="submit" name="submit" value="Add">
        <input type="submit" name="submit" value="Cancel">
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['submit'] === 'Add') {
        if (empty($_POST['name']) || empty($_POST['brand']) || empty($_POST['description']) || empty($_POST['type']) || empty($_POST['gender']) || empty($_POST['price'])) {
            echo "Please fill out all fields";
        } else {
            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $description = $_POST['description'];
            $type = $_POST['type'];
            $gender = $_POST['gender'];
            $price = $_POST['price'];

            try {
                $pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("INSERT INTO products (name, brand, description, type, gender, price) VALUES (:name, :brand,:description, :type, :gender, :price)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':brand', $brand);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':price', $price);
    
                $stmt->execute();
    
                $pdo = null;

                header("Location: http://localhost/isaiah/index.php?page=products");
                exit();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else if ($_POST['submit'] === 'Cancel') {
        header('Location: http://localhost/isaiah/index.php?page=products');
        exit;
    }
}
?>






    