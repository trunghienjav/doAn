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
	<style type="text/css">
		.chart1{
			width: 50%;
			/*border: 1px solid black;*/
			height: auto;
			float: left;
		}
		.chart2{
			width: 50%;
			height: auto;
			float: left;
		}
		.highcharts-figure,
		.highcharts-data-table table {
			min-width: 360px;
			max-width: 800px;
			margin: 1em auto;
			/*float: left;*/
		}

		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #ebebeb;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}

		.highcharts-data-table caption {
			padding: 1em 0;
			font-size: 1.2em;
			color: #555;
		}

		.highcharts-data-table th {
			font-weight: 600;
			padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
			padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
			background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
			background: #f1f7ff;
		}
	</style>
</head>
<body>
	<?php 
	include '../connect.php';

	$sql_chart2 = "select products.id,
	products.name as 'ten',
	ifnull(sum(quantity),0) as quantity_sales
	from products
	left join order_product on products.id = order_product.product_id
	left join orders on orders.id = order_product.order_id
	where orders.status = 2 or orders.id is null or (orders.status = 3 and order_id is not null)
	group by products.id
	order by quantity_sales desc ";
	// orders.id is null or (orders.status = 3 and order_id is not null) là để hiện ra tất cả các sản phẩm dù chưa đc đặt hàng
	$result = mysqli_query($connect,$sql_chart2);
	$arr = [];
	foreach ($result as $each_char2) {
		$arr[$each_char2['ten']] = (float)$each_char2['quantity_sales'];
	}
	// echo json_encode($arr);
	// exit();
	$arrX_char2 = array_keys($arr);
	$arrY_char2 = array_values($arr);
	?>
	<div id="general">
		<div id="top">
			<h2>Thống kê</h2>
			<?php require '../menu.php'; ?>

		</div>
		<div id="middle" style="height: 700px;">
			<div class="chart1">
				<figure class="highcharts-figure">
					<div id="container">
						
					</div>
				</figure>
			</div>
			<div class="chart2">
				<figure class="highcharts-figure">
					<div id="container2"></div> 
					<!-- sửa thành container 2 -->
				</figure>
			</div>
			<div>
				<h3>Thống kê hôm nay</h3>
				<?php
				$today = date('d');
				$sql_statistical_today = "select count(*) as tong_don_da_duyet, status,date_format(created_at,'%e-%m') as date,ifnull(sum(total_price),0) as total 
				from orders
				where status = '2' and DATE(created_at) = CURDATE() ";
				$result_statistical_today = mysqli_query($connect,$sql_statistical_today);
				$each_statistical_today = mysqli_fetch_array($result_statistical_today);
				$sql_statistical_today2 = "select count(*) as tong_don_da_huy, status,date_format(created_at,'%e-%m') as date
				from orders
				where status = '3' and DATE(created_at) = CURDATE() ";
				$result_statistical_today2 = mysqli_query($connect,$sql_statistical_today2);
				$each_statistical_today2 = mysqli_fetch_array($result_statistical_today2);
				?>
				<!-- and DATE(created_at) = CURDATE() :lấy bên trang thống kê get_turnover.php,đc thầy hướng dẫn -->
				Số đơn đã duyệt: <?php echo $each_statistical_today['tong_don_da_duyet'] ?><br>
				Số đơn đã huỷ: <?php echo $each_statistical_today2['tong_don_da_huy'] ?><br>
				Doanh thu: $<?php echo  $each_statistical_today['total'] ?><br>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://code.highcharts.com/highcharts.js"></script>
			<script src="https://code.highcharts.com/modules/series-label.js"></script>
			<script src="https://code.highcharts.com/highcharts-3d.js"></script>
			<script src="https://code.highcharts.com/modules/cylinder.js"></script>
			<script src="https://code.highcharts.com/modules/exporting.js"></script>
			<script src="https://code.highcharts.com/modules/export-data.js"></script>
			<script src="https://code.highcharts.com/modules/accessibility.js"></script>
			<script type="text/javascript">
				Highcharts.chart('container2', { //sửa thành container 2
					chart: {
						type: 'cylinder',
						options3d: {
							enabled: true,
							alpha: 15,
							beta: 15,
							depth: 50,
							viewDistance: 25
						}
					},
					title: {
						text: 'Tổng doanh số sản phẩm đã bán'
					},
					xAxis: {
						categories: <?php echo json_encode($arrX_char2) ?>,
					},
					yAxis: {
						title: {
							margin: 20,
							text: 'Số lượng'
						}
					},
					plotOptions: {
						series: {
							depth: 25,
							colorByPoint: true
						}
					},
					series: [{
						data: <?php echo json_encode($arrY_char2) ?>,
						name: 'số lượng',
						showInLegend: false
					}]
				});
				$(document).ready(function() {
					$.ajax({
						url: 'get_turnover.php',
						dataType: 'json',
						data: {days: 30},
					})
					.done(function(response) {
				const arrX = Object.keys(response);//buổi 31 từ 1:28:00, nó sẽ trả về biến đối tượng object - key
				const arrY = Object.values(response);
				Highcharts.chart('container', {

					title: {
						text: 'Thống kê doanh thu 30 ngày gần nhất'
					},

					yAxis: {
						title: {
							text: 'Số tiền'
						}
					},
			// đây là mảng thời gian
			xAxis: {
				categories: arrX
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					}
				}
			},
			// đây là mảng dữ liệu
			series: [{
				name: 'Doanh thu',
				data: arrY//in ra value của arr
			}], 
			responsive: {
				rules: [{
					condition: {
						maxWidth: 1500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});

			});
				});

			</script>
		</div>
		<?php require '../footer.php'; ?>
	</div>
</body>
</html>