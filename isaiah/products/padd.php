<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $brand = $_POST['brand'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Get image data
  $image = $_FILES['image'];
  $image_name = $image['name'];
  $image_tmp = $image['tmp_name'];

  // Move image to uploads directory
  move_uploaded_file($image_tmp, '../uploads/'.$image_name);

  // Insert product into database
  $sql = "INSERT INTO products (brand, name, type, gender, description, price, image_url)
          VALUES (:brand, :name, :type, :gender, :description, :price, :image_url)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['brand' => $brand, 'name' => $name, 'type' => $type, 'gender' => $gender,
                  'description' => $description, 'price' => $price, 'image_url' => 'uploads/'.$image_name]);

  header('Location: ../index.php');
  exit();
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

<div style="padding-left:700px">
    <h1>Add Product</h1>
</div>

<div style="padding-left:710px">
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






    