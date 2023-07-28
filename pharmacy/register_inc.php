<?php

if (isset($_POST['register_pharm'])) {
    require "conn.php";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    // ERROR HANDLER
    if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
        header("Location: register.php?error=emptyfields&username=" . $username);
        exit();
    } elseif ($password !== $cpassword) {
        header("Location: register.php?error=passworddoesnotmatch&email=" . $email);
        exit();
    } else {
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: register.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            if ($rowCount > 0) {
                header("Location: register.php?error=usernameistaken&email=" . $username);
                exit();
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: register.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
                    mysqli_stmt_execute($stmt);
                    header("Location: dashboard.php?success=registered");
                    exit();
                }
            }
        }
    }
}

?>
