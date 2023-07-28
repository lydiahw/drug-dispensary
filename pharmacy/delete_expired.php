<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Receive Medicine 
            
        </h6>
    </div>

    <form action="delete_expired_inc.php" method="post" id="manage-receiving">
        <div class="col-md-12">

            <?php
            
               if(isset($_GET['id'])){
                $id = $_GET['id'];
               }
            
            ?>

            <hr>
            <div class="row mb-3">
                <div class="col-md-4">
                   <label class="control-label">Medicine Name</label>

                   <?php
                   
                     require "conn.php";

                     $sql ="SELECT * FROM store WHERE id = '$id'";
                     $res = mysqli_query($connection,$sql);

                     if($res == TRUE){
                        $count = mysqli_num_rows($res);
                        $sn=1;

                        if($count > 0){
                            while ($rows=mysqli_fetch_assoc($res)) {
                                $id=$rows['id'];
                                $medicine_name=$rows['medicine_name']; 
                                $Qty=$rows['Qty']; 	
                                $price=$rows['price']; 
                                $expiry_date =$rows['expiry_date'];	
                                $app =$rows['app'];	
                                $dosage_sold =$rows['dosage_sold'];	
                                $total = $Qty * $price;	
                                ?>

                                <input type="text" name="medicine_name" value="<?php echo "$medicine_name";?> " class="form-control text-right" step="any"  >

                                <?php
                            }
                        }
                     }
                   
                   ?>
                </div>

                <div class="col-md-4">
                   <label class="control-label">Available Quanitity</label>
                   <input type="text" name="available_quanitity" class="form-control text-right" step="any" value="<?php echo $Qty?>" >
                   <input type="hidden" name="amount" class="form-control text-right" step="any" value="<?php echo $total?>" >
                   <input type="hidden" name="price" class="form-control text-right" step="any" value="<?php echo $price?>" >
                </div>

                <div class="col-md-2">
                   <label class="control-label">Expired Qty</label>
                   <input type="text" name="expiried_qty" class="form-control text-right" step="any" >
                </div>

                <div class="col-md-2">
                  <label class="control-label">Expiry Date</label>
                  <input type="date" name="expiry_date" class="form-control text-right" step="any" >
                </div>

                <div class="col-md-2 form-group">
                  <input type="hidden" name="id" value="<?php echo "$id";?>" class="form-control text-right prc" id="qty" step="any" >	
                </div>
            </div>

            <div class="col-md-12 mb-3 float-right">
               <label class="control-label">&nbsp</label>
               <button class="btn btn-block btn-lg btn-danger " name="delete"  value="Reload Page" type="submit" id="add_list"><i class="fa fa-plus"></i> Delete</button>
            </div>

        </div>
    </form>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>