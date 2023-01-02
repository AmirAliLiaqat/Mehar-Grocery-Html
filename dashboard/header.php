<?php session_start(); ?>

<!-- Navbar Start -->
<div class="container-fluid px-0 wow fadeIn" data-wow-delay="0.1s">
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-3 px-lg-5 d-flex justify-content-between wow fadeIn" data-wow-delay="0.1s">
        <a href="dashboard.php" class="navbar-brand ms-4 ms-lg-0">
            <img src="../img/logo.png">
        </a>
        <div class="nav-item dropdown">
            <span class="ms-3" style="cursor: pointer;">
            <div class="user_profile text-center">
                <h3 class="fw-bold mb-0"><span style="color: #63c644;">Hello,</span> <span style="color: #F65005;"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span></h3>
            </div><!--user_profile-->
            </span>
            <div class="dropdown-menu m-0">
                <a href="view_user.php" class="dropdown-item"><i class="fa-solid fa-user"></i> View Account</a>
                <a href="delete_user.php" class="dropdown-item"><i class="fa-solid fa-trash"></i> Delete Account</a>
                <a href="../logout.php" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div><!--dropdown-->
        </div><!--nav-item-->
    </nav>
</div><!--container-->
<!-- Navbar End -->