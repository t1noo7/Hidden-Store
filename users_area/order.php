<?php
include('../includes/connect.php');
include('../functions/common_functions.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result = mysqli_query($conn, $cart_query);
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result);
while ($row_price = mysqli_fetch_array($result)) {
    $product_id = $row_price['product_id'];
    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $result_products = mysqli_query($conn, $select_products);
    while ($row_product_price = mysqli_fetch_array($result_products)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}

//getting quantity of items in cart
$get_cart = "SELECT * FROM `cart_details`";
$result_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($result_cart);
$quantity = $get_item_quantity['quantity'];
if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;
}
$insert_orders = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) 
                  VALUES ('$user_id', '$subtotal', '$invoice_number', '$count_products', NOW(), '$status')";
$result_query = mysqli_query($conn, $insert_orders);
if ($result_query) {
    echo "M<script>alert('Orders are submitted Successfully');</script>";
    echo "<script>window.open('profile.php', '_self');</script>";
} else {
    echo "<h3 class='text-center text-danger'>Error in placing order</h3>";
}

//order pending
$insert_pending_orders = "INSERT INTO `order_pending` (user_id, invoice_number, product_id, quantity, order_status) 
                        VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
$result_pending_orders = mysqli_query($conn, $insert_pending_orders);

//delete cart items after order is placed
$delete_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete_cart = mysqli_query($conn, $delete_cart);
?>