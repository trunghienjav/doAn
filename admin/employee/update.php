<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div id="general">
		<div id="top">
			<?php
			require '../menu.php';
			require '../connect.php';
			$id = $_GET['id'];
			$sql = "select * from admin
			where id = '$id' ";
			$result = mysqli_query($connect,$sql);
			$each = mysqli_fetch_array($result);

			$sql = "select * from admin
			 ";
			$result2 = mysqli_query($connect,$sql);
			?>
		</div>
		<div id="middle">
			<h2>Sửa thông tin nhân viên</h2>
			<form method="post" action="process_update.php">
				<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
				Tên
				<input type="text" name="name" value="<?php echo $each['name'] ?>">
				<br>
				Email
				<input type="email" name="email" value="<?php echo $each['email'] ?>">
				<br>
				Mật khẩu :
				<a href="change_pass.php?id=<?php echo $each['id'] ?>">
					Đổi mật khẩu
				</a>
				<br>
				Quyền
				<select name="level">
					<?php foreach ($result2 as $each2): ?>
						<option value="<?php echo $each2['level'] ?>"
							<?php if($id == $each2['id']){ ?>
								selected
							<?php } ?>
						>
						<!-- từ id nó sẽ in ra cái level -->
							<?php 
							switch ($each2['level']) {
								case '0':
								echo "Nhân viên";
								break;
								case '1':
								echo "Quản lý";
								break;
							}
							 ?>
						</option>

					<?php endforeach ?>
				</select>
				<br>
				<button>Sửa</button>
			</form>
		</div>
	</div>

</body>
</html>
<!-- <a href="reset_pass.php">Reset</a><br>
<br>
<a href="change_pass.php">Đổi mk mới</a><br> -->