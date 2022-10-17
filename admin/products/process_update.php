<?php
session_start();
require '../check_admin_login.php';

$id = $_POST['id'];
if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['description'])){
	$_SESSION['error'] = 'Phải điền đầy đủ thông tin';
	header("location:product_update.php?id=$id");
	exit;
}
$name = $_POST['name'];
$photo_new = $_FILES['photo_new'];
if($photo_new['size'] > 0){//hình mới thì có size hơn 0
	$folder = 'photos/';
	$file_extension = explode('.', $photo_new['name'])[1];
	//để lấy đuôi file ảnh, buổi 19 từ 01:04:00
	$file_name = time() . '.' . $file_extension;
	$path_file = $folder . $file_name;
	move_uploaded_file($photo_new["tmp_name"], $path_file);
	//tmp_name là tên file thư mục chứa ảnh tạm thời (temp), di chuyển từ file này đến file đích
}else{
	$file_name = $_POST['photo_old'];
}
$price = $_POST['price'];
$description = $_POST['description'];
$manufacture_id = $_POST['manufacture_id'];

require '../connect.php';
$sql = "update products
set
name = '$name',
photo = '$file_name',
price = '$price',
description = '$description',
manufacture_id = '$manufacture_id'
where id = '$id' ";
mysqli_query($connect,$sql);
mysqli_close($connect);