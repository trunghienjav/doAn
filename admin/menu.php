
<div id="top">
	<ul>
		<?php if($_SESSION['level'] == 1){
			include '../manufactures_manager.php';
			include '../employee_manager.php';
		}
		?>
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
		<?php if($_SESSION['level'] == 1){?>
			<li>
				<a class="link" href="../statistical">
					Thống kê
				</a>
			</li>
		<?php } ?>
<!-- 		<li>
	 		<a class="link" href="../employee">
	 			Quản lí nhân viên
	 		</a>
	 	</li> -->
	 </ul>
	 <div id="header_name">
	 	Chào <?php echo $_SESSION['name'] ?>,
	 	<a href="../logout_ad.php">
	 		Đăng xuất
	 	</a>
	 </div>

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