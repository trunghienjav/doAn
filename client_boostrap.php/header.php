<?php
$search = '';
if(isset($_GET['search'])){
    $search = $_GET['search'];
}          
require '../admin/connect.php';
$sql = "select * from products
where name like '%$search%' ";
$result = mysqli_query($connect,$sql);
?>
<div id="wrapper">

    <!-- ****** Header Area Start ****** -->
    <header class="header_area">
        <!-- Top Header Area Start -->
        <div class="top_header_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-end">

                    <div class="col-12 col-lg-7">
                        <div class="top_single_area d-flex align-items-center">
                            <!-- Logo Area -->
                            <div class="top_logo">
                                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
                            </div>
                            <!-- Cart & Menu Area -->
                            <div class="header-cart-menu d-flex align-items-center ml-auto">
                                <!-- Cart Area -->

                                <div style="" class="sign-in">
                                    <?php if(empty($_SESSION['id'])){ ?>
                                       <a href="login.php">&emsp; Login/Register</a>
                                   <?php }else{ ?>
                                    <div class="cart">
                                        <a  id="header-cart-btn" target="_blank"><span class="cart_quantity"><?php
                                        if(isset($_SESSION['id'])){
                                            $id = $_SESSION['id'];
                                            if(isset(($_SESSION['cart']))){
                                                echo(count($_SESSION['cart']));
                                            }else{
                                                echo 0;
                                            }
                                        }else{
                                            echo 0;
                                        }
                                        ?>
                                    </span> <i class="ti-bag"></i> Your Cart</a>
                                    <!-- Cart List Area Start -->
                                    <p>Hello <a href="profile.php"><?php echo $_SESSION['name'] ?></a> </p><a href="logout.php">Log out</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Header Area End -->
<div class="main_header_area">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 d-md-flex justify-content-between">
                <!-- Header Social Area -->
                <div class="header-social-area">
                    <a href="#"><span class="karl-level">Share</span> <i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </div>
                <!-- Menu Area -->
                <div class="main-menu-area">
                    <nav class="navbar navbar-expand-lg align-items-start">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                        <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                            <ul class="navbar-nav animated" id="nav">
                                <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="view_cart.php">Cart & Checkout</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Dresses</a></li>
                                <li class="nav-item"><a class="nav-link" href="#"> Shoes</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div id="search">
                        <caption>
                            <form>
                             &emsp;&emsp;&emsp;&emsp; <input type="search" name="search" value="<?php echo $search ?>">&emsp;<button> Search</button>
                         </form>
                     </caption>

                 </div>
             </div>
             <!-- Help Line -->
             <div class="help-line">
                <a href="#"><i class="ti-headphone-alt"></i> +34 657 3556 778</a>

            </div>
        </div >
        <?php
        if(isset($_SESSION['error'])){ ?>
            <span style="color:red">
                <?php 
                echo ($_SESSION['error']);
                unset($_SESSION['error']);
                ?>
            </span>
        <?php }elseif(isset($_SESSION['success'])){ ?>
         <span style="color:green; font-size: 200%;">
            <?php 
            echo ($_SESSION['success']);
            unset($_SESSION['success']);
            ?>
        </span>
    <?php }elseif(isset($_SESSION['add_success'])){ ?>
     <span style="color:green; font-size: 200%;">
        <?php 
        echo ($_SESSION['add_success']);
        unset($_SESSION['add_success']);
        ?>
    </span>
<?php } ?>
</div>
</div>
</div>
</header>
<!-- ****** Header Area End ****** -->

<!-- ****** Top Discount Area Start ****** -->

</div>
