<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])){
    // define the upload directory and file name
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['image']['name']);
    $upload_file = $upload_dir . $file_name;
    
    // check if the file is an image and move it to the upload directory
    $imageFileType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    
    if(in_array($imageFileType, $allowed_extensions)){
        if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)){
            // image upload successful, save the file path to the database
            $pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
            $sql = "UPDATE products SET image_url = :image_url WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':image_url', $upload_file);
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
            header("Location: index.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>

<html>
  <head>
    <title>Upload Image</title>
  </head>
  <body>
    <h1>Upload Image</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <label for="image">Select image to upload:</label>
      <input type="file" name="image" id="image" required>
      <br>
      <input type="submit" value="Upload">
    </form>
  </body>
</html>
