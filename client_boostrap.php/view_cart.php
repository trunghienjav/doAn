<?php session_start(); ?>
<?php require 'check_login.php';
 if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];// lấy lại toàn bộ thông tin cart
}else{
    $_SESSION['error'] = 'Bạn chưa có sản phẩm nào trong giỏ hàng';
    header('location:index.php');
    exit;
}
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

</head>

<body>
     <?php require 'header.php'; ?>
     <?php require 'body_view_cart.php'; ?>
     <?php require 'footer.php'; ?>
    </div>
</body>
</html>