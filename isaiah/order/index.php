<?php
include_once 'orders.php';
?>
<html>
    <head>
      <title>Order</title>
   <style>
      table {
        color: black;
      }

    </style>

<div style="padding-left:650px">
<h1>Input Orders</h1>
</div>


<div style="padding-left:610px">
<table bgcolor="white" border="2">
  <form method="POST" action="orders.php">
    <tr>
      <td><label for="name">Name:</label></td>
      <td><input type="text" id="username" name="name" value=""></td>
    </tr>
    <tr>
      <td><label for="email">Email:</label></td>
      <td><input type="text" id="email" name="email" value=""></td>
    </tr>
    <tr>
      <td><label for="product">Product ID:</label></td>
      <td><input type="text" id="product" name="productid" value=""></td>
    </tr>
    <tr>
      <td><label for="quantity">Quantity:</label></td>
      <td><input type="text" id="quantity" name="quantity" value=""></td>
      
    </tr>
    <td colspan="2"><input type="submit" value="Submit"></td>
  </form>
  
</table>
<br>
<tr>
      
    </tr>
</div>
</br>
    </body>
    
</html>
