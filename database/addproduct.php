<?php
// Include the database connection
include "db.php";

// Check if the add product form was submitted
if (isset($_POST['product_name']) && isset($_POST['product_code']) && isset($_POST['category']) && isset($_POST['type']) && isset($_POST['uom']) && isset($_POST['cost']) && isset($_POST['selling']) && isset($_POST['balance'])) {
    // Get the product details from the form data
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $uom = $_POST['uom'];
    $cost = $_POST['cost'];
    $selling = $_POST['selling'];
    $balance = $_POST['balance'];

    // Prepare and execute the INSERT query
    $query = "INSERT INTO products (product_name, product_code, category, type, uom, cost, selling, balance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssdd", $product_name, $product_code, $category, $type, $uom, $cost, $selling, $balance);
    mysqli_stmt_execute($stmt);
    
    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the product list page
    header("Location: ../manageinventory.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
