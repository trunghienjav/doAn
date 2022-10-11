<?php session_start();
require 'check_login.php';  ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- Title  -->
	<title>Hien - Fashion Ecommerce Template | Home</title>

	<!-- Favicon  -->
	<link rel="icon" href="img/core-img/favicon.ico">

	<!-- Core Style CSS -->
	<link rel="stylesheet" href="css/core-style.css">
	<link rel="stylesheet" href="style.css">

	<!-- Responsive CSS -->
	<link href="css/responsive.css" rel="stylesheet">
</style>
</head>
<body>
	<?php require 'header.php'; ?>

	<!-- ****** Top Discount Area End ****** -->

	<!-- ****** Welcome Slides Area Start ****** -->
	<section class="new_arrivals_area section_padding_100_0 clearfix">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section_heading text-center">
						<h3>Purchase history</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="row karl-new-arrivals" >
					<?php
					$order_id = $_GET['id'];
					require '../admin/connect.php';
					$sql = "select * from order_product
					join products
					on products.id = order_product.product_id
					where order_id = '$order_id' ";
					$result = mysqli_query($connect,$sql);
					$sum = 0;
					?>
					<table class="table table-responsive">
						<tr>
							<th>Ảnh</th>
							<th>Tên sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Tổng tiền</th>
						</tr>
						<?php foreach ($result as $each): ?>
							<tr>
								<td><img height="150" src="../admin/products/photos/<?php echo $each['photo'] ?>"></td>
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
		</div>
	</section>

	<!-- Product Description -->
	<!-- ****** Popular Brands Area End ****** -->

	<!-- ****** Footer Area Start ****** -->

	<!-- ****** Footer Area End ****** -->

</div>
<!-- /.wrapper end -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>

</body>

</html>