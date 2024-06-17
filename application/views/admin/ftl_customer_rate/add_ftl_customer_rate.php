<?php include(dirname(__FILE__) . '/../admin_shared/admin_header.php'); ?>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default">


  <!-- END: Main Menu-->

  <?php include(dirname(__FILE__) . '/../admin_shared/admin_sidebar.php'); ?>
  <!-- END: Main Menu-->

  <!-- START: Main Content-->
  <main>
    <div class="container-fluid site-width">
      <!-- START: Listing-->
      <div class="row">
        <div class="col-12">
          <div class="col-12 col-sm-12 mt-3">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">FTL Customer Rate Master</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <form role="form" action="admin/ftl-customer-rate-master" method="post">
                        <div class="box-body">
                          <div class="form-group row">
                            <label for="ac_name" class="col-sm-1 col-form-label">Customer Name</label>
                            <div class="col-sm-3">
                              <select class="form-control" name="ftl_customer_id" required>
                                <option value="0">Select Customer</option>
                                <?php foreach ($get_ftl_customer as $cc) { ?>
                                  <option value="<?php echo $cc['customer_id']; ?>"><?php echo $cc['customer_name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>


                          <br>

                          <div class="form-group row">

                            <label for="ac_name" class="col-sm-1 col-form-label">Vehicle Type</label>
                            <div class="col-sm-3">
                              <select class="form-control" name="vehicle_type" required>
                                <option value="0">Select Vehicle</option>
                                <?php foreach ($get_vehicle_type as $cc) { ?>
                                  <option value="<?php echo $cc['id']; ?>"><?php echo $cc['vehicle_name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>

                            <label for="ac_name" class="col-sm-1 col-form-label">Origin </label>
                            <div class="col-sm-3">
                              <select class="form-control" id="sender_city" name="origin" required>
                                <option value="">Select City</option>
                                <?php
                                if (count($cities)) {
                                  foreach ($cities as $rows) {
                                ?>
                                    <option value="<?php echo $rows['id']; ?>">
                                      <?php echo $rows['city']; ?>
                                    </option>
                                <?php }
                                }
                                ?>
                              </select>
                            </div>

                            <label for="ac_name" class="col-sm-1 col-form-label">Destination</label>
                            <div class="col-sm-3">

                              <select class="form-control" id="sender_city" name="destination" required>
                                <option value="">Select City</option>
                                <?php
                                if (count($cities)) {
                                  foreach ($cities as $rows) {
                                ?>
                                    <option value="<?php echo $rows['id']; ?>">
                                      <?php echo $rows['city']; ?>
                                    </option>
                                <?php }
                                }
                                ?>
                              </select>
                            </div>
                          </div>

                          <br>


                          <div class="form-group row">
                            <label for="ac_name" class="col-sm-1 col-form-label">From Date </label>
                            <div class="col-sm-3">
                              <input type="date" class="form-control" name="from_date" value="" required>
                            </div>

                            <label for="ac_name" class="col-sm-1 col-form-label">To Date</label>
                            <div class="col-sm-3">
                              <input type="date" class="form-control" name="to_date" value="" required>
                            </div>

                            <label for="ac_name" class="col-sm-1 col-form-label">Rate</label>
                            <div class="col-sm-3">
                              <!-- <input type="text" class="form-control" name="cod_rate" value="" placeholder="Enter COD Rate" required> -->
                              <input type="text" class="form-control" name="rate" value="" placeholder="Enter rate" required>
                            </div>
                          </div>

                          <br><br>
                          <div class="col-md-2">
                            <div class="box-footer">
                              <button type="submit" name="submit" class="btn btn-primary">Add Rate</button>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Listing-->
      </div>
  </main>
  <!-- END: Content-->
  <!-- START: Footer-->

  <?php include(dirname(__FILE__) . '/../admin_shared/admin_footer.php'); ?>
  <!-- START: Footer-->
</body>
<!-- END: Body-->

</html>