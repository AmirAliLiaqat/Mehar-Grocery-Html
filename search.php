<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Search - <?php session_start(); if(isset($_SESSION['site_name'])) { echo $_SESSION['site_name']; } else {echo "Mehar Grocery";} ?></title>
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
            <h1 class="display-3 mb-3 animated slideInDown">Search</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Search</li>
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
                        <h1 class="display-5 mb-3">Search Products</h1>
                        <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div><!--section-header-->
                </div><!--col-lg-6-->
            </div><!--row-->
            <div class="row g-0 gx-5 wow fadeInUp">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control d-inline" placeholder="Search products" style="width: 90%">
                        <button class="btn btn-primary" name="search">Search</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['search'])) :
                    $query = mysqli_real_escape_string($conn, $_POST['query']);
                    $search_products = "SELECT * FROM `products` WHERE `product_code` = '$query' or `product_title` = '$query'";
                    $search_products_query = mysqli_query($conn, $search_products) or die("Query Failed");
                
                    if(mysqli_num_rows($search_products_query) > 0) {
                        while($product = mysqli_fetch_assoc($search_products_query)) :
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp mt-5 mx-auto" data-wow-delay="0.1s">
                    <div class="product-item">
                        <div class="position-relative bg-light overflow-hidden">
                            <img class="img-fluid w-100" src="upload-images/<?php echo $product['featured_image']; ?>" alt="">
                            <?php if($product['product_sale_price'] != 0) { ?>
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Sale</div>
                            <?php } ?>
                        </div><!--position-relative-->
                        <div class="text-center p-4">
                            <a class="d-block h5 mb-2" href="view_product/<?php echo $product['product_title']; ?>"><?php echo $product['product_title']; ?></a>
                            <?php if($product['product_sale_price'] != 0) { ?>
                            <span class="text-primary me-1"><?php echo number_format($product['product_sale_price']) . ' ' . $_SESSION['currency_format']; ?></span>
                            <span class="text-body text-decoration-line-through"><?php echo number_format($product['product_reqular_price']) . ' ' . $_SESSION['currency_format']; ?></span>
                            <?php } else { ?>
                            <span class="text-primary"><?php echo number_format($product['product_reqular_price']) . ' ' . $_SESSION['currency_format']; ?></span>
                            <?php } ?>
                        </div><!--text-center-->
                        <div class="d-flex border-top">
                            <small class="w-50 text-center border-end py-3">
                                <a class="text-body" href="view_product.php/?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                            </small>
                            <small class="w-50 text-center py-2">
                                <form action="add_cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-primary" name="add_to_cart"><i class="fa fa-shopping-bag text-white me-2"></i>Add to cart</button>
                                </form>
                            </small>
                        </div><!--d-flex-->
                    </div><!--product-item-->
                </div><!--col-xl-3-->
                <?php endwhile; } else { echo "<span class='text-danger'>No product found!</span>"; } endif; ?>
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