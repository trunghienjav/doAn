<?php
session_start();
require '../check_admin_login.php';
$id = $_GET['id'];//id của sản phẩm
require '../connect.php';

try {//xóa này là nếu sản phẩm đã đc đặt hoặc đc duyệt rồi thì ko thể xóa đc
	//phải left join để nó lấy 1 phần, ko có thì sẽ trả về null chứ nếu inner join thì nó lấy hết. mà lấy hết nếu ko có thì nó ko hiện gì đâu
	$sql = "delete products.* from products
	LEFT JOIN order_product on order_product.product_id = products.id
	LEFT JOIN orders on order_product.order_id = orders.id
	where products.id = '$id' and (status = '3' or orders.id is null)";	
	mysqli_query($connect,$sql);
	header('location:index.php');
	exit();
} catch (Exception $e) {
	$_SESSION['error'] = 'Bạn không thể xóa sản phẩm đã được đặt hàng';
	header('location:index.php');
	exit();
}
mysqli_close($connect);