<?php

session_start();

include "connection.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } elseif (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM doc_pat WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['Password'];

            if (password_verify($password, $hashedPassword)) {
                // Password matches, authentication successful
                $_SESSION['email'] = $row['Email'];
                $_SESSION['name'] = $row['Name'];
                $_SESSION['address'] = $row['Address'];
                $_SESSION['user_id'] = $row['UserID'];
                $_SESSION['role'] = $row['Role'];

                $userType = $_SESSION['role'];

                switch ($userType) {
                    case 'Patient':
                        header('Location: patient.php');
                        break;
                    case 'Doctor':
                        header('Location: doctor.php');
                        break;
                    case 'Pharmacy':
                        header('Location: pharmacy.php');
                        break;
                    case 'Admin':
                        header('Location: admin.php');
                        break;
                    default:
                        header('Location: home.html');
                }
                exit();
            } else {
                // Password does not match, authentication failed
                header("Location: index.php?error=Incorrect Password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect Email or Password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
