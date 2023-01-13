<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add & Edit Products - Mehar Grocery</title>
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
                        <?php 
                            require_once '../config.php';
                            // error_reporting(0);

                            // Code for adding the new product...
                            if(isset($_POST['add_product'])) {
                                $product_code = uniqid();
                                $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
                                $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                                $product_brand = mysqli_real_escape_string($conn, $_POST['product_brand']);
                                $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
                                $product_sub_category = mysqli_real_escape_string($conn, $_POST['product_sub_category']);
                                $product_stock_qty = mysqli_real_escape_string($conn, $_POST['product_stock_qty']);
                                $product_stock_status = mysqli_real_escape_string($conn, $_POST['product_stock_status']);
                                $product_weight = mysqli_real_escape_string($conn, $_POST['product_weight']);
                                $product_shipping = mysqli_real_escape_string($conn, $_POST['product_shipping']);
                                $product_status = mysqli_real_escape_string($conn, $_POST['product_status']);
                                $product_author = mysqli_real_escape_string($conn, $_POST['product_author']);
                                $product_SKU = mysqli_real_escape_string($conn, $_POST['product_SKU']);
                                $product_reqular_price = mysqli_real_escape_string($conn, $_POST['product_reqular_price']);
                                $product_sale_price = mysqli_real_escape_string($conn, $_POST['product_sale_price']);
                                $product_tax = mysqli_real_escape_string($conn, $_POST['product_tax']);
                                date_default_timezone_set("Asia/Karachi");
                                $publish_date = date("d, M Y");

                                if($product_description == '') {
                                    $product_description = "";
                                }

                                if(isset($_FILES['featured_image']['name'])) {
                                    $featured_image = $_FILES['featured_image']['name'];
                                    // Auto rename image
                                    $ext = end(explode('.',$featured_image));
                                    // Rename the image
                                    $featured_image = "product_".rand(00,99).'.'.$ext;
                                    $source_path = $_FILES['featured_image']['tmp_name'];
                                    $destination_path = "../upload-images/".$featured_image;
    
                                    // Finally upload the image
                                    $upload = move_uploaded_file($source_path, $destination_path);
                                } else {
                                    $featured_image = "";
                                }

                                // if(isset($product_category)) { $cat_id = $product_category; } else { $cat_id = 0;}
                                // $add_product_category = "SELECT COUNT(`product_id`) AS cat_product_count FROM `products` WHERE `product_category` = '$cat_id'";
                                // $add_product_category_query = mysqli_query($conn, $add_product_category) or die("Query Failed");

                                // while($cat_product = mysqli_fetch_assoc($add_product_category_query)) :
                                //     $cat_products = $cat_product['cat_product_count'];
                                //     $update_category = "UPDATE `categories` SET `products`='$cat_products' WHERE `cat_id` = $cat_id";
                                //     $update_category_query = mysqli_query($conn, $update_category) or die("Problem to adding product in category...");
                                // endwhile;

                                // if(isset($product_sub_category)) { $sub_cat_id = $product_sub_category; } else { $sub_cat_id = 0; }
                                // $add_product_sub_category = "SELECT COUNT(`product_id`) AS sub_cat_product_count FROM `products` WHERE `product_sub_category` = '$sub_cat_id'";
                                // $add_product_sub_category_query = mysqli_query($conn, $add_product_sub_category) or die("Query Failed");

                                // while($sub_cat_product = mysqli_fetch_assoc($add_product_sub_category_query)) :
                                //     $sub_cat_products = $sub_cat_product['sub_cat_product_count'];
                                //     $update_sub_category = "UPDATE `sub_categories` SET `cat_products`='$sub_cat_products' WHERE `sub_cat_id` = $sub_cat_id";
                                //     $update_sub_category_query = mysqli_query($conn, $update_sub_category) or die("Problem to adding product in category...");
                                // endwhile;

                                $publish_product = "INSERT INTO `products`(`product_code`, `featured_image`, `product_title`, `product_description`, `product_brand`, `product_category`, `product_sub_category`, `product_stock_qty`, `product_stock_status`, `product_weight`, `product_shipping`,`product_status`, `product_author`, `product_SKU`, `product_reqular_price`, `product_sale_price`, `product_tax`, `publish_date`) 
                                VALUES ('$product_code','$featured_image','$product_title','$product_description','$product_brand','$product_category','$product_sub_category','$product_stock_qty','$product_stock_status','$product_weight','$product_shipping','$product_status','$product_author','$product_SKU','$product_reqular_price','$product_sale_price','$product_tax','$publish_date')";

                                $publish_product_query = mysqli_query($conn, $publish_product) or die('Query Failed');
                            
                                if($publish_product_query) {
                                    $message[] = "Product added successfully...";
                                } else {
                                    $message[] = "There was a problem to adding the product...";
                                }
                            }

                            // Code for updating the product...
                            if(isset($_POST['update_product'])) {
                                $product_id = $_GET['product_id'];
                                $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
                                $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                                $product_brand = mysqli_real_escape_string($conn, $_POST['product_brand']);
                                $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
                                $product_sub_category = mysqli_real_escape_string($conn, $_POST['product_sub_category']);
                                $product_stock_qty = mysqli_real_escape_string($conn, $_POST['product_stock_qty']);
                                $product_stock_status = mysqli_real_escape_string($conn, $_POST['product_stock_status']);
                                $product_weight = mysqli_real_escape_string($conn, $_POST['product_weight']);
                                $product_shipping = mysqli_real_escape_string($conn, $_POST['product_shipping']);
                                $product_status = mysqli_real_escape_string($conn, $_POST['product_status']);
                                $product_SKU = mysqli_real_escape_string($conn, $_POST['product_SKU']);
                                $product_reqular_price = mysqli_real_escape_string($conn, $_POST['product_reqular_price']);
                                $product_sale_price = mysqli_real_escape_string($conn, $_POST['product_sale_price']);
                                $product_tax = mysqli_real_escape_string($conn, $_POST['product_tax']);
                                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                                $update_by = mysqli_real_escape_string($conn, $_POST['update_by']);
                                date_default_timezone_set("Asia/Karachi");
                                $update_date = date("d, M Y");

                                if($product_description == '') {
                                    $product_description = "";
                                }

                                if(isset($_FILES['featured_image']['name'])) { 
                                    $featured_image = $_FILES['featured_image']['name'];
                                
                                    if($featured_image != "") {
                                        // Auto rename image
                                        $ext = end(explode('.',$featured_image));
                                        // Rename the image
                                        $featured_image = "product_".rand(00,99).'.'.$ext;
                                        $source_path = $_FILES['featured_image']['tmp_name'];
                                        $destination_path = "../upload-images/".$featured_image;
                                
                                        // Finally upload the image
                                        $upload = move_uploaded_file($source_path, $destination_path);
                                
                                        if($current_image != "") {
                                            // Remove the current image
                                            $remove_path = "../upload-images/".$current_image;
                                            $remove_image = unlink($remove_path);
                                        }
                                
                                    } else {
                                        $featured_image = $current_image;
                                    }
                                    
                                } else {
                                    $featured_image = $current_image;
                                }

                                $update_product = "UPDATE `products` SET `featured_image`='$featured_image',`product_title`='$product_title',`product_description`='$product_description',`product_brand`='$product_brand',`product_category`='$product_category',`product_sub_category`='$product_sub_category',`product_stock_qty`='$product_stock_qty',`product_stock_status`='$product_stock_status',`product_weight`='$product_weight',`product_shipping`='$product_shipping',`product_status`='$product_status',`product_SKU`='$product_SKU',`product_reqular_price`='$product_reqular_price',`product_sale_price`='$product_sale_price',`product_tax`='$product_tax',`update_by`='$update_by',`update_date`='$update_date' WHERE `product_id` = '$product_id'";

                                $update_product_query = mysqli_query($conn, $update_product) or die('Query Failed');
                            
                                if($update_product_query) {
                                    $message[] = "<span class='text-success'>Product updated successfully...</span>";
                                } else {
                                    $message[] = "<span class='text-danger'>There was a problem to updating the product...</span>";
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
                        <h1><?php echo (isset($_GET['query']) == "edit_product") ? "Edit" : "Add New" ?> Product</h1>
                        <?php
                            if(isset($_GET['product_id'])) {
                                $product_id = $_GET['product_id'];
                        ?>
                        <!-- code for updating product -->
                        <form class="row" method="post" enctype="multipart/form-data">
                            <?php
                                $fetch_products = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
                                $fetch_products_query = mysqli_query($conn, $fetch_products) or die("Query Failed");
                                while($row = mysqli_fetch_assoc($fetch_products_query)) :
                            ?>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <input type="text" class="form-control fw-bold" name="product_title" placeholder="Enter title here" value="<?php echo $row['product_title']; ?>"><br>
                                <textarea name="product_description" class="form-control" placeholder="Description" rows="10"><?php echo $row['product_description']; ?></textarea><br>
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>More Details</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_brand" class="form-label">Select Brand:</label>
                                                <select name="product_brand" class="form-select">
                                                    <option value="">--select brand--</option>
                                                    <?php
                                                        $fetch_brands = "SELECT * FROM `brands`";
                                                        $fetch_brands_query = mysqli_query($conn, $fetch_brands) or die("Query Failed");

                                                        while($brands = mysqli_fetch_assoc($fetch_brands_query)) :
                                                    ?>
                                                    <option <?php if($row['product_brand'] == $brands['brand_id']) {echo "selected";} ?> value="<?php echo $brands['brand_id']; ?>"><?php echo $brands['brand_title']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_category" class="form-label">Select Category:</label>
                                                <select name="product_category" class="form-select" required>
                                                    <option value="">--select category--</option>
                                                    <?php
                                                        $fetch_categories = "SELECT * FROM `categories`";
                                                        $fetch_categories_query = mysqli_query($conn, $fetch_categories) or die("Query Failed");

                                                        while($categories = mysqli_fetch_assoc($fetch_categories_query)) :
                                                    ?>
                                                    <option <?php if($row['product_category'] == $categories['cat_id']) {echo "selected";} ?> value="<?php echo $categories['cat_id']; ?>"><?php echo $categories['cat_name']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_sub_category" class="form-label">Select Sub Category:</label>
                                                <select name="product_sub_category" class="form-select">
                                                    <option value="">--select sub category--</option>
                                                    <?php
                                                        $fetch_sub_categories = "SELECT * FROM `sub_categories`";
                                                        $fetch_sub_categories_query = mysqli_query($conn, $fetch_sub_categories) or die("Query Failed");

                                                        while($sub_categories = mysqli_fetch_assoc($fetch_sub_categories_query)) :
                                                    ?>
                                                    <option <?php if($row['product_sub_category'] == $sub_categories['sub_cat_id']) {echo "selected";} ?> value="<?php echo $sub_categories['sub_cat_id']; ?>"><?php echo $sub_categories['sub_cat_title']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Inventory</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_stock_qty">Stock Qty:</label>
                                                <input type="text" name="product_stock_qty" class="form-control" value="<?php echo $row['product_stock_qty']; ?>" required>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_stock_status">Stock Status:</label>
                                                <select name="product_stock_status" class="form-select" required>
                                                    <option <?php if($row['product_stock_status'] == '0') {echo "selected";} ?> value="0">Out of stock</option>
                                                    <option <?php if($row['product_stock_status'] == '1') {echo "selected";} ?> value="1">In stock</option>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Shipping</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_weight">Weight (kg):</label>
                                                <input type="text" name="product_weight" class="form-control" value="<?php echo $row['product_weight']; ?>">
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_shipping">Shipping Fee:</label>
                                                <input type="text" name="product_shipping" class="form-control" value="<?php echo $row['product_shipping']; ?>">
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                            </div><!--col-lg-8-->
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Publish</h3>
                                    <div class="form-group mb-2">
                                        <label for="product_status" class="form-label">Status:</label>
                                        <select name="product_status" class="form-select">
                                            <option <?php if($row['product_status'] == 'draft') {echo "selected";} ?> value="draft" selected>Draft</option>
                                            <option <?php if($row['product_status'] == 'publish') {echo "selected";} ?> value="publish">Publish</option>
                                        </select>
                                    </div><!--form-group-->
                                    <div class="form-group">
                                        <label for="update_by" class="form-label">Update by: </label>
                                        <input type="hidden" class="text-lowercase form-control" name="update_by" value="<?php echo $_SESSION['fname']; ?>">
                                        <span class="text-lowercase"><?php echo $_SESSION['fname']; ?></span>
                                    </div><!--form-group-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Featured Image</h3>
                                    <img src="../upload-images/<?php echo $row['featured_image']; ?>" width="100%">
                                    <input type="file" name="featured_image" class="form-control">
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Pricing</h3>
                                    <div class="form-group mb-3">
                                        <label for="product_SKU">SKU:</label>
                                        <input type="text" name="product_SKU" class="form-control" value="<?php echo $row['product_SKU']; ?>">
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_reqular_price">Regular Price:</label>
                                        <input type="text" name="product_reqular_price" class="form-control" value="<?php echo $row['product_reqular_price']; ?>" required>
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_sale_price">Sale Price:</label>
                                        <input type="text" name="product_sale_price" class="form-control" value="<?php echo $row['product_sale_price']; ?>">
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_tax">Tax:</label>
                                        <select name="product_tax" class="form-select">
                                            <option <?php if($row['product_tax'] == '0') {echo "selected";} ?> value="0" selected>None</option>
                                            <option <?php if($row['product_tax'] == '10%') {echo "selected";} ?> value="10%">10% of price</option>
                                            <option <?php if($row['product_tax'] == '20%') {echo "selected";} ?> value="20%">20% of price</option>
                                            <option <?php if($row['product_tax'] == '30%') {echo "selected";} ?> value="30%">30% of price</option>
                                            <option <?php if($row['product_tax'] == '50%') {echo "selected";} ?> value="50%">50% of price</option>
                                        </select>
                                    </div><!--form-group-->
                                </div><!--widget-->
                                <input type="hidden" name="current_image" value="<?php echo $row['featured_image'] ?>">
                                <button class="btn btn-primary rounded-pill float-end py-3 px-5" name="update_product" type="submit">Update Product</button>
                            </div><!--col-lg-4-->
                            <?php endwhile; ?>
                        </form>
                        <?php } else { ?>
                        <!-- code for adding product -->
                        <form class="row" method="post" enctype="multipart/form-data">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <input type="text" class="form-control fw-bold" name="product_title" placeholder="Enter title here" required><br>
                                <textarea name="product_description" class="form-control" placeholder="Description" rows="10"></textarea><br>
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>More Details</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_brand" class="form-label">Select Brand:</label>
                                                <select name="product_brand" class="form-select">
                                                    <option value="">--select brand--</option>
                                                    <?php
                                                        $fetch_brands = "SELECT * FROM `brands`";
                                                        $fetch_brands_query = mysqli_query($conn, $fetch_brands) or die("Query Failed");

                                                        while($brands = mysqli_fetch_assoc($fetch_brands_query)) :
                                                    ?>
                                                    <option value="<?php echo $brands['brand_id']; ?>"><?php echo $brands['brand_title']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_category" class="form-label">Select Category:</label>
                                                <select name="product_category" class="form-select" required>
                                                    <option value="">--select category--</option>
                                                    <?php
                                                        $fetch_categories = "SELECT * FROM `categories`";
                                                        $fetch_categories_query = mysqli_query($conn, $fetch_categories) or die("Query Failed");

                                                        while($categories = mysqli_fetch_assoc($fetch_categories_query)) :
                                                    ?>
                                                    <option value="<?php echo $categories['cat_id']; ?>"><?php echo $categories['cat_name']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_sub_category" class="form-label">Select Sub Category:</label>
                                                <select name="product_sub_category" class="form-select">
                                                    <option value="">--select sub category--</option>
                                                    <?php
                                                        $fetch_sub_categories = "SELECT * FROM `sub_categories`";
                                                        $fetch_sub_categories_query = mysqli_query($conn, $fetch_sub_categories) or die("Query Failed");

                                                        while($sub_categories = mysqli_fetch_assoc($fetch_sub_categories_query)) :
                                                    ?>
                                                    <option value="<?php echo $sub_categories['sub_cat_id']; ?>"><?php echo $sub_categories['sub_cat_title']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Inventory</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_stock_qty">Stock Qty:</label>
                                                <input type="text" name="product_stock_qty" class="form-control" required>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_stock_status">Stock Status:</label>
                                                <select name="product_stock_status" class="form-select" required>
                                                    <option value="0">Out of stock</option>
                                                    <option value="1" selected>In stock</option>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Shipping</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_weight">Weight (kg):</label>
                                                <input type="text" name="product_weight" class="form-control">
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_shipping">Shipping Fee:</label>
                                                <input type="text" name="product_shipping" class="form-control">
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                    </div><!--row-->
                                </div><!--widget-->
                            </div><!--col-lg-8-->
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Publish</h3>
                                    <div class="form-group mb-2">
                                        <label for="product_status" class="form-label">Status:</label>
                                        <select name="product_status" class="form-select">
                                            <option value="draft" selected>Draft</option>
                                            <option value="publish">Publish</option>
                                        </select>
                                    </div><!--form-group-->
                                    <div class="form-group">
                                        <label for="product_author" class="form-label">Author: </label>
                                        <input type="hidden" class="text-lowercase form-control" name="product_author" value="<?php echo $_SESSION['fname']; ?>">
                                        <span class="text-lowercase"><?php echo $_SESSION['fname']; ?></span>
                                    </div><!--form-group-->
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Featured Image</h3>
                                    <input type="file" name="featured_image" class="form-control">
                                </div><!--widget-->
                                <div class="widget border bg-white p-3 mb-3">
                                    <h3>Pricing</h3>
                                    <div class="form-group mb-3">
                                        <label for="product_SKU">SKU:</label>
                                        <input type="text" name="product_SKU" class="form-control">
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_reqular_price">Regular Price:</label>
                                        <input type="text" name="product_reqular_price" class="form-control" required>
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_sale_price">Sale Price:</label>
                                        <input type="text" name="product_sale_price" class="form-control">
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="product_tax">Tax:</label>
                                        <select name="product_tax" class="form-select">
                                            <option value="0" selected>None</option>
                                            <option value="10%">10% of price</option>
                                            <option value="20%">20% of price</option>
                                            <option value="30%">30% of price</option>
                                            <option value="50%">50% of price</option>
                                        </select>
                                    </div><!--form-group-->
                                </div><!--widget-->
                                <button class="btn btn-primary rounded-pill float-end py-3 px-5" name="add_product" type="submit">Add Product</button>
                            </div><!--col-lg-4-->
                        </form>
                        <?php } ?>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>