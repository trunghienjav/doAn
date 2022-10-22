<?php session_start();
if(isset($_COOKIE['remember'])){
    $token = $_COOKIE['remember'];
    require '../admin/connect.php';
    $sql = "select * from customers
    where token = '$token'
    limit 1 ";
    $result = mysqli_query($connect,$sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows == 1){
        $each = mysqli_fetch_array($result);
        $_SESSION['id'] = $each['id'];
        $_SESSION['name'] = $each['name'];
    }
}
?>
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
    <?php require 'body.php'; ?>
    <!-- ****** Popular Brands Area End ****** -->

    <!-- ****** Footer Area Start ****** -->
    <?php require 'footer.php'; ?>
    <!-- ****** Footer Area End ****** -->
</div>
<!-- /.wrapper end -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
<script src="js/notify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".add-to-cart-btn").click(function() {
           let id = $(this).data('id');
           $.ajax({
            url: 'add_to_cart.php',
            type: 'GET',
                    // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                    data: {id},
                })
           .done(function(response) {
            // let parent_tr = btn.parents('.cart');
            // let cart_quantity = parent_tr.find('.cart_quantity').text();
            if(response == 1){
               $.notify("has been added to cart", "success");
           }else{
            alert('Bạn không thể thêm quá 10 sản phẩm trong giỏ hàng');
        }

    });
       });
    });
</script>

</body>

</html>