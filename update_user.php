<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Profile - <?php session_start(); if(isset($_SESSION['site_name'])) { echo $_SESSION['site_name']; } else {echo "Mehar Grocery";} ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require_once 'template-parts/header-links.php'; ?>
</head>

<body>

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center wow fadeInUp mb-5">
                <a href="index.php"><img src="img/logo.png" alt=""></a>
            </div><!--text-center-->
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Update Profile</h1>
            </div><!--section-header-->
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <?php
                        require_once 'config.php';

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
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['fname']; ?>" required>
                                    <label for="fname">First Name</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lname']; ?>" required>
                                    <label for="lname">Last Name</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo $row['email']; ?>" required>
                                    <label for="email">Your Email</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Phone Number" value="<?php echo $row['phone']; ?>">
                                    <label for="number">Phone Number</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $row['city']; ?>">
                                    <label for="city">City</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $row['country']; ?>">
                                    <label for="country">Country</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" value="<?php echo $row['zip']; ?>">
                                    <label for="zip">Zip Code</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="status" id="status" class="form-control" required>
                                        <option <?php if($row['status']=='user') {echo "selected";} ?> value="user">User</option>
                                        <option <?php if($row['status']=='admin') {echo "selected";} ?> value="admin">Admin</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current_profile_pic" class="form-label">Current Profile Picture: </label><br>
                                    <?php
                                        if($row['profile_pic']!="") { 
                                            ?>
                                                <img src="upload-images/<?php echo $row['profile_pic']; ?>" width="100" height="10%" style="border-radius: 50%;">
                                            <?php
                                        } else {
                                            echo "No profile picture is added";
                                        }
                                    ?>
                                </div><!--form-group-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" placeholder="Profile Picture">
                                    <label for="profile_pic">New Profile Picture</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
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
                </div><!--col-lg-7-->
            </div><!--row-->
        </div><!--container-->
    </div><!--container-xxl-->
    <!-- Contact End -->

    <?php require_once 'template-parts/footer.php'; ?>
    <?php require_once 'template-parts/footer-links.php'; ?>
</body>

</html>