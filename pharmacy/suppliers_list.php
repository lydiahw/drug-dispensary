<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Suppliers
        <a href="supplier.php" class="btn btn-primary">Add Supplier</a>
        
        </h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">
          <table class ="table table-bordered" id ="table-data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Supplier</th>
                        <th>Action</th>
                        
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

               $sql = "SELECT * FROM suppliers";
               $res = mysqli_query($connection, $sql);

               if($res == true){
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count > 0){
                    while($rows = mysqli_fetch_assoc($res)){
                        $supplier_name =$rows['supplier_name'];

                        ?>

                 <tbody id="output">
                    <tr>
                        <th scope ="row"><?php echo $sn++;?></th>
                        <td class ="text-bold"><?php echo $supplier_name;?></td>
                        <td class="text-bold">
                            <button type ="submit" class ="btn btn-success">EDIT</button>
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
        
          $pr_query = "select * from suppliers ";
          $pr_result = mysqli_query($connection, $pr_query);
          $total_record = mysqli_num_rows($pr_result);
          $total_page = ceil($total_record/$num_per_page);

          if($page>1){
            echo "<a href='supplier.php?page=".($page-1)."' class='btn btn-warning'>Previous</a>";
          }

          for($i=1;$i<$total_page;$i++){
            echo "<a href='supplier.php?page=".$i."' class='btn btn-success'>$i</a>";
          }

          if($i>$page){
            echo "<a href='supplier.php?page=".($page+1)."' class='btn btn-warning'>Next</a>";
          }
        
        ?>
    </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
