<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Mehar Grocery</title>
    <?php require_once 'header_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
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
                        <h1 class="mb-5">All Products <a href="add_and_edit_product.php" class="btn btn-primary rounded-pill float-end py-3 px-5">Add New</a></h1>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="table-dark text-center">
                                    <th>Sr#</th>
                                    <th class="text-start">Product Code</th>
                                    <th>Image</th>
                                    <th class="text-start">Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Stock Status</th>
                                    <th>Categories</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once '../config.php';

                                    //define total number of results you want per page  
                                    $results_per_page = 10;
                                
                                    //find the total number of results stored in the database  
                                    $query = "SELECT * FROM `products`";
                                    $result = mysqli_query($conn, $query);
                                    $number_of_result = mysqli_num_rows($result);
                                
                                    //determine the total number of pages available  
                                    $number_of_page = ceil ($number_of_result / $results_per_page);  
                                
                                    //determine which page number visitor is currently on  
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                    } else {  
                                        $page = 1;
                                    }  
                                
                                    //determine the sql LIMIT starting number for the results on the displaying page  
                                    $page_first_result = ($page-1) * $results_per_page;
                                    
                                    $fetch_products = "SELECT * FROM `products` LIMIT " . $page_first_result . ',' . $results_per_page;
                                    $fetch_products_query = mysqli_query($conn, $fetch_products) or die("Query Failed");
                                    $sr = 1;

                                    if(mysqli_num_rows($fetch_products_query) > 0) {
                                        while($row = mysqli_fetch_assoc($fetch_products_query)) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $sr++; ?></td>
                                    <td class="text-start"><?php echo $row['product_code']; ?></td>
                                    <td><img src="../upload-images/<?php echo $row['featured_image']; ?>" width="50" height="50" class="rounded"></td>
                                    <td class="text-start"><?php echo $row['product_title']; ?></td>
                                    <td><?php echo $row['product_reqular_price']; ?></td>
                                    <td><?php echo $row['product_stock_qty']; ?></td>
                                    <td>
                                        <?php 
                                            if($row['product_stock_status'] == '1') {
                                                echo "<span class='btn btn-primary rounded-pill py-1 px-3'>In stock</span>";
                                            } else {
                                                echo "<span class='btn btn-danger rounded-pill py-1 px-3'>Out of stock</span>";
                                            }
                                        ?>
                                    </td>
                                    <?php 
                                        $cat_id = $row['product_category'];
                                        $fetch_category = "SELECT `cat_name` FROM `categories` WHERE `cat_id` = '$cat_id'";
                                        $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed");

                                        while($category = mysqli_fetch_assoc($fetch_category_query)):
                                    ?>
                                    <td>
                                        <?php echo $category['cat_name']; ?></td>
                                    <?php endwhile; ?>
                                    <td><?php echo $row['publish_date']; ?></td>
                                    <td>
                                        <?php 
                                            if($row['product_status'] == 'publish') {
                                                echo "<span class='btn btn-primary rounded-pill py-1 px-3'>publish</span>";
                                            } else {
                                                echo "<span class='btn btn-danger rounded-pill py-1 px-3'>draft</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success rounded" href="add_and_edit_product.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&query=edit_product&product_id=<?php echo $row['product_id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&product_id=<?php echo $row['product_id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7" class="text-center fw-bold">No product found !!!</td>
                                        </tr>
                                    <?php } 
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                        <?php
                            if($page >= 2){ ?>
                                <a href="products.php?page=<?php echo $page-1; ?>" class="btn btn-success mx-2">Prev</a>
                            <?php }
                            for($page = 1; $page <= $number_of_page; $page++) { ?>
                                <a href="products.php?page=<?php echo $page; ?>" class="btn btn-success mx-2 <?php if($_GET["page"] == $page) echo "current" ?>"><?php echo $page; ?></a>
                            <?php }
                            if($page < $number_of_page){ ?>
                                <a href="products.php?page=<?php echo $page=1; ?>" class="btn btn-success mx-2">Next</a>
                            <?php }
                        ?>
                        </div><!--pagination-->
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>