
<!-- ****** Welcome Slides Area End ****** -->

<!-- ****** Top Catagory Area Start ****** -->

<!-- ****** Top Catagory Area End ****** -->

<!-- ****** Quick View Modal Area Start ****** -->
<!-- ****** Đây là vùng kick dấu cộng trong hình sp thì nó sẽ hiện ra ****** -->

<!-- ****** Quick View Modal Area End ****** -->

<!-- ****** New Arrivals Area Start ****** -->
<!-- ****** Đây là div ôm tổng hết phần hiển thị sản phẩm ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
            <button class="btn active" data-filter="*">ALL</button>
            <button class="btn" data-filter="*">WOMAN</button>
            <button class="btn" data-filter="*">MAN</button>
            <button class="btn" data-filter="*">ACCESSORIES</button>
            <button class="btn" data-filter="*">shoes</button>
            <button class="btn" data-filter="*">KIDS</button>
        </div>
    </div>

    <div class="container">
        
        <div class="row karl-new-arrivals">
            <?php foreach ($result as $each): ?>
            <!-- Single gallery Item Start -->
            <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.3s">
                <!-- Product Image -->
                <div class="product-img">
                    <img src="../admin/products/photos/<?php echo $each['photo'] ?>" alt="">
                    <div class="product-quicview">
                        <a href="product_details.php?id=<?php echo $each['id'] ?>" data-toggle="" data-target="#quickview"><i class="ti-plus"></i></a>
                    </div>
                </div>
                <!-- Product Description -->
                <div class="product-description">
                    <h4 class="product-price">$<?php echo $each['price'] ?></h4>
                    <p><?php echo $each['name'] ?></p>
                    <!-- Add to Cart -->
                     <?php 
                        if(isset($_SESSION['id'])){ ?>
                            <a href="add_to_cart.php?id=<?php echo $each['id'] ?>" class="add-to-cart-btn">ADD TO CART</a>
                    <?php } ?>
                </div>
            </div>
            <?php endforeach ?>
        </div>

    </div>
    <!-- Product Description -->
</div>

<!-- Single gallery Item Start -->

</div>
</div>
</section>
<!-- ****** New Arrivals Area End ****** -->

<!-- ****** Offer Area Start ****** -->
<section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url(img/bg-img/bg-5.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-end justify-content-end">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                    <h2>White t-shirt <span class="karl-level">Hot</span></h2>
                    <p> Fashion and Style</p>
                    <div class="offer-product-price">
                        <h3>めっちゃ人気ですよー</h3>
                    </div>
                    <a href="#" class="btn karl-btn mt-30">Hết hàng rồi</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Offer Area End ****** -->

<!-- ****** Popular Brands Area Start ****** -->

