<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Blog - <?php session_start(); if(isset($_SESSION['site_name'])) { echo $_SESSION['site_name']; } else {echo "Mehar Grocery";} ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require 'template-parts/header-links.php'; ?>
</head>

<body>
    
    <?php require 'template-parts/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Blog</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Latest Blog</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div><!--section-header-->
            <div class="row g-4">
                <?php
                    require 'config.php'; 
                    $fetch_blog_posts = "SELECT * FROM `posts` WHERE `status` = 'publish'";
                    $fetch_blog_posts_query = mysqli_query($conn, $fetch_blog_posts) or die("Query Failed");

                    if(mysqli_num_rows($fetch_blog_posts_query) > 0) {
                        while($row = mysqli_fetch_assoc($fetch_blog_posts_query)) {
                ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp mb-4" data-wow-delay="0.1s">
                    <img class="bg-light border-bottom" src="upload-images/<?php echo $row['featured_image']; ?>" width="100%" height="310">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href=""><?php echo $row['title']; ?></a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i><?php echo $row['author']; ?></small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i><?php echo $row['publish_date']; ?></small>
                        </div><!--text-muted-->
                    </div><!--bg-light-->
                </div><!--col-lg-4-->
                <?php 
                        }
                    }    
                ?>
            </div><!--row-->
        </div><!--container-->
    </div><!--container-xxl-->
    <!-- Blog End -->

    <?php require 'template-parts/footer.php'; ?>
    <?php require 'template-parts/footer-links.php'; ?>
</body>

</html>