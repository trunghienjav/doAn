<?php session_start();
require 'check_login.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Hien - Fashion Ecommerce Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet">
</style>
</head>
<body>
    <?php require 'header.php'; ?>
    
    <!-- ****** Top Discount Area End ****** -->

    <!-- ****** Welcome Slides Area Start ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3>Purchase history</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="row karl-new-arrivals" style="position: relative; height: 1989.15px;">
                    <?php
                    $id = $_SESSION['id'];
                    require '../admin/connect.php';
                    $sql = "select orders.*,
                    customers.name,
                    customers.phone_number,
                    customers.address
                    from orders
                    join customers
                    on customers.id = orders.customer_id
                    where customers.id = '$id'
                    order by status asc 
                    ";
                    $result = mysqli_query($connect,$sql);
                    $num_rows = mysqli_num_rows($result);
                    if($num_rows >= 1){ ?>
                        <table class="table table-responsive">
                         <tr>
                             <th>Mã</th>
                             <th>Thời gian đặt</th>
                             <th>Thông tin người nhận</th>
                             <th>Thông tin người đặt</th>
                             <th>Tổng tiền</th>
                             <th>Chi tiết</th>
                             <th>Tình trạng đơn</th>
                             <th>Hủy đơn</th>
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
                                <td>$<?php 
                                $total_price = $each['total_price'];
                                // $total_price_all += $each['total_price']; ? 
                            // $arr = array($each['total_price']);//lưu nó vào 1 cái mảng trước đã
                            // print_r($arr);
                            // $total_price_all = array_sum($arr);
                            // $total_price_all_format = number_format($total_price_all);
                            echo $total_price_format = number_format($total_price);
                        ?></td>
                        <td>
                            <a class="link" style="color: blue;" href="orders_details.php?id=<?php echo $each['id'] // lấy theo id của order?>">
                                Xem
                            </a>
                        </td>
                        <td>
                            <?php
                            switch ($each['status']) {
                                case '1':
                                    echo "Đang đợi duyệt";
                                    break;
                                case '2':
                                    echo "Đã duyệt";
                                    break;
                                case '3':
                                    echo "Đã hủy";
                                    break; 
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                            if($each['status'] == 1){ ?>
                                <a class="link" style="color: blue;" href="process_cancel.php?id=<?php echo $each['id'] ?>">Hủy</a> 
                           <?php } ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <?php if(isset($total_price_all_format)){ ?>
                <h3>Tổng hóa đơn $<?php echo $total_price_all_format ?></h3>
            <?php } ?> 
        <?php }else{ ?>
            <h4 style="color: red;">You don't have any purchase history</h4>
        <?php } ?>
        <br>   
        <br>   
        <br>   
    </div>
</div>
</div>
<!-- Product Description -->
<!-- ****** Popular Brands Area End ****** -->

<!-- ****** Footer Area Start ****** -->

<!-- ****** Footer Area End ****** -->

</div>
<!-- /.wrapper end -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>

</body>

</html>