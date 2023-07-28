<?php

   

    include('security.php');

    if (isset($_POST['userregisterbtn'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        
        $password = $_POST['password'];
        $cpassword = $_POST['confirmpassword'];

        if($password === $cpassword){
            $query = " INSERT INTO users (username, email, address,  password) VALUES ('$username', '$email', '$address', '$password')";
            $query_run = mysqli_query($connection,$query);
    
            if($query_run){
                //echo"saved";
                //$_SESSION['success'] ="User Added";
                header('Location: pharmacy.php');
            }else{
                //echo "Not saved"
                //$_SESSION['success'] ="User NOT Added";
                header('Location: pharmacy.php');
            }
        }else{
            $_SESSION['status'] ="Password and Confirm Password Do Not Match";
            header('Location: pharmacy.php');
        }

       
    }

   //edit
    if (isset($_POST['updatebtn_user'])){
        $username = $_POST['edit_name_user'];
        $email = $_POST['edit_email_user'];
        $address = $_POST['edit_address_user'];
        
        $password = $_POST['edit_password_user'];

        $query = " UPDATE users SET username='$username', email='$email', address= '$address',  password='$password' WHERE id ='$id' ";
        $query_run = mysqli_query($connection,$query);

        if($query_run){
            // $_SESSION['success'] = "Data is DELETED";
             header('Location: pharmacy.php');
         }else{
             //$_SESSION['status'] = "Data is NOT DELETED";
             header('Location: pharmacy.php');
         }

       
    }

    

    //delete
    if (isset($_POST['delete_btn_user'])){

        $id = $_POST['delete_id_user'];

        $query ="DELETE FROM users WHERE id = '$id' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
           // $_SESSION['success'] = "Data is DELETED";
            header('Location: pharmacy.php');
        }else{
            //$_SESSION['status'] = "Data is NOT DELETED";
            header('Location: pharmacy.php');
        }
    }



?>


