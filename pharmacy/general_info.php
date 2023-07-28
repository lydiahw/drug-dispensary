<?php

include('includes/header.php');
include('includes/navbar.php');

require('conn.php');
$sql =  "SELECT * FROM pharmacy_info";
$res = mysqli_query($connection,$sql);
$count = mysqli_num_rows($res);

if($count > 0){
    $row = mysqli_fetch_assoc($res);
    //header("Location:dashboard.php");
}
?>


<div class = "wrapper">
    <section>
        <center>
            <header>
                Pharmacy General Information
            </header>
        </center>

        <form action="code.php" class = "header" method ="POST">

                <div class="form-group">
                    <label>Pharmacy Name</label>
                    <input type = "text" name="name" value="" class="form-control" placeholder= "Enter Pharmacy Name">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type = "text" name="address" value="" class="form-control" placeholder= "Enter Address">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type = "number" name="number" value="" class="form-control" placeholder= "Enter Phone Number">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type = "email" name="email" value="" class="form-control" placeholder= "Enter Email">
                </div>
                <div class="form-group">
                    <label>Opening Date</label>
                    <input type = "date" name="opening_date" value="" class="form-control" placeholder= "Enter Opening Date">
                </div>
                <div class="form-group">
                    <label>Closing Date</label>
                    <input type = "date" name="closing_date" value="" class="form-control" placeholder= "Enter Closing Date">
                </div>
                <div class="form-group">
                    <label>Opening Balance</label>
                    <input type = "text" name="opening_balance" value="" class="form-control" placeholder= "Enter Opening Balance">
                </div>
                <div class="form-group">
                    <label>Closing Balance</label>
                    <input type = "text" name="closing_balance" value="" class="form-control" placeholder= "Enter Closing Balance">
                </div>
                <center>
                <button type ="submit" name ="submitbtn" class ="btn btn-primary">Submit</button>
                </center>

            </form>
    </section>
</div> 


<?php

include('includes/scripts.php');
include('includes/footer.php');

?>