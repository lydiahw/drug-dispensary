<?php

include('conn.php');

session_start();

//login
if(isset($_POST['login_pharm'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query ="SELECT * FROM users WHERE username ='$username' AND password = '$password' ";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_fetch_array($query_run)){
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    }else{
        $_SESSION['status'] = "Username / Password is Invalid";
        header('Location: login.php');
        exit();
    }
}


//general pharmacy info
if(isset($_POST['submitbtn'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['[phone]'];
    $email = $_POST['email'];
    $opening_date = $_POST['opening_date'];
    $closing_date = $_POST['closing_date'];
    $opening_balance = $_POST['opening_balance'];
    $closing_balance = $_POST['closing_balance'];

    $query = "INSERT INTO pharmacy_info (name, address, phone, email, opening_date, closing_date, opening_balance, closing_balance) VALUES ('$name', '$address', '$phone', '$email', '$opening_date', '$closing_date', '$opening_balance', '$closing_balance') ";

    $res = mysqli_query($connection, $query);
    if($res){
        header("Location: dashboard.php");
        exit();
    }
}


//price.php

if(isset($_POST['add'])){
    //echo "clicked";

    $medicine_name = $_POST['medicine_name'];
    $capacity = $_POST['capacity'];
    $medicine_type = $_POST['medicine_type'];
    $price = $_POST['price'];
    $dosage_sold =$_POST['dosage_sold'];
    $dosage = $_POST['dosage'];
    $packet_amount = $_POST['packet_amount'];
    $adult_dose_price = $_POST['adult_dose_price'];
    $child_dose_price = $_POST['child_dose_price'];

   /* $query1 = "INSERT INTO store SET 
       medicine_name = '$medicine_name',
       capacity = '$capacity',
       type = '$medicine_type',
       price = '$price',
       dosage_sold = '$dosage_sold',
       dosage = '$dosage',
       app = '$packet_amount',
       price_dosage = '$adult_dose_price',
       half_dosage_price ='$child_dose_price'
    ";

    $res = mysqli_query($connection, $query1);
    if($res == true){
        $query2 = "INSERT INTO pharmacy_stock SET
            medicine_name = '$medicine_name',
            capacity = '$capacity',
            type = '$medicine_type',
            price = '$price',
            dosage_sold = '$dosage_sold',
            dosage = '$dosage',
            app = '$packet_amount',
            price_dosage = '$adult_dose_price',
            half_dosage_price ='$child_dose_price'
        ";

        $res = mysqli_query($connection, $query2);
        if($res == true){
            header("Location:dashboard.php");
            exit();
        }
    }*/
}

//add_medicine.php
if(isset($_POST['submit_medicine'])){
    $medicine_name = $_POST['medicine_name'];
    $capacity = $_POST['capacity'];
    $medicine_type = $_POST['medicine_type'];

    echo $medicine_name;
    echo $capacity;
    echo $medicine_type;
     
    $query3 = "INSERT INTO store SET 
       medicine_name = '$medicine_name',
       capacity = '$capacity',
       type = '$medicine_type'
    ";

    $res = mysqli_query($connection, $query3);
    if ($res == true){
        header("Location:medicine_list.php");
        exit();
    }
}
	
?>
