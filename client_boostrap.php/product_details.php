<?php session_start();
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
  <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
  <style type="text/css">
    fieldset, label { margin: 0; padding: 0; }
    body{ margin: 20px; }
    h1 { font-size: 1.5em; margin: 10px; }
    .rating { 
      border: none;
      float: left;
    }

    .rating > input { display: none; } 
    .rating > label:before { 
      margin: 5px;
      font-size: 1.25em;
      font-family: FontAwesome;
      display: inline-block;
      content: "\f005";
    }

    .rating > .half:before { 
      content: "\f089";
      position: absolute;
    }

    .rating > label { 
      color: #ddd; 
      float: right; 
    }

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
</head>

<body>
  <?php 
  if(empty($_GET['id'])){
    $_SESSION['error'] = "Không tồn tại id sản phẩm";
    header('location:index.php');
    exit();
  }
  ?>
  <?php require 'header.php'; ?>
  <?php require 'body_product_details.php'; ?>
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
<script src="js/notify.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".delete-btn").click(function() {
      let btn = $(this);
      let id = btn.data('id');
      // let parent_span = btn.parents('.general-rating');
      $.ajax({
        url: 'delete_rating.php',
        type: 'GET',
        data: {id},
      })
      .done(function() {
        // parent_tr.find('.span-sum').text(sum);
        btn.parents('.general-rating').remove();
        // btn.parents('.general-rating').remove();
        $.notify("Đã xóa 1 sản phẩm", "success");
        console.log("success");
      })
    })
  });
</script>
</body>
</html>