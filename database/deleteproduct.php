<?php
// Include the database connection
include "db.php";

if (isset($_POST['deleteSelected'])) {
    // Check if any products were selected for deletion
    if (isset($_POST['selectedProduct'])) {
        // Retrieve the selected products
        $selectedProducts = $_POST['selectedProduct'];

        // Iterate through the selected products and delete them
        foreach ($selectedProducts as $productName) {
            // Prepare and execute the delete query
            $query = "DELETE FROM products WHERE product_name = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $productName);
            mysqli_stmt_execute($stmt);
        }

        // Get the maximum product ID
        $query = "SELECT MAX(id) AS max_id FROM products";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $maxId = $row['max_id'];

        // Set the next auto-increment value
        $query = "ALTER TABLE products AUTO_INCREMENT = " . ($maxId + 1);
        mysqli_query($conn, $query);

        // Close the prepared statement
        mysqli_stmt_close($stmt);

        // Redirect back to the product list page
        header("Location: ../manageinventory.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
