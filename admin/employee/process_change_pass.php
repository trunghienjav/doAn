<?php
session_start(); 
$id = $_POST['id'];
$password = $_POST['password'];
$new_password = $_POST['new_password'];

require '../connect.php';
$sql = "select * from admin
where id = '$id' ";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);

if($password !== $each['password']){
	$_SESSION['error'] = 'Mật khẩu nhập vào không đúng';
	header("location:change_pass.php?id=$id");
	exit;
}
$sql = "update admin
set
password = '$new_password'
where id = '$id' ";
mysqli_query($connect,$sql);
header('location:index.php');
mysqli_close($connect);