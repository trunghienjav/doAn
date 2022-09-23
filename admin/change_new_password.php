<?php 
$token = $_GET['token'];
require 'connect.php';

$sql = "select * from forgot_password
where token = '$token' ";
$result = mysqli_query($connect,$sql);
if(mysqli_num_rows($result) === 0){
	header('location:index.php');
}	
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form action="process_change_new_pass.php" method="post">
	<input type="" name="token" value="<?php echo $token ?>" >
	Mật khẩu mới
	<input type="password" name="password">
	<br>
	<button>
		Đổi mật khẩu mới
	</button>
</form>
</body>
</html>