<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Mehar Grocery</title>
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
                        <h1>Add Brands</h1>
                        <?php 
                            require_once '../config.php';

                            // code for adding new brand...
                            if(isset($_POST['add_brand'])) {
                                $brand_title = mysqli_real_escape_string($conn, $_POST['brand_title']);
                                $brand_category = mysqli_real_escape_string($conn, $_POST['brand_category']);

                                $add_brand = "INSERT INTO `brands`(`brand_title`, `brand_cat`) 
                                VALUES ('$brand_title','$brand_category')";
                                $add_brand_query = mysqli_query($conn, $add_brand) or die("Query Failed");

                                if($add_brand_query) {
                                    $message[] = "<span class='text-success'>Brand added successfully...</span>";
                                } else {
                                    $message[] = "<span class='text-danger'>There was a problem with adding new brand!</span>";
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- code for adding form -->
                                <form class="row" method="post">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label for="brand_title" class="form-label fw-bold">Title:</label>
                                            <input type="text" name="brand_title" class="form-control">
                                        </div><!--form-group-->
                                    </div><!--col-6-->
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label for="brand_category" class="form-label fw-bold">Category:</label>
                                            <select name="brand_category" class="form-select" required>
                                                <option selected>--select parent category--</option>
                                                <?php
                                                    $fetch_category = "SELECT * FROM `categories`";
                                                    $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed");
                                                    $sr = 1;

                                                    while($category = mysqli_fetch_assoc($fetch_category_query)) :
                                                ?>
                                                <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                                                <?php endwhile;?>
                                            </select>
                                        </div><!--form-group-->
                                    </div><!--col-6-->
                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary rounded-pill py-3 px-5" name="add_brand" type="submit">Add Brand</button>
                                    </div><!--col-12-->
                                </form>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-start">
                                            <th>Sr#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once '../config.php';
                                            $fetch_brand = "SELECT * FROM `brands`";
                                            $fetch_brand_query = mysqli_query($conn, $fetch_brand) or die("Query Failed");
                                            $sr = 1;

                                            if(mysqli_num_rows($fetch_brand_query) > 0) {
                                                while($row = mysqli_fetch_assoc($fetch_brand_query)) {
                                        ?>
                                        <tr class="text-start">
                                            <td><?php echo $sr++; ?></td>
                                            <td><?php echo $row['brand_title']; ?></td>
                                            <td>
                                                <?php
                                                    $category_id = $row['brand_cat'];
                                                    $fetch_category = "SELECT `cat_name` FROM `categories` WHERE `cat_id` = '$category_id'";
                                                    $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed");
    
                                                    while($category = mysqli_fetch_assoc($fetch_category_query)) :
                                                        echo $category['cat_name'];
                                                    endwhile;
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success rounded" href="categories.php?query=<?php echo sha1("Don't do inlegal activities"); ?>&result=edit_brand&brand_id=<?php echo $row['brand_id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&brand_id=<?php echo $row['brand_id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center fw-bold">No brand found !!!</td>
                                                </tr>
                                            <?php } 
                                        ?>
                                    </tbody>
                                </table>
                            </div><!--col-lg-12-->
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