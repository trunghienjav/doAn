<?php
session_start();
require 'check_login.php';

$name_receiver = $_POST['name_receiver'];
$phone_receiver = $_POST['phone_receiver'];
$address_receiver = $_POST['address_receiver'];
if(empty($_POST['name_receiver']) || empty($_POST['phone_receiver']) ||empty($_POST['address_receiver'])){
	$_SESSION['error_fill'] = "Vui lòng điền đầy đủ thông tin";
	header('location:view_cart.php');
	exit;
}
require '../admin/connect.php';
$cart = $_SESSION['cart'];
$total_price = 0;
foreach ($cart as $each) {
	$total_price += $each['quantity'] * $each['price'];
}
//bai 24 tu 1:34:00
//có thể tryền cái sum ở body_view_cart trong form dưới theo dạng hidden để lấy tiếp giá trị sum, nhưng khi khách hàng ấn source code có thể thấy và chỉnh sửa được nên mình chỉ lưu nó ở SS, xử lí trong back end
$customer_id = $_SESSION['id'];
$status = 1;

$sql = "insert into orders(customer_id,name_receiver,phone_receiver,address_receiver,status,total_price)
values('$customer_id','$name_receiver','$phone_receiver','$address_receiver','$status','$total_price') ";
mysqli_query($connect,$sql);

$sql = "select max(id) from orders where customer_id = '$customer_id' ";
$result = mysqli_query($connect,$sql);
$order_id = mysqli_fetch_array($result)['max(id)'];

foreach ($cart as $product_id => $each) { //lấy theo product_id
	$quantity = $each['quantity'];
	$sql = "insert into order_product(order_id, product_id,quantity)
	values('$order_id','$product_id','$quantity') ";
	mysqli_query($connect,$sql);
	unset($_SESSION['cart']);
	$_SESSION['success'] = "Đặt hàng thành công";
	header('location:index.php');
}