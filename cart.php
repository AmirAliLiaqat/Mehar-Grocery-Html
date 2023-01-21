<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cart - <?php session_start(); echo $_SESSION['site_name']; ?></title>
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
            <h1 class="display-3 mb-3 animated slideInDown">Cart</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">My Cart</h1>
                        <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div><!--section-header-->
                </div><!--col-lg-6-->
            </div><!--row-->
            <?php
                if(isset($_POST['delete_item'])) {
                    $remove_product_id = mysqli_real_escape_string($conn, $_POST['remove_product_id']);
                    $remove_product_title = mysqli_real_escape_string($conn, $_POST['remove_product_title']);
                    
                    $delete = "DELETE FROM `cart` WHERE `cart_id` = '$remove_product_id'";
                    $delete_query = mysqli_query($conn, $delete);

                    if($delete_query) {
                        $message[] = $remove_product_title . " is deleted from cart";
                    }
                }
                if(isset($_POST['delete_all'])) {
                    
                    $delete_all = "DELETE FROM `cart`";
                    $delete_all_query = mysqli_query($conn, $delete_all);

                    if($delete_all_query) {
                        $message[] = "all items are deleted from cart";
                    }
                }
            ?>
            <?php
                if(isset($message)) {
                    foreach ($message as $message) {
                        echo '
                            <div class="message">
                                <span class="text-success">'.$message.'</span>
                                <i onclick="this.parentElement.remove();">&#10060;</i>
                            </div><!--message-->
                        ';
                    }
                }
            ?>
            <table class="table table-hover table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Product Img</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once 'config.php';

                        $user_id = $_SESSION['id'];
                        $fetch_cart = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                        $fetch_cart_query = mysqli_query($conn, $fetch_cart);
                        
                        $grand_total = 0;

                        if(mysqli_num_rows($fetch_cart_query) > 0) {
                            while($cart = mysqli_fetch_assoc($fetch_cart_query)) :
                                $product_id = $cart['product_id'];

                                $fetch_product = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
                                $fetch_product_query = mysqli_query($conn, $fetch_product);
                                
                                while($product = mysqli_fetch_assoc($fetch_product_query)) :
                                    $sub_total = $product['product_reqular_price'] * $cart['product_qty'];
                                    $grand_total += $sub_total;
                    ?>
                    <tr class="text-center">
                        <td>
                            <img src="upload-images/<?php echo $product['featured_image']; ?>" width="80" height="80" class="rounded">
                        </td>
                        <td><?php echo $product['product_title']; ?></td>
                        <td><?php echo number_format($product['product_reqular_price']); echo " " . $_SESSION['currency_format']; ?></td>
                        <td style="width:120px;">
                            <?php
                                if(isset($_POST['update_qty'])) {
                                    $product_id = mysqli_real_escape_string($conn, $_POST['id']);
                                    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
                                    $update_qty = "UPDATE `cart` SET `product_qty` = '$qty' WHERE `product_id` = '$product_id'";
                                    $update_qty_query = mysqli_query($conn, $update_qty);
                                }
                            ?>
                            <form action="" method="post">
                                <div class="d-flex">
                                    <input type="hidden" name="id" value="<?php echo $cart['product_id']; ?>">
                                    <input type="number" name="qty" class="form-control w-50" value="<?php echo $cart['product_qty']; ?>">&nbsp;
                                    <button class="btn btn-success rounded" name="update_qty"><i class="fa-solid fa-pen-to-square"></i></button>
                                </div>
                            </form>
                        </td>
                        <td><?php echo number_format($sub_total); echo ' ' . $_SESSION['currency_format']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="remove_product_id" value="<?php echo $cart['cart_id']; ?>">
                                <input type="hidden" name="remove_product_title" value="<?php echo $product['product_title']; ?>">
                                <button class="btn btn-danger" name="delete_item"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                                endwhile; 
                            endwhile; 
                        } else { ?>
                            <tr class="text-center text-white">
                                <td colspan="7" class="text-dark">your cart is empty</td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <td colspan="4" class="text-end">
                            <span class="fw-bold">Total Amount = </span>
                        </td>
                        <td><?php echo number_format($grand_total); echo ' ' . $_SESSION['currency_format']; ?></td>
                        <td>
                            <form action="" method="post">
                                <button class="btn btn-danger <?php echo ($grand_total > 1)?'':'disabled'; ?>" name="delete_all"><i class="fa-solid fa-trash"></i> Delete All</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="">
                <a href="product.php" class="btn btn-danger">Continue Shopping</a>
                <a href="checkout.php" class="btn btn-success float-end <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to checkout</a>
            </div><!--row-->
        </div><!--container-->
    </div><!--container-xxl-->
    <!-- Product End -->

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