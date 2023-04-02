<?php
include 'config.php';

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
  header('Location: http://localhost/isaiah/index.php?page=products');
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<style>
		body {
			background-image: url('../images/homebackground.png');
			background-size: cover;
		}

		form {
			margin: 0 auto;
			padding: 20px;
			width: 500px;
			background-color: white;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
		}

		h1 {
			text-align: center;
			color: white;
			font-size: 36px;
			margin-bottom: 20px;
		}

		label {
			display: block;
			margin-bottom: 5px;
			color: #333;
			font-size: 18px;
			font-weight: bold;
		}

		input[type="text"], textarea, input[type="number"] {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border-radius: 5px;
			border: none;
			background-color: #f2f2f2;
			margin-bottom: 20px;
			box-sizing: border-box;
		}

		textarea {
			height: 150px;
		}

		input[type="submit"] {
			background-color: #333;
			color: white;
			padding: 10px 20px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #555;
		}
	</style>
</head>
<body>
	<h1>Add Product</h1>
	<form method="POST" enctype="multipart/form-data">
		<label>Name:</label>
		<input type="text" name="name">

		<label>Brand:</label>
		<input type="text" name="brand">

		<label>Description:</label>
		<textarea name="description"></textarea>

		<label>Type:</label>
		<input type="text" name="type">

		<label>Gender:</label>
		<input type="text" name="gender">

		<label>Price:</label>
		<input type="number" name="price">
        <label>Image:</label>
	<input type="file" name="image">

	<input type="submit" value="Add Product">
</form>
</body>
</html>
