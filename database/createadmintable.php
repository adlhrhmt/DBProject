<?php

$connection = mysqli_connect("localhost", "root", "", "megah");
if (!$connection) {
    die("Error connecting to the database: " . mysqli_connect_error());
}

$query = "CREATE TABLE IF NOT EXISTS admin (
    adminId INT AUTO_INCREMENT PRIMARY KEY,
    adminFullname VARCHAR(255) NOT NULL,
    adminEmail VARCHAR(255) NOT NULL,
    adminPassword VARCHAR(255) NOT NULL
)";

$result = mysqli_query($connection, $query);

if ($result) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
