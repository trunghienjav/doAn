<?php
require '../check_super_admin_login.php';

session_start();
$id = $_POST['id'];
if(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone_number'])){
	$_SESSION['error'] = 'Phải điền đầy đủ thông tin';
	header("location:manufacture_update.php?id=$id");
	//có biến $ thì phải ngoặc kép
	exit;
}
$name = $_POST['name'];
$photo_new  = $_FILES['photo_new'];//úp này lên là ra dạng mảng
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];

if($photo_new['size'] > 0){
	$folder = 'photos/';
	$file_extension = explode('.', $photo_new['name'])[1];
	$file_name = time() . '.' . $file_extension;
	$path_file = $folder . $file_name;
	move_uploaded_file($photo_new['tmp_name'], $path_file);
}else{
	$file_name = $_POST['photo_old'];
}
require '../connect.php';
$sql = "update manufactures
set
name = '$name',
address = '$address',
phone_number = '$phone_number',
photo = '$file_name'
where id = '$id'
 ";

 mysqli_query($connect,$sql);
 mysqli_close($connect);

 header('location:index.php');