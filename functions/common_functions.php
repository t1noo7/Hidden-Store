<?php
include('../includes/connect.php');

function getProduct()
{
    global $conn;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0, 9";
            $result = mysqli_query($conn, $select_query);
            while ($row = mysqli_fetch_assoc($result)) {
                // product details
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

function getAllProducts()
{
    global $conn;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` ORDER BY RAND()";
            $result = mysqli_query($conn, $select_query);
            while ($row = mysqli_fetch_assoc($result)) {
                // product details
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

function get_SpecificCategory()
{
    global $conn;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` WHERE category_id=$category_id ORDER BY RAND() LIMIT 0, 9";
        $result = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            // product details
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keywords = $row['product_keywords'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}

function get_SpecificBrand()
{
    global $conn;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `products` WHERE brand_id=$brand_id ORDER BY RAND() LIMIT 0, 9";
        $result = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No brand available for this service.</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            // product details
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keywords = $row['product_keywords'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}
function getBrands()
{
    global $conn;
    $select_brands = "SELECT * FROM `brands`";
    $result_brands = mysqli_query($conn, $select_brands);
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo "<li class='nav-item'>
                <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
              </li>";
    }
}

function getCategories()
{
    global $conn;
    $select_categories = "SELECT * FROM `categories`";
    $result_categories = mysqli_query($conn, $select_categories);
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'>
                <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
              </li>";
    }
}

function searchProduct()
{
    global $conn;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%' OR product_title LIKE '%$search_data_value%' LIMIT 0, 9";
        $result = mysqli_query($conn, $search_query);
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            // product details
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keywords = $row['product_keywords'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}

function viewDetails()
{
    global $conn;
    if (isset($_GET["product_id"])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM `products` WHERE product_id=$product_id ORDER BY RAND() LIMIT 0, 1";
                $result = mysqli_query($conn, $select_query);
                while ($row = mysqli_fetch_assoc($result)) {
                    // product details
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_keywords = $row['product_keywords'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='index.php' class='btn btn-secondary'>Back to Home</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class='col-md-8'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>Related products</h4>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
    }
}

function getIPAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address' AND product_id=$get_product_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present in the cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_address', 0)";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Item added to cart successfully')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

function cartItem()
{
    global $conn;
    if (isset($_GET['add_to_cart'])) {
        $get_ip_address = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        $get_ip_address = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

function totalCartPrice()
{
    global $conn;
    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo "Total Price: " . $total_price . "/-";
}

function checkUsername($username)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM user_table WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}

function checkEmail($email)
{
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM user_table WHERE user_email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}

// Kiểm tra nếu có AJAX gọi đến
if (isset($_POST['action']) && $_POST['action'] == 'checkUsername') {
    checkUsername($_POST['username']);
    exit(); // Chỉ xử lý AJAX, không chạy phần còn lại
}
if (isset($_POST['action']) && $_POST['action'] == 'checkEmail') {
    checkEmail($_POST['email']);
    exit(); // Chỉ xử lý AJAX, không chạy phần còn lại
}

function getUserOrderDetails()
{
    global $conn;
    $username = $_SESSION['username'] ?? '';
    $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
    $result_details = mysqli_query($conn, $get_details);
    while ($row_query = mysqli_fetch_array($result_details)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='pending'";
                    $result_orders = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_orders);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'> $row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                    } else {
                        echo "<h3 class='text-center text-success  mt-5 mb-2'>You have no pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}
?>