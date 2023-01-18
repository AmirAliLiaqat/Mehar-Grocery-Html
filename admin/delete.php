<?php

    require_once '../config.php';

    $post_id = $_GET['post_id'];
    $message_id = $_GET['message_id'];
    $user_id = $_GET['user_id'];
    $cat_id = $_GET['cat_id'];
    $sub_cat_id = $_GET['sub_cat_id'];
    $brand_id = $_GET['brand_id'];

    $select_post_img = "SELECT `featured_image` FROM `posts` WHERE `id` = '$post_id'";
    $select_post_img_query = mysqli_query($conn, $select_post_img) or die("Query Unsuccessfull");

    while($row = mysqli_fetch_assoc($select_post_img_query)) {
        $featured_image = $row['featured_image'];
    }

    // code for deletig posts...
    if(isset($post_id) AND isset($featured_image)) {

        $delete_access = "<script>alert('Are you really want to delete this account....')</script>";

        if(isset($delete_access)) {
            if($featured_image != "") {
                $image_path = "../upload-images/".$featured_image;
                $remove_image = unlink($image_path);
            }
    
            $delete_post = "DELETE FROM `posts` WHERE `id` = $post_id";
            $delete_post_query = mysqli_query($conn, $delete_post);
    
            header('location: posts.php');
        }
        
    }

    // code for deleting messages...
    if(isset($message_id)) {
        $delete_message = "DELETE FROM `messages` WHERE `id` = $message_id";
        $delete_message_query = mysqli_query($conn, $delete_message);

        header('location: messages.php');
    }

    // code for deleting users...
    if(isset($user_id)) {
        $delete_user = "DELETE FROM `users` WHERE `id` = $user_id";
        $delete_user_query = mysqli_query($conn, $delete_user);

        header('location: users.php');
    }

    // code for deleting categories...
    if(isset($cat_id)) {
        $delete_category = "DELETE FROM `categories` WHERE `cat_id` = $cat_id";
        $delete_category_query = mysqli_query($conn, $delete_category);

        header('location: categories.php');
    }

    // code for deleting sub categories...
    if(isset($sub_cat_id)) {
        $delete_sub_category = "DELETE FROM `sub_categories` WHERE `sub_cat_id` = $sub_cat_id";
        $delete_sub_category_query = mysqli_query($conn, $delete_sub_category);

        header('location: sub_categories.php');
    }

    // code for deleting sub brands...
    if(isset($brand_id)) {
        $delete_brands = "DELETE FROM `brands` WHERE `brand_id` = $brand_id";
        $delete_brands_query = mysqli_query($conn, $delete_brands);

        header('location: brands.php');
    }

?>