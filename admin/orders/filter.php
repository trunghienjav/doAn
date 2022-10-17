<?php 
// switch ($status) {
// 	case '1':
// 		header("location:index.php?status=$status");
// 		break;
// 	case '2':
// 		header("location:index.php?status=$status");
// 		break;		
// 	case '3':
// 		header("location:index.php?status=$status");
// 		break;
// }
session_start();
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
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}
	$status = '';
	if(isset($_GET['status'])){
		$status = $_GET['status'];
	}
	$sql = "select orders.*,
	customers.name,
	customers.phone_number,
	customers.address
	from orders
	join customers
	on customers.id = orders.customer_id
	where
	status = '$status'
	and
	(name_receiver like '%$search%'
	or
	address_receiver like '%$search%'
	or
	phone_receiver like '%$search%')
	order by id desc
	";
	$result = mysqli_query($connect,$sql);
	?>
	<div id="general">
		<div id="top">
			<h1>Quản lí đơn hàng</h1>
			<?php require '../menu.php'; ?>
		</div>
		<div id="middle" style="height: 200%;">
			<br>
			<table border="1" width="100%">
				<form method="get" action="filter.php">
					Lọc theo Trạng thái
					<select name="status">
						<?php 
						$sql = "select * from status";
						$result2 = mysqli_query($connect,$sql);
						?>
						<?php foreach ($result2 as $status_arr): ?>
							<option
							value="<?php echo $status_arr['id'] ?>"
							<?php if ($status_arr['id'] == $status) {?>
								selected
							<?php } ?>
							>
							<?php echo $status_arr['name'] ?>
						</option>
					<?php endforeach ?>
				</select>
				<button>Tìm</button>
				<br>
			</form>
			<form action="index.php">
				<button>Tất cả</button>
			</form>

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
							echo "Đã duyệt";
							break;
							case '3':
							echo "Đã hủy";
							break;
						} ?>
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

</div>

</body>
</html>