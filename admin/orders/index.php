<?php session_start();
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
</head>
<body>
	<?php 
	require '../connect.php';

	$search = '';
	// if(isset($_GET['search'])){
	// 	$search = $_GET['search'];
	// }
	$status = '';
	// if(isset($_GET['status'])){
	// 	$status = $_GET['status'];
	// }
	$sql = "select orders.*,
	customers.name,
	customers.phone_number,
	customers.address
	from orders
	join customers
	on customers.id = orders.customer_id
	where ";//CHỔ NÀY PHẢI CÓ THÊM DẤU CÁCH
	if(isset($_GET['search']) && $_GET['status'] == ''){
		$search = $_GET['search'];
		$sql .= "
		name_receiver like '%$search%'
		or
		address_receiver like '%$search%'
		or
		phone_receiver like '%$search%'";
	}elseif(isset($_GET['status']) ){
		$status = $_GET['status'];
		$sql .= "status = '$status' ";
		if(isset($_GET['search'])){
			$search = $_GET['search'];
			$sql .= "and
			(name_receiver like '%$search%'
			or
			address_receiver like '%$search%'
			or
			phone_receiver like '%$search%')";
			// die($sql);
		}
	}
	// die($sql);
	if($search == '' && $status == ''){
		$sql = "select orders.*,
		customers.name,
		customers.phone_number,
		customers.address
		from orders
		join customers
		on customers.id = orders.customer_id
		order by status asc, created_at desc";
	}
	// die($sql);
	$result = mysqli_query($connect,$sql);
	?>
	<div id="general">
		<div id="top">
			<h2>Quản lí đơn hàng</h2>
			<?php require '../menu.php'; ?>

		</div>
		<div id="middle" style="height: 200%;">
			<br>
			<table border="1" width="100%">
				<caption>
					<form>
						<input type="search" name="search" placeholder="Tìm theo tên" value="<?php echo $search ?>">
						<select name="status">
							<option value=""
							<?php if($status == '' && $search = '') { ?>
								selected
							<?php } ?>
							>
							Tất cả
						</option>
						<option value="1" 
						<?php if($status == 1){ ?>
							selected
						<?php } ?>
						>
						Mới đặt
					</option>
					<option value="2" 
					<?php if($status == 2){ ?>
						selected
					<?php } ?>
					>
					Đã duyệt
					<option value="3" 
					<?php if($status == 3){ ?>
						selected
					<?php } ?>
					>
					Hủy
				</select>
				<button>Tìm kiếm</button>
			</form>
		</caption>

		<tr>
			<th>Mã</th>
			<th>Thời gian đặt</th>
			<th>Thông tin người nhận</th>
			<th>Thông tin người đặt</th>
			<th>Trạng thái</th>
			<th>Tổng tiền</th>
			<th>Chi tiết</th>
			<th>Sửa</th>
		</tr>
		<?php foreach ($result as $each): ?>
			<tr>
				<td><?php echo $each['id'] ?></td>
				<td><?php echo $each['created_at'] ?></td>
				<td>
					<?php echo $each['name_receiver'] ?><br>
					<?php echo $each['address_receiver'] ?><br>
					<?php echo $each['phone_receiver'] ?><br>
				</td>
				<td>
					<?php echo $each['name'] ?><br>
					<?php echo $each['address'] ?><br>
					<?php echo $each['phone_number'] ?><br>
				</td>
				<td>
					<?php switch ($each['status']) {
						case '1':
						echo "Mới đặt";
						break;
						case '2':
						?>
						<span style="color: limegreen;">
							<?php
							echo "Đã duyệt";
							break;
							?>
						</span>
						<?php case '3':
						?>
						<span style="color: red;">
							<?php
							echo "Đã hủy";
							break;
							?>
						</span>
						
					<?php } ?>
				</td>
				<td>$<?php 
				$total_price = $each['total_price'];
				echo $total_price_format = number_format($total_price);
			?></td>
			<td>
				<a class="link" style="color: blue;" href="details.php?id=<?php echo $each['id'] // lấy theo id của order?>">
					Xem
				</a>
			</td>
			<td>
				<?php 
				if($each['status'] == 1){?>
					<a class="link" style="color: blue;" href="update.php?id=<?php echo $each['id'] ?>&status=2">
						Duyệt đơn
					</a>
					<br>
					<br>
					<a class="link" style="color: red;" href="update.php?id=<?php echo $each['id'] ?>&status=3">
						Hủy đơn
					</a>
				<?php } ?>
			</td>
		</tr>
	<?php endforeach ?>

</table>
</div>
<?php require '../footer.php'; ?>

</div>

</body>
</html>