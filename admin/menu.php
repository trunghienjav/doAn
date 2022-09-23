
<div id="top">
	<ul>
		<li>
			<a class="link" href="../manufactures">
				Quản lý nhà sản xuất
			</a>
		</li>
		<li>
			<a class="link" href="../products">
				Quản lý sản phẩm
			</a>
		</li>
		<li>
			<a class="link" href="../orders">
				Quản lý đơn hàng
			</a>
		</li>
<!-- 		<li>
	 		<a class="link" href="../employee">
	 			Quản lí nhân viên
	 		</a>
	 	</li> -->
	</ul>
		Chào <?php echo $_SESSION['name'] ?>,
	<a href="../logout_ad.php">
		Đăng xuất
	</a>
</div>
<?php 
if(isset($_GET['error'])){
	?>
	<span style="color: red">
		<?php echo $_GET['error']; ?>
	</span>
<?php } ?>
<?php 
if(isset($_GET['success'])){
	?>
	<span style="color: green">
		<?php echo $_GET['success']; ?>
	</span>
	<?php } ?>