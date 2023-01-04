<ul class="menu-list text-white wow fadeInUP">
    <li <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>><a href="dashboard.php">Dashboard</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "posts.php") echo 'class="active"'; ?>><a href="posts.php">Posts</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "products.php") echo 'class="active"'; ?>><a href="products.php">Products</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "orders.php") echo 'class="active"'; ?>><a href="orders.php">Orders</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "users.php") echo 'class="active"'; ?>><a href="users.php">Users</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "messages.php") echo 'class="active"'; ?>><a href="messages.php">Messages</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "brands.php") echo 'class="active"'; ?>><a href="brands.php">Brands</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "categories.php") echo 'class="active"'; ?>><a href="categories.php">Categories</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "sub-categories.php") echo 'class="active"'; ?>><a href="sub-categories.php">Sub Categories</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "options.php") echo 'class="active"'; ?>><a href="options.php">Options</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "profile.php") echo 'class="active"'; ?>><a href="profile.php?result=<?php echo sha1("Don't do inlegal activities"); ?>&id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
</ul>