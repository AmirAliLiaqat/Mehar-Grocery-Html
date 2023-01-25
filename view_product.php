<?php
    require_once 'config.php';
    session_start();

    if(isset($_POST['add_to_cart'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_qty = mysqli_real_escape_string($conn, $_POST['product_qty']);
        $stock_status = mysqli_real_escape_string($conn, $_POST['stock_status']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

        if($stock_status == 1) {
            $add_to_cart = "INSERT INTO `cart`(`product_id`,`product_qty`, `user_id`)
            VALUES ('$product_id','$product_qty','$user_id')";
            $add_to_cart_query = mysqli_query($conn, $add_to_cart);

            if($add_to_cart_query) {
                echo '
                    <div class="message p-2">
                        <span class="text-success mx-auto">Product is added to cart successfully...</span>
                    </div><!--message-->
                ';
            } else {
                echo '
                    <div class="message p-2">
                        <span class="text-danger mx-auto">Error! for adding product to cart!</span>
                    </div><!--message-->
                ';
            }
        } else {
            echo '
                <div class="message p-2">
                    <span class="text-danger mx-auto">product is out of stock you can`t add it in our card</span>
                </div><!--message-->
            ';
        }
    }

    if(isset($_GET['product_id'])) {
        $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);

        $fetch_product = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
        $fetch_product_query = mysqli_query($conn, $fetch_product);

        while($product = mysqli_fetch_assoc($fetch_product_query)) :
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_title']; ?> - <?php if(isset($_SESSION['site_name'])) { echo $_SESSION['site_name']; } else {echo "Mehar Grocery";} ?></title>
    <?php require_once 'template-parts/header-links.php'; ?>
</head>
<body>

    <?php require_once 'template-parts/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown"><?php echo $product['product_title']; ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="product.php">Products</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><?php echo $product['product_title']; ?></li>
                </ol>
            </nav>
        </div><!--container-->
    </div><!--container-fluid-->
    <!-- Page Header End -->

    
    <!-- view product section start -->
    <section class="view-product">
        <div class="container">
            <div class="row border-bottom py-5">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <img src="upload-images/<?php echo $product['featured_image']; ?>" alt="product_img" width="500" height="500">
                </div><!--col-lg-5-->
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="product-meta p-3">
                        <span class="text-success fw-bold">
                            <?php
                                $count_review = "SELECT COUNT(review_id) AS total_reviews FROM `product_reviews` WHERE `product_id` = '$product_id'";
                                $count_review_query = mysqli_query($conn, $count_review);
                                while($review = mysqli_fetch_assoc($count_review_query)) :
                                    echo $review['total_reviews'];
                                endwhile;
                            ?>
                            Reviews
                        </span>
                        <h3 class="display-4  mb-3"><?php echo $product['product_title']; ?></h3>
                        <p>
                            <?php
                                if($product['product_description'] != "") {
                                    echo $product['product_description'];
                                } else {
                            ?>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                            <?php } ?>
                        <div class="product-meta-content d-flex justify-content-between">
                            <div class="product-stock mx-2">
                                <p class="fw-bold">Avability:</p>
                                <?php if($product['product_stock_status'] == 0) { ?>
                                    <p class="text-danger fw-bold">Out of stock</p>
                                <?php } else { ?>
                                    <p class="text-success fw-bold">In stock</p>
                                <?php } ?>
                            </div><!--product-stock-->
                            <div class="product-price mx-2">
                                <p class="fw-bold">Price:</p>
                                <p class="text-primary fw-bold"><?php echo number_format($product['product_reqular_price']); echo ' ' . $_SESSION['currency_format'] ?></p>
                            </div><!--product-price-->
                            <form action="" method="post">
                            <div class="product-qty mx-2">
                                <p class="fw-bold">Quantity:</p>
                                <div class="counter text-center">
                                    <input type="number" class="form-control w-50" name="product_qty" value="1">
                                </div><!--counter-->
                            </div><!--product-qty-->
                        </div><!--product-meta-content-->
                        <div class="action mb-3">
                            <input type="hidden" name="stock_status" value="<?php echo $product['product_stock_status']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button class="btn btn-success" name="add_to_cart"><i class="fa-solid fa-cart-shopping"></i> Add to cart</button>
                        </div><!--action-->
                            </form>
                        <div class="product-meta-tags mb-2">
                            <?php 
                                $brand_id = $product['product_brand'];
                                $fetch_brands = "SELECT * FROM `brands` WHERE `brand_id` = '$brand_id'";
                                $fetch_brands_query = mysqli_query($conn, $fetch_brands);
                                while($brands = mysqli_fetch_assoc($fetch_brands_query)) :
                            ?>
                            <strong>Product Brand:</strong>
                            <span><?php echo $brands['brand_title']; ?></span>
                            <?php endwhile; ?>
                        </div><!--product-meta-tags-->
                        <div class="product-meta-category mb-2">
                            <?php 
                                $cat_id = $product['product_category'];
                                $fetch_categories = "SELECT * FROM `categories` WHERE `cat_id` = '$cat_id'";
                                $fetch_categories_query = mysqli_query($conn, $fetch_categories);
                                while($categories = mysqli_fetch_assoc($fetch_categories_query)) :
                            ?>
                            <strong>Product Category:</strong>
                            <span><?php echo $categories['cat_name']; ?></span>
                            <?php endwhile; ?>
                        </div><!--product-meta-category-->
                        <div class="product-meta-sub-category mb-2">
                            <?php 
                                $sub_cat_id = $product['product_sub_category'];
                                $fetch_sub_categories = "SELECT * FROM `sub_categories` WHERE `sub_cat_id` = '$sub_cat_id'";
                                $fetch_sub_categories_query = mysqli_query($conn, $fetch_sub_categories);
                                while($sub_categories = mysqli_fetch_assoc($fetch_sub_categories_query)) :
                            ?>
                            <strong>Product Sub Category:</strong>
                            <span><?php echo $sub_categories['sub_cat_title']; ?></span>
                            <?php endwhile; ?>
                        </div><!--product-meta-sub-category-->
                    </div><!--product-meta-->
                </div><!--col-lg-7-->
            </div><!--row-->

            <div class="row my-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Specifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                Reviews 
                                <?php
                                    $count_review = "SELECT COUNT(review_id) AS total_reviews FROM `product_reviews` WHERE `product_id` = '$product_id'";
                                    $count_review_query = mysqli_query($conn, $count_review);
                                    while($review = mysqli_fetch_assoc($count_review_query)) :
                                        echo '(' . $review['total_reviews'] . ')';
                                    endwhile;
                                ?>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content bg-light" id="pills-tabContent">
                        <div class="tab-pane fade p-4 show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <h3 class=" mb-3">Description:</h3>
                            <p class="mb-0">
                                <?php
                                    if($product['product_description'] != "") {
                                        echo $product['product_description'];
                                    } else {
                                ?>
                                <?php echo $product['product_title']; ?> has no description...
                                <?php } ?>
                            </p>
                        </div><!--tab-pane-->
                        <div class="tab-pane fade p-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <h3 class=" mb-3">Specifications of Dabur Amla Hair Oil -100ml</h3>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>SKU</td>
                                        <td><?php echo $product['product_SKU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Weight</td>
                                        <td><?php echo $product['product_weight']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td><?php echo $product['product_shipping']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td><?php echo $product['product_tax']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--tab-pane-->
                        <div class="tab-pane fade p-4" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <h3 class=" border-bottom pb-4">
                                <?php echo $product['product_title']; ?> has 
                                <?php
                                    $count_review = "SELECT COUNT(review_id) AS total_reviews FROM `product_reviews` WHERE `product_id` = '$product_id'";
                                    $count_review_query = mysqli_query($conn, $count_review);
                                    while($review = mysqli_fetch_assoc($count_review_query)) {
                                        echo $review['total_reviews'];
                                    }
                                ?>
                                reviews.
                            </h3>
                            <div class="customier-review my-3">
                                <ul class="list-unstyled commentlist">
                                    <?php
                                        $fetch_review = "SELECT * FROM `product_reviews` WHERE `product_id` = '$product_id'";
                                        $fetch_review_query = mysqli_query($conn, $fetch_review);
                                        while($all_review = mysqli_fetch_assoc($fetch_review_query)) {
                                    ?>
                                    <li class="comment">
                                        <div class="comment-inner d-flex my-3">
                                            <div class="comment-avatar">
                                                <img src="img/default.png" alt="user" class="rounded-circle" width="80">
                                            </div><!--comment-avatar-->
                                            <div class="comment-content px-3">
                                                <div class="comment-meta">
                                                    <div class="review-ratings">
                                                        <span class="star-cb-group">
                                                            <?php
                                                                $total = $all_review['rating'];

                                                                for($i = 1; $i < $total + 1; $i++) {
                                                            ?>
                                                            <input type="radio" checked="checked" /><label for="rating">Rating</label>
                                                            <?php } ?>
                                                        </span>
                                                    </div><!--review-ratings-->
                                                  <span class="comment-author text-success fw-bold"><?php echo $all_review['username']; ?></span>
                                                </div><!--comment-meta-->
                                                <div class="text">
                                                    <div class="comment-text">
                                                        <p><?php echo $all_review['user_review']; ?></p>
                                                    </div><!--comment-text-->
                                                </div><!--text-->
                                            </div><!--comment-content-->
                                        </div><!--comment-inner-->
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div><!--customier-review-->
                            <div class="customier-review-form">
                                <?php
                                    if(isset($_POST['submit'])) {
                                        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
                                        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
                                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                                        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
                                        $user_review = mysqli_real_escape_string($conn, $_POST['user_review']);

                                        $add_review = "INSERT INTO `product_reviews`(`product_id`, `rating`, `username`, `user_email`, `user_review`) 
                                        VALUES ('$product_id','$rating','$username','$user_email','$user_review')";

                                        $add_review_query = mysqli_query($conn, $add_review);
                                    }
                                ?>
                                <form action="" method="post">
                                    <div class="star-rating">
                                        <h3 class="fw-bold">Add Your Review</h3>
                                        <p class="mb-0">Give Rating</p>
                                        <div class="review-ratings">
                                            <span class="star-cb-group">
                                                <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>
                                                <input type="radio" id="rating-4" name="rating" value="4" checked="checked" /><label for="rating-4">4</label>
                                                <input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>
                                                <input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>
                                                <input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>
                                                <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
                                            </span>
                                        </div><!--review-ratings-->
                                    </div><!--star-rating-->
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group my-2">
                                                <label for="username" class="form-label">Your Full Name:</label>
                                                <input type="text" class="form-control" name="username" placeholder="Name">
                                            </div><!--form-group-->
                                        </div><!--col-lg-6-->
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group my-2">
                                                <label for="user_email" class="form-label">Your Email:</label>
                                                <input type="email" class="form-control" name="user_email" placeholder="Email">
                                            </div><!--form-group-->
                                        </div><!--col-lg-6-->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group my-2">
                                                <label for="user_review" class="form-label">Your Review:</label>
                                                <textarea name="user_review" id="" cols="30" rows="10" class="form-control" placeholder="Enter your review here..."></textarea>
                                            </div><!--form-group-->
                                        </div><!--col-lg-12-->
                                    </div><!--row-->
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-primary btn-lg" name="submit">Submit</button>
                                </form>
                            </div><!--customier-review-form-->
                        </div><!--tab-pane-->
                    </div><!--tab-content-->
                </div><!--col-lg-12-->
            </div><!--row-->
        </div><!--container-->
    </section>
    <!-- view product section end -->

    <?php require_once 'template-parts/footer.php'; ?>
    <?php require_once 'template-parts/footer-links.php'; ?>

</body>
</html>
<?php endwhile; } ?>