
<?php session_start();
require '../check_super_admin_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
</head>
<div id="general">
	<div id="top">
		<h1>Khu vực nhà sản xuất</h1>
		<a class="link" href="manufacture_insert.php">
			Thêm nhà sản xuất
		</a>
		<?php require '../menu.php' ?>
	</div>
	<div id="middle">
		<body>
			<form method="post" action="process_insert.php" enctype="multipart/form-data">
				<h2>Thêm nhà sản xuất</h2>
				Tên
				<input type="text" name="name">
				<br>
				Địa chỉ
				<textarea name="address"></textarea>
				<br>
				Điện thoại
				<input type="text" name="phone_number">
				<br>
				Ảnh
				<input type="file" name="photo">
				<br>
				<button>Thêm</button>
			</form>
		</body>
	</div>
	<?php require '../footer.php' ?>
</div>
</html>