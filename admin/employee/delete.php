<?php
session_start();
require '../check_super_admin_login.php';
$id = $_GET['id'];
require '../connect.php';

$sql = "select * from admin
where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
$level = $each['level'];
//lấy ra lại cái level để if
if($level == 1){
	$_SESSION['error'] = 'Bạn không thể xóa Super Admin';
	header('location:index.php');
	exit;
}
$sql = "delete from admin
where id = '$id'";
mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');

