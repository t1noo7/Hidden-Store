<h1 class="text-center text-success">All Products</h1>
<table class="table table-bordered mt-5">
    <thead class="table-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_products = "SELECT * FROM `products`";
        $result_products = mysqli_query($conn, $get_products);
        $number = 0;
        while ($row_products = mysqli_fetch_assoc($result_products)) {
            $product_id = $row_products['product_id'];
            $product_title = $row_products['product_title'];
            $product_image = $row_products['product_image1'];
            $product_price = $row_products['product_price'];
            $status = $row_products['status'];
            $number++;
            ?>
            <tr class='text-center'>
                <td><?php echo $number ?></td>
                <td><?php echo $product_title ?></td>
                <td><img src='./product_images/<?php echo $product_image ?>' class='product_img' alt=''></td>
                <td><?php echo $product_price ?></td>
                <td>
                    <?php
                    $get_count = "SELECT * FROM `order_pending` WHERE product_id=$product_id";
                    $result_count = mysqli_query($conn, $get_count);
                    $row_count = mysqli_num_rows($result_count);
                    echo $row_count;
                    ?>
                </td>
                <td><?php echo $status ?></td>
                <td><a href='index.php?edit_products' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>