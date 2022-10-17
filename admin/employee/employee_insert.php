<?php session_start();
require '../check_super_admin_login.php';

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
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
</head>
<body>
	<div id="general">
		<div id="top">
			<?php
			require '../menu.php';
			require '../connect.php';
			?>
			</a>
		</div>
		<div id="middle">
			<h2>
				Thêm nhân viên
			</h2>
			<br>
			<form method="post" action="process_emp_insert.php">
				Tên
				<input type="name" name="name">
				<br>
				Email
				<input type="email" name="email">
				<br>
				Mật khẩu
				<input type="password" name="password">
				<br>
				Quyền
				<select name="level">
					<option value="0">
						Nhân viên
					</option>
					<option value="1">
						Quản lý
					</option>
				</select>
				<br>
				<button>Đăng kí</button>
			</form>
		</div>
		<?php require '../footer.php'; ?>
	</d