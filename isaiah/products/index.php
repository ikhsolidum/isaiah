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
      text-shadow: 0 0 10px black;
    }
    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0px 0px 10px #aaa;
      z-index: 9999;
      display: none;
    }
    .popup label {
      display: block;
      margin-bottom: 10px;
    }
    .popup input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .popup button {
      background-color: #4CAF50;
      color: white;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .popup button:hover {
      background-color: #3e8e41;
    }
    span {
      color: black;
    }
  </style>
</head>
<body>
  <div id="header" style="padding-left: 650px">
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
              <button onclick="showOrderPopup(
                '<?= $row['id'] ?>',
                '<?= $row['brand'] ?>',
                '<?= $row['name'] ?>',
                '<?= $row['type'] ?>',
                '<?= $row['gender'] ?>',
                '<?= $row['description'] ?>',
                '<?= $row['price'] ?>')">Order</button>

              <button onclick="window.location.href='products/padd.php'">Add</button>
              <button onclick="window.location.href='products/pedit.php?id=<?= $row['id'] ?>&brand=<?= $row['brand'] ?>&name=<?= $row['name'] ?>&type=<?= $row['type'] ?>&gender=<?= $row['gender'] ?>&description=<?= $row['description'] ?>&price=<?= $row['price'] ?>'">Edit</button>
              <button onclick="if(confirm('Are you sure you want to delete this product?')) { window.location.href='products/pdelete.php?id=<?= $row['id'] ?>'; }">Delete</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8">No products found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  
  <div class="popup" id="order-popup" style="display: none;">
    <h2>Order Product</h2>
    <p>ID: <span id="order-product-id"></span></p>
    <p>Brand: <span id="order-product-brand"></span></p>
    <p>Name: <span id="order-product-name"></span></p>
    <p>Type: <span id="order-product-type"></span></p>
    <p>Gender: <span id="order-product-gender"></span></p>
    <p>Description: <span id="order-product-description"></span></p>
    <p>Price: <span id="order-product-price"></span></p>
    <label for="order-product-quantity">Quantity:</label>
    <input type="number" id="order-product-quantity" name="order-product-quantity" value="1" min="1">
    <br>
    <button onclick="createOrder()">Create Order</button>
    <button onclick="hideOrderPopup()">Cancel</button>
  </div>
  <script>
   
   function showOrderPopup(id, brand, name, type, gender, description, price) {
  document.getElementById("order-product-id").innerHTML = id;
  document.getElementById("order-product-brand").innerHTML = brand;
  document.getElementById("order-product-name").innerHTML = name;
  document.getElementById("order-product-type").innerHTML = type;
  document.getElementById("order-product-gender").innerHTML = gender;
  document.getElementById("order-product-description").innerHTML = description;
  document.getElementById("order-product-price").innerHTML = price;


  let quantityInput = document.getElementById("order-product-quantity");
  quantityInput.addEventListener("input", function() {
    let quantity = quantityInput.value;
    let newPrice = quantity * price;
    document.getElementById("order-product-price").innerHTML = newPrice;
  });

  document.getElementById("order-popup").style.display = "block";
}

function hideOrderPopup() {
  document.getElementById("order-popup").style.display = "none";
}

function createOrder() {
  let productId = document.getElementById("order-product-id").innerHTML;
  let quantity = document.getElementById("order-product-quantity").value;

}


  
  </script>
</body>
</html>