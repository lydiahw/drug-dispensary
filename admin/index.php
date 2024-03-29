<?php
   include('security.php');

   include('includes/header.php');
   include('includes/navbar.php');


?>

                <!-- Begin Page Content -->
<div class="container-fluid">

     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
       
    </div>

    <!-- Content Row -->
    <div class="row">

         <!-- TOTAL NUMBER OF REGISTERED ADMIN -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                                             
                                        $query ="SELECT id FROM admin ORDER by id";
                                        $query_run = mysqli_query($connection,$query);

                                        $row = mysqli_num_rows($query_run);

                                        echo '<h1> '.$row.' </h1>'
                                                
                                    ?>
                                                
                                </div>
                            </div>
                        <div class="col-auto">
                        <i class="fa fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- TOTAL NUMBER OF REGISTERED USERS -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Registered Pharmacists</div>
                            <?php

                                $query ="SELECT id FROM users ORDER by id";
                                $query_run = mysqli_query($connection,$query);

                                $row = mysqli_num_rows($query_run);

                                echo '<h1> '.$row.' </h1>'
                                                
                            ?>
                        </div>
                    <div class="col-auto">
                    <i class="fa fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Registered Patients
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                                    <?php
                                              
                                               
                                              $query = "SELECT UserID FROM doc_pat WHERE Role = 'patient' ORDER BY UserID";


                                               $query_run = mysqli_query($connection,$query);
     
                                               $row = mysqli_num_rows($query_run);
     
                                               echo '<h1> '.$row.' </h1>'
                                             
                                             ?>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Registered Doctors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            <?php
                                              
                                               
                                                $query = "SELECT UserID FROM doc_pat WHERE Role = 'doctor' ORDER BY UserID";


                                                 $query_run = mysqli_query($connection,$query);
       
                                                 $row = mysqli_num_rows($query_run);
       
                                                 echo '<h1> '.$row.' </h1>'
                                               
                                               ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                   
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

    

<?php

    include('includes/scripts.php');
    include('includes/footer.php');


?>

    
    

  

