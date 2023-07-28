<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pharmacy Stock
            <button type= "button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Requisition
            </button>
        </h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">
          <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Medicine Name</th>
                        <th>Stock Available</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>

             <?php

               require "conn.php";

               if(isset($_GET['page'])){

                $page =$_GET['page'];

               }else{
                $page = 1;
               }

               $num_per_page = 10;
               $start_from = ($page -1)*10;

               $sql = "SELECT * FROM pharmacy_stock limit $start_from, $num_per_page";
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
                        $pharmacy_Qty=$rows['pharmacy_Qty'];
                        $price = $rows['price'];
                        $expiry_date = $rows['expiry_date'];
                        $expiry_date=$rows['expiry_date'];
                        $dosage_sold=$rows['dosage_sold'];
                        $dosage=$rows['dosage'];
                        $price_dosage=$rows['price_dosage'];
                        $dosage_sold=$rows['dosage_sold'];
                        $app=$rows['app'];

                        ?>

                 <tbody id="output">
                    <tr>
                        <th scope ="row"><?php echo $sn++; ?></th>
                        <td><?php echo $medicine_name;?></td>

                        <?php
                        
                           if($dosage_sold == "Yes"){

                            if($pharmacy_Qty < 2){
                                ?>
                                <td class = "text-white text-bold bg-danger"><?php echo $pharmacy_Qty ?></td>

                                <?php
                            }else{

                                ?>
                                <td class ="text-bold"><?php echo $pharmacy_Qty ?></td>
                                <?php
                            }
                           }else{
                            if($pharmacy_Qty < 2){
                                ?>

                                <td class ="text-white text-bold bg-danger"><?php echo $pharmacy_Qty ?></td>
                                <?php
                            }else{

                                ?>
                                <td class ="text-bold"><?php echo $pharmacy_Qty ?></td>
                                <?php
                            }
                           }
                        
                        ?>

                        <?php
                        
                           if($dosage_sold == "Yes"){
                            ?>
                            <td class= "text-bold"><?php echo $price_dosage?></td>
                            <?php
                           }else{
                            ?>
                            <td><?php echo $price;?></td>
                            <?php
                           }
                           ?>
                           <?php
                             if($dosage_sold == "Yes"){
                                ?>
                                <td class ="text-bold"><?php echo $price_dosage * $pharmacy_Qty ?></td>
                                <?php
                             }else{

                                ?>
                                <td><?php echo $price * $pharmacy_Qty;?></td>
                                <?php
                             }
                        
                        ?>

                        <td><?php echo $expiry_date;?></td>
                        <td>
                            <a href="update_pharmacy.php?id=<?php echo "$id"?> "class = "btn btn-success" type ="button">Add Damaged</a>
                        </td>
                       
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

    <div class="col-md-6 md-3">

        <?php
        
           $pr_query ="SELECT * from pharmacy_stock";
           $pr_result = mysqli_query($connection, $pr_query);
           $total_record = mysqli_num_rows($pr_result);

           $total_page = ceil($total_record/$num_per_page);
           
           if($page > 1){
            echo "<a href='pharmacy_stock.php?page=".($page-1)."' class='btn btn-warning'>Previous</a>";
           }

           for($i=1;$i<$total_page;$i++){
            echo "<a href='pharmacy_stock.php?page=".$i."' class='btn btn-success'>$i</a>";
           }

           if($i>$page){
            echo "<a href='pharmacy_stock.php?page=".($page+1)."' class='btn btn-warning'>Next</a>";
           }
        
        ?>

    </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
