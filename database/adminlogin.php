<?php
include "db.php";
$show_error = false;
$_SESSION['logged_out'];

if ($_SESSION['logged_out'] == false) {
    header("Location: index.php");
} else if ($_SESSION['logged_out'] == true) {
    if (isset($_POST['Login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the SELECT query
        $query = "SELECT * FROM admin WHERE adminEmail = ? AND adminPassword = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userArray = array(
                    'uid' => $row['adminid'],
                    'fullname' => $row['adminFullName'],
                    'email' => $row['adminEmail'],
                    'login' => true
                );

                setcookie("user_data", json_encode($userArray));
            }

            $_SESSION["logged_out"] = false;
            header("Location: ../manageinventory.php");
            exit();
        } else {
            $show_error = true;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
