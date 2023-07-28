<?php

include('security.php');

if (isset($_POST['medicinebtn'])){
    $medicine_name = $_POST['medicine_name'];
    $type = $_POST['medicine_type'];
    $price = $_POST['medicine_price'];
    
   

   
        $query = " INSERT INTO store (medicine_name, type, price) VALUES ('$medicine_name', '$type', '$price')";
        $query_run = mysqli_query($connection,$query);

        if($query_run){
            //echo"saved";
            //$_SESSION['success'] ="User Added";
            header('Location: drugs.php');
        }else{
            //echo "Not saved"
            //$_SESSION['success'] ="User NOT Added";
            header('Location: drugs.php');
        }
    }else{
        $_SESSION['status'] ="Password and Confirm Password Do Not Match";
        header('Location: pharmacy.php');
    

   
}

?>