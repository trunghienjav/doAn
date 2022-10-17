	<?php session_start();
	require '../check_super_admin_login.php';

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
		<link rel="stylesheet" type="text/css" href="../css/demo.css">
	</head>
	<body>
		<div id="general">
			<div id="top">
				<h1>Khu vực nhà sản xuất</h1>
				<?php require '../menu.php' ?>
			</div>
			<a style="color: red;" href="manufacture_insert.php">
				Thêm nhà sản xuất
			</a>
			<div id="middle">
				<?php 
				$id = $_GET['id'];
				require '../connect.php';
				$sql = "select * from manufactures
				where id = '$id'";
				$result = mysqli_query($connect,$sql);
				$num_rows = mysqli_num_rows($result);
				if($num_rows === 1){
					$each = mysqli_fetch_array($result);
					?>
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
						Tên
						<input type="text" name="name" value="<?php echo $each['name'] ?>">
						<br>
						Địa chỉ
						<textarea name="address"><?php echo $each['address'] ?></textarea>
						<br>
						Điện thoại
						<input type="text" name="phone_number" value="<?php echo $each['phone_number'] ?>">
						<br>
						Đổi ảnh mới
						<input type="file" name="photo_new">
						<br>
						<br>
						Hoặc giữ ảnh cũ
						<img src="photos/<?php echo $each['photo'] ?>" height='150'>
						<input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
						<br>
						<button>Sửa</button>
					</form>
				<?php }else{ ?>
					<h1>
						Không tìm thấy theo mã này
					</h1>
				<?php } ?>
			</div>
			<?php require '../footer.php' ?>
		</div>
	</body>
	</html>