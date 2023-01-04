<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add & Edit Post - Mehar Grocery</title>
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
                            error_reporting(0);

                            // Code for adding the new post...
                            if(isset($_POST['publish'])) {
                                $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
                                $post_description = mysqli_real_escape_string($conn, $_POST['post_description']);
                                $post_excerpt = mysqli_real_escape_string($conn, $_POST['post_excerpt']);
                                $post_author = mysqli_real_escape_string($conn, $_POST['post_author']);
                                $post_status = mysqli_real_escape_string($conn, $_POST['post_status']);
                                date_default_timezone_set("Asia/Karachi");
                                $publish_date = date("M d Y");

                                if($post_description == '') {
                                    $post_description = "";
                                }

                                if($post_excerpt == '') {
                                    $post_excerpt = "";
                                }

                                if(isset($_FILES['featured_image']['name'])) {
                                    $featured_image = $_FILES['featured_image']['name'];
                                    // Auto rename image
                                    $ext = end(explode('.',$featured_image));
                                    // Rename the image
                                    $featured_image = "post_".rand(00,99).'.'.$ext;
                                    $source_path = $_FILES['featured_image']['tmp_name'];
                                    $destination_path = "../upload-images/".$featured_image;
    
                                    // Finally upload the image
                                    $upload = move_uploaded_file($source_path, $destination_path);
                                } else {
                                    $featured_image = "";
                                }

                                $publish_post = "INSERT INTO `posts`(`featured_image`, `title`, `description`, `excerpt`, `author`, `status`, `publish_date`) 
                                VALUES ('$featured_image','$post_title','$post_description','$post_excerpt', '$post_author','$post_status','$publish_date')";

                                $publish_post_query = mysqli_query($conn, $publish_post) or die('Query Failed');
                            
                                if($publish_post_query) {
                                    $message[] = "Post publish successfully...";
                                } else {
                                    $message[] = "There was a problem to publishing the post...";
                                }
                            }

                            // Code for updating the post...
                            if(isset($_POST['update'])) {
                                $updated_title = mysqli_real_escape_string($conn, $_POST['updated_title']);
                                $updated_description = mysqli_real_escape_string($conn, $_POST['updated_description']);
                                $updated_excerpt = mysqli_real_escape_string($conn, $_POST['updated_excerpt']);
                                $updated_author = mysqli_real_escape_string($conn, $_POST['updated_author']);
                                $updated_status = mysqli_real_escape_string($conn, $_POST['updated_status']);
                                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                                $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
                                date_default_timezone_set("Asia/Karachi");
                                $updated_date = date("M d Y");

                                if($updated_description == '') {
                                    $updated_description = "";
                                }

                                if($updated_excerpt == '') {
                                    $updated_excerpt = "";
                                }

                                if(isset($_FILES['featured_image']['name'])) { 
                                    $featured_image = $_FILES['featured_image']['name'];

                                    if($featured_image != "") {
                                        // Auto rename image
                                        $ext = end(explode('.',$featured_image));
                                        // Rename the image
                                        $featured_image = "post_".rand(00,99).'.'.$ext;
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

                                $update_post = "UPDATE `posts` SET `featured_image`='$featured_image',
                                `title`='$updated_title',`description`='$updated_description',
                                `excerpt`='$updated_excerpt',`author`='$updated_author',
                                `status`='$updated_status',`updated_date`='$updated_date' WHERE `id` = '$post_id'";

                                $update_post_query = mysqli_query($conn, $update_post) or die('Query Failed');
                            
                                if($update_post_query) {
                                    $message[] = "Post updated successfully...";
                                } else {
                                    $message[] = "There was a problem to updating the post...";
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
                        <?php
                            $post_id = $_GET['post_id'];

                            if(!isset($post_id)) { ?>
                                <h1>Add New Post</h1>
                                <form class="row" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <input type="text" class="form-control fw-bold" name="post_title" placeholder="Enter title here" required><br>
                                        <textarea name="post_description" class="form-control" placeholder="Description" rows="10"></textarea><br>
                                        <input type="text" class="form-control" name="post_excerpt" placeholder="Excerpt">
                                    </div><!--col-lg-8-->
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="widget border bg-white p-3 mb-3">
                                            <h3>Publish</h3>
                                            <div class="form-group mb-2">
                                                <label for="post_status" class="form-label">Status:</label>
                                                <select name="post_status" class="form-select">
                                                    <option value="draft" selected>Draft</option>
                                                    <option value="publish">Publish</option>
                                                </select>
                                            </div><!--form-group-->
                                            <div class="form-group">
                                                <label for="post_author" class="form-label">Author: </label>
                                                <input type="hidden" class="text-lowercase form-control" name="post_author" value="<?php echo $_SESSION['fname']; ?>">
                                                <span class="text-lowercase"><?php echo $_SESSION['fname']; ?></span>
                                            </div><!--form-group-->
                                        </div><!--widget-->
                                        <div class="widget border bg-white p-3 mb-3">
                                            <h3>Featured Image</h3>
                                            <input type="file" name="featured_image" class="form-control">
                                        </div><!--widget-->
                                    </div><!--col-lg-4-->
                                    <div class="col-12">
                                    <button class="btn btn-primary rounded-pill float-end py-3 px-5" name="publish" type="submit">Publish</button>
                                    </div><!--col-12-->
                                </form>
                            <?php
                            } else { ?>
                                <h1>Edit Post</h1>
                                <?php
                                    $fetch_post_data = "SELECT * FROM `posts` WHERE `id` = $post_id";
                                    $fetch_post_data_query = mysqli_query($conn, $fetch_post_data) or die("Query Failed");

                                    if(mysqli_num_rows($fetch_post_data_query) > 0) {
                                        while($row = mysqli_fetch_assoc($fetch_post_data_query)) {
                                ?>
                                <form class="row" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <input type="text" class="form-control fw-bold" name="updated_title" placeholder="Enter title here" value="<?php echo $row['title']; ?>" required><br>
                                        <textarea name="updated_description" class="form-control" placeholder="Description" rows="10" value="<?php echo $row['description']; ?>"></textarea><br>
                                        <input type="text" class="form-control" name="updated_excerpt" placeholder="Excerpt" value="<?php echo $row['excerpt']; ?>">
                                    </div><!--col-lg-8-->
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="widget border bg-white p-3 mb-3">
                                            <h3>Publish</h3>
                                            <div class="form-group mb-2">
                                                <label for="updated_status" class="form-label">Status:</label>
                                                <select name="updated_status" class="form-select">
                                                    <option <?php if($row['status']=='draft') {echo "selected";} ?> value="draft">Draft</option>
                                                    <option <?php if($row['status']=='publish') {echo "selected";} ?> value="publish">Publish</option>
                                                </select>
                                            </div><!--form-group-->
                                            <div class="form-group">
                                                <label for="updated_author" class="form-label">Update By: </label>
                                                <input type="hidden" class="text-lowercase form-control" name="updated_author" value="<?php echo $_SESSION['fname']; ?>">
                                                <span class="text-lowercase"><?php echo $_SESSION['fname']; ?></span>
                                            </div><!--form-group-->
                                        </div><!--widget-->
                                        <div class="widget border bg-white p-3 mb-3">
                                            <h3>Featured Image</h3>
                                            <div class="form-group mb-3">
                                                <label for="current_featured_img" class="form-label">Current Image: </label><br>
                                                <img src="../upload-images/<?php echo $row['featured_image']; ?>" width="330" height="200">
                                            </div><!--form-group-->
                                            <label for="featured_image" class="form-label">Select New Image: </label>
                                            <input type="file" name="featured_image" class="form-control">
                                        </div><!--widget-->
                                    </div><!--col-lg-4-->
                                    <div class="col-12">
                                        <input type="hidden" name="current_image" value="<?php echo $row['featured_image']; ?>">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                        <button class="btn btn-primary rounded-pill float-end py-3 px-5" name="update" type="submit">Update</button>
                                    </div><!--col-12-->
                                </form>
                                <?php 
                                        }
                                    }    
                                ?>
                            <?php
                            }
                        ?>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>