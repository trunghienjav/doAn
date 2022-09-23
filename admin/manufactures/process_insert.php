<?php 
require '../check_super_admin_login.php';

$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$photo = $_FILES['photo'];//chú ý
if(empty($_POST['name']) || empty($_POST['address']) || 
empty($_POST['phone_number']) || empty($_FILES['photo'])){
	header('location:manufacture_insert.php?error=Phải điền đầy đủ thông tin');
	exit;
}
$folder = 'photos/';//buổi 19 từ 53:00, mình phải đẩy ảnh lên server và lưu lại trên đó, để ng khác cũng có thể nhìn thấy file ảnh trong máy mình, đồng thời lần sau truy cập thì ko cần phải load lại ảnh nữa
$file_extension = explode('.', $photo['name'])[1];//để lấy đuôi file ảnh 
//buổi 19 từ 01:04:00
$file_name = time().'.'.$file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($photo["tmp_name"], $path_file);
//tmp_name là tên file thư mục tạm thời (temp), di chuyển từ file này đến file đích
require '../connect.php';
$sql = "insert into manufactures(name,address,phone_number,photo)
values('$name','$address','$phone_number','$file_name')";

mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');
