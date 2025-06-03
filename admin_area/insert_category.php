<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];
    $select_query = "SELECT * FROM `categories` WHERE category_title='$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This category is already present in the database')</script>";
    } else {
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result_insert = mysqli_query($conn, $insert_query);
        if ($result_insert) {
            echo "<script>alert('Category has been inserted successfully')</script>";
        }
    }
}
?>
<h2 class="text-center">Insert Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert category" aria-label="Category"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3" name="insert_cat" value="Insert category">
    </div>
</form>