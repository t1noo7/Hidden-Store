<?php
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This brand is already present in the database')</script>";
    } else {
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result_insert = mysqli_query($conn, $insert_query);
        if ($result_insert) {
            echo "<script>alert('Brand has been inserted successfully')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Brand</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brand" aria-label="Brand"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3" name="insert_brand" value="Insert brand">
    </div>
</form>