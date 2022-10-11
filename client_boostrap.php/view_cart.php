<?php session_start(); ?>
<?php require 'check_login.php';
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];// lấy lại toàn bộ thông tin cart
}else{
    $_SESSION['error'] = 'Bạn chưa có sản phẩm nào trong giỏ hàng';
    header('location:index.php');
    exit;
}
$total = 0;
//PHẦN TRÊN PHẢI ĐỂ NÓ RA NGOÀI FILE VIEW CART CHỨ NẾU ĐỂ TRONG BODY_VIEW_CART NÓ SẼ RA LỖI HEADER ALREADY SENT đậu xanh
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
    <title>Hien - Fashion Ecommerce Template | Product Details</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
 <?php require 'header.php'; ?>
 <?php require 'body_view_cart.php'; ?>
 <?php require 'footer.php'; ?>
</div>
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-update-quantity").click(function() {
            let btn = $(this);
            let id = btn.data('id');
            let type = parseInt(btn.data('type'));
            $.ajax({
                url: 'update_quantity_in_cart.php',
                type: 'GET',
                // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                data: {id,type},
            })
            .done(function(response) {//khi thành công thì...
               let parent_tr = btn.parents('tr');//buổi 29 từ 1:04:00, gọi lại thẻ tr cha
               let price = parent_tr.find('.span-price').text(); // tìm tới...
               let quantity = parent_tr.find('.span-quantity').text();//ghi theo tên class của cái thèn bên trên thôi
               if(response !== '1'){
                $("#div-error").text(response);
                $("#div-error").show();
                quantity--;
            }else{
                $("#div-error").hide();
            }
            if(type == 1){
                quantity++;
            }
            else{
                quantity--;
            }
            if(quantity === 0){
                parent_tr.remove();
            }else{
                parent_tr.find('.span-quantity').text(quantity);
                let sum = price * quantity;
                parent_tr.find('.span-sum').text(sum);
            }
            getTotal();
        });
        });
        $(".btn-delete").click(function() {
            let btn = $(this);
            let id = btn.data('id');
            $.ajax({
                url: 'delete_cart.php',
                type: 'GET',
                data: {id},
            })
            .done(function() {
                btn.parents('tr').remove();
                getTotal();
            });
        });
    });
    function getTotal(){
        let total = 0;
            $(".span-sum").each(function() {//in ra từng cái sum
                total += parseFloat($(this).text());
            });
            $("#span-total").text(total);
        }
    </script>
</body>
</html>