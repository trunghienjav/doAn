<?php  
if(empty($_SESSION['id'])){
	$_SESSION['error'] = 'Vui lòng đăng nhập';
	header('location:login.php');
}