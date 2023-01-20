<?php

    require_once 'config.php';
    session_start();

    if(isset($_POST['add_to_cart'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

        $fetch_product = "SELECT * FROM `cart` WHERE `product_id` = '$product_id'";
        $fetch_product_query = mysqli_query($conn, $fetch_product);

        if(mysqli_num_rows($fetch_product_query) > 0) {
            $_SESSION['success'] = "<div class='message'>
                <span class='text-warning position-absolute'>Product is already exist in our cart...</span>
            </div>";
            header('location: index.php');
        } else {
            $add_to_cart = "INSERT INTO `cart`(`product_id`, `user_id`)
            VALUES ('$product_id','$user_id')";
            $add_to_cart_query = mysqli_query($conn, $add_to_cart);

            if($add_to_cart_query) {
                $_SESSION['success'] = "<div class='message'>
                    <span class='text-success position-absolute'>Product is added to cart successfully...</span>
                </div>";
                header('location: index.php');
            } else {
                echo "failed to add cart";
            }
        }
    }

?>