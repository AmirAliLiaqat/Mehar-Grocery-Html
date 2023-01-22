<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Checkout - <?php session_start(); echo $_SESSION['site_name']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require 'template-parts/header-links.php'; ?>
</head>

<body>
    
    <?php require 'template-parts/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Checkout</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Checkout</h1>
                        <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div><!--section-header-->
                </div><!--col-lg-6-->
            </div><!--row-->
            <?php
                require_once 'config.php';

                if(isset($_POST['place_order'])) {
                    // var_dump($_POST);

                    $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
                    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                    $user_name = $fname . ' ' . $lname;
                    $city = mysqli_real_escape_string($conn, $_POST['city']);
                    $state = mysqli_real_escape_string($conn, $_POST['state']);
                    $country = mysqli_real_escape_string($conn, $_POST['country']);
                    $product_qty = mysqli_real_escape_string($conn, $_POST['product_qty']);
                    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
                    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

                    date_default_timezone_set("Asia/Karachi");
                    $order_date = date("d-M-Y"); 

                    $order = "INSERT INTO `orders`(`user_id`, `user_name`, `city`, `state`, `country`, `product_qty`, `total_amount`, `payment_method`, `order_date`) 
                    VALUES ('$user_id','$user_name','$city','$state','$country','$product_qty','$total_amount','$payment_method','$order_date')";
                    $order_query = mysqli_query($conn, $order);

                    if($order) {
                        $delete_cart = "DELETE FROM `cart` WHERE `user_id` =  '$user_id'";
                        $delete_cart_query = mysqli_query($conn, $delete_cart);

                        $message[] = "<span class='text-success'>Your order placed successfully...</span>";
                    } else {
                        $message[] = "<span class='text-danger'>Order can't be placed!</span>";
                    }
                }
            ?>
            <?php
                if(isset($message)) {
                    foreach ($message as $message) {
                        echo '
                            <div class="message">
                                <span>'.$message.'</span>
                                <i onclick="this.parentElement.remove();">&#10060;</i>
                            </div><!--message-->
                        ';
                    }
                }
            ?>
            <form class="row my-3" method="post">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card text-dark mb-3">
                        <div class="card-header">
                            <h4 class="card-title text-uppercase">Buyer Info <a href="login.php" class="site_text float-end">Login Here</a></h4>
                        </div><!--card-header-->
                        <div class="card-body">
                            <div class="row form-group px-3">
                                <label for="fname" class="col-sm-4 form-label p-3">First Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-light" name="fname" required>
                                </div><!--col-sm-8-->
                            </div><!--row-->
                            <div class="row form-group px-3">
                                <label for="lname" class="col-sm-4 form-label p-3">Last Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-light" name="lname" required>
                                </div><!--col-sm-8-->
                            </div><!--row-->
                            <div class="row form-group px-3">
                                <label for="city" class="col-sm-4 form-label p-3">City:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-light" name="city" required>
                                </div><!--col-sm-8-->
                            </div><!--row-->
                            <div class="row form-group px-3">
                                <label for="state" class="col-sm-4 form-label p-3">State:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-light" name="state" required>
                                </div><!--col-sm-8-->
                            </div><!--row-->
                            <div class="row form-group px-3">
                                <label for="country" class="col-sm-4 form-label p-3">Country:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-light" name="country" required>
                                </div><!--col-sm-8-->
                            </div><!--row-->
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-lg-6-->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card text-dark mb-3">
                        <div class="card-header">
                            <h4 class="card-title text-uppercase">Billing Details</h4>
                        </div><!--card-header-->
                        <?php 
                            $user_id = $_SESSION['id'];
                            $fetch_amount = "SELECT COUNT(cart_id) AS `counter` FROM `cart` WHERE `user_id` = '$user_id'";
                            $fetch_amount_query = mysqli_query($conn, $fetch_amount);

                            $fetch_cart = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                            $fetch_cart_query = mysqli_query($conn, $fetch_cart);

                            $grand_total = 0;
                            $shipping_fee = 99;

                            while($cart = mysqli_fetch_assoc($fetch_cart_query)) :
                                $product_id = $cart['product_id'];

                                $fetch_product = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
                                $fetch_product_query = mysqli_query($conn, $fetch_product);
                                
                                while($product = mysqli_fetch_assoc($fetch_product_query)) :
                                    $sub_total = $product['product_reqular_price'] * $cart['product_qty'];
                                    $grand_total += $sub_total;
                                endwhile; 
                            endwhile;
                        ?>
                        <div class="card-body">
                          <p class="card-text">
                            Subtotal (<?php while($amount=mysqli_fetch_assoc($fetch_amount_query)) : echo $amount['counter']; ?>
                            <input type="hidden" name="product_qty" value="<?php echo $amount['counter']; ?>"><?php
                            endwhile; ?> items)
                            <span class="site_text float-end"><?php echo number_format($grand_total); echo ' ' . $_SESSION['currency_format']; ?></span>
                          </p>
                          <p class="card-text">
                            Shipping Fee
                            <span class="site_text float-end"><?php echo number_format($shipping_fee); echo ' ' . $_SESSION['currency_format']; ?></span>
                          </p>
                        </div><!--card-body-->
                        <?php //endwhile; //endwhile; ?>
                        <div class="card-footer">
                            <h6 class="card-title">
                                Total
                                <?php $total = $grand_total + $shipping_fee; ?>
                                <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
                                <span class="site_text float-end"><?php echo number_format($grand_total + $shipping_fee); echo ' ' . $_SESSION['currency_format']; ?></span>
                            </h6>
                        </div><!--card-footer-->
                    </div><!--card-->
                    <div class="card text-dark mb-3">
                        <div class="card-header">
                            <h4 class="card-title text-uppercase">Payment Methods</h4>
                        </div><!--card-header-->
                        <div class="card-body p-5">
                            <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="payment-cards">
                                <i class="fa-brands fa-3x fa-cc-paypal"></i>
                                <i class="fa-brands fa-3x fa-cc-stripe"></i>
                                <i class="fa-brands fa-3x fa-cc-visa"></i>
                                <i class="fa-brands fa-3x fa-cc-mastercard"></i>
                                <i class="fa-brands fa-3x fa-cc-amex"></i>
                                <i class="fa-solid fa-3x fa-wallet"></i>
                            </div><!--payment-cards-->
                            <div class="form-group mt-3">
                                <label for="payment_method" class="form-label fw-bold">Select Payment Method</label>
                                <select name="payment_method" class="form-select">
                                    <option value="cash on delivery">cash on delivery</option>
                                    <option value="bank transfer">bank transfer</option>
                                    <option value="credit card">credit card</option>
                                    <option value="paypal">paypal</option>
                                    <option value="strip">strip</option>
                                    <option value="visa">visa</option>
                                    <option value="mastercard">mastercard</option>
                                </select>
                            </div><!--form-group-->
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-lg-6-->
                <div class="col-xl-12 col-lg-12">
                    <div class="text-end my-5">
                        <button class="btn btn-lg btn-success" name="place_order">Place Order</button>
                    </div><!--text-end-->
                </div><!--col-xl-12-->
            </form><!--row-->
        </div><!--container-->
    </div><!--container-xxl-->
    <!-- Checkout End -->

    <!-- Firm Visit Start -->
    <div class="container-fluid bg-primary bg-icon mt-5 py-6">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-5 text-white mb-3">Visit Our Firm</h1>
                    <p class="text-white mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.</p>
                </div>
                <div class="col-md-5 text-md-end wow fadeIn" data-wow-delay="0.5s">
                    <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="">Visit Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Firm Visit End -->

    <!-- Testimonial Start -->
    <div class="container-fluid bg-light bg-icon py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Customer Review</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-4.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <?php require 'template-parts/footer.php'; ?>
    <?php require 'template-parts/footer-links.php'; ?>
</body>

</html>