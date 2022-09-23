<?php 
session_start();
if(isset($_SESSION['level'])){
	header('location:root/index.php');
}
if(isset($_SESSION['error'])){ ?>
	<span style="color:red">
		<?php 
		echo ($_SESSION['error']);
		unset($_SESSION['error']);
		?>
	</span>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h2>Đăng nhập Admin</h2>
	<form method="post"	action="process_login_ad.php">
		Email
		<input type="email" name="email">
		<br>
		Mật khẩu
		<input type="password" name="password">
		<br>
		<button>Đăng nhập</button>
		<a href="forgot_password.php"> Quên mật khẩu</a>
	</form>
</body>
</html>