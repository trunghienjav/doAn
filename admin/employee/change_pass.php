<?php 
session_start();
$id = $_GET['id'];

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
	<div>
		<?php require '../menu.php'; ?>
	</div>
	<br>
	<form method="post" action="process_change_pass.php">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		Nhập lại mật khẩu cũ
		<input type="password" name="password">
		<br>
		Nhập mật khẩu mới
		<input type="password" name="new_password">
		<br>
		<button>Đổi</button>
	</form>
</body>
</html>