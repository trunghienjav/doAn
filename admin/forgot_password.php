<?php session_start();
if(isset($_SESSION['error'])){ ?>
	<span style="color:red">
		<?php echo($_SESSION['error']);
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
	<form action="process_forgot_pass.php" method="post">
		<h2>Khôi phục mật khẩu</h2>
		Email
		<input type="email" name="email">
		<br>
		<button>
			Gửi mail đổi mật khẩu
		</button>
	</form>
</body>
</html>