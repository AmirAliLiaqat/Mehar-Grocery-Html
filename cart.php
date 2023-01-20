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
                        <h1 class="display-5 mb-3">Your Cart</h1>
                        <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div><!--section-header-->
                </div><!--col-lg-6-->
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