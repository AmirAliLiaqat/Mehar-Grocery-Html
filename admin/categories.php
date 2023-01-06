<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Mehar Grocery</title>
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
                        <h1><?php echo (isset($_GET['result']) == "edit_cat") ? "Edit" : "Add" ?> Category</h1>
                        <?php 
                            require_once '../config.php';

                            // code for adding new category...
                            if(isset($_POST['add_category'])) {
                                $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                                $category_description = mysqli_real_escape_string($conn, $_POST['category_description']);

                                $add_category = "INSERT INTO `categories`(`cat_name`, `cat_description`) VALUES ('$category_name','$category_description')";
                                $add_category_query = mysqli_query($conn, $add_category) or die("Query Failed");

                                if($add_category_query) {
                                    $message[] = "Category added successfully...";
                                } else {
                                    $message[] = "There was a problem with adding new category!";
                                }
                            }

                            // code for updateing category...
                            if(isset($_POST['update_category'])) {
                                $cat_id =  $_GET['cat_id'];

                                $update_category_name = mysqli_real_escape_string($conn, $_POST['update_category_name']);
                                $update_category_description = mysqli_real_escape_string($conn, $_POST['update_category_description']);

                                $update_category = "UPDATE `categories` SET `cat_name`='$update_category_name',`cat_description`='$update_category_description' WHERE `cat_id` = '$cat_id'";
                                $update_category_query = mysqli_query($conn, $update_category) or die("Query Failed");

                                if($update_category_query) {
                                    $message[] = "Category updated successfully...";
                                } else {
                                    $message[] = "There was a problem with adding new category!";
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
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php 
                                    if(isset($_GET['cat_id'])) {
                                        $cat_id =  $_GET['cat_id'];

                                        $fetch_category = "SELECT * FROM `categories` WHERE `cat_id` = '$cat_id'";
                                        $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed!");

                                        while($row = mysqli_fetch_assoc($fetch_category_query)) {
                                ?>
                                <!-- code for updating form -->
                                <form action="" method="post">
                                    <div class="form-group mb-3">
                                        <label for="update_category_name" class="form-label fw-bold">Name:</label>
                                        <input type="text" name="update_category_name" class="form-control" value="<?php echo $row['cat_name']; ?>">
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="update_category_description" class="form-label fw-bold">Description:</label>
                                        <textarea name="update_category_description" rows="10" class="form-control"><?php echo $row['cat_description']; ?></textarea>
                                    </div><!--form-group-->
                                    <button class="btn btn-primary rounded-pill py-3 px-5" name="update_category" type="submit">Update Category</button>
                                </form>
                                <?php } } else { ?>
                                    <!-- code for adding form -->
                                    <form action="" method="post">
                                        <div class="form-group mb-3">
                                            <label for="category_name" class="form-label fw-bold">Name:</label>
                                            <input type="text" name="category_name" class="form-control">
                                        </div><!--form-group-->
                                        <div class="form-group mb-3">
                                            <label for="category_description" class="form-label fw-bold">Description:</label>
                                            <textarea name="category_description" rows="10" class="form-control"></textarea>
                                        </div><!--form-group-->
                                        <button class="btn btn-primary rounded-pill py-3 px-5" name="add_category" type="submit">Add Category</button>
                                    </form>
                                <?php } ?>
                            </div><!--col-lg-4-->
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center">
                                            <th>Sr#</th>
                                            <th class="text-start">Name</th>
                                            <th class="text-start">Description</th>
                                            <th>Products</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once '../config.php';
                                            $fetch_category = "SELECT * FROM `categories`";
                                            $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed");
                                            $sr = 1;

                                            if(mysqli_num_rows($fetch_category_query) > 0) {
                                                while($row = mysqli_fetch_assoc($fetch_category_query)) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $sr++; ?></td>
                                            <td class="text-start"><?php echo $row['cat_name']; ?></td>
                                            <td class="text-start"><?php echo substr_replace($row['cat_description'], '...', 30); ?></td>
                                            <td><?php echo $row['products']; ?></td>
                                            <td>
                                                <a class="btn btn-success rounded" href="categories.php?query=<?php echo sha1("Don't do inlegal activities"); ?>&result=edit_cat&cat_id=<?php echo $row['cat_id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&cat_id=<?php echo $row['cat_id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center fw-bold">No category found !!!</td>
                                                </tr>
                                            <?php } 
                                        ?>
                                    </tbody>
                                </table>
                            </div><!--col-lg-8-->
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