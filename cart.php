<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hidden Store - Cart details</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<!-- font-awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- custom css file -->
<link rel="stylesheet" href="./styles.css" />
<style>
    .cart_img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }
</style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="logo" class="logo" />
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i
                                    class="fa-solid fa-cart-shopping"></i><sup><?php cartItem() ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link link-danger' href='./users_area/profile.php'>Welcome <strong>" . $_SESSION['username'] . "</strong></a>
                          </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='./users_area/user_login.php'>Welcome Guest</a>
                          </li>";
                }
                if (isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                          </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community.</p>
        </div>

        <!-- fourth child table -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">

                        <?php
                        $get_ip_address = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                        $result_query = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if ($result_count > 0) {
                            echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";

                            while ($row = mysqli_fetch_array($result_query)) {
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                                $result_products = mysqli_query($conn, $select_products);
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $total_price += $product_values;
                                    ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="./images/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                                        <td><input type="text" name="qty" class="form-input w-50"></td>
                                        <?php
                                        $get_ip_address = getIPAddress();
                                        if (isset($_POST['update_cart'])) {
                                            $quantities = $_POST['qty'];
                                            $update_cart = "UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$get_ip_address'";
                                            $result_quantity = mysqli_query($conn, $update_cart);
                                            $total_price = $total_price * $quantities;
                                        }
                                        ?>
                                        <td><?php echo $price_table ?>/-</td>
                                        <td><input type="checkbox" name="removeItem[]" value="<?php echo $product_id ?>"></td>
                                        <td>
                                            <!-- <button class="bg-info px-3 py-2 mx-3">Update</button><button -->
                                            <input type="submit" value="Update Cart" class="bg-info px-3 py-2 mx-3"
                                                name="update_cart">
                                            <input type="submit" value="Remove" class="bg-info px-3 py-2 mx-3" name="remove_cart">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="d-flex mb-5">
                        <?php
                        $get_ip_address = getIPAddress();
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                        $result_query = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price/-</strong>
                            </h4>
                            <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 mx-3' name='continue_shopping'>
                            <button class='bg-secondary p-3 py-2'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 mx-3' name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php', '_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>

        <?php
        function removeCartItem()
        {
            global $conn;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeItem'] as $remove_id) {
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php', '_self')</script>";
                    }
                }
            }
        }
        removeCartItem();
        ?>

        <!-- last child -->
        <?php include('includes/footer.php'); ?>
    </div>

    <!-- bootstrap js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>