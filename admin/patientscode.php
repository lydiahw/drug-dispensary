<?php

//add 
include('security.php');

if (isset($_POST['patientregisterbtn'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['edit_age_user'];
    $address = $_POST['address'];
    
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    if($password === $cpassword){
        $query = " INSERT INTO doc_pat (Name, Email, Age, Address,  Password) VALUES ('$username', '$email', '$age', '$address', '$password')";
        $query_run = mysqli_query($connection,$query);

        if($query_run){
            //echo"saved";
            //$_SESSION['success'] ="User Added";
            header('Location: patients.php');
        }else{
            //echo "Not saved"
            //$_SESSION['success'] ="User NOT Added";
            header('Location: patients.php');
        }
    }else{
        $_SESSION['status'] ="Password and Confirm Password Do Not Match";
        header('Location: patients.php');
    }

   
}

//edit
if (isset($_POST['edit_btn_patient'])){

    $username = $_POST['edit_name_user'];
    $email = $_POST['edit_email_user'];
    $age = $_POST['edit_age_user'];
    $address = $_POST['edit_address_user'];
    
    $password = $_POST['edit_password_user'];

    $query = " UPDATE doc_pat SET Name='$username', Email='$email', Age = '$age', Address= '$address',  Password='$password' WHERE UserID ='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        // $_SESSION['success'] = "Data is DELETED";
         header('Location: patients.php');
     }else{
         //$_SESSION['status'] = "Data is NOT DELETED";
         header('Location: patients.php');
     }

   
}

//delete
if (isset($_POST['delete_btn_patient'])){

    $id = $_POST['delete_id_user'];

    $query ="DELETE FROM doc_pat WHERE UserID = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
       // $_SESSION['success'] = "Data is DELETED";
        header('Location: patients.php');
    }else{
        //$_SESSION['status'] = "Data is NOT DELETED";
        header('Location: patients.php');
    }
}


?>