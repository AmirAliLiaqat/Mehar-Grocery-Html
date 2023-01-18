<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User - <?php session_start(); echo $_SESSION['site_name']; ?></title>
    <?php require_once 'template-parts/header-links.php'; ?>
</head>
<body>

    <?php require_once 'template-parts/header.php'; ?>

    <section class="user_profile admin_content mt-5 pt-5">
        <div class="container mt-5 pt-5">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">User Profile</h1>
            </div><!--section-header-->
            <?php
                require_once 'config.php';
                $id = $_GET['id'];

                $select_data = "SELECT * FROM `users` WHERE `ID` = '$id'";
                $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                $sn = 1;

                if(mysqli_num_rows($select_data_query) > 0) {
                    while($row = mysqli_fetch_assoc($select_data_query)) {
            ?>
            <div class="user_profile_img text-center wow fadeInUp pb-3">
                <?php
                    if($row['profile_pic']!="") { 
                        ?>
                            <img src="upload-images/<?php echo $row['profile_pic']; ?>" width="200" height="200" style="border-radius: 50%">
                        <?php
                    } else {
                        echo "<img src='img/default.png'>";
                    }
                ?>
            </div><!--user_profile_img-->
            <div class="row wow fadeInUp">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="text-dark mx-auto">
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">First Name:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['fname']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Last Name:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['lname']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Email:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['email']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Phone Number:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['phone']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Country:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['country']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">City:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['city']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Zip Code:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['zip']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Status:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['status']; ?></td>
                        </tr>
                        <tr class="user_detail_tr">
                            <td class="user_detail_td fw-bold border-bottom p-2">Last Login:</td>
                            <td class="user_detail_td fw-bold border-bottom p-2"><?php echo $row['last_login_details']; ?></td>
                        </tr>
                        <tr class="user_detail_tr border-bottom-0">
                            <td class="user_detail_td fw-bold border-bottom p-2"></td>
                            <td class="user_detail_td fw-bold border-bottom p-2">
                                <button class="btn btn-primary" onclick="window.print();" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-print"></i> Print</button>
                                <a class="btn btn-info" href="update_user.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a class="btn btn-danger" href="delete_user.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    </table>
                </div><!--col-lg-9-->
            </div><!--row-->
            <?php
                    }
                } else { ?>
                    <tr class="text-center">
                        <td colspan="6">No User Found.</td>
                    </tr>
                <?php }
            ?>
        </div><!--container-->
    </section>

    <?php require_once 'template-parts/footer.php'; ?>
    <?php require_once 'template-parts/footer-links.php'; ?>

</body>
</html>