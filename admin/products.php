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
                                    <th>Image</th>
                                    <th class="text-start">Name</th>
                                    <th>SKU</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Categories</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once '../config.php';
                                    $fetch_posts = "SELECT * FROM `posts`";
                                    $fetch_posts_query = mysqli_query($conn, $fetch_posts) or die("Query Failed");
                                    $sr = 1;

                                    if(mysqli_num_rows($fetch_posts_query) > 0) {
                                        while($row = mysqli_fetch_assoc($fetch_posts_query)) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $sr++; ?></td>
                                    <td><img src="../upload-images/<?php echo $row['featured_image']; ?>" width="50" height="50" class="rounded"></td>
                                    <td class="text-start"><?php echo $row['title']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $row['publish_date']; ?></td>
                                    <td>
                                        <?php 
                                            if($row['status'] == 'publish') {
                                                echo "<span class='btn btn-primary rounded-pill py-1 px-3'>publish</span>";
                                            } else {
                                                echo "<span class='btn btn-danger rounded-pill py-1 px-3'>draft</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success rounded" href="add_and_edit_post.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&post_id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&post_id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
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
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>