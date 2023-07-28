<?php


require "conn.php";
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

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Patients </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            <?php
                                              
                                               
                                              $query = "SELECT UserID FROM doc_pat WHERE Role = 'patient' ORDER BY UserID";


                                               $query_run = mysqli_query($connection,$query);
     
                                               $row = mysqli_num_rows($query_run);
     
                                               echo '<h1> '.$row.' </h1>'
                                             
                                             ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doctors</div>
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
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Medicine List</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                               <?php
                                               
                                                 $query ="SELECT id FROM store ORDER by id";
                                                 $query_run = mysqli_query($connection,$query);
       
                                                 $row = mysqli_num_rows($query_run);
       
                                                 echo '<h1> '.$row.' </h1>'
                                               
                                               ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Expired Drugs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                              <?php
                                              $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
                                               
                                               $query = "SELECT id FROM store WHERE expiry_date < '$drug_expiry_date' ORDER BY id";

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


                    
                        

                        

                       
                        

                    <!--patinets awaiting-->
                    <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title text-gray-800 font-weight-bold">Patients Awaiting </h4>
                                    </div>
                                   
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="">
                                            <th class="border-top-0">Patient No</th>
                                            <th class="border-top-0">Doctor ID</th>
											<th class="border-top-0">Drug ID</th> 
                                            <th class="border-top-0">Quantity </th> 
                                            <th class="border-top-0">Frequency</th> 
                                            <th class="border-top-0">Total</th> 
                                        </tr>
                                    </thead>

    
                                    
                                    <?php

                                        require "conn.php";

                                        $sql = "SELECT * FROM prescription";
                                        $res = mysqli_query($connection, $sql);
                                    

                                      if($res == true){
                                           $count = mysqli_num_rows($res);
                        
                                         if($count > 0){


                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $PatientID = $rows['PatientID'];
                                                $DoctorID = $rows['DoctorID'];
                                                $DrugID = $rows['DrugID'];
                                                $Quantity = $rows['Quantity'];
                                                $Frequency = $rows['Frequency'];
                                                $Total = $rows['Total'];
                                            ?>
                                            <tbody id="output">
                                                <td><?php echo $PatientID; ?></td>
                                                <td><?php echo $DoctorID; ?></td>
                                                <td><?php echo $DrugID; ?></td>
                                                <td><?php echo $Quantity; ?></td>
                                                <td><?php echo $Frequency; ?></td>
                                                <td><?php echo $Total; ?></td>
                                                <td><a href="prescription.php?invoice=" class="btn btn-success">Attend</a></td>
                                                <td></td>
                                            </tbody>
                                            <?php
                                            }
                }
               }
               
            
            ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

    </div>
    <!-- End of Page Wrapper -->

   
   

   


  
<?php

include('includes/scripts.php');
include('includes/footer.php');

?>
   

