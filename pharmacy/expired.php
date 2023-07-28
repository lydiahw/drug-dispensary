<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Expired
            
        </h6>
    </div>

    <div class="card-body">
    <?php

require "conn.php";

$sql = "SELECT * FROM store";
$res = mysqli_query($connection, $sql);

if($res == true){
 $count = mysqli_num_rows($res);
 if($count > 0){
     while($rows = mysqli_fetch_assoc($res)){
         $id = $rows['id'];
         $medicine_name = $rows['medicine_name'];
         $type=$rows['type'];
         $capacity = $rows['capacity'];
         $Qty=$rows['Qty'];
         $price = $rows['price'];
         $amount=$rows['amount'];
         $expiry_date = $rows['expiry_date'];
         $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
         ?>
         <?php

}
        }
       }
       ?>

  <div class="table-responsive">
  <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Medicine Name</th>
                <th>Date Expired</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>

        <?php 
														
														
														
                 $sql ="SELECT * FROM store WHERE expiry_date < '$drug_expiry_date'";
                  //create a query that fetch data from the database
                  $res = mysqli_query($connection,$sql);

                  //check if there are any records in the database
                  if ($res == TRUE) {
                      $count = mysqli_num_rows($res);
                      $sn=1;
                      if($count > 0){
                          while ($rows=mysqli_fetch_assoc($res)) {
                              $id=$rows['id'];
                              $medicine_name=$rows['medicine_name'];
                              $type=$rows['type'];
                              $capacity=$rows['capacity'];
                              $Qty=$rows['Qty'];
                              $price=$rows['price'];
                              $amount=$rows['amount'];
                              $expiry_date= $rows['expiry_date'];
                              $dosage_sold= $rows['dosage_sold'];
                              $price_dosage= $rows['price_dosage'];
                              $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
                              $confirm= $rows['confirm'];
                            
                         ?>

     

         <tbody id="output">
            
                
                <td><?php echo $sn++;?> </td>
                <td><?php echo $medicine_name;?></td>
                <td><?php echo $expiry_date;?></td>
                <td><?php echo $Qty;?></td>
                <td>
                <?php 
                                           if ($dosage_sold == "Yes") {
                                            echo "$price_dosage";
                                           }else {
                                               echo "$price";
                                           }
                                       
                                       ?>	
                </td>
                <td>
                <?php 
                                        if ($price_dosage == '') {
                                            $price_dosage = '0';
                                        }
                                        else {
                                            $price_dosage = $rows['dosage_sold'];
                                        }
                                          $dosage_sold_total = $Qty * $price_dosage;
                                          $total = $Qty * $price;


                                           if ($dosage_sold == "Yes") {
                                            echo "$dosage_sold_total";
                                           }else {
                                               echo "$total";
                                           }
                                       
                                       ?>	
                </td>
                <td>
                <?php 
                                           
                                           if ($confirm == '0') {
                                               echo "Not Yet Confirmed";
                                           }else {
                                            echo "Confirmed";
                                           }
                                           ?>
                </td>
                <td>
                  <a href="delete_expired.php?id=<?php echo $id;?>" class="btn btn-warning"> Confirm</a>
                </td>
            
        </tbody>
        <?php
                          }
                        }
                    }
                    ?>

              
       
       
    
    

      

    
        
    </table>
</div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
