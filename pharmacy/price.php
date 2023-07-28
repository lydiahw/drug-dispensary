<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <center>
        <header style="font-size: 24px; font-weight:bold">
            Add Medicine Price
        </header>
    </center>
    <div class="col-12">
        <div class="car">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="code.php" method="POST" class="form-horizontal form-material">

                                                <?php
                                                if (isset($_POST['submit_medicine'])) {
                                                    $medicine_name = $_POST['medicine_name'];
                                                    $capacity = $_POST['capacity'];
                                                    $medicine_type = $_POST['medicine_type'];
                                                    $dosage_sold = $_POST['dosage_sold'];
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="medicine_name" value="<?php echo htmlspecialchars($medicine_name); ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="medicine_type" value="<?php echo $capacity; ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="capacity" value="<?php echo $medicine_type; ?>">
                                                    </div>
                                                </div>

                                                <?php
                                                if (isset($_POST['submit_medicine'])) {
                                                    if ($dosage_sold === 'Yes') {
                                                        ?>
                                                        <input type="hidden" name ="dosage_sold" value="<?php echo $dosage_sold; ?>">
                                                        <div class="form-group">
                                                            <label for="dosage">Dosage</label>
                                                            <input type="number" class="form-control from-control-line" name="dosage" placeholder="Enter Dosage">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount_packet">Amount in Packet</label>
                                                            <input type="number" class="form-control from-control-line" name="packet_amount" placeholder="Enter Amount">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="adult_dose_price">Adult Dose Price</label>
                                                            <input type="number" class="form-control from-control-line" name="adult_dose_price" placeholder="Enter Adult Dosage">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="child_dose_price">Child Dose Price</label>
                                                            <input type="number" class="form-control from-control-line" name="child_dose_price" placeholder="Enter Child Dosage">
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" class="form-control form-control-line" name="price">
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-success" name="add">Submit</button>
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
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
