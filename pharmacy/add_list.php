<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Item
            
        </h6>
    </div>

    <div class="table-responsive">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" action="add_item_inc.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                           <label for="example-email" class="col-md-12"> <b>Item Name</b></label>
                           <div class="col-md-12">
                             <input type="text" name="item_name" placeholder="Enter Item Name" class="form-control form-control-line" id="example-email">
                           </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                              <button class="btn btn-success" type="submit" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>