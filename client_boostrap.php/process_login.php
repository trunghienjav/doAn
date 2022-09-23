<?php 
$email = $_POST['email'];
$password = $_POST['password'];

if($email == '' || $password == ''){
	session_start();
	$_SESSION['error'] = "Bạn phải điền đầy đủ thông tin";
	header('location:login.php');
	exit;		
}
if(isset($_POST['remember'])){
	$remember = true;
}else{
	$remember = false;
}

require '../admin/connect.php';
$sql = "select * from customers
where email = '$email' and password = '$password' ";
$result = mysqli_query($connect,$sql);
$num_rows = mysqli_num_rows($result);//đếm tông số bản ghi
if($num_rows == 1){
	session_start();
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$_SESSION['id'] = $each['id'];
	$_SESSION['name'] = $each['name'];
	if($remember){
		$token = uniqid('user_',true);
		$sql = "update customers 
		set
		token = '$token'
		where
		id = '$id' ";
		mysqli_query($connect,$sql);
		setcookie('remember',$token,time() + 60*60*24*30);
		//tên cookie, giá trị cookie, hạn sử dụng của cookie nghĩa là thời gian hiện tại + thời gian tương lai(60p * 60s * 24 tiếng * 30 ngày = số giây trong 1 tháng) 
		//bài 22 từ 55:00s
	}
}else{
	session_start();
	$_SESSION['error'] = 'Tài khoản hoặc mật khẩu không đúng';
	header('location:login.php');
	exit;
}



