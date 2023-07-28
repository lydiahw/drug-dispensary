<?php

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$dateOfBirth = $_POST['age'];
$password = $_POST['password'];
$role = $_POST['role'];

$conn = new mysqli('localhost', 'root', '', 'drug_dispensary');

$dateOfBirth = date('Y-m-d', strtotime(str_replace('/', '-', $dateOfBirth)));

// Calculate the user's age
$age = date_diff(date_create($dateOfBirth), date_create('today'))->y;

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $query = "SELECT * FROM doc_pat WHERE Email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists, display an error message or take appropriate action
        header("Location: register.php?error=Email already exists");
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO doc_pat(Name, Age, Address, Email, Password, Role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $name, $age, $address, $email, $hashedPassword, $role);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}

header("Location: login.html");
exit();

?>
