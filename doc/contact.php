<?php
include "connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];


$stmt = $conn->prepare("INSERT INTO comment(Name, Telephone, Email, Comment) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phone, $email, $comment);
$stmt->execute();
$stmt->close();
$conn->close();




?>