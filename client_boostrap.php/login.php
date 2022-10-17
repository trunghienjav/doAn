<?php 
session_start();
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
if(isset($_SESSION['id'])){
    header('location:index.php');
    exit;
}
// if(isset($_POST['id'])){
//     $jump_id = $_POST['id'];// biến này là khi chưa đăng nhập => xem sản phẩm => addtocart => đăng nhập => theo id mà quay lại màng hình đang mua
//     $r =print_r($jump_id);
//     die($r);
// }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Hien Shop Page</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="../client_boostrap.php/bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="../client_boostrap.php/assets/css/ct-paper.css" rel="stylesheet"/>
    <link href="../client_boostrap.php/assets/css/demo.css" rel="stylesheet" /> 
    <link href="../client_boostrap.php/assets/css/examples.css" rel="stylesheet" /> 
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
      
</head>
<body class="full-screen login">
    <nav class="navbar navbar-ct-transparent navbar-fixed-top" role="navigation-demo" id="register-navbar">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="login.php">Hien Shop</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-example-2">
          <ul class="nav navbar-nav navbar-right">
            <li>
                <a  class="btn btn-simple">Components</a>
            </li>
            <li>
                <a  class="btn btn-simple">Examples</a>
            </li>
            <li>
                <a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-simple"><i class="fa fa-facebook"></i></a>
            </li>
           </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-->
    </nav> 
    
    <div class="wrapper">
        <div class="background" style="background-image: url('../client_boostrap.php/assets/img/landscape.jpg');"> 
            <div class="filter-black"></div>
            <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 ">
                            <div class="demo-card">
                                <h3 class="title">Welcome</h3>

                                <form class="register-form" method="post" action="process_login.php">
                                      <?php
                                        if(isset($_SESSION['error'])){ ?>
                                        <span style="color:red">
                                            <?php 
                                            echo ($_SESSION['error']);
                                            unset($_SESSION['error']);
                                            ?>
                                        </span>
                                    <?php } ?>
                                    <br>
                                    <input type="hidden" name="jump_id" value="<?php echo $jump_id ?>">                                  
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">

                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <button class="btn btn-danger btn-block">Login</button>
                                    <label>Remember</label>
                                    <input type="checkbox" name="remember">
                                </form>
                                <br>
                                <p>If you don't have an account, please Register</p>
                                <form class="register-form" method="post" action="register.php">
                                    <button class="btn btn-danger btn-block">Register</button>
                                </form>
                                <div class="forgot">
                                    <a href="#" class="btn btn-simple btn-danger">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>     
        </div>
    </div>      

</body>

<script src="../client_boostrap.php/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="../client_boostrap.php/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="../client_boostrap.php/bootstrap3/js/bootstrap.js" type="text/javascript"></script>

<!--  Plugins -->
<script src="../client_boostrap.php/assets/js/ct-paper-checkbox.js"></script>
<script src="../client_boostrap.php/assets/js/ct-paper-radio.js"></script>
<script src="../client_boostrap.php/assets/js/bootstrap-select.js"></script>
<script src="../client_boostrap.php/assets/js/bootstrap-datepicker.js"></script>

<script src="../client_boostrap.php/assets/js/ct-paper.js"></script>
    
</html>