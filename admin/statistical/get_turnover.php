<?php
require '../connect.php';
$max_date = $_GET['days'];//lấy trong phạm vi là n ngày
$sql = "SELECT
date_format(created_at,'%e-%m') AS 'ngay',
	-- buổi 31 tại 1:00:00, e là trả lại ngày nhưng chỉ 1 chữ số
	SUM(total_price) AS 'doanh_thu'
	FROM orders
	WHERE DATE(created_at) >= CURDATE() - INTERVAL $max_date DAY
	GROUP BY date_format(created_at,'%e-%m')";
	$result = mysqli_query($connect,$sql);
	
	// echo json_encode($arr);

	//tính toán đoạn dưới từ 1:03:30 bài 31
	$arr = [];
	$today = date('d');
	if($today < $max_date){//thì nó sẽ in từ số ngày tháng trước
		$get_day_last_month = $max_date - $today; //sô ngày từ bây h đến cuối tháng
		$last_month = date('m',strtotime(" -1 month"));//lấy ra tháng trước
		$last_month_date = date('Y-m-d',strtotime(" -1 month"));//này là sao nhỉ
		$max_day_last_month = (new DateTime($last_month_date))->format('t');//ngày lớn nhất của tháng trước 
		$start_day_last_month = $max_day_last_month - $get_day_last_month;//thời điểm bắt đầu thống kê
		for ($i= $start_day_last_month; $i <= $max_day_last_month; $i++) {
			$key = $i . '-' . $last_month; 
			$arr[$key] = 0;//ban đầu cho dữ liệu nó bằng 0 hết...
		}
		$start_date_this_month = 1;
	}elseif($today = $max_date){//cái này tự ngẫm ra, thầy dạy 2 TH nhưng tự mình làm thêm 1 TH nữa
		$start_date_this_month = 1;
		$this_month = date('m');
		for ($i= $start_date_this_month; $i <= $today; $i++) {
			$key = $i . '-' . $this_month; 
		$arr[$key] = 0;//ban đầu cho dữ liệu nó bằng 0 hết...
	}
}else{
	$start_date_this_month = $today - $max_date;
}

$this_month = date('m');
for ($i= $start_date_this_month; $i <= $today; $i++) {
	$key = $i . '-' . $this_month; 
		$arr[$key] = 0;//ban đầu cho dữ liệu nó bằng 0 hết...
	}
	foreach ($result as $each) {
		$arr[$each['ngay']] = (float)$each['doanh_thu'];//...sau đó nếu có kq thì nó sẽ chèn vào, sắp xếp sẵn luôn 
	}
	echo json_encode($arr);
	// exit();
?>