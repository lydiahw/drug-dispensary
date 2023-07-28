<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="container">
	   <div class="row">
		  <div class="col-md-6 mx-auto mt-5">
			 <div class="payment">
				<div class="payment_header bg-danger">
				   <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
				</div>
				<div class="content">
				   <h1>Failed !</h1>
                   <?php 
                   
                        if (isset($_SESSION['out-stock'])) {
                            echo $_SESSION['out-stock'];
                            unset ($_SESSION['out-stock']);
                        }
               ?>
				   <?php 
                        if (isset($_SESSION['patient_no'])) {
                          $id = $_SESSION['patient_no'];
                          $invoice = $_SESSION['invoice'];
                          
                        }
               ?>
				   <a href="prescription.php?invoice=<?php echo $invoice;?> && patient_id=<?php echo $id;?>">Go Back </a>
				</div>
				
			 </div>
		  </div>
	   </div>
	</div>


    <?php
include('includes/scripts.php');
include('includes/footer.php');
?>