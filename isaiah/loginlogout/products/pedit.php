<?php
    include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <div style="padding-left:670px">
        <h1>Edit Product</h1>
    </div>

    
<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id=?";
        if (isset($conn)) { // check if $conn is set
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $brand =  $_POST['brand'];
            $type = $_POST['type'];
            $gender = $_POST['gender'];
            $sql = "UPDATE products SET name=?, description=?, price=?, brand=?, type=?, gender=? WHERE id=?";
            if (isset($conn)) { // check if $conn is set
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $description, $price, $brand, $type, $gender, $id]);
                header('Location: main.php');
                exit;
            }
        }
    }
    ?>

    <?php if (isset($row)): ?>
        <div style="padding-left:500px">
            <form method="POST">
                <table bgcolor="white" border="2">
                    <tr>
                        <th>Name:</th>
                        <th>Description:</th>
                        <th>Price:</th>
                        <th>Brand:</th>
                        <th>Type:</th>
                        <th>Gender:</th>
                    </tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>">
                    </td>
                    <td>
                        <textarea name="description"><?php echo $row['description']; ?></textarea>
                    </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>">
                    </td>
                    <td>
                        <input type="text" name="brand" value="<?php echo $row['brand']; ?>">
                    </td>
                    <td>
                        <input type="text" name="type" value="<?php echo $row['type']; ?>">
                    </td>
                    <td>
                        <input type="text" name="gender" value="<?php echo $row['gender']; ?>">
                    </td>
                </table>
                <br>
                <input type="submit" value="Save">
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
