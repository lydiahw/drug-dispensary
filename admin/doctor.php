<?php
   include('security.php');

   include('includes/header.php');
   include('includes/navbar.php');

?>

<!-- Modal -->
<div class="modal fade" id="addusersprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Patients Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action ="pharmacycode.php" method ="POST">

      <div class="modal-body">

        <div class="form-group">
            <label>Name</label>
            <input type = "text" name="username" class="form-control" placeholder= "Enter Username">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type = "email" name="email" class="form-control" placeholder= "Enter Email">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type = "text" name="address" class="form-control" placeholder= "Enter Address">
        </div>
       
        <style>
          select {
             width: 465px; 
             height:40px
          }
        </style>
        <div class="form-group">
            <label>Password</label>
            <input type = "password" name="password" class="form-control" placeholder= "Enter Password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type = "password" name="confirmpassword" class="form-control" placeholder= "Confirm Password">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name ="userregisterbtn" class="btn btn-primary">Save </button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Patients
            <button type= "button" class="btn btn-primary" data-toggle="modal" data-target="#addusersprofile">
                Add Patients Profile 
            </button>
        </h6>
    </div>
    <div class="card-body">

      <?php
        
        if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
          echo '<h2> '.$_SESSION['success'].' </h2>';
          unset ($_SESSION ['success']);
        }
        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
          echo '<h2 class = "bg-info"> '.$_SESSION['status'].' </h2>';
          unset ($_SESSION ['status']);
        }
    
      ?>

        <div class="table-responsive">

        <?php
           //$connection = mysqli_connect("localhost", "root","", "drug_dispensary" );

           $query = "SELECT * FROM doc_pat";
           $query_run = mysqli_query($connection, $query)

        
        ?>

            <table class ="table table-bordered" id ="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                   
                   if(mysqli_num_rows($query_run) > 0){
                    while($row = mysqli_fetch_assoc($query_run)){
                      
                      ?>

                    
                    <tr>
                      <td><?php echo $row['UserID']; ?></td>
                      <td> <?php echo $row['Name']; ?></td>
                      <td> <?php echo $row['Email']; ?></td>
                      <td> <?php echo $row['Age']; ?></td>
                      <td> <?php echo $row['Address']; ?></td>
                      <td> <?php echo $row['Password']; ?></td>
                      <td> 
                        <form action="pharmacy_edit.php" method ="post">
                          <input type ="hidden" name="edit_id_user" value="<?php echo $row['UserID']; ?>">
                          <button type="submit" name ="edit_btn_user" class="btn btn-success" >EDIT </button>
                        </form>
                      </td>
                      <td> 
                        <form action="pharmacycode.php" method ="post">
                          <input type ="hidden" name="delete_id_user" value="<?php echo $row['UserID']; ?>">
                          <button type="submit" name ="delete_btn_user" class="btn btn-danger" >DELETE </button>
                        </form>
                      </td>
                      
                    </tr>

                    <?php
                    }
                   }
                    else{
                      echo "No record found";
                    }
                   
                
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
   
   include('includes/scripts.php');
   include('includes/footer.php');

?>