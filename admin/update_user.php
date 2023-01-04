<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Mehar Grocery</title>
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
            <div class="main_content text-white">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12" id="admin_menu">
                        <?php require_once 'sidebar.php'; ?>
                    </div><!--col-lg-2-->
                    <div class="col-lg-10 col-md-01 col-sm-12 admin_content p-3">
                        <h1>Update Profile</h1>
                        <?php
                            require_once '../config.php';

                            // Code for edit form
                            if(isset($_POST['update'])) {
                                $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $number = mysqli_real_escape_string($conn, $_POST['number']);
                                $country = mysqli_real_escape_string($conn, $_POST['country']);
                                $city = mysqli_real_escape_string($conn, $_POST['city']);
                                $zip = mysqli_real_escape_string($conn, $_POST['zip']);
                                $status = mysqli_real_escape_string($conn, $_POST['status']);
                                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                                $id = mysqli_real_escape_string($conn, $_POST['id']);

                                if(isset($_FILES['profile_pic']['name'])) { 
                                    $profile_pic = $_FILES['profile_pic']['name'];

                                    if($profile_pic != "") {
                                        // Auto rename image
                                        $ext = end(explode('.',$profile_pic));
                                        // Rename the image
                                        $profile_pic = "profile_pic_".rand(00,99).'.'.$ext;
                                        $source_path = $_FILES['profile_pic']['tmp_name'];
                                        $destination_path = "upload-images/".$profile_pic;

                                        // Finally upload the image
                                        $upload = move_uploaded_file($source_path, $destination_path);

                                        if($current_image != "") {
                                            // Remove the current image
                                            $remove_path = "upload-images/".$current_image;
                                            $remove_image = unlink($remove_path);
                                        }

                                    } else {
                                        $profile_pic = $current_image;
                                    }
                                    
                                } else {
                                    $profile_pic = $current_image;
                                }

                                $update = "UPDATE `users` SET `profile_pic`='$profile_pic',`fname`='$fname',`lname`='$lname',`email`='$email',`phone`='$number',`country`='$country',`city`='$city',`zip`='$zip',`status`='$status' WHERE `ID` = $id";

                                $update_query = mysqli_query($conn, $update) or die('Query Failed');
                            
                                if($update_query) {
                                    $message[] = "Profile updated successfully...";
                                } else {
                                    $message[] = "Failed to update user!";
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
                            if(isset($_GET['id'])){ 
                                $id = $_GET['id'];

                                $fetch_data = "SELECT * FROM `users` WHERE `id` = $id";
                                $fetch_data_query = mysqli_query($conn, $fetch_data) or die("Query Failed");

                                if(mysqli_num_rows($fetch_data_query) > 0) {
                                    while($row = mysqli_fetch_assoc($fetch_data_query)) {
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-3 text-dark">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['fname']; ?>" required>
                                        <label for="fname">First Name</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lname']; ?>" required>
                                        <label for="lname">Last Name</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo $row['email']; ?>" required>
                                        <label for="email">Your Email</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="number" name="number" placeholder="Phone Number" value="<?php echo $row['phone']; ?>">
                                        <label for="number">Phone Number</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $row['city']; ?>">
                                        <label for="city">City</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $row['country']; ?>">
                                        <label for="country">Country</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" value="<?php echo $row['zip']; ?>">
                                        <label for="zip">Zip Code</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <select name="status" id="status" class="form-control" required>
                                            <option <?php if($row['status']=='user') {echo "selected";} ?> value="user">User</option>
                                            <option <?php if($row['status']=='admin') {echo "selected";} ?> value="admin">Admin</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="current_profile_pic" class="form-label">Current Profile Picture: </label><br>
                                        <?php
                                            if($row['profile_pic']!="") { 
                                                ?>
                                                    <img src="../upload-images/<?php echo $row['profile_pic']; ?>" width="100" height="100" style="border-radius: 50%;">
                                                <?php
                                            } else {
                                                echo "No profile picture is added";
                                            }
                                        ?>
                                    </div><!--form-group-->
                                </div><!--col-lg-12-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="profile_pic" name="profile_pic" placeholder="Profile Picture">
                                        <label for="profile_pic">New Profile Picture</label>
                                    </div><!--form-floating-->
                                </div><!--col-lg-12-->
                                <div class="col-12 text-center">
                                    <input type="hidden" name="current_image" value="<?php echo $row['profile_pic']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" name="update" type="submit">Update</button>
                                </div><!--col-12-->
                            </div><!--row-->
                        </form>
                        <?php 
                                    }
                                }
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