<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Mehar Grocery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php require 'template-parts/header-links.php'; ?>
</head>

<body>
    
    <?php require 'template-parts/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Login</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Login</li>
                </ol>
            </nav>
        </div><!--container-->
    </div><!--container-fluid-->
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Login</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div><!--form-floating-->
                            </div><!--col-12-->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Password" required>
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

    <?php require 'template-parts/footer.php'; ?>
    <?php require 'template-parts/footer-links.php'; ?>
</body>

</html>