<?php session_start(); ?>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@example.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <img src="img/logo.png" height="120px">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About Us</a>
                <a href="product.php" class="nav-item nav-link">Products</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="blog.php" class="dropdown-item">Blog Grid</a>
                        <a href="feature.php" class="dropdown-item">Our Features</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        <a href="404.php" class="dropdown-item">404 Page</a>
                    </div><!--dropdown-menu-->
                </div><!--nav-item-->
                <a href="contact.php" class="nav-item nav-link">Contact Us</a>
            </div><!--navbar-nav-->
            <div class="d-none d-lg-flex ms-2">
                <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                    <small class="fa fa-search text-body"></small>
                </a>
                <div class="nav-item dropdown">
                    <span class="btn-sm-square bg-white rounded-circle ms-3 mb-3" style="cursor: pointer;">
                        <small class="fa fa-user text-body"></small>
                    </span>
                    <div class="dropdown-menu m-0" style="left: -40px;">
                        <?php
                            if(isset($_SESSION['status']) && $_SESSION['status'] === 'user') { ?>
                                <div class="user_profile text-center">
                                    <h6 class="fw-bold border-bottom pb-2"><span style="color: #63c644;">Hello,</span> <span style="color: #F65005;"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span></h6>
                                </div><!--user_profile-->
                                <a href="view_user.php" class="dropdown-item"><i class="fa-solid fa-user"></i> View Account</a>
                                <a href="delete_user.php" class="dropdown-item"><i class="fa-solid fa-trash"></i> Delete Account</a>
                                <a href="logout.php" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                            <?php
                            } else { ?>
                                <a href="login.php" class="dropdown-item">Login</a>
                                <a href="register.php" class="dropdown-item">Register</a>
                            <?php
                            }
                        ?>
                    </div><!--dropdown-->
                </div><!--nav-item-->
                
                <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                    <small class="fa fa-shopping-bag text-body"></small>
                </a>
            </div><!--d-none-->
        </div><!--collapse-->
    </nav>
</div>
<!-- Navbar End -->