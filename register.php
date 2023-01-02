<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register - Mehar Grocery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require_once 'template-parts/header-links.php'; ?>
</head>

<body>
    
    <?php require_once 'template-parts/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Register</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Register</li>
                </ol>
            </nav>
        </div><!--container-->
    </div><!--container-fluid-->
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Register</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div><!--section-header-->
            <?php
                require_once 'config.php'; 
                error_reporting(0);

                // Code for register form
                if(isset($_POST['register'])) {
                    
                    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $number = mysqli_real_escape_string($conn, $_POST['number']);
                    $country = mysqli_real_escape_string($conn, $_POST['country']);
                    $city = mysqli_real_escape_string($conn, $_POST['city']);
                    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
                    $status = mysqli_real_escape_string($conn, $_POST['status']);

                    if(isset($_FILES['profile_pic']['name'])) {
                        $profile_pic = $_FILES['profile_pic']['name'];
                        // Auto rename image
                        $ext = end(explode('.',$profile_pic));
                        // Rename the image
                        $profile_pic = "profile_pic_".rand(00,99).'.'.$ext;
                        $source_path = $_FILES['profile_pic']['tmp_name'];
                        $destination_path = "upload-images/".$profile_pic;

                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
                    } else {
                        $profile_pic = "";
                    }

                    $register_user = "INSERT INTO `users`(`profile_pic`, `fname`, `lname`, `email`, `password`, `phone`, `country`, `city`, `zip`, `status`) 
                    VALUES ('$profile_pic','$fname','$lname','$email', md5('$password'), '$number','$country','$city','$zip', '$status')";

                    $register_user_query = mysqli_query($conn, $register_user) or die('Query Failed');
                
                    if($register_user_query) {
                        $message[] = "User register Successfully...";
                    } else {
                        $message[] = "There was a problem to register the user...";
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
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Phone Number">
                                    <label for="number">Phone Number</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City">
                                    <label for="city">City</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                                    <label for="country">Country</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code">
                                    <label for="zip">Zip Code</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="status" id="status" class="form-control" required>
                                        <option selected disabled>-- please select --</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" placeholder="Profile Picture">
                                    <label for="profile_pic">Profile Picture</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12 text-center">
                                <p class="text-center pt-4">Already have an account. <a href="login.php" class="text-danger">login</a></p>
                                <button class="btn btn-primary rounded-pill py-3 px-5" name="register" type="submit">Register</button>
                            </div><!--col-12-->
                        </div><!--row-->
                    </form>
                </div><!--col-lg-7-->
            </div><!--row-->
        </div><!--container-->
    </div><!--container-xxl-->
    <!-- Contact End -->

    <?php require_once 'template-parts/footer.php'; ?>
    <?php require_once 'template-parts/footer-links.php'; ?>
</body>

</html>