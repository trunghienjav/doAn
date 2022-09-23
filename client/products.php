<style type="text/css">
	.each_product{
		width: 33%;
		border: 1px solid black;
		height: 243px;
		float: left;
	}
</style>
<?php 
require '../admin/connect.php';
$sql = "select * from products";
$result = mysqli_query($connect,$sql);
?>
<div id="middle">
	<?php foreach ($result as $each): ?>
		<div class="each_product">
			<h1>
				<?php echo $each['name'] ?>
			</h1>
			<img src="../admin/products/photos/<?php echo $each['photo'] ?>" height="100">
			<p>
				<?php echo $each['price'] ?>
			</p>
			<!-- nhảy tới product.php sau đó include product detail  -->
			<a class="link" href="product.php?id=<?php echo $each['id'] ?>">
				Xem chi tiết >>>
			</a>
			<br>
			<?php if(!empty($_SESSION['id'])){ ?>
				<a href="add_to_cart.php?id=<?php echo $each['id'] ?>">
					Thêm vào giỏ hàng
				</a>
			<?php } ?>
		</div>
	<?php endforeach ?>
</div>