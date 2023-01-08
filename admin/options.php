<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Options - Mehar Grocery</title>
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
                        <h1>Options</h1>
                        <?php
                            require_once '../config.php';

                            if(isset($_POST['add_option'])) {
                                $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
                                $site_slogen = mysqli_real_escape_string($conn, $_POST['site_slogen']);
                                $site_description = mysqli_real_escape_string($conn, $_POST['site_description']);

                                $contact_address = mysqli_real_escape_string($conn, $_POST['contact_address']);
                                $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
                                $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);

                                $currency_format = mysqli_real_escape_string($conn, $_POST['currency_format']);

                                $about_text = mysqli_real_escape_string($conn, $_POST['about_text']);
                                $newsletter_text = mysqli_real_escape_string($conn, $_POST['newsletter_text']);
                                $footer_copyright = mysqli_real_escape_string($conn, $_POST['footer_copyright']);

                                $twitter_link = mysqli_real_escape_string($conn, $_POST['twitter_link']);
                                $facebook_link = mysqli_real_escape_string($conn, $_POST['facebook_link']);
                                $youtube_link = mysqli_real_escape_string($conn, $_POST['youtube_link']);
                                $instagram_link = mysqli_real_escape_string($conn, $_POST['instagram_link']);
                                $linkedin_link = mysqli_real_escape_string($conn, $_POST['linkedin_link']);
                                $social_links = $twitter_link . ', ' . $facebook_link . ', ' . $youtube_link . ', ' . $instagram_link . ', ' . $linkedin_link;

                                if(isset($_FILES['site_logo']['name'])) {
                                    $site_logo = $_FILES['site_logo']['name'];
                                    // Auto rename image
                                    $ext = end(explode('.',$site_logo));
                                    // Rename the image
                                    $site_logo = "site_logo_".'.'.$ext;
                                    $source_path = $_FILES['site_logo']['tmp_name'];
                                    $destination_path = "../upload-images/".$site_logo;
    
                                    // Finally upload the image
                                    $upload = move_uploaded_file($source_path, $destination_path);
                                } else {
                                    $site_logo = "";
                                }

                                $add_options = "INSERT INTO `options`(`site_name`, `site_logo`, `site_slogen`, 
                                `site_description`, `currency_format`, `about_text`, `newsletter_text`, 
                                `footer_text`, `contact_address`, `contact_number`, `contact_email`, `social_links`) 
                                VALUES ('$site_name','$site_logo','$site_slogen','$site_description',
                                '$currency_format','$about_text','$newsletter_text','$footer_copyright',
                                '$contact_address','$contact_number','$contact_email','$social_links')";
                                $add_options_query = mysqli_query($conn, $add_options) or die("Query Failed");

                                if($add_options_query) {
                                    $message[] = "<span class='text-success'>Options added successfully...</span>";
                                } else {
                                    $message[] = "<span class='text-danger'>There was a problem with adding Options!</span>";
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
                        <form class="row" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="site_name" class="form-label fw-bold">Site Name:</label>
                                    <input type="text" name="site_name" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="site_slogen" class="form-label fw-bold">Site Slogen:</label>
                                    <input type="text" name="site_slogen" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="site_description" class="form-label fw-bold">Site Description:</label>
                                    <textarea name="site_description" class="form-control"></textarea>
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="about_text" class="form-label fw-bold">About Text:</label>
                                    <textarea name="about_text" class="form-control"></textarea>
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="contact_address" class="form-label fw-bold">Contact Address:</label>
                                    <input type="text" name="contact_address" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="contact_number" class="form-label fw-bold">Contact Number:</label>
                                    <input type="text" name="contact_number" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="contact_email" class="form-label fw-bold">Contact Email:</label>
                                    <input type="email" name="contact_email" class="form-control">
                                </div><!--form-group-->
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="site_logo" class="form-label fw-bold">Site logo:</label>
                                    <input type="file" name="site_logo" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="newsletter_text" class="form-label fw-bold">Newsletter Text:</label>
                                    <textarea name="newsletter_text" class="form-control"></textarea>
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="currency_format" class="form-label fw-bold">Currency Format:</label>
                                    <input type="text" name="currency_format" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="footer_copyright" class="form-label fw-bold">Footer Copyright:</label>
                                    <input type="text" name="footer_copyright" class="form-control">
                                </div><!--form-group-->
                                <div class="form-group mb-3">
                                    <label for="" class="form-label fw-bold">Social Links:</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" style="width:40px;"><i class="fab fa-twitter"></i></span>
                                        <input type="text" name="twitter_link" class="form-control">
                                    </div><!--input-group-->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" style="width:40px;"><i class="fab fa-facebook-f"></i></span>
                                        <input type="text" name="facebook_link" class="form-control">
                                    </div><!--input-group-->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" style="width:40px;"><i class="fab fa-youtube"></i></span>
                                        <input type="text" name="youtube_link" class="form-control">
                                    </div><!--input-group-->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" style="width:40px;"><i class="fab fa-instagram"></i></span>
                                        <input type="text" name="instagram_link" class="form-control">
                                    </div><!--input-group-->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" style="width:40px;"><i class="fab fa-linkedin-in"></i></span>
                                        <input type="text" name="linkedin_link" class="form-control">
                                    </div><!--input-group-->
                                </div><!--form-group-->
                            </div><!--col-lg-6-->
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" name="add_option" type="submit">Add</button>
                            </div><!--col-lg-12-->
                        </form>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--main_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'footer_links.php'; ?>

</body>
</html>