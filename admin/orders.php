<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Mehar Grocery</title>
    <?php require_once 'header_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once '../config.php';
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
                        <h1>Orders</h1>
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Detail</th>
                                    <!-- <th>City</th>
                                    <th>State</th>
                                    <th>Country</th> -->
                                    <th>Qty</th>
                                    <th>Total Amount</th>
                                    <th>Payment Method</th>
                                    <th>Order Date</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $fetch_orders = "SELECT * FROM `orders`";
                                    $fetch_orders_query = mysqli_query($conn, $fetch_orders);

                                    while($order = mysqli_fetch_assoc($fetch_orders_query)) :
                                ?>
                                <tr>
                                    <td>ODR00<?php echo $order['order_id']; ?></td>
                                    <td>
                                        <span class="fw-bold">Name:</span> <?php echo $order['user_name']; ?> <br>
                                        <span class="fw-bold">Address:</span> <?php echo $order['city']; echo ', ' . $order['state']; echo ', ' . $order['country']; ?>
                                    </td>
                                    <td><?php echo $order['product_qty']; ?></td>
                                    <td><?php echo number_format($order['total_amount']); echo ' ' . $_SESSION['currency_format'] ?></td>
                                    <td><?php echo $order['payment_method']; ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td style="width:180px;">
                                        <?php
                                            if(isset($_POST['payment_status'])) {
                                                $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
                                                $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
                                                $update_payment_status = "UPDATE `orders` SET `payment_status` = '$payment_status' WHERE `order_id` = '$order_id'";
                                                $update_payment_status_query = mysqli_query($conn, $update_payment_status);
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="d-flex">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <select name="payment_status" class="form-select">
                                                    <option <?php if($order['payment_status'] == 0) echo "selected"; ?> value="0">unpaid</option>
                                                    <option <?php if($order['payment_status'] == 1) echo "selected"; ?> value="1">paid</option>
                                                </select>&nbsp;&nbsp;
                                                <button class="btn btn-success rounded" name="update_payment_status"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width:180px;">
                                        <?php
                                            if(isset($_POST['update_delivery_status'])) {
                                                $delivery_status = mysqli_real_escape_string($conn, $_POST['delivery_status']);
                                                $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
                                                $update_delivery_status = "UPDATE `orders` SET `delivery_status` = '$delivery_status' WHERE `order_id` = '$order_id'";
                                                $update_delivery_status_query = mysqli_query($conn, $update_delivery_status);
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="d-flex">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <select name="delivery_status" class="form-select">
                                                    <option <?php if($order['delivery_status'] == 0) echo "selected"; ?> value="0">pending</option>
                                                    <option <?php if($order['delivery_status'] == 1) echo "selected"; ?> value="1">delivered</option>
                                                </select>&nbsp;&nbsp;
                                                <button class="btn btn-success rounded" name="update_delivery_status"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
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