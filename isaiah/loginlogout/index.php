<?php
include_once 'classes/class.user.php';
include 'config/config.php';
include 'navigation/navigationbar.php';


$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$user = new User();
if(!$user->get_session()){
	header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weekend Closet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
<style>
    span {
        color: white;
    }
    </style>
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="index.php?page=home" class="active">Home</a>
  <a href="index.php?page=products">Products</a>
  <a href="index.php?page=order">Order</a>
  <!---<a href="index.php?page=user">User</a>-->
  <span>Logged in as <?php echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?></span>
  <a href="Logout.php">Logout</a>
</div>
  
 <br>
<div id="header"style="padding-left:830px">
      <h1>Weekend Closet</h1>
    </div>

  <div id="content">
  <?php
      switch($page){
                case 'home':
                    require_once 'index.php';
                break; 
                case 'products':
                    require_once 'products/index.php';
                break; 
                case 'order':
                    require_once 'order/index.php';
                break; 
                case 'user':
                    require_once 'user/index.php';
                break;
                
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>
</div>

</body>
</html>