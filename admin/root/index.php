<?php session_start();
if(isset($_SESSION['error'])){ ?>
	<span style="color:red">
		<?php 
		echo ($_SESSION['error']);
		unset($_SESSION['error']);
		?>
	</span>
<?php }
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h2>Đây là giao diện Admin</h2>
	<?php
	include '../menu.php';
	?>
</body>
</html>