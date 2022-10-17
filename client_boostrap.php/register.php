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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
      
</head>
<body class="full-screen register">
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
                <a  target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a  target="_blank" class="btn btn-simple"><i class="fa fa-facebook"></i></a>
            </li>
           </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-->
    </nav> 

<div class="wrapper">
    <div class="background" style="background-image: url('../client_boostrap.php/assets/img/blue.jpg');"> 
        <div class="filter-black"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-1 col-sm-7 col-xs-12">
                    <div class="info info-horizontal">
                        <div class="icon">
                            <i class="fa fa-umbrella"></i>
                        </div>
                        <div class="description">
                            <h3> Nắng đã có ô </h3>
                            <p>Mưa hãy vô Hiền Shop để mua đồ</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="demo-card">
                        <h3 class="title text-center">Register</h3>

                        <div class="division">
                            <div class="line l"></div>
                            <span>o</span>
                            <div class="line r"></div>
                        </div>
                        <form class="register-form" method="post" action="process_register.php">
                            <?php session_start();
                            if(isset($_SESSION['error'])){ ?>
                                <span style="color:red">
                                    <?php 
                                    echo ($_SESSION['error']);
                                    unset($_SESSION['error']);
                                    ?>
                                </span>
                            <?php } ?>
                            <input type="text" class="form-control" name="email" placeholder="Email">

                            <input type="password" class="form-control"  name="password" placeholder="Password">

                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">

                            <input type="text" name="name" class="form-control" placeholder="Your Full Name">

                            <input type="text" name="phone_number" class="form-control" placeholder="Your phone number">

                            <input type="text" name="address" class="form-control" placeholder="Your address">

                            <button class="btn btn-fill btn-block">Register</button>
                        </form>
                        <div class="login">
                            <p>Already have an account? <a href="login.php">Log in</a>.</p>
                        </div>
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

<script src="../bootstrap3/js/bootstrap.js" type="text/javascript"></script>

<!--  Plugins -->
<script src="../client_boostrap.php/assets/js/ct-paper-checkbox.js"></script>
<script src="../client_boostrap.php/assets/js/ct-paper-radio.js"></script>
<script src="../client_boostrap.php/assets/js/bootstrap-select.js"></script>
<script src="../client_boostrap.php/assets/js/bootstrap-datepicker.js"></script>

<script src="../client_boostrap.php/assets/js/ct-paper.js"></script>

</html>