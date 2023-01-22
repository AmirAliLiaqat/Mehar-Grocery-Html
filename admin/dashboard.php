<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mehar Grocery</title>
    <?php require_once 'header_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once '../config.php';
        if(!isset($_SESSION['fname'])) {
            header('location: ../login.php');
        }
    ?>

    <section class="admin_section section_content wow fadeInUP">
        <div class="container-fluid">
            <div class="main_content">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12" id="admin_menu">
                        <?php require_once 'sidebar.php'; ?>
                    </div><!--col-lg-2-->
                    <div class="col-lg-10 col-md-01 col-sm-12 admin_content p-3">
                        <div class="row p-3">
                            <h1>Dashboard:</h1>
                            <div class="col-md-8 col-sm-12">
                                <div class="row">
                                    <!-- admin users -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_admin_users = "SELECT COUNT(id) AS admin FROM `users` WHERE `status` = 'admin'";
                                            $fetch_admin_users_query = mysqli_query($conn, $fetch_admin_users) or die("Query Failed");
                                            while($admin_users = mysqli_fetch_assoc($fetch_admin_users_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Admin Users</h2>
                                            <h3 class="text-success"><?php echo number_format($admin_users['admin']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- normal users -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_normal_users = "SELECT COUNT(id) AS normal FROM `users` WHERE `status` = 'user'";
                                            $fetch_normal_users_query = mysqli_query($conn, $fetch_normal_users) or die("Query Failed");
                                            while($normal_users = mysqli_fetch_assoc($fetch_normal_users_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Normal Users</h2>
                                            <h3 class="text-success"><?php echo number_format($normal_users['normal']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- messages -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_messages = "SELECT COUNT(id) AS message FROM `messages`";
                                            $fetch_messages_query = mysqli_query($conn, $fetch_messages) or die("Query Failed");
                                            while($messages = mysqli_fetch_assoc($fetch_messages_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Messages</h2>
                                            <h3 class="text-success"><?php echo number_format($messages['message']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- posts -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_posts = "SELECT COUNT(id) AS post FROM `posts`";
                                            $fetch_posts_query = mysqli_query($conn, $fetch_posts) or die("Query Failed");
                                            while($posts = mysqli_fetch_assoc($fetch_posts_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Posts</h2>
                                            <h3 class="text-success"><?php echo number_format($posts['post']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- products -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_products = "SELECT COUNT(product_id) AS product FROM `products`";
                                            $fetch_products_query = mysqli_query($conn, $fetch_products) or die("Query Failed");
                                            while($products = mysqli_fetch_assoc($fetch_products_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Products</h2>
                                            <h3 class="text-success"><?php echo number_format($products['product']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- orders -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_orders = "SELECT COUNT(order_id) AS order_count FROM `orders`";
                                            $fetch_orders_query = mysqli_query($conn, $fetch_orders) or die("Query Failed");
                                            while($orders = mysqli_fetch_assoc($fetch_orders_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Orders</h2>
                                            <h3 class="text-success"><?php echo number_format($orders['order_count']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- brands -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_brands = "SELECT COUNT(brand_id) AS brand FROM `brands`";
                                            $fetch_brands_query = mysqli_query($conn, $fetch_brands) or die("Query Failed");
                                            while($brands = mysqli_fetch_assoc($fetch_brands_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Brands</h2>
                                            <h3 class="text-success"><?php echo number_format($brands['brand']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- categories -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_categories = "SELECT COUNT(cat_id) AS category FROM `categories`";
                                            $fetch_categories_query = mysqli_query($conn, $fetch_categories) or die("Query Failed");
                                            while($categories = mysqli_fetch_assoc($fetch_categories_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Categories</h2>
                                            <h3 class="text-success"><?php echo number_format($categories['category']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                    <!-- sub categories -->
                                    <div class="col-md-6 col-sm-12">
                                        <?php 
                                            $fetch_sub_categories = "SELECT COUNT(sub_cat_id) AS sub_category FROM `sub_categories`";
                                            $fetch_sub_categories_query = mysqli_query($conn, $fetch_sub_categories) or die("Query Failed");
                                            while($sub_categories = mysqli_fetch_assoc($fetch_sub_categories_query)) {
                                        ?>
                                        <div class="col-inner text-center bg-light my-2 p-3">
                                            <h2 class="fw-bold">Sub Categories</h2>
                                            <h3 class="text-success"><?php echo number_format($sub_categories['sub_category']); ?></h3>
                                        </div><!--col-inner-->
                                        <?php } ?>
                                    </div><!--col-md-6-->
                                </div><!--row-->
                            </div><!--col-md-8-->
                            <div class="col-md-4 col-sm-12">
                                <!-- total summary card -->
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <h3 class="text-white">Total Summary <i class="fas fa-plus float-end" id="total_summary"></i></h3>
                                    </div><!--card-header-->
                                    <div class="card-body" id="total_summary_body">
                                        <?php 
                                            $fetch_total_amount = "SELECT * FROM
                                            (SELECT SUM(total_amount) AS A FROM `orders`)A,
                                            (SELECT SUM(total_amount) AS B FROM `orders` WHERE `payment_method` = 'cash on delivery')B,
                                            (SELECT SUM(total_amount) AS C FROM `orders` WHERE `payment_method` = 'bank transfer')C,
                                            (SELECT SUM(total_amount) AS D FROM `orders` WHERE `payment_method` = 'credit card')D,
                                            (SELECT SUM(total_amount) AS H FROM `orders` WHERE `payment_method` = 'mastercard')E,
                                            (SELECT SUM(total_amount) AS E FROM `orders` WHERE `payment_method` = 'paypal')F,
                                            (SELECT SUM(total_amount) AS F FROM `orders` WHERE `payment_method` = 'strip')G,
                                            (SELECT SUM(total_amount) AS G FROM `orders` WHERE `payment_method` = 'visa')H
                                            ";
                                            $fetch_total_amount_query = mysqli_query($conn, $fetch_total_amount) or die("Query Failed");
                                            while($total_summary = mysqli_fetch_assoc($fetch_total_amount_query)) {
                                        ?>
                                        <h5 class="card-title text-white mb-3">Amount Received: <?php echo number_format($total_summary['A']); ?></h5>
                                        <hr>
                                        <h5 class="card-title text-white mb-3">Cash on delivery: <?php echo number_format($total_summary['B']); ?></h5>
                                        <h5 class="card-title text-white mb-3">Bank Transfer: <?php echo number_format($total_summary['C']); ?></h5>
                                        <h5 class="card-title text-white mb-3">Credit Card: <?php echo number_format($total_summary['D']); ?></h5>
                                        <hr>
                                        <h5 class="card-title text-white mb-3">Mastercard: <?php echo number_format($total_summary['E']); ?></h5>
                                        <h5 class="card-title text-white mb-3">Paypal: <?php echo number_format($total_summary['F']); ?></h5>
                                        <h5 class="card-title text-white mb-3">Strip: <?php echo number_format($total_summary['G']); ?></h5>
                                        <h5 class="card-title text-white mb-3">Visa: <?php echo number_format($total_summary['H']); ?></h5>
                                        <?php } ?>
                                    </div><!--card-body-->
                                </div><!--card-->
                                <!-- current month summary card -->
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-header">
                                        <h3 class="text-white">Summary <?php echo date('M, Y'); ?> <i class="fas fa-plus float-end" id="month_summary"></i></h3>
                                    </div><!--card-header-->
                                    <div class="card-body" id="month_summary_body">
                                        <?php
                                            $current_month = date('m');
                                            $current_year = date('Y');
                                            $fetch_month_amount = "SELECT SUM(total_amount) AS month_total_amount FROM `orders` WHERE `order_date` BETWEEN date('01-$current_month-$current_year') AND date('30-$current_month-$current_year')";
                                            $fetch_month_amount_query = mysqli_query($conn, $fetch_month_amount) or die("Query Failed");
                                            while($month_amount = mysqli_fetch_assoc($fetch_month_amount_query)) {
                                        ?>
                                        <h5 class="card-title text-white">Amount Received: <?php echo number_format($month_amount['month_total_amount']); ?></h5>
                                        <?php } ?>
                                    </div><!--card-body-->
                                </div><!--card-->
                                <!-- user last login card -->
                                <div class="card text-white bg-secondary mb-3">
                                    <div class="card-header">
                                        <h3 class="text-white">User Last Login Stats <i class="fas fa-plus float-end" id="login_stats"></i></h3>
                                    </div><!--card-header-->
                                    <div class="card-body" id="login_stats_body">
                                        <?php 
                                            $fetch_normal_users = "SELECT * FROM `users`";
                                            $fetch_normal_users_query = mysqli_query($conn, $fetch_normal_users) or die("Query Failed");
                                            while($normal_users = mysqli_fetch_assoc($fetch_normal_users_query)) {
                                        ?>
                                        <h5 class="card-title text-white mb-3"><?php echo $normal_users['fname']; ?>: <?php echo $normal_users['last_login_details']; ?></h5>
                                        <?php } ?>
                                    </div><!--card-body-->
                                </div><!--card-->
                            </div><!--col-md-4-->
                        </div><!--row-->
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>