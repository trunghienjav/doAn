<?php
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

function current_url(){
	$url = "http://" . $_SERVER['HTTP_HOST'] . "/myproject";
	return $url;
}
//validate confirm pass
if($password !== $confirm_password){
	session_start();
	$_SESSION['error'] = "Mật khẩu xác nhận không đúng";
	header('location:register.php');
	exit;	
}
//validate ko nhập vào
if($email == '' || $password == '' || $name == '' || $phone_number == '' || $address == ''){
	session_start();
	$_SESSION['error'] = "Bạn phải điền đầy đủ thông tin";
	header('location:register.php');
	exit;		
}
require '../admin/connect.php';
$sql = "select count(*) from customers
where email = '$email' ";
$result = mysqli_query($connect,$sql);
$num_rows = mysqli_fetch_array($result)['count(*)'];//count này khi nó in ra thì sẽ như vầy count(*) => 6
//validate xem có trùng email
if($num_rows == 1){
	session_start();
	$_SESSION['error'] = 'Trùng Email rồi, xin hãy nhập lại';
	header('location:register.php');
	exit;
} 
$sql = "insert into customers(email,name,password,phone_number,address)
values('$email','$name','$password','$phone_number','$address') ";
mysqli_query($connect,$sql);

$sql = "select * from customers
where email = '$email' ";
$result = mysqli_query($connect,$sql);
$id = mysqli_fetch_array($result)['id'];
session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;

require '../admin/mail.php';//buổi 26 1:15:00
$link = current_url() . '/client_boostrap.php/index.php';
$title = "Đăng kí thành công";
$content = "Chúc mừng bạn đã đăng kí thành công tài khoản trên Hien Shop. Nhấn vào link để tiếp tục đăng nhập <a href='$link'>Trang chủ </a> ";
sendmail($email,$name,$title,$content);

header('location:index.php');
mysqli_close($connect);
