<!DOCTYPE html>
<html>
  <head>
    <title>Edit Product</title>
    <style>
      * {
        box-sizing: border-box;
      }
      body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color: #f6f6f6;
        background-image: url('../images/homebackground.png');
		background-size: cover;
      }
      h1 {
        text-align: center;
        color: white;
      }
      form {
        max-width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      }
      label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
        display: block;
      }
      input[type='text'],
      input[type='number'],
      textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 20px;
      }
      textarea {
        height: 100px;
        resize: vertical;
      }
      input[type='submit'] {
        background-color: #2ecc71;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }
      input[type='submit']:hover {
        background-color: #27ae60;
      }
      .row::after {
        content: '';
        clear: both;
        display: table;
      }
      .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
      }
      .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
      }
      @media (max-width: 600px) {
        .col-25,
        .col-75,
        input[type='submit'] {
          width: 100%;
          margin-top: 0;
        }
      }
    </style>
  </head>
  <body>
    <h1>Edit Product</h1>
    
    <?php
// Establish a database connection using PDO
$pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");

// Function to update a product's details
function updateProduct($id, $brand, $name, $type, $gender, $description, $price, $pdo) {
  try {
    $sql = "UPDATE products SET brand = :brand, name = :name, type = :type, gender = :gender, description = :description, price = :price WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true; // Update successful
    } else {
      return false; // Update failed
    }
  } catch (PDOException $e) {
    return false; // Update failed due to exception
  }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $brand = $_POST['brand'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  if (updateProduct($id, $brand, $name, $type, $gender, $description, $price, $pdo)) {
    echo 'success'; // Update successful
  } else {
    echo 'error'; // Update failed
  }
} else {
  echo 'error'; // Request method is not POST
}
?>







<form method="POST">
    <div class="row">
        <div class="col-25">
            <label for="name">Name:</label>
        </div>
        <div class="col-75">
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
    </div>
            <div class="row">
                <div class="col-25">
                    <label for="description">Description:</label>
                </div>
                <div class="col-75">
                    <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="price">Price:</label>
                </div>
                <div class="col-75">
                    <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="brand">Brand:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="brand" name="brand" value="<?php echo $row['brand']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="type">Type:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="type" name="type" value="<?php echo $row['type']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="gender">Gender:</label>
                </div>
                <div class="col-75">
                    <select id="gender" name="gender">
                        <option value="Men" <?php if ($row['gender'] == 'Men') echo 'selected'; ?>>Men</option>
                        <option value="Women" <?php if ($row['gender'] == 'Women') echo 'selected'; ?>>Women</option>
                        <option value="Unisex" <?php if ($row['gender'] == 'Unisex') echo 'selected'; ?>>Unisex</option>
                    </select>
                </div>
            </div>
        <br>
            <div class="row">
                <input type="submit" value="Save">
            </div>
        </form>
        <?php } }
             ?>
            
            </div>
            </body>
            </html>        