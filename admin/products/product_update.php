
<?php session_start();
require '../check_admin_login.php';

$id = $_GET['id'];
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
			<?php
			require '../menu.php';
			require '../connect.php';
			$sql = "select * from products
			where id = '$id'";
			$result = mysqli_query($connect,$sql);
			$each = mysqli_fetch_array($result);

			$sql = "select * from manufactures";
			$result2 = mysqli_query($connect,$sql);

			?>
		</div>
		<div id="middle">
			<h2>Sửa sản phẩm</h2>
			<form method="post" action="process_update.php" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
				Tên
				<input type="text" name="name" value="<?php echo $each['name'] ?>">
				<br>
				Đổi ảnh mới
				<input type="file" name="photo_new" >
				<br>
				Hoặc giữ ảnh cũ
				<br>
				<img height="170" src="photos/<?php echo $each['photo'] ?>">
				<input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
				<br>
				Giá
				<input type="number" name="price" value="<?php echo $each['price'] ?>">
				<br>
				Mô tả
				<textarea name="description"><?php echo $each['description'] ?></textarea>
				<br>
				Nhà sản xuất
				<select name="manufacture_id">
					<?php foreach ($result2 as $each2): ?>
						<option value="<?php echo $each2['id'] ?>"
							<?php if($each['manufacture_id'] == $each2['id']){ ?>
								selected
							<?php } ?>
							>
							<!-- từ id nó sẽ in ra cái name -->
							<?php echo $each2['name'] ?>
						</option>
					<?php endforeach ?>
				</select>
				<br>
				<button>Sửa</button>
			</form>
		</div>
		<?php require '../footer.php'; ?>
	</div>
</body>
</html>