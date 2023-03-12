<?php
// Establish a database connection using PDO
$pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");
// Select all products and order them by price ascending
$sql = "SELECT * FROM products ORDER BY price ASC";
$result = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Lists</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      font-size: 14px;
    }
    table th, table td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
  background-color: white;
}

table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: brown;
}



.add-button {
  margin-top: 20px;
  text-align: center;
}

.add-button button {
  background-color: #4CAF50;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.add-button button:hover {
  background-color: #3e8e41;
}

h1 {
  margin: 20px;
}

</style>
</head>
<body>

<div id="header"style="padding-left:650px">
      <h1>Product Lists</h1>
    </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Name</th>
        <th>Type</th>
        <th>Gender</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->rowCount() > 0): ?>
        <?php foreach ($result as $row): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['brand'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['price'] ?></td>
            <td>
              <button onclick="window.location.href='products/pedit.php?id=<?= $row['id'] ?>&brand=<?= $row['brand'] ?>&name=<?= $row['name'] ?>&type=<?= $row['type'] ?>&gender=<?= $row['gender'] ?>&description=<?= $row['description'] ?>&price=<?= $row['price'] ?>'">Edit</button>
              <button onclick="if(confirm('Are you sure you want to delete this product?')) { window.location.href='products/pdelete.php?id=<?= $row['id'] ?>'; }">Delete</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8">No records found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <div class="add-button">
    <button onclick="window.location.href='products/padd.php'">Add Product</button>
  </div>
</body>
</html>