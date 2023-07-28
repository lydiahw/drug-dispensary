<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Move Medicine to Pharmacy
           
        </h6>

        <form action="manage_pharmacy_inc.php" method ="post" id ="manage-receiving">

          <?php
        
           if(isset($_GET['id'])){
            $id = $_GET['id'];
           }
        
          ?>

          <div class="col-md-12">
            <hr>
            <div class="row mb-3">

              <?php 
              
                require "conn.php";

                $sql = "SELECT * FROM store WHERE id = '$id' ";
                $res = mysqli_query($connection,$sql);

                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    $sn=1;
                    if($count > 0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id =$rows['id'];
                            $medicine_name =$rows['medicine_name'];
                            $Qty =$rows['Qty'];
                            $expiry_date =$rows['expiry_date'];

                            ?>
                            
                            <div class="col-md-6">
                                <label readonly class="control-label" for="">Medicine Name</label>
                                <input type="text" name ="medicine_name" value="<?php echo $medicine_name;?> || Expiry Date <?php echo "$expiry_date" ;?>" class="form-control text-right" step="any"  > 
                            </div>

                            <?php
                        }
                    }
                }
              
              ?>

              <div class="col-md-2 form-group">
                <label for="" class="control-label">Qty</label>
                <input type="text" name ="Aqty" class ="form-control text-right prc" id ="qty" step="any">
                <input type="hidden" name="Sqty" value="<?php echo $Qty;?>" class="form-control text-right prc" id="qty" step="any" >
                <input type="hidden" name="id" value="<?php echo $id;?>" class="form-control text-right prc" id="qty" step="any" >
              </div>

              <?php
              
                require "conn.php";

                $sql ="SELECT * FROM pharmacy_stock WHERE id = '$id'";

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn=1;
                    if($count > 0){
                        while ($rows=mysqli_fetch_assoc($res)) {
                            $id=$rows['id']; 
                            $pharmacy_Qty=$rows['pharmacy_Qty'];  	
                            ?>

                            <input type="hidden" name="Pqty" value="<?php echo $pharmacy_Qty;?>" class="form-control text-right prc" id="qty" step="any" >

                            <?php

                        }
                    }
                }
              
              ?>

              <div class="col-md-3">
                  <label class="control-label">&nbsp</label>
                  <button class="btn btn-block btn-sm btn-success" name="submit"  value="Reload Page" onClick="document.location.reload(true)" type="submit" id="add_list"><i class="fa fa-plus"></i> Add to Phamacy</button>
              </div>


            </div>
          </div>


        </form>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
