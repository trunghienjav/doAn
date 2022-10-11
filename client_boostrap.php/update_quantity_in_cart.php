<?php
session_start(); 
$id = $_GET['id'];
$type = $_GET['type'];
if($type === '0'){
	if($_SESSION['cart'][$id]['quantity'] > 1){
		$_SESSION['cart'][$id]['quantity']--;
	}else{
		unset($_SESSION['cart'][$id]);
	}
}
elseif($type === '1'){
	if ($_SESSION['cart'][$id]['quantity'] > 9) {
		echo "Bạn không thể thêm quá 10 sản phẩm";
		// header('location:view_cart.php');
		exit;
	}
	$_SESSION['cart'][$id]['quantity']++;
}
echo 1;
// header('location:view_cart.php');