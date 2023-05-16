<?php
// Establish a database connection using PDO
$pdo = new PDO("mysql:host=localhost;dbname=productlists", "root", "");

// Check if a search term is provided
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build the SQL query
$sql = "SELECT * FROM products";
if (!empty($search)) {
  $sql .= " WHERE brand LIKE :search OR name LIKE :search OR type LIKE :search";
}
$sql .= " ORDER BY price ASC";

// Prepare and execute the SQL query
$stmt = $pdo->prepare($sql);
if (!empty($search)) {
  $stmt->bindValue(':search', "$search%", PDO::PARAM_STR);
}
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to update a product's details
function updateProduct($id, $brand, $name, $type, $gender, $description, $price, $pdo) {
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

  updateProduct($id, $brand, $name, $type, $gender, $description, $price, $pdo);
}
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
  <form method="post">
    <input type="text" id="search-input" name="search" placeholder="Search..." oninput="updateTable()">
    
  </form>
</div>
<table id="product-table"> <!-- Added id attribute to the table for easier manipulation -->
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
    <?php if (count($result) > 0): ?>

        <?php foreach ($result as $row): ?>
          <tr data-id="<?= $row['id'] ?>">
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

<button onclick="redirectToAddPage()">Add</button>


<button id="edit-button-<?= $row['id'] ?>" onclick="redirectToEditPage(
  '<?= $row['id'] ?>',
  '<?= $row['brand'] ?>',
  '<?= $row['name'] ?>',
  '<?= $row['type'] ?>',
  '<?= $row['gender'] ?>',
  '<?= $row['description'] ?>',
  '<?= $row['price'] ?>')">Edit</button>

  
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

    <div class="popup" id="edit-popup" style="display: none;">
  <h2>Edit Product</h2>
  <p>ID: <span id="edit-product-id"></span></p>
  <label for="edit-product-brand">Brand:</label>
  <input type="text" id="edit-product-brand" name="edit-product-brand">
  <label for="edit-product-name">Name:</label>
  <input type="text" id="edit-product-name" name="edit-product-name">
  <label for="edit-product-type">Type:</label>
  <input type="text" id="edit-product-type" name="edit-product-type">
  <label for="edit-product-gender">Gender:</label>
  <input type="text" id="edit-product-gender" name="edit-product-gender">
  <label for="edit-product-description">Description:</label>
  <textarea id="edit-product-description" name="edit-product-description"></textarea>
  <label for="edit-product-price">Price:</label>
  <input type="number" id="edit-product-price" name="edit-product-price">
  <br>
  <button id="save-button" onclick="saveEditedProduct()">Save</button>
  <button onclick="cancelEdit()">Cancel</button>
</div>
  
  
  <script>
    function updateTable() {
      var search = document.getElementById("search-input").value.toLowerCase();
      var table = document.getElementById("product-table");
      var rows =
      table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

      for (var i = 0; i < rows.length; i++) {
        var brand = rows[i].getElementsByTagName("td")[1].innerText.toLowerCase();
        var name = rows[i].getElementsByTagName("td")[2].innerText.toLowerCase();
        var type = rows[i].getElementsByTagName("td")[3].innerText.toLowerCase();

        if (brand.includes(search) || name.includes(search) || type.includes(search)) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
      }
    }

    function showOrderPopup(id, brand, name, type, gender, description, price) {
  document.getElementById("order-product-id").innerHTML = id;
  document.getElementById("order-product-brand").innerHTML = brand;
  document.getElementById("order-product-name").innerHTML = name;
  document.getElementById("order-product-type").innerHTML = type;
  document.getElementById("order-product-gender").innerHTML = gender;
  document.getElementById("order-product-description").innerHTML = description;
  document.getElementById("order-product-price").innerHTML = price;

  let quantityInput = document.getElementById("order-product-quantity");
  quantityInput.value = 1; // Reset quantity to 1 when showing the popup

  let updatePrice = function() {
    let quantity = quantityInput.value;
    let newPrice = quantity * price;
    document.getElementById("order-product-price").innerHTML = newPrice;
  };

  quantityInput.addEventListener("input", updatePrice);

  document.getElementById("order-popup").style.display = "block";

  // Update the price immediately when showing the popup
  updatePrice();
}

function hideOrderPopup() {
  document.getElementById("order-popup").style.display = "none";
}

function createOrder() {
  let productId = document.getElementById("order-product-id").innerHTML;
  let quantity = document.getElementById("order-product-quantity").value;

}
function redirectToAddPage() {
  window.location.href = 'products/padd.php';
}

function redirectToEditPage(id, brand, name, type, gender, description, price) {
  document.getElementById("edit-product-id").innerHTML = id;
  document.getElementById("edit-product-brand").value = brand;
  document.getElementById("edit-product-name").value = name;
  document.getElementById("edit-product-type").value = type;
  document.getElementById("edit-product-gender").value = gender;
  document.getElementById("edit-product-description").value = description;
  document.getElementById("edit-product-price").value = price;

  // Show the edit popup
  document.getElementById("edit-popup").style.display = "block";
  
  // Add an event listener to the Save button
  document.getElementById("save-button").addEventListener("click", saveEditedProduct);
}

function cancelEdit() {
  // Hide the edit popup without saving changes
  document.getElementById("edit-popup").style.display = "none";

  // Remove the event listener from the Save button
  document.getElementById("save-button").removeEventListener("click", saveEditedProduct);
}


// ...

function saveEditedProduct() {
  let id = document.getElementById("edit-product-id").innerHTML;
  let brand = document.getElementById("edit-product-brand").value;
  let name = document.getElementById("edit-product-name").value;
  let type = document.getElementById("edit-product-type").value;
  let gender = document.getElementById("edit-product-gender").value;
  let description = document.getElementById("edit-product-description").value;
  let price = document.getElementById("edit-product-price").value;

  // Send the updated data to the server using AJAX or form submission
  let formData = new FormData();
  formData.append('id', id);
  formData.append('brand', brand);
  formData.append('name', name);
  formData.append('type', type);
  formData.append('gender', gender);
  formData.append('description', description);
  formData.append('price', price);

  fetch('pedit.php', {
  method: 'POST',
  body: formData
})
  .then(response => response.text())
  .then(data => {
    if (data === 'success') {
      // Update the table row with the edited data
      let row = document.querySelector(`#product-table tr[data-id="${id}"]`);
      if (row) {
        row.querySelector('td:nth-child(2)').textContent = brand;
        row.querySelector('td:nth-child(3)').textContent = name;
        row.querySelector('td:nth-child(4)').textContent = type;
        row.querySelector('td:nth-child(5)').textContent = gender;
        row.querySelector('td:nth-child(6)').textContent = description;
        row.querySelector('td:nth-child(7)').textContent = price;
      }

      // Hide the edit popup
      document.getElementById('edit-popup').style.display = 'none';
    } else {
      alert('Failed to update the product. Please try again.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred while updating the product.');
  });
}

  </script>
</body>
</html>
