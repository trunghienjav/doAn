<?php session_start();
require '../check_super_admin_login.php';

if(isset($_SESSION['error'])){ ?>
	<span style="color:red">
		<?php 
		echo ($_SESSION['error']);
		unset($_SESSION['error']);
		?>
	</span>
<?php } ?>
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
			<span>
				<h2>
					Khu vực quản lý nhân viên
				</h2>
				<?php require '../menu.php';
				require '../connect.php'; ?>
			</span>
			<br>
			<br>
			<br>
			<br>
			<br>
			<a href="employee_insert.php">
				Thêm nhân viên
			</a>
		</div>
		<div id="middle">
			<br>
			<?php
			$search = '';
			if(isset($_GET['search'])){
				$search = $_GET['search'];
			}
			$page = 1;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			} 
			$sql_emp_num = "select count(*) from admin";
			$result_emp_num = mysqli_query($connect,$sql_emp_num);
			$arr_emp_num = mysqli_fetch_array($result_emp_num);
			$emp_num = $arr_emp_num['count(*)'];
			$emp_num_per_page = 8;

			$page_num = ceil($emp_num / $emp_num_per_page);
			$jump_over = $emp_num_per_page * ($page - 1);
			$sql = "select * from admin
			where
			name like '%$search%' or
			email like '%$search%'
			order by level desc
			limit $emp_num_per_page offset $jump_over ";
			$result = mysqli_query($connect,$sql);

			?>
			<table border="1" width="100%">
				<caption>
					<form>
						Tìm kiếm
						<br>
						<input type="search" name="search"  placeholder="nhập vào email hoặc tên" value="<?php echo $search ?>">
						<button>Tìm</button>
					</form>
				</caption>
				<tr>
					<th>Mã</th>
					<th>Tên</th>
					<th>Email</th>
					<th>Mật khẩu</th>
					<th>Quyền</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
				<?php foreach ($result as $each): ?>
					<tr>
						<td>
							<?php echo $each['id'] ?>
						</td>
						<td>
							<?php echo $each['name'] ?>
						</td>
						<td>
							<?php echo $each['email'] ?>
						</td>
						<td>
							*********
						</td>
						<td>
							<?php 
							switch ($each['level']) {
								case '0':
								echo "Nhân viên";
								break;
								case '1':
								echo "Quản lý";
								break;
							}
							?>
						</td>
						<td>
							<a class="link" style="color: blue;" href="update.php?id=<?php echo $each['id'] ?>">Sửa</a>
						</td>
						<td>
							<a  class="link" style="color: red;" href="delete.php?id=<?php echo $each['id'] ?>">X</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php for ($i=1; $i <= $page_num; $i++) {?>
				<a href="?page=<?php echo $i ?>&search=<?php echo $search ?>">
					<?php echo $i ?>
				</a>
			<?php } ?> 
		</div>
		<?php require '../footer.php' ?>
	</div>
</body>
</html>