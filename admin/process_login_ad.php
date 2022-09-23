<?php 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

require 'connect.php';//nếu mà cùng đường dẫn (cùng cấp) thì ko cần ../
$sql = "select * from admin
where email = '$email' and password = '$password'";
$result = mysqli_query($connect,$sql);
if(mysqli_num_rows($result) === 1){
	$each = mysqli_fetch_array($result);
	$_SESSION['id'] = $each['id'];
	$_SESSION['name'] = $each['name'];
	$_SESSION['level'] = $each['level'];

	header('location:root/index.php');
	exit;
}else{
	$_SESSION['error'] = 'Mật khẩu hoặc tài khoản không đúng, xin dăng nhập lại.';
	header('location:index.php');
	exit;
}
