
<?php session_start();
require '../check_admin_login.php';

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
			$sql = "select * from manufactures";
			$result = mysqli_query($connect,$sql);
	// $each = mysqli_fetch_array($result);//làm khác nhưng ko biết KQ giống ko, test sau
	// à đé đc, fetch array là nó chỉ in bản ghi đầu tiên thôi, hiểu rồi
			?>
		</div>
		<div id="middle">
			<h2>Thêm sản phẩm</h2>
		(nhớ validate chổ này, vd ko thêm vào thì bắt buộc thêm vào)
		<form method="post" action="process_insert.php" enctype="multipart/form-data">
			Tên
			<input type="text" name="name">
			<br>
			Ảnh
			<input type="file" name="photo">
			<br>
			Giá
			<input type="number" name="price">
			<br>
			Mô tả
			<textarea name="description"></textarea>
			<br>
			Nhà sản xuất
			<select name="manufacture_id">
				<?php foreach ($result as $each): ?>
					<option value="<?php echo $each['id'] ?>">
						<?php echo $each['name'] ?>
					</option>
				<?php endforeach ?>
			</select>
			<br>
			<button>Thêm</button>
		</form>
		</div>
		<?php require '../footer.php'; ?>
	</div>
</body>
</html>