<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Supplier
            
        </h6>
    </div>

    <div class="table-responsive">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal form-material" action="add_supplier_inc.php">
                        <div class="form-group">
                          <label for="example-email" class="col-md-12"> <b>Supplier Name</b></label>
                          <div class="col-md-12">
                             <input type="text" name="supplier_name" placeholder="Enter Supplier Name" class="form-control form-control-line" id="example-email">
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
