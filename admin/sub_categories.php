<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub Categories - Mehar Grocery</title>
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
                        <h1>Add Sub Category</h1>
                        <?php 
                            require_once '../config.php';

                            // code for adding new sub category...
                            if(isset($_POST['add_sub_category'])) {
                                $sub_category_title = mysqli_real_escape_string($conn, $_POST['sub_category_title']);
                                $sub_category_description = mysqli_real_escape_string($conn, $_POST['sub_category_description']);
                                $parent_category = mysqli_real_escape_string($conn, $_POST['parent_category']);

                                
                                $add_sub_category = "INSERT INTO `sub_categories`(`sub_cat_title`, `sub_cat_description`, `cat_parent`) 
                                VALUES ('$sub_category_title','$sub_category_description', '$parent_category')";
                                $add_sub_category_query = mysqli_query($conn, $add_sub_category) or die("Query Failed");

                                if($add_sub_category_query) {
                                    $message[] = "<span class='text-success'>Sub category added successfully...</span>";
                                } else {
                                    $message[] = "<span class='text-danger'>There was a problem with adding new sub category!</span>";
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
                                <!-- code for adding form -->
                                <form action="" method="post">
                                    <div class="form-group mb-3">
                                        <label for="sub_category_title" class="form-label fw-bold">Title:</label>
                                        <input type="text" name="sub_category_title" class="form-control" required>
                                    </div><!--form-group-->
                                    <div class="form-group mb-3">
                                        <label for="parent_category" class="form-label fw-bold">Parent Category:</label>
                                        <select name="parent_category" class="form-select" required>
                                            <option value="" selected>--select parent category--</option>
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
                                    <div class="form-group mb-3">
                                        <label for="sub_category_description" class="form-label fw-bold">Description:</label>
                                        <textarea name="sub_category_description" rows="10" class="form-control"></textarea>
                                    </div><!--form-group-->
                                    <button class="btn btn-primary rounded-pill py-3 px-5" name="add_sub_category" type="submit">Add Sub Category</button>
                                </form>
                            </div><!--col-lg-4-->
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center">
                                            <th>Sr#</th>
                                            <th class="text-start">Title</th>
                                            <th class="text-start">Description</th>
                                            <th class="text-start">Category</th>
                                            <th>Products</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $fetch_sub_category = "SELECT * FROM `sub_categories`";
                                            $fetch_sub_category_query = mysqli_query($conn, $fetch_sub_category) or die("Query Failed");
                                            $sr = 1;

                                            if(mysqli_num_rows($fetch_sub_category_query) > 0) {
                                                while($row = mysqli_fetch_assoc($fetch_sub_category_query)) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $sr++; ?></td>
                                            <td class="text-start"><?php echo $row['sub_cat_title']; ?></td>
                                            <td class="text-start"><?php echo substr_replace($row['sub_cat_description'], '...', 30); ?></td>
                                            <td class="text-start">
                                                <?php
                                                    $category_id = $row['cat_parent'];
                                                    $fetch_category = "SELECT `cat_name` FROM `categories` WHERE `cat_id` = '$category_id'";
                                                    $fetch_category_query = mysqli_query($conn, $fetch_category) or die("Query Failed");
    
                                                    while($category = mysqli_fetch_assoc($fetch_category_query)) :
                                                        echo $category['cat_name'];
                                                    endwhile;
                                                ?>
                                            </td>
                                            <td><?php echo $row['cat_products']; ?></td>
                                            <td>
                                                <a class="btn btn-success rounded" href="sub_categories.php?query=<?php echo sha1("Don't do inlegal activities"); ?>&result=edit_sub_cat&sub_cat_id=<?php echo $row['sub_cat_id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&sub_cat_id=<?php echo $row['sub_cat_id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center fw-bold">No sub category found !!!</td>
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