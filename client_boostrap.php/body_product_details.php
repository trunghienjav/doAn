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
                            <h4>
                               <?php 
                               $sql_avg_rating = "select AVG(rating) as avg_rate from rating where product_id = '$id';";
                               $result_avg_rating = mysqli_query($connect,$sql_avg_rating);
                               $each_avg_rating = mysqli_fetch_array($result_avg_rating);
                               ?>
                               <?php 
                               echo "<span class='stars'>";
                               for ( $i = 1; $i <= 5; $i++ ) {
                                if ( round( $each_avg_rating['avg_rate'] - .25 ) >= $i ) {
                                                echo "<i class='fa fa-star' style='font-size:20px;color:#ff9f00;'></i>"; //fas fa-star for v5
                                            } elseif ( round( $each_avg_rating['avg_rate'] + .25 ) >= $i ) {
                                                echo "<i class='fa fa-star-half-o' style='font-size:20px;color:#ff9f00;'></i>";//fas fa-star-half-alt for v5
                                            } else {
                                                echo "<i class='fa fa-star-o' style='font-size:20px;color:#ff9f00;'></i>"; //far fa-star for v5
                                            }
                                        }
                                        echo '</span>';
                                        ?>
                                    </h4>
                                    <h4 class="price">$<?php echo $each['price'] ?></h4>

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
                                                <form action="process_rating.php" method="post">
                                                    <h2>Rating</h2>
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <fieldset class="rating">
                                                        <input type="radio" id="5" name="rating" value="5" /><label class = "full" for="5" title="Awesome - 5 stars"></label>
                                                        <input type="radio" id="4.5" name="rating" value="4.5" /><label class="half" for="4.5" title="Pretty good - 4.5 stars"></label>
                                                        <input type="radio" id="4" name="rating" value="4" /><label class = "full" for="4" title="Pretty good - 4 stars"></label>
                                                        <input type="radio" id="3.5" name="rating" value="3.5" /><label class="half" for="3.5" title="Meh - 3.5 stars"></label>
                                                        <input type="radio" id="3" name="rating" value="3" /><label class = "full" for="3" title="Meh - 3 stars"></label>
                                                        <input type="radio" id="2.5" name="rating" value="2.5" /><label class="half" for="2.5" title="Kinda bad - 2.5 stars"></label>
                                                        <input type="radio" id="2" name="rating" value="2" /><label class = "full" for="2" title="Kinda bad - 2 stars"></label>
                                                        <input type="radio" id="1.5" name="rating" value="1.5" /><label class="half" for="1.5" title="Meh - 1.5 stars"></label>
                                                        <input type="radio" id="1" name="rating" value="1" /><label class = "full" for="1" title="Sucks big time - 1 star"></label>
                                                        <input type="radio" id="0.5" name="rating" value="0.5" /><label class="half" for="0.5" title="Sucks big time - 0.5 stars"></label>
                                                    </fieldset>
                                                    <br>
                                                    <br>
                                                    Comment
                                                    <br>
                                                    <textarea name="comment"></textarea>
                                                    <button>Send</button>
                                                </form>
                                            </div>
                                            <h4>Review</h4>
                                            <?php
                                            if(isset($_SESSION['error_rating'])){ ?>
                                                <span style="color:red">
                                                    <?php 
                                                    echo ($_SESSION['error']);
                                                    unset($_SESSION['error']);
                                                    ?>
                                                </span>
                                            <?php } ?>
                                            <!-- <br> -->
                                            <?php 
                                            $sql = "select id,customer_id, name, rating, comment, date_format(created_at,'%Y-%m-%d') as created_at
                                            from rating
                                            where product_id = '$id'
                                            limit 5";
                                            $result_rating = mysqli_query($connect,$sql);
                                            $num_rows_rating = mysqli_num_rows($result_rating);
                                            if($num_rows_rating == 0){
                                             echo "There are no reviews for this product yet";
                                         }
                                         ?>
                                         <?php foreach ($result_rating as $each_rating): ?>
                                            <span class="general-rating">
                                                <span class="span-rating" style="color: blue;"><?php echo $each_rating['name'] ?>: (<?php echo $each_rating['created_at'] ?>)
                                                </span>
                                                <span class="span-star">
                                                    <?php 
                                                    echo "<span class='stars'>";
                                                    for ( $i = 1; $i <= 5; $i++ ) {
                                                        if ( round( $each_rating['rating'] - .25 ) >= $i ) {
                                                        echo "<i class='fa fa-star' style='font-size:20px;color:#ff9f00;'></i>"; //fas fa-star for v5
                                                    } elseif ( round( $each_rating['rating'] + .25 ) >= $i ) {
                                                        echo "<i class='fa fa-star-half-o' style='font-size:20px;color:#ff9f00;'></i>";//fas fa-star-half-alt for v5
                                                    } else {
                                                        echo "<i class='fa fa-star-o' style='font-size:20px;color:#ff9f00;'></i>"; //far fa-star for v5
                                                    }
                                                }
                                                echo '</span>';
                                                ?>
                                            </span>
                                            <?php 
                                            if(isset($_SESSION['id']) && $each_rating['customer_id'] == $_SESSION['id']){ ?>
                                                <button class="delete-btn" data-id='<?php echo $each_rating['id'] ?>' style="padding: 1px;">&ensp;X&ensp;</button>
                                                <!-- cái $each_rating['id'] là id của comment -->
                                            <?php } ?>
                                            <br>
                                            <span class="span-comment">
                                                <?php echo $each_rating['comment'] ?><br>
                                                ---------------------------------------------------------------------------------
                                                <br>

                                            </span>
                                        </span>

                                    <?php endforeach ?>
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