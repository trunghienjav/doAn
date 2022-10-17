<?php 
if(!isset($_SESSION['level'])){
	//isset kt có tồn tại hay không
	$_SESSION['error'] = 'Đăng nhập đi anh bạn êi, nhảy đi đâu thế';
	header('location:../index.php');
}