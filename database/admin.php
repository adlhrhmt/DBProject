<?php

// Include the database connection
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE adminEmail = '$email' AND adminPassword = '$password'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $isAdmin = false;
} else {
    $isAdmin = true;
}

$query = "SELECT * FROM admin";

$result = mysqli_query($conn, $query);

if (!$result) {
    $allAdmins = false;
} else {
    $allAdmins = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO user VALUES (0, '$fullname', '$email', '$password', '$username', NULL, NULL, NULL)";

$result = mysqli_query($conn, $query);

if (!$result) {
    $insertSuccess = false;
} else {
    $insertSuccess = true;
}

// Close the database connection
mysqli_close($conn);

?>
