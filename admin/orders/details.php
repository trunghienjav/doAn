<?php 
session_start();
require '../check_admin_login.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
	</title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
</head>
<body>
	<?php 
	$order_id = $_GET['id'];
	require '../connect.php';
	$sql = "select * from order_product
	join products
	on products.id = order_product.product_id
	where order_id = '$order_id' ";
	$result = mysqli_query($connect,$sql);
	$sum = 0;
	?>
	<div id="general">
		<div id="top">
			Quản lí đơn hàng
			<?php require '../menu.php'; ?>
		</div>
		<div id="middle" style="height: 80%;">
			<table border="1" width="100%">
				<tr>
					<th>Ảnh</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Số lượng</th>
					<th>Tổng tiền</th>
				</tr>
				<?php foreach ($result as $each): ?>
					<tr>
						<td><img height="150" src="../products/photos/<?php echo $each['photo'] ?>"></td>
						<td><?php echo $each['name'] ?></td>
						<td><?php echo $each['price'] ?></td>
						<td><?php echo $each['quantity'] ?></td>
						<td>
							<?php 
							$result = $each['price'] * $each['quantity'];
							echo $result;
							$sum +=$result;
							$sum_format = number_format($sum);
							?>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<h1>Tổng tiền của đơn này là $<?php echo $sum_format ?></h1>
		</div>
	</div>

</body>
</html>