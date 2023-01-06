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

                            // Code for adding the new post...
                            if(isset($_POST['publish'])) {
                                $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
                                $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                                $product_excerpt = mysqli_real_escape_string($conn, $_POST['product_excerpt']);
                                $product_author = mysqli_real_escape_string($conn, $_POST['product_author']);
                                $product_status = mysqli_real_escape_string($conn, $_POST['product_status']);
                                date_default_timezone_set("Asia/Karachi");
                                $publish_date = date("M d Y");

                                if($product_description == '') {
                                    $product_description = "";
                                }

                                if($product_excerpt == '') {
                                    $product_excerpt = "";
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

                                $publish_post = "INSERT INTO `posts`(`featured_image`, `title`, `description`, `excerpt`, `author`, `status`, `publish_date`) 
                                VALUES ('$featured_image','$product_title','$product_description','$product_excerpt', '$product_author','$product_status','$publish_date')";

                                $publish_product_query = mysqli_query($conn, $publish_post) or die('Query Failed');
                            
                                if($publish_product_query) {
                                    $message[] = "Post publish successfully...";
                                } else {
                                    $message[] = "There was a problem to publishing the post...";
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
                        <h1>Add New Product</h1>
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
                                                    <option value="draft" selected>Draft</option>
                                                    <option value="publish">Publish</option>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_category" class="form-label">Select Category:</label>
                                                <select name="product_category" class="form-select">
                                                    <option value="draft" selected>Draft</option>
                                                    <option value="publish">Publish</option>
                                                </select>
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label for="product_sub_category" class="form-label">Select Sub Category:</label>
                                                <select name="product_sub_category" class="form-select">
                                                    <option value="draft" selected>Draft</option>
                                                    <option value="publish">Publish</option>
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
                                                <input type="text" name="product_stock_qty" class="form-control">
                                            </div><!--form-group-->
                                        </div><!--col-6-->
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_stock_status">Stock Status:</label>
                                                <select name="product_stock_status" class="form-select">
                                                    <option value="0" selected>In stock</option>
                                                    <option value="1">Out of stock</option>
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
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="product_dimensions">Dimensions (cm):</label>
                                                <input type="text" name="product_length" placeholder="Length" style="width: 15%;">
                                                <input type="text" name="product_width" placeholder="Width" style="width: 15%;">
                                                <input type="text" name="product_height" placeholder="Height" style="width: 15%;">
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
                                        <input type="text" name="product_reqular_price" class="form-control">
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
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>