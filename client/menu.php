<div id="top">
	<ol>
		<li>
			<a class="link" href="index.php">
				Trang chủ
			</a>
		</li>
		<?php if(empty($_SESSION['id'])){ ?>
			<li>
				<a href="signin.php">
					Đăng nhập
				</a>
			</li>
			<li>
				<a class="link" href="signup.php">
					Đăng kí
				</a>
			</li>
		<?php }else{ ?>
			<li>
				<a class="link" href="view_cart.php">
					Xem giỏ hàng
				</a>
			</li>
			<li>
				Chào <?php echo $_SESSION['name'] ?>,
				<a class="link" href="signout.php">
					Đăng xuất
				</a>
			</li>
		<?php } ?>
	</ol>
</div>