<?php
session_start();
$id = $_POST['id']; 
$name = $_POST['name'];
$email = $_POST['email'];
$level = $_POST['level'];


require '../connect.php';
$sql = "update admin
set
name = '$name',
email = '$email',
level = '$level'
where id = '$id' ";

mysqli_query($connect,$sql);
if($id = $_SESSION['id'] && $level == 0){
	$_SESSION['error'] = "Bạn đã trở thành nhân viên, không có quyền đăng nhập vào khu vực Super Admin";
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['level']);
	header('location:../index.php');
	exit;
}
mysqli_close($connect);