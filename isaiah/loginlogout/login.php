<?php
include 'classes/class.user.php';
include 'config/config.php';


$user = new User();
//if($user->get_session()){
//	header("location: index.php");
//}
if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	$login = $user->check_login($useremail,$password);
	if($login){
		header("location: index.php");
	}else{
		?>
        <div id='error_notif'>Wrong email or password.</div>
        <?php
	}
	
}
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
<link rel="stylesheet" href="css/style.css?<?php echo time();?>">
<style>
	body {
		background-image: url('loginbackground.png');
	}
	h1 {
		color: white;
	}
	h2 {
		color: white;
	}
	</style>
</head>

<body>
	
<div id="brand-block">
    <h1>Weekend Closet</h1>
</div>
<div id="login-block">
	<h2>Please login</h2>
	<form method="POST" action="" name="login">
	<div>
		<input type="email" class="input" required name="useremail" placeholder="Valid E-mail"/>
	</div>
	<div>
		<input type="password" class="input" required name="password" placeholder="Password"/>
	</div>
	<div>
		<br>
		<input type="submit" name="submit" value="Submit"/>
	</div>
	
	</form>
</div>

</body>
</html>
