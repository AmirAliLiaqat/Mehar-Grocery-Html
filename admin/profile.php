<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Mehar Grocery</title>
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
                        <h1>Profile</h1></br>
                        <?php
                            require_once '../config.php';
                            $id = $_GET['id'];

                            $select_data = "SELECT * FROM `users` WHERE `ID` = '$id'";
                            $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                            $sn = 1;

                            if(mysqli_num_rows($select_data_query) > 0) {
                                while($row = mysqli_fetch_assoc($select_data_query)) {
                        ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="user_profile_img text-center pb-3">
                                    <?php
                                        if($row['profile_pic']!="") { 
                                            ?>
                                                <img src="../upload-images/<?php echo $row['profile_pic']; ?>" width="200" height="200" style="border-radius: 50%">
                                            <?php
                                        } else {
                                            echo "<img src='../img/default.png'>";
                                        }
                                    ?>
                                </div><!--user_profile_img-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <table class="text-dark">
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
                                            <a class="btn btn-danger" href="../delete_user.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-trash"></i> Delete</a>
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
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>