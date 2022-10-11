<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
	<style type="text/css">
		.chart2{
			width: 100%;
			/*border: 1px solid black;*/
			height: 430px;
			/*float: left;*/
		}
		.chart3{
			width: 45%;
			/*border: 1px solid black;*/
			height: 430px;
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

	$sql = "select products.id,
	products.name as 'ten',
	ifnull(sum(quantity),0) as quantity_sales
	from products
	left join order_product on products.id = order_product.product_id
	left join orders on orders.id = order_product.order_id
	where orders.status = 2 or order_id is null or (orders.status = 3 and order_id is not null)
	group by products.id
	order by quantity_sales desc ";
	$result = mysqli_query($connect,$sql);
	$arr = [];
	foreach ($result as $each) {
		$arr[$each['ten']] = (float)$each['quantity_sales'];
	}
	// echo json_encode($arr);
	// exit();
	$arrX = array_keys($arr);
	$arrY = array_values($arr);
	?>
	<div id="general">
		<div id="top">
			<h2>Thống kê</h2>
		</div>
		<div id="middle">
			<div class="chart2">
				<figure class="highcharts-figure">
					<div id="container"></div>
				</figure>
			</div>
			<div class="chart3">
				<figure class="highcharts-figure">
					<div id="container3"></div>
				</figure>
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
				// $(document).ready(function() {
					Highcharts.chart('container', {
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
							text: 'Số sản phẩm bán chạy nhất'
						},
						xAxis: {
							categories: <?php echo json_encode($arrX) ?>
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
							data: <?php echo json_encode($arrY) ?>,
							name: 'Sô lượng',
							showInLegend: false
						}]
					});
				</script>
			</div>
			<?php require '../footer.php'; ?>
		</div>
	</body>
	</html>