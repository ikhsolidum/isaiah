<?php
include 'config.php';

$pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
$sql = "SELECT * FROM products ORDER BY price ASC";
$result = $pdo->query($sql);
?>

<?php
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
?>

<html>
  <head>
    <title>Products</title>
    <style>
      table {
        color: black;
      }
    </style>
  </head>
  <body>
    <div style="padding-left:700px">
      <h1>Product Lists</h1>
    </div>

    <div style="padding-left: 330px">
    <table bgcolor="white" border="2">
  <tr>
    <th>ID</th>
    <th>Brand</th>
    <th>Name</th>
    <th>Type</th>
    <th>Gender</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th>Action</th>
  </tr>
  <?php
  if ($result->rowCount() > 0) {
    foreach ($result as $row) {
  ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['brand']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><img src="<?php echo dirname($_SERVER['PHP_SELF']) . '/' . $row['image_url']; ?>" alt="Product image" height="100"></td>
        <td>
    <input type="button" value="Edit" onclick="window.location.href='products/pedit.php?id=<?php echo $row['id']; ?>&brand=<?php echo $row['brand']; ?>&name=<?php echo $row['name']; ?>&type=<?php echo $row['type']; ?>&gender=<?php echo $row['gender']; ?>&description=<?php echo $row['description']; ?>&price=<?php echo $row['price']; ?>'">
    <input type="button" value="Delete" onclick="if(confirm('Are you sure you want to delete this product?')) { window.location.href='products/pdelete.php?id=<?php echo $row['id']; ?>'; }">
    <input type="button" value="Upload Image" onclick="window.location.href='products/pupload.php?id=<?php echo $row['id']; ?>';">
</td>

      </tr>
  <?php
    }
  } else {
  ?>
    <tr>
      <td colspan="6">No records found</td>
    </tr>
  <?php
  }
  ?>
</table>
      <br>

<a href="products/padd.php">
  <button>Add Product</button>
</a>

      <br>
      <table id="editForm" style="display: none;">
  <form method="post" action="products/pupdate.php">
    <input type="hidden" name="id" id="id" value="">
    <tr>
      <td><label for="name">Brand:</label></td>
      <td><input type="text" name="brand" id="brand" required></td>
    </tr>
    <tr>
      <td><label for="name">Name:</label></td>
      <td><input type="text" name="name" id="name" required></td>
    </tr>
    <tr>
      <td><label for="name">Type:</label></td>
      <td><input type="text" name="type" id="type" required></td>
    </tr>
    <tr>
      <td><label for="name">Gender:</label></td>
      <td><input type="text" name="gender" id="gender" required></td>
    </tr>
    <tr>
      <td><label for="description">Description:</label></td>
      <td><input type="text" name="description" id="description" required></td>
    </tr>
    <tr>
      <td><label for="price">Price:</label></td>
      <td><input type="number" step="0.01" name="price" id="price" required></td>
    </tr>
    <tr>
  <td><label for="image">Image:</label></td>
  <td><input type="file" name="image" id="image" required></td>
</tr>

    <tr>
      <td></td>
      <td>
        <input type="submit" value="Update">
        <button onclick="closeForm()">Cancel</button>
      </td>
    </tr>
  </form>
</table>
<script>
  function editProduct(id, brand, name, type, gender, description, price) {
    document.getElementById('id').value = id;
    document.getElementById('brand').value = brand;
    document.getElementById('name').value = name;
    document.getElementById('type').value = type;
    document.getElementById('gender').value = gender;
    document.getElementById('description').value = description;
    document.getElementById('price').value = price;
    document.getElementById('editForm').style.display = 'table';
  }

  function closeForm() {
  document.getElementById('id').value = '';
  document.getElementById('brand').value = '';
  document.getElementById('name').value = '';
  document.getElementById('type').value = '';
  document.getElementById('gender').value = '';
  document.getElementById('description').value = '';
  document.getElementById('price').value = '';
  document.getElementById('editForm').style.display = 'none';
}

</script> 
 </body>
</html>
