<?php
session_start();
require '../check_admin_login.php';

$name = $_POST['name'];
$photo = $_FILES['photo'];
$price = $_POST['price'];
$description = $_POST['description'];
$manufacture_id = $_POST['manufacture_id'];
if(empty($_POST['name']) || empty($_POST['price']) || 
empty($_POST['description'])){//phải là post photo thì nó mới nhận đc// ddeos được dmm
	$_SESSION['error'] = 'Phải điền đầy đủ thông tin';
header("location:product_insert.php");
exit;
}
$folder = 'photos/';
$file_extension = explode('.', $photo['name'])[1];
//để lấy đuôi file ảnh 
//buổi 19 từ 01:04:00
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($photo["tmp_name"], $path_file);
//tmp_name là tên file thư mục chứa ảnh tạm thời (temp), di chuyển từ file này đến file đích
require '../connect.php';
$sql = "insert into products(name,photo,price,description,manufacture_id)
values('$name','$file_name','$price','$description','$manufacture_id')";
mysqli_query($connect,$sql);
header('location:index.php');
mysqli_close($connect);