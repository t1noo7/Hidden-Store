<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product-title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Image upload
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Image temp names
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    if (empty($product_title) || empty($product_description) || empty($product_keywords) || empty($product_categories) || empty($product_brands) || empty($product_price) || empty($product_image1) || empty($product_image2) || empty($product_image3)) {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        if (strlen($product_title) < 3) {
            echo "<script>alert('Product title is too short')</script>";
            exit();
        }
        if (strlen($product_description) < 10) {
            echo "<script>alert('Product mo_ta is too short')</script>";
            exit();
        }
        if (strlen($product_keywords) < 3) {
            echo "<script>alert('Product keywords are too short')</script>";
            exit();
        }
        if ($product_price < 0) {
            echo "<script>alert('Product price cannot be negative')</script>";
            exit();
        }
        if (
            strlen($product_image1) > 100
            || strlen($product_image2) > 100 || strlen($product_image3) > 100
        ) {
            echo "<script>alert('Image names are too long')</script>";
            exit();
        }
        if (!is_numeric($product_price)) {
            echo "<script>alert('Product price must be a number')</script>";
            exit();
        }
        if (strlen($product_image1) < 3 || strlen($product_image2) < 3 || strlen($product_image3) < 3) {
            echo "<script>alert('Image names are too short')</script>";
            exit();
        }
        // Check if the images are valid
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $image1_extension = pathinfo($product_image1, PATHINFO_EXTENSION);
        $image2_extension = pathinfo($product_image2, PATHINFO_EXTENSION);
        $image3_extension = pathinfo($product_image3, PATHINFO_EXTENSION);

        if (
            !in_array(strtolower($image1_extension), $allowed_extensions) ||
            !in_array(strtolower($image2_extension), $allowed_extensions) ||
            !in_array(strtolower($image3_extension), $allowed_extensions)
        ) {
            echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG and GIF are allowed.')</script>";
            exit();
        }
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Insert query
        $insert_query = "INSERT INTO `products` (category_id, brand_id, product_title, product_description, product_keywords, product_price, product_image1, product_image2, product_image3, datetime, status) VALUES ('$product_categories', '$product_brands', '$product_title', '$product_description', '$product_keywords', '$product_price', '$product_image1', '$product_image2', '$product_image3', NOW(), '$product_status')";

        $result_query = mysqli_query($conn, $insert_query);

        if ($result_query) {
            echo "<script>alert('Product inserted successfully')</script>";
            echo "<script>window.open('insert_product.php','_self')</script>";
        } else {
            die("Query failed: " . mysqli_error($conn));
        }
    }
    // Move images to the server
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
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

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-title" class="form-label">Product Title</label>
                <input type="text" name="product-title" id="product-title" class="form-control"
                    placeholder="Enter Product Title" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control"
                    placeholder="Enter Product Description" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                    placeholder="Enter Product Keywords" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                    // Fetch categories from the database
                    $select_query = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['category_id'];
                        $category_title = $row['category_title'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="brands" id="" class="form-select">
                    <option value="">Select a Brand</option>
                    <?php
                    // Fetch brands from the database
                    $select_query = "SELECT * FROM `brands`";
                    $result = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $brand_id = $row['brand_id'];
                        $brand_title = $row['brand_title'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter Product Price" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>
        </form>
    </div>

</body>

</html>