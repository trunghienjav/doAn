<?php
$sum = 0;
?>
<div class="cart_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <?php
                    if(isset($_SESSION['error'])){ ?>
                        <span style="color:red">
                            <?php 
                            echo ($_SESSION['error']);
                            unset($_SESSION['error']);
                            ?>
                        </span>
                    <?php } ?>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- //code for each in ra giỏ hàng-->
                            <?php foreach ($cart as $id => $each): ?>
                             <tr>
                                <td class="cart_product_img d-flex align-items-center">
                                    <a><img src="../admin/products/photos/<?php echo $each['photo'] ?>"></a>
                                    <h6><?php echo $each['name'] ?></h6>
                                </td>
                                <td class="price"><span>$<?php echo $each['price'] ?></span></td>
                                <td class="qty">
                                    <div class="quantity">
                                        <!-- đoạn này copy, chỉ viết từ href -->
                                        <a href="update_quantity_in_cart.php?id=<?php echo $id ?>&type=decre" class="qty-minus" ><i class="fa fa-minus" aria-hidden="true" ></i></a>
                                        <input type="button" class="qty-text" id="qty" name="quantity" value="<?php echo $each['quantity'] ?>">
                                        <a class="qty-plus" href="update_quantity_in_cart.php?id=<?php echo $id ?>&type=incre"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                                <td class="total_price">
                                    <span>$
                                        <?php
                                        $result = $each['price'] * $each['quantity'];
                                        echo $result;
                                        $sum += $result;
                                        ?>
                                    </span>
                                </td>
                                <td class="update-checkout w-50 text-right">
                                    <a href="delete_cart.php?id=<?php echo $id ?>">X</a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>

            <div class="cart-footer d-flex mt-30">
                <div class="back-to-shop w-50">
                    <a href="index.php">Continue shooping</a>
                </div>
                <div class="update-checkout w-50 text-right">
                    <a href="#">clear cart</a>
                    <a href="#">Update cart</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
            <?php
            $id = $_SESSION['id'];
            require '../admin/connect.php';
            $sql = "select * from customers
            where id = '$id' ";
            $result = mysqli_query($connect,$sql);
            $each = mysqli_fetch_array($result);
         ?>
        <div class="checkout_area section_padding_1">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-page-heading">
                                <h5>Billing Address</h5>
                                
                            </div>

                            <form action="process_checkout.php" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name">Receiver Name<span>*</span></label>
                                        <input type="text" class="form-control" name="name_receiver" value="<?php echo $each['name'] ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="street_address">Receiver Address <span>*</span></label>
                                        <input type="text" class="form-control mb-3" name="address_receiver" value="<?php echo $each['address'] ?>">
                                        
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="phone_receiver">Receiver Phone Number <span>*</span></label>
                                        <input type="number" class="form-control" name="phone_receiver" min="0" value="<?php echo $each['phone_number'] ?>">
                                    </div>
                                </div>
                            
                        </div>
                    </div>

        <div class="col-09 col-md-7 col-lg-2">

        </div>
        <div class="col-12 col-lg-4">
            <div class="cart-total-area mt-70">
                <div class="cart-page-heading">
                    <h5>Cart total</h5>
                    <p>Final info</p>
                </div>

                <ul class="cart-total-chart">
                    <li><span>Subtotal</span> <span>$<?php echo $sum ?></span></li>
                    <li><span>Shipping</span> <span>Free</span></li>
                    <li><span><strong>Total</strong></span> <span><strong>$
                        <?php  $format_sum = number_format($sum);
                        echo $format_sum;
                        ?>
                        
                    </strong></span></li>
                </ul>
                <button class="btn karl-checkout-btn">Proceed to checkout</button>
            </div>
        </div>
    </div>
    </form>

</div>
</div>