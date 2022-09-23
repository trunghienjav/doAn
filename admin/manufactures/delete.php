<?php 
session_start();
require '../check_super_admin_login.php';
if (empty($_GET['id'])) {
	header('location:index.php?error=Phải truyền mã để xóa');//sau đoạn này nên lưu vào session
	exit;
}
$id = $_GET['id'];
require '../connect.php';
$sql = "delete from manufactures
where id = '$id' ";

mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');