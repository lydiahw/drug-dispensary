<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Top Up Pharmacy
           
        </h6>
    </div>

    <?php
    
       if(isset($_SESSION['out-stock'])){
        echo $_SESSION['out-stock'];
        unset($_SESSION['out-stock']);
       }
    
    ?>

    <?php
    
       if(isset($_SESSION['exceeds-stock'])){
        echo $_SESSION['exceeds-stock'];
        unset ($_SESSION['exceeds-stock']);
       }
    
    ?>

    <div class="card-body">

        <div class="table-responsive">
         <form method =" POST" action="requisation.php">
          <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Stock Available</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>

             <?php

               require "conn.php";

               $sql = "SELECT * FROM store";
               $res = mysqli_query($connection, $sql);

               if($res == true){
                $count = mysqli_num_rows($res);
                $sn =1;
                if($count > 0){
                    while($rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $medicine_name = $rows['medicine_name'];
                        $type = $rows['type'];
                        $capacity = $rows['capacity'];
                        $Qty=$rows['Qty'];
                        $price = $rows['price'];
                        $expiry_date = $rows['expiry_date'];

                        ?>

                 <tbody id="output">
                    <tr>
                        
                        <td>
                            <input readonly class="form-control" value="<?php echo "$medicine_name";?> " name="medicine_name">
                        </td>
                        <td><?php echo $Qty;?></td>
                        <td><?php echo $expiry_date;?></td>
                        <td>
                           <a  href="requisation.php?id=<?php echo "$id"?>" class="btn btn-success" type="button">Receive</a>
                        </td>
                    </tr>
                </tbody>

                        <?php
                    }
                }
               }
               
            
            ?>

              

            
                
            </table>
         </form>
        </div>
    </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
