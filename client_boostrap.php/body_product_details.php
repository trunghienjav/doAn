        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
        <!-- <<<<<<<<<<<<<<<<<<<< Bắt đầu từ đây <<<<<<<<<<<<<<<<<<<< -->
        <div class="breadcumb_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        </ol>
                        <!-- btn -->
                        <a href="index.php" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to Category</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="single_product_details_area section_padding_0_100">
            <div class="container">
                <div class="row">
                    <?php
                    $id = $_GET['id'];
                    $sql = "select * from products
                    where id = '$id' ";
                    $result_product_details = mysqli_query($connect,$sql);
                    $each = mysqli_fetch_array($result_product_details);
                    ?>
                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="../admin/products/photos/<?php echo $each['photo'] ?>">
                                            <img class="d-block w-100" src="../admin/products/photos/<?php echo $each['photo'] ?>" alt="First slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">

                            <h4 class="title"><a href="#"><?php echo $each['name'] ?></a></h4>

                            <h4 class="price">$<?php echo $each['price'] ?></h4>

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>

                            <div class="widget size mb-50">
                                <h6 class="widget-title">Size</h6>
                                <div class="widget-desc">
                                    <ul>
                                        <li><a>S</a></li>
                                        <li><a>M</a></li>
                                        <li><a>L</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Add to Cart Form -->
                            <?php 
                            if(isset($_SESSION['id'])){ 
                                ?>
                                <form class="cart clearfix mb-50 d-flex" action="add_to_cart.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $each['id'] ?>">
                                    <button type="submit" name="addtocart" class="btn cart-submit d-block">Add to cart</button>
                                </form>
                            <?php }elseif(empty($_SESSION['id'])){  ?>
                                <form class="cart clearfix mb-50 d-flex" action="login.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <button type="submit" name="addtocart_jump_to_id" class="btn cart-submit d-block">Add to cart</button>
                                </form>       
                            <?php } ?>
                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <p><?php echo $each['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

        <!-- ****** Quick View Modal Area Start ****** -->

            <!-- ****** Quick View Modal Area End ****** -->