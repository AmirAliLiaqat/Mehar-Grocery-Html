<?php

    require_once '../config.php';

    $post_id = $_GET['post_id'];
    $message_id = $_GET['message_id'];

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

?>