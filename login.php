<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - <?php session_start(); echo $_SESSION['site_name']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require_once 'template-parts/header-links.php'; ?>
</head>

<body>

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mb-5">
                <a href="index.php"><img src="img/logo.png" alt=""></a>
            </div><!--text-center-->
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Login</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div><!--section-header-->
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <?php 
                        require_once 'config.php';

                        if(isset($_POST['login'])) {
                    
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                            date_default_timezone_set("Asia/Karachi");
                            $login_detail = date("h:i:s:a M d Y"); 

                            $login_user = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
                            $login_user_query = mysqli_query($conn, $login_user) or die('Query Failed');

                            $user_login_detail = "UPDATE `users` SET `last_login_details`= '$login_detail' WHERE `email` = '$email'";
                            $user_login_detail_query = mysqli_query($conn, $user_login_detail) or die('Query Failed');
                            
                            if(mysqli_num_rows($login_user_query) > 0) {
                                $row = mysqli_fetch_assoc($login_user_query);

                                $_SESSION['id'] = $row['id'];
                                $_SESSION['fname'] = $row['fname'];
                                $_SESSION['lname'] = $row['lname'];
                                $_SESSION['status'] = $row['status'];

                                if($_SESSION['status'] === 'user') { 
                                    header('location: index.php');
                                } else {
                                    header('location: admin/dashboard.php');
                                }
                            } else {
                                $message[] = "Login Details are incorrect...";
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
                    <form action="" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" require_onced>
                                    <label for="email">Your Email</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" require_onced>
                                    <label for="password">Password</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12 text-center">
                                <p class="text-center pt-4">If don't have an account. <a href="register.php" class="text-danger">Register</a></p>
                                <button class="btn btn-primary rounded-pill py-3 px-5" name="login" type="submit">Login</button>
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