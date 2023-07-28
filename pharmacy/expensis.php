<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Store List
           
        </h6>
    </div>



    <div class="card-body">

        <?php
        
           require "conn.php";

           $sql = "SELECT * FROM store";
           $res = mysqli_query($connection, $sql);

           if($res ){
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
                    $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
                    ?>

                    <?php
                }
            }
           }
        
        ?>
      <div class="card">
        <div class="card-body">
        <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Expired Medicine List
           
            </h6>
          </div>

        
        <div class="table-responsive">
          <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Medicine Name</th>
                        <th>Date Expired</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        
                    </tr>
                </thead>

            <?php

               require "conn.php";

               $sql = "SELECT * FROM expired_medince";
               $res = mysqli_query($connection, $sql);

               if($res == true){
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $medicine_name = $rows['medicine_name'];
                        $date_expired=$rows['date_expired'];
                        $qty=$rows['qty'];
                        $amount=$rows['amount'];

                        ?>

                 <tbody id="output">
                    
                        
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $medicine_name;?></td>
                        <td><?php echo $date_expired;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $amount;?></td>
                        <td></td>
                    
                </tbody>

                        <?php
                    }
                }
               }
               
            
            ?>
  
            </table>
        </div>
        <hr>
        <div class="px-3 py-2" align ="right">
            <h4>Total:
                <?php
                   $sql ="SELECT SUM(amount) as 'amount' FROM expired_medince";
                   $res = mysqli_query($connection,$sql);
                   $data = mysqli_fetch_array($res);	
                   ?>
                   <?php  echo $data['amount'];?>
            </h4>
        </div>
        </div>
      </div>
      <hr>

      <div class="card">
        <div class="card-body">
        <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary"> List of Damaged Medicine
           
            </h6>
          </div>

        
        <div class="table-responsive">
          <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        
                        <th>Medicine Name</th>
                        <th>Quantity Damaged</th>
                        <th>Price</th>
                        <th>Amount</th>
                        
                    </tr>
                </thead>

             <?php

               require "conn.php";

               if(isset($_GET['page'])){
                $page = $_GET['page'];
               }else{
                $page = 1;
               }

               $num_per_page = 10;
               $start_from = ($page-1)*10;

               $sql = "SELECT * FROM damaged limit $start_from,$num_per_page ";
               $res = mysqli_query($connection, $sql);

               if($res == true){
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count > 0){
                    while($rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $name=$rows['name'];   
                        $qty=$rows['qty'];
                        $price=$rows['price'];
                        $amount=$rows['amount'];

                        ?>

                 <tbody id="output">
                    
                    <tr>    
                        
                        <td><?php echo $name;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $amount;?></td>
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
        <hr>
        <div class="px-3 py-2" align ="right">
            <h4>Total:
                <?php
                   $sql ="SELECT SUM(amount) as 'amount' FROM damaged";
                   $res = mysqli_query($connection,$sql);
                   $data = mysqli_fetch_array($res);	
                   ?>
                   <?php  echo $data['amount'];?>
            </h4>
        </div>
        </div>
      </div>

        
    </div>
</div>    




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>


