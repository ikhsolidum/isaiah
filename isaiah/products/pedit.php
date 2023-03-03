<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    h1 {
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #ccc;
        font-weight: bold;
    }

    input[type=text], textarea, input[type=number] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div.container {
        padding-left: 20%;
        padding-right: 20%;
    }

    div.row {
        margin-bottom: 20px;
    }

    div.col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
    }

    div.col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
    }

    /* Clear floats after the columns */
    div.row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - makes the form stack on top of each other */
    @media screen and (max-width: 600px) {
        div.col-25, div.col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id=?";
            if (isset($conn)) { 
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
            if (isset($conn)) { 
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $description, $price, $brand, $type, $gender, $id]);
                header('Location: main.php');
                exit;
            }
        }
    }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $brand =  $_POST['brand'];
            $type = $_POST['type'];
            $gender = $_POST['gender'];
            $sql = "UPDATE products SET name=?, description=?, price=?, brand=?, type=?, gender=? WHERE id=?";
            if (isset($conn)) { 
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $description, $price, $brand, $type, $gender, $id]);
                header('Location: main.php');
                exit;
            }
        }
    
    ?>

<?php if (isset($row)): ?>
    <form method="POST">
        <div class="row">
            <div class="col-25">
                <label for="name">Name:</label>
            </div>
            <div class="col-75">
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="description">Description:</label>
            </div>
            <div class="col-75">
                <textarea id="description" name="description"><?php echo $row['description']; ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="price">Price:</label>
            </div>
            <div class="col-75">
                <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="brand">Brand:</label>
            </div>
            <div class="col-75">
                <input type="text" id="brand" name="brand" value="<?php echo $row['brand']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="type">Type:</label>
            </div>
            <div class="col-75">
                <input type="text" id="type" name="type" value="<?php echo $row['type']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="gender">Gender:</label>
            </div>
            <div class="col-75">
                <select id="gender" name="gender">
                    <option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
        </div>

        <div class="row">
            <input type="submit" value="Save">
            <input type="submit" value="Cancel" onclick="location.href='../index.php';">
        </div>
    </form>
<?php endif; ?>

