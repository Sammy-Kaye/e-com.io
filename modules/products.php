<?php
include 'database/db_connect.php';

// Fetch all products from the database
function getAllProducts($conn) {
    $query = "SELECT product_id, name, description, price, stock, category_id, created_at FROM products";
    $result = mysqli_query($conn, $query);
    $products = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    } else {
        die("Error retrieving products: " . mysqli_error($conn));
    }

    return $products;
}

// Establish database connection and fetch products
$conn = connectDatabase();
$products = getAllProducts($conn);
?>
