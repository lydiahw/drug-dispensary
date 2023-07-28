<?php
   include('security.php');
   
   include('includes/header.php');
   include('includes/navbar.php');
   

?>




<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">EDIT Pharmacist Profile </h6>
    </div>
    <div class="card-body">


    <?php

    

    if(isset($_POST['edit_btn_user'])){
        $id = $_POST['edit_id_user'];
        
        $query = "SELECT * FROM users WHERE id = '$id' ";
        $query_run = mysqli_query($connection, $query);

        foreach($query_run as $row){

            ?>

            <form action="userscode.php" method="POST">
                
                <input type="hidden" name ="edit_id_user" value="<?php echo $row['id'] ?>">

                <div class="form-group">
                    <label>Username</label>
                    <input type = "text" name="edit_name_user" value="<?php echo $row['username'] ?>" class="form-control" placeholder= "Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type = "email" name="edit_email_user" value="<?php echo $row['email'] ?>" class="form-control" placeholder= "Enter Email">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type = "text" name="edit_address_user" value="<?php echo $row['address'] ?>" class="form-control" placeholder= "Enter Address">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type = "password" name="edit_password_user" value="<?php echo $row['password'] ?>" class="form-control" placeholder= "Enter Password">
                </div>

                <a href ="users.php" class ="btn btn-danger">CANCEL</a>
                <button type ="submit" name ="updatebtn_user" class ="btn btn-primary">Update</button>

            </form>

        <?php
        }
    }

    ?>


</div>
</div>
</div>

</div>



<?php
   
   include('includes/scripts.php');
   include('includes/footer.php');

?>