<?php 
session_start();
require '../check_super_admin_login.php';
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

	<div id="general">
		<div id="top">
			<h2>Khu vực nhà sản xuất</h2>
			<?php include '../menu.php' ; ?>
			<br>
			<br>
			<br>
			<br>
			<br>
			<a style="color: black;" href="manufacture_insert.php">
				Thêm nhà sản xuất
			</a>	
		</div>
		<?php 
		require '../connect.php';
		//làm phân trang:
		$page = 1;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$sql_manufactures_num = "select count(*) from manufactures";
	//sql lấy ra số lượng nhà sản suất
		$arr_manufactures_num = mysqli_query($connect,$sql_manufactures_num);
	//mảng số lượng nhà sản suất
	// print_r($arr_manufactures_num);
		$result_manufactures_num = mysqli_fetch_array($arr_manufactures_num);
		// $r = print_r($result_manufactures_num);
		// die($r);
	// in ra 
		$manufactures_num = $result_manufactures_num['count(*)'];
	// die($manufactures_num);
	$manu_num_per_page = 3;// số nhà sx muốn hiển thị trên 1 trang
	$page_num = ceil($manufactures_num / $manu_num_per_page);
	//vd có 5 cái news, muốn chia 1 trang có 3 news cần mấy trang => số trang

	$jump_over = $manu_num_per_page * ($page - 1);

	$search = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}
	$sql = "select * from manufactures
	where
	name like '%$search%' or
	address like '%$search%' or
	phone_number like '%$search%'
	limit $manu_num_per_page offset $jump_over";
	//limit là giới hạn số bản ghi trả lại
	//offset là chỉ định hàng nào sẽ bắt đầu khi truy xuất dữ liệu
	$result = mysqli_query($connect,$sql);
	//code dưới muốn làm tính năng hiện ra kq ko tìm thấy search nhưng đếu đc :v
	// $each = mysqli_fetch_array($result);

	// // if($_GET['search'] !== $each['name'] || $_GET['search'] !== $each['address'] || $_GET['search'] !== $each['phone_number']){
	// // 	header('location:index.php?error=Không tìm thấy kết quả');
	// // }
	?>
	<div id="middle">
		<table border="1" width="100%">
			<caption>
				<form>
					Từ khóa cần tìm
					<br>
					<input type="search" name="search" value="<?php echo $search ?>">
					<button type="submit">Tìm</button>
				</form>
			</caption>
			<?php if(isset($_SESSION['error'])){ ?>
				<span style="color:red;">
					<?php echo($_SESSION['error']);
					unset($_SESSION['error']);
					?>
				</span>
			<?php } ?>

			<tr>
				<th>Mã</th>
				<th>Tên</th>
				<th>Địa chỉ</th>
				<th>Điện thoại</th>
				<th>Ảnh</th>
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			<?php foreach ($result as $each): ?>
				<tr>
					<td><?php echo $each['id'] ?></td>
					<td><?php echo $each['name'] ?></td>
					<td><?php echo $each['address'] ?></td>
					<td><?php echo $each['phone_number'] ?></td>
					<td><img height="100" src="photos/<?php echo $each['photo'] ?>">
					</td>
					<td>
						<a href="manufacture_update.php?id=<?php echo $each['id'] ?>">
							Sửa
						</a>
					</td>
					<td>
						<a href="delete.php?id=<?php echo $each['id'] ?>">
							Xóa
						</a>
					</td>
				</tr>			
			<?php endforeach ?>
		</table>
		<?php for($i = 1;$i <= $page_num; $i++){ ?>
			<a href="?page=<?php echo $i ?>&search=<?php echo $search ?>">
				<?php echo $i ?>
			</a>
		<?php } ?>
	</div>
	<?php require '../footer.php' ?>
</div>

<?php mysqli_close($connect) ?>
</body>
</html>