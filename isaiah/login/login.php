<?php
include 'classes/class.user.php';
include 'config/config.php';

$user = new User();

if(isset($_REQUEST['login_submit'])){
	$login = $user->check_login($_REQUEST['useremail'],$_REQUEST['password']);
	if($login){
		header("location: ../index.php");
	}else{
		?>
        <div id='error_notif'>Wrong email or password.</div>
        <?php
	}
	
} else if (isset($_REQUEST['register_submit'])) {
	$result = $user->register($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);
	if ($result === true) {
		header("location: ../index.php");
	} else {
		?>
		<div id='error_notif'><?php echo $result; ?></div>
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
			color: black;
		}
		h2 {
			color: white;
		}
#error_notif {
color: red;
font-weight: bold;
text-align: center;
}
</style>

</head>
<body>
	<div class="container">
		<div class="login-box">
			<h1>Login</h1>
			<form method="post">
				<label for="useremail">Email</label>
				<input type="text" name="useremail" required>
				<label for="password">Password</label>
				<input type="password" name="password" required>
				<input type="submit" name="login_submit" value="Login">
				<p>Don't have an account? <button onclick="location.href='register.php'">Sign up here</button></p>
			</form>
			
		</div>
	</div>
</body>
</html>


