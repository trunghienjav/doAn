<?php 
try {
	session_start();
	if(empty($_GET['id'])){
		throw new Exception("Không tồn tại id");
	}
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
}elseif($_SESSION['cart'][$id]['quantity'] > 9){
	echo "Bạn không được thêm quá 10 sản phẩm";
	header('location:index.php');
	exit();
}elseif(!empty($_SESSION['cart'][$id])){
	$_SESSION['cart'][$id]['quantity']++;
}
echo 1;
// echo json_encode($_SESSION['cart']);
// $_SESSION['add_success'] = "Thêm vào giỏ hàng thành công";
// header('location:index.php');
} catch (Throwable $e) {
	echo $e;
}


