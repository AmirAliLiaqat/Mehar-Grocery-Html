<?php 
    require_once './config.php';

    $fetch_options = "SELECT * FROM `options`";
    $fetch_options_query = mysqli_query($conn, $fetch_options) or die("Query Failed");

    while($options = mysqli_fetch_assoc($fetch_options_query)) :
        $_SESSION['site_name'] = $options['site_name'];
        $_SESSION['site_logo'] = $options['site_logo'];
        $_SESSION['site_slogen'] = $options['site_slogen'];
        $_SESSION['site_description'] = $options['site_description'];
        $_SESSION['currency_format'] = $options['currency_format'];
        $_SESSION['about_text'] = $options['about_text'];
        $_SESSION['newsletter_text'] = $options['newsletter_text'];
        $_SESSION['footer_text'] = $options['footer_text'];
        $_SESSION['contact_address'] = $options['contact_address'];
        $_SESSION['contact_number'] = $options['contact_number'];
        $_SESSION['contact_email'] = $options['contact_email'];
        $_SESSION['social_links'] = $options['social_links'];
    endwhile;
?>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i><?php echo $_SESSION['contact_address']; ?></small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i><?php echo $_SESSION['contact_email']; ?></small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-body ms-3" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <img src="upload-images/<?php echo $_SESSION['site_logo']; ?>">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About Us</a>
                <a href="product.php" class="nav-item nav-link">Products</a>
                <a href="blog.php" class="nav-item nav-link">Blog</a>
                <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="blog.php" class="dropdown-item">Blog Grid</a>
                        <a href="feature.php" class="dropdown-item">Our Features</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        <a href="404.php" class="dropdown-item">404 Page</a>
                    </div>
                </div> -->
                <a href="contact.php" class="nav-item nav-link">Contact Us</a>
            </div><!--navbar-nav-->
            <div class="d-none d-lg-flex ms-2">
                <a class="btn-sm-square bg-white rounded-circle ms-3" href="search.php">
                    <small class="fa fa-search text-body"></small>
                </a>
                <div class="nav-item dropdown">
                    <span class="btn-sm-square bg-white rounded-circle ms-3" style="cursor: pointer;">
                        <small class="fa fa-user text-body"></small>
                    </span>
                    <div class="dropdown-menu" style="left: -40px; margin-top: 25px;">
                        <?php
                            if(isset($_SESSION['status']) && $_SESSION['status'] === 'user') { ?>
                                <div class="user_profile text-center">
                                    <h6 class="fw-bold border-bottom pb-2"><span style="color: #63c644;">Hello,</span> <span style="color: #F65005;"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span></h6>
                                </div><!--user_profile-->
                                <a href="view_user.php?result=<?php echo sha1("ID not found"); ?>&id=<?php echo $_SESSION['id']; ?>" class="dropdown-item"><i class="fa-solid fa-user"></i> View Account</a>
                                <a href="delete_user.php?result=<?php echo sha1("ID not found"); ?>&id=<?php echo $_SESSION['id']; ?>" class="dropdown-item"><i class="fa-solid fa-trash"></i> Delete Account</a>
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
                
                <a class="btn-sm-square bg-white rounded-circle ms-3" href="cart.php">
                    <small class="fa fa-shopping-bag text-body"></small>
                </a>
                <?php
                    if(isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];

                        $fetch_cart = "SELECT COUNT(cart_id) AS `cart_num` FROM `cart` WHERE `user_id` = '$user_id'";
                        $fetch_cart_query = mysqli_query($conn, $fetch_cart);

                        while($cart = mysqli_fetch_assoc($fetch_cart_query)) :
                            echo "(" . $cart['cart_num'] . ")";
                        endwhile;
                    } else {
                        echo "(0)";
                    }
                ?>
            </div><!--d-none-->
        </div><!--collapse-->
    </nav>
</div>
<!-- Navbar End -->