<?php 
session_start();
require '../check_super_admin_login.php';
if (empty($_GET['id'])) {
	header('location:index.php?error=Phải truyền mã để xóa');//sau đoạn này nên lưu vào session
	exit;
}
$id = $_GET['id'];
require '../connect.php';
try {
	$sql = "delete from manufactures
	where manufactures.id = '$id'";
	mysqli_query($connect,$sql);
	header('location:index.php');
	exit();
} catch (Exception $e) {
	$_SESSION['error'] = 'Không thể xóa nhà sản xuất đang có sản phẩm bày bán';
	header('location:index.php');
	exit();
}
mysqli_close($connect);
