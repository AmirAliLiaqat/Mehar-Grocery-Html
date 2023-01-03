<?php

    require_once 'config.php';

    $id = $_GET['id'];

    $select_user = "SELECT `profile_pic` FROM `users` WHERE `id` = '$id'";
    $select_user_query = mysqli_query($conn, $select_user) or die("Query Unsuccessfull");

    while($row = mysqli_fetch_assoc($select_user_query)) {
        $profile_pic = $row['profile_pic'];
    }

    if(isset($id) AND isset($profile_pic)) {

        $delete_access = "<script>alert('Are you really want to delete this account....')</script>";

        if(isset($delete_access)) {
            if($profile_pic != "") {
                $image_path = "upload-images/".$profile_pic;
                $remove_image = unlink($image_path);
            }
    
            $delete_user = "DELETE FROM `users` WHERE `id` = $id";
            $delete_user_query = mysqli_query($conn, $delete_user);
    
            header('location: login.php');
        }
        
    }

?>