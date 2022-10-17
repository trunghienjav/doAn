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
	<div id="general">
		<div id="top">
			<h2>Khu vực sản phẩm</h2>
			<?php
			require '../menu.php' ;
		//nếu là s_admin thì nó sẽ hiện ra mục employee manager
			require '../connect.php';

			$search = '';
			if(isset($_GET['search'])){
				$search = $_GET['search'];
			}

			$page = 1;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			$sql_products_num = "select count(*) from products";
	//sql lấy ra số lượng nhà sản suất
			$arr_products_num = mysqli_query($connect,$sql_products_num);
	//mảng số lượng nhà sản suất
	// print_r($arr_manufactures_num);
			$result_products_num = mysqli_fetch_array($arr_products_num);
	// in ra 
		// $r = print_r($result_products_num);
		// die($r);
			$products_num = $result_products_num['count(*)'];
	// die($manufactures_num);
	$products_num_per_page = 3;// số sp muốn hiển thị trên 1 trang
	//nhớ công thức phía dưới
	$page_num = ceil($products_num / $products_num_per_page);
	//vd có 5 cái news, muốn chia 1 trang có 3 news cần mấy trang => số trang

	$jump_over = $products_num_per_page * ($page - 1);		
	$sql = "select products.*, manufactures.name as manufacture_name
	from products
	join manufactures on products.manufacture_id = manufactures.id
	where
	products.name like '%$search%' or
	products.price like '%$search%'
	limit $products_num_per_page offset $jump_over ";
		//có nghĩa là nếu search = '' thì nó sẽ like và in ra tất cả, ngược lại thì chỉ ra kq search
		//limit là giới hạn số bản ghi trả lại
		//offset là chỉ định hàng nào sẽ bắt đầu khi truy xuất dữ liệu
	$result = mysqli_query($connect,$sql);
	?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<a style="color:black;" href="product_insert.php">
		Thêm sản phẩm
	</a>
</div>
<div id="middle">

	<table border="1" width="100%">
		<caption>
			<form>
				Từ khóa cần tìm
				<br>
				<input type="search" name="search" value="<?php echo $search ?>">
				<button type="submit">Tìm</button>
			</form>
			<?php if(isset($_SESSION['error'])){ ?>
				<span style="color:red;">
					<?php echo($_SESSION['error']);
					unset($_SESSION['error']);
					?>
				</span>
			<?php } ?>
		</caption>
		<tr>
			<th>Mã</th>
			<th>Tên</th>
			<th>Ảnh</th>
			<th>Giá</th>
			<th>Tên nhà sản xuất</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
		<?php 
		foreach ($result as $each): ?>
			<tr>
				<td><?php echo $each['id'] ?></td>
				<td><?php echo $each['name'] ?></td>
				<td>
					<img height="100" src="photos/<?php echo $each['photo'] ?>">
				</td>
				<td><?php echo $each['price'] ?></td>
				<td><?php echo $each['manufacture_name'] ?></td>
				<td>
					<a href="product_update.php?id=<?php echo $each['id'] ?>">
						Sửa
					</a>
				</td>
				<td>
					<a href="delete.php?id=<?php echo $each['id'] ?>">
						X
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
	<?php for($i = 1;$i <= $page_num; $i++){ ?>
		<a href="?page=<?php echo $i ?>&search=<?php echo $search ?>">
			<?php echo $i ?>
		</a>&ensp;
	<?php } ?>
</div>
<?php require '../footer.php'; ?>
</div>
</body>
</html>