<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Mehar Grocery</title>
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
                        <h1 class="mb-5">All Users</h1>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="table-dark text-center">
                                    <th>Sr#</th>
                                    <th>Image</th>
                                    <th class="text-start">Fname</th>
                                    <th>Lname</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Zip</th>
                                    <th>Last Login</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once '../config.php';
                                    $fetch_posts = "SELECT * FROM `users`";
                                    $fetch_posts_query = mysqli_query($conn, $fetch_posts) or die("Query Failed");
                                    $sr = 1;

                                    if(mysqli_num_rows($fetch_posts_query) > 0) {
                                        while($row = mysqli_fetch_assoc($fetch_posts_query)) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $sr++; ?></td>
                                    <td>
                                        <?php
                                            if($row['profile_pic']!="") { 
                                                ?>
                                                    <img src="../upload-images/<?php echo $row['profile_pic']; ?>" width="50" height="50" class="rounded">
                                                <?php
                                            } else {
                                                echo "<img src='../img/default.png' width='50' height='50' class='rounded'>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['country']; ?></td>
                                    <td><?php echo $row['zip']; ?></td>
                                    <td>
                                        <?php
                                            if($row['last_login_details'] != '') {
                                                echo $row['last_login_details'];
                                            } else {
                                                echo "No login detail...";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if($row['status'] == 'user') {
                                                echo "<span class='btn btn-primary rounded-pill py-1 px-3'>user</span>";
                                            } else {
                                                echo "<span class='btn btn-warning rounded-pill text-white py-1 px-3'>admin</span>";
                                            }
                                        ?>
                                    </td>
                                    <td><a class="btn btn-danger rounded" href="delete.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&user_id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                                <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7" class="text-center fw-bold">No user found !!!</td>
                                        </tr>
                                    <?php }
                                ?>
                            </tbody>
                        </table>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>