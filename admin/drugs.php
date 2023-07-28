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
        <h5 class="modal-title" id="exampleModalLabel">Add Medicine Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action ="medicinecode.php" method ="POST">

      <div class="modal-body">

        <div class="form-group">
            <label>Name</label>
            <input type = "text" name="medicine_name" class="form-control" placeholder= "Enter  Medicine Name">
        </div>
        <div class="form-group">
            <label>Type</label>
            <input type = "text" name="medicine_type" class="form-control" placeholder= "Enter Medicine Type">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type = "text" name="medicine_price" class="form-control" placeholder= "Enter Medicine Price">
        </div>
       
        <style>
          select {
             width: 465px; 
             height:40px
          }
        </style>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name ="medicinebtn" class="btn btn-primary">Save </button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Medicine
            <button type= "button" class="btn btn-primary" data-toggle="modal" data-target="#addusersprofile">
                Add Medicine
            </button>
        </h6>
    </div>
    <div class="card-body">

     

        <div class="table-responsive">

            <table class ="table table-bordered" id ="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Medicine Info</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>

                <?php

require "database/dbconfig.php";

$sql = "SELECT * FROM store";
$res = mysqli_query($connection, $sql);

if($res == true){
 $count = mysqli_num_rows($res);
 if($count > 0){
     while($rows = mysqli_fetch_assoc($res)){
         $id = $rows['id'];
         $medicine_name = $rows['medicine_name'];
         $capacity = $rows['capacity'];
         $type = $rows['type'];
         $price = $rows['price'];
         $expiry_date = $rows['expiry_date'];

         ?>

  <tbody id="output">
     <tr>
         <th scope ="row"></th>
         <td>
             <p>MID: <?php echo $id;?></p>
             <p>Name: <?php echo $medicine_name;?></p>
             <p> Expiry Date: <?php echo $expiry_date;?></p>
         </td>
         <td><?php echo $type;?></td>
         <td><?php echo $price;?></td>
         <td></td>
     </tr>

                </tbody>
                <?php
     }
    }
}
?>
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