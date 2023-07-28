<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<div class ="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Patients</h1>
    </div>
    <div class = "patient-form">
        <?php
        
            if(isset($_GET['id'])){
                $patient_no = $_GET['id'];
            }
        
        ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h3 class = "card-title"><?php echo $patient_no;?></h3>
                </div>
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="code.php" method="post">
                                    <div class="form-group">
                                        <label for="patient_name" class="col-md-12"><b>Patient Name</b></label>
                                        <div class="col-md-12">
                                            <input type="text" name="patient_name" placeholder="Enter Patient Name" class="form-control form-control-line" id="patient_name">
                                            <input type="hidden" name="patient_no" placeholder ="Enter Patient Number" class="form-control form-control-line" id="patient_no">
                                            <input type="hidden" name="status" placeholder="Enter Patient Name"class="form-control form-control-line" id="example-email" value = "0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class ="col-md-12"><b> Date of Birth</b></label>
                                        <div class="col-md-12">
                                           <input type="date" name="dob" placeholder="Enter date of birth "class="form-control form-control-line" id="dob"> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class ="col-md-12"><b> Address</b></label>
                                        <div class="col-md-12">
                                           <input type="text" name="location" placeholder="Enter Address "class="form-control form-control-line" id="dob"> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                           <button class ="btn btn-success" type="submit" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
