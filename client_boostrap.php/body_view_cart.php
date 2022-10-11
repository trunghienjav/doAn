
<div class="cart_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <div class="alert alert-danger" id="div-error" style="display: none;">

                    </div>
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
                            <?php if(empty($cart)){ ?>
                                <h3 style="text-align: center;">Your cart is empty</h3><br><br><br><br><br><br><br>
                            <?php }else{ ?>

                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- //code for each in ra giỏ hàng-->
                                <?php foreach ($cart as $id => $each): ?> 
                                 <tr>
                                    <td class="cart_product_img d-flex align-items-center">
                                        <a><img src="../admin/products/photos/<?php echo $each['photo'] ?>"></a>
                                        <h6 style="font-size: 20px;"><?php echo $each['name'] ?></h6>
                                    </td>
                                    <td>
                                        <span style="font-size: 20px;">
                                            $
                                        </span>
                                        <!-- vì nó lấy dạng text() nên ko đc để $ trong cùng php, nếu ko nó sẽ ra giá trị NaN-->
                                        <span
                                        class="span-price"
                                        style="font-size: 20px;"
                                        >
                                        <?php echo $each['price'] ?>
                                    </span>
                                </td>
                                <td>
                                    <button
                                    class="btn-update-quantity"
                                    data-id='<?php echo $id ?>'
                                    data-type='0'
                                    style="padding: 7px;"
                                    >
                                    - 
                                </button>&ensp;
                                <span class="span-quantity">
                                    <?php echo $each['quantity'] ?>                     
                                </span>
                                &ensp;<button
                                class="btn-update-quantity"
                                data-id='<?php echo $id ?>'
                                data-type='1'
                                style="padding: 7px;"
                                >
                                +
                            </button>
                        </td>
                        <td>
                            <span style="font-size: 20px;">
                                $
                            </span>
                            <span
                            class="span-sum"
                            style="font-size: 20px;"
                            >
                            <?php
                            $sum = $each['price'] * $each['quantity'];
                            $total += $sum;
                            echo $sum;
                            ?>
                        </span>
                    </td>
                    <td>
                        <button
                        class="btn-delete"
                        data-id='<?php echo $id ?>'
                        style="padding: 7px;"
                        >
                        Delete
                    </button>
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
                            <?php
                            if(isset($_SESSION['error_fill'])){ ?>
                                <span style="color:red">
                                    <?php 
                                    echo ($_SESSION['error_fill']);
                                    unset($_SESSION['error_fill']);
                                    ?>
                                </span>
                            <?php } ?>

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
                                <li>
                                    <span>Shipping</span> <span>Free</span>
                                </li>
                                <li>
                                    <span><strong>Total</strong></span> <span id="span-total">$
                                        <?php  $format_total = number_format($total);
                                        echo $format_total;
                                        ?>

                                    </span>
                                </li>
                            </ul>
                            <button class="btn karl-checkout-btn">Proceed to checkout</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php } ?>