<?php
session_start(); 
$id = $_GET['id'];
$type = $_GET['type'];
if($type === 'decre'){
	if($_SESSION['cart'][$id]['quantity'] > 1){
		$_SESSION['cart'][$id]['quantity']--;
	}else{
		unset($_SESSION['cart'][$id]);
	}
}elseif($type === 'incre'){
	if ($_SESSION['cart'][$id]['quantity'] > 9) {
		$_SESSION['error'] = 'Bạn không thể thêm quá 10 sản phẩm';
		header('location:view_cart.php');
		exit;
	}
	$_SESSION['cart'][$id]['quantity']++;
}
header('location:view_cart.php');