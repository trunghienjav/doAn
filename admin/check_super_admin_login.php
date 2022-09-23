<?php 
if(empty($_SESSION['level'])){
	$_SESSION['error'] = 'Bạn phải đăng nhập vào tài khoản super admin';
	header('location:../root/index.php');
}