<?php
session_start();

function current_url(){
	$url = "http://" . $_SERVER['HTTP_HOST'] . "/myproject";
	return $url;
}
// echo current_url();
// die();

$email = $_POST['email'];
require 'connect.php';

$sql = "select id, name from admin
where email = '$email' ";

$result = mysqli_query($connect,$sql);
if(mysqli_num_rows($result) === 1){
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$name = $each['name'];
	$sql = "delete from forgot_password
	where admin_id = '$id' ";
	mysqli_query($connect,$sql);
	$token = uniqid();
	$sql = "insert into forgot_password(admin_id,token)
	values('$id','$token') ";
	mysqli_query($connect,$sql);
	
	$link = current_url() . '/admin/change_new_password.php?token='.$token;
	require 'mail.php';
	$title = 'Change new Password';
	$content = "Bấm vào đây để đổi mật khẩu <a href='$link'>Hiệu lực trong 5 phút</a>";
	sendmail($email,$name,$title,$content);
}else{
	$_SESSION['error'] = 'Email chưa được đăng kí';
	header('location:forgot_password.php');
}