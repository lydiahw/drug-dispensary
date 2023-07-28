<?php

$servername='localhost';
$username='root';
$password='';
$database='drug_dispensary';

$conn=new mysqli($servername,$username,$password,$database);

if($conn->connect_error)
{die('Connection Error:'.conn->connect_error);}	


//username: admin
//email: admin@gmail.com
//password:12345

if(!$_SESSION['user_id']){
    
 }


?>

