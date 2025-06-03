<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ecommerce Website using Php and MySQL.</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<!-- font-awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- custom css file -->
<link rel="stylesheet" href="./styles.css" />
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
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php totalCartPrice() ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data" />
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product" />
                    </form>
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

        <!-- fourth child -->
        <div class="row px-3">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <?php
                    //fetch products
                    getAllProducts();
                    get_SpecificCategory();
                    get_SpecificBrand();
                    // $ip = getIPAddress();
                    // echo 'User IP Address: ' . $ip . '<br>';
                    ?>

                </div>
            </div>
            <div class="col-md-2 bg-secondary p-0">
                <!-- brand display -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <?php
                    getBrands();
                    ?>
                </ul>

                <!-- categories -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    getCategories();
                    ?>
                </ul>
            </div>
        </div>


        <!-- last child -->
        <?php include('includes/footer.php'); ?>
    </div>

    <!-- bootstrap js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>