<?php 
session_start();
$id = $_GET['id'];

if(empty($_SESSION['cart'][$id])){// cái SS cart ở đâu ra thì ban đầu nó chưa có, ta cho nó empty thì hiển nhiên đúng
	require '../admin/connect.php';
	$sql = "select * from products
	where id = '$id'";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);
	//phần này nhìn code json cho dễ hiểu
	$_SESSION['cart'][$id]['name'] = $each['name']; //tạo ss cart theo id lấy ra tên cột = in ra cột
	$_SESSION['cart'][$id]['photo'] = $each['photo'];
	$_SESSION['cart'][$id]['price'] = $each['price'];
	$_SESSION['cart'][$id]['quantity'] = 1;
}else{
	$_SESSION['cart'][$id]['quantity']++;
}
echo json_encode($_SESSION['cart']);
