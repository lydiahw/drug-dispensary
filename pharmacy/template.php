<?php

include('includes/header.php');
include('includes/navbar.php');

?>


<div class="container-fluid">
    <center>
        <header style ="font-size: 24px; font-weight:bold">
            Add Medicine
        </header>
    </center>
    <div class="col-12">
        <div class="car">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <form action="code.php" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for ="medicine_name">
                                        <b>Medicine Name</b>
                                    </label>
                                    <div class="col-md-12">
                                        <input type = "text" name="medicine_name" placeholder ="Medicine Name" class ="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for ="capacity">
                                        <b>Capacity</b>
                                    </label>
                                    <div class="col-md-12">
                                        <input type = "text" name="capacity" placeholder ="Medicine Capacity" class ="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for ="medicine_type">
                                        <b>Medicine Type</b>
                                    </label>
                                    <div class="col-md-12">
                                        <input type = "text" name="medicine_type" placeholder ="Medicine Type" class ="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for ="medicine_name">
                                        <b>The medicine is sold as a dose</b>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="radio" name = "dosage_sold" value ="yes" >Yes
                                        <input type="radio" name = "dosage_sold" value ="no" >No
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit" name="submit" >
                                            Submit
                                        </button>
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


<?php

include('includes/scripts.php');
include('includes/footer.php');

?>
   