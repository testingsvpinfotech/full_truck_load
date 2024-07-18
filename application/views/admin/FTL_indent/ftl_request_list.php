<?php include (dirname(__FILE__) . '/../admin_shared/admin_header.php'); ?>
<!-- END Head-->
<style>
  .buttons-copy {
    display: none;
  }

  .buttons-csv {
    display: none;
  }

  /*.buttons-excel{display: none;}*/
  .buttons-pdf {
    display: none;
  }

  .buttons-print {
    display: none;
  }

  /*#example_filter{display: none;}*/
  .input-group {
    width: 60% !important;
  }
</style>
<!-- START: Body-->

<body id="main-container" class="default">
  <?php include (dirname(__FILE__) . '/../admin_shared/admin_sidebar.php'); ?>
  <!-- START: Main Content-->
  <main>
    <div class="container-fluid site-width">
      <!-- START: Listing-->
      <div class="row">
        <div class="col-12  align-self-center">
          <div class="col-12 col-sm-12 mt-3">
            <div class="card">
              <div class="card-header justify-content-between align-items-center">
                <h4 class="card-title">View Indent Tripsheet</h4>
              </div>
              <div class="card-header">
                <form role="form" action="admin/view-ftl-request" method="GET" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="col-md-2">
                      <label for="">Filter</label>
                      <select class="form-control fillter" name="filter">
                        <option selected disabled>Select Filter</option>
                        <option value="indent_no" <?php echo (isset($filter) && $filter == 'indent_no') ? 'selected' : ''; ?>>Indent No</option>
                        <option value="origin_city" <?php echo (isset($filter) && $filter == 'origin_city') ? 'selected' : ''; ?>>Origin City</option>
                        <option value="destination_city" <?php echo (isset($filter) && $filter == 'destination_city') ? 'selected' : ''; ?>>Destination city</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="">Filter Value</label>
                      <input type="text" class="form-control"
                        value="<?php echo (isset($filter_value)) ? $filter_value : ''; ?>" name="filter_value" />
                    </div>
                    <div class="col-md-2">
                      <label for="">Customer</label>
                      <select class="form-control fillter" name="user_id" id="user_id">
                        <option value="">Selecte Customer</option>
                        <?php if (!empty($customer)) {
                          foreach ($customer as $key => $values) { ?>
                            <option value="<?php echo $values['customer_id']; ?>" <?php echo (isset($user_id) && $user_id == $values['customer_id']) ? 'selected' : ''; ?>>
                              <?php echo $values['customer_name']; ?></option><?php }
                        } ?>
                      </select>
                    </div>
                    <div class="col-sm-1">
                      <label for="">From Date</label>
                      <input type="date" name="from_date" value="<?php echo (isset($from_date)) ? $from_date : ''; ?>"
                        id="from_date" autocomplete="off" class="form-control">
                    </div>

                    <div class="col-sm-1">
                      <label for="">To Date</label>
                      <input type="date" name="to_date" value="<?php echo (isset($to_date)) ? $to_date : ''; ?>"
                        id="to_date" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-sm-2">
                      <br>
                      <input type="submit" class="btn btn-primary" name="submit" value="Filter">
                      <a href="admin/view-ftl-request" class="btn btn-info">Reset</a>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-body">
                <?php if ($this->session->flashdata('notify') != '') { ?>
                  <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-colored">
                    <?php echo $this->session->flashdata('notify'); ?>
                  </div>
                  <?php unset($_SESSION['class']);
                  unset($_SESSION['notify']);
                } ?>
                <div class="table-responsive">
                  <table class="table  table-responsive table-striped table-bordered" data-sorting="true">
                    <!-- id="example"-->
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th scope="col">Request ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Pickup Address</th>
                        <th scope="col">Origin Pincode</th>
                        <th scope="col">Origin City</th>
                        <th scope="col">Destination City </th>
                        <th scope="col">Destination Pincode</th>
                        <th scope="col">Vehicle Name</th>
                        <th scope="col">Vehicle Capacity</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Delivery Address</th>
                        <th scope="col">Delivery Contact Person</th>
                        <th scope="col">Delivery Contact Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Status</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php if (!empty($ftl_request_data)) {
                        $cnt = 1;
                        foreach ($ftl_request_data as $value): ?>
                          <tr>
                            <td><?php echo $cnt++; ?></td>
                            <td><a href="<?php echo base_url('admin/update_ftl_request/' . $value['id']); ?>"
                                class="text-info"><?php echo $value['ftl_request_id']; ?></a></td>
                            <td><?php echo $value['cust_name']; ?></td>
                            <td><?php echo $value['cid']; ?></td>
                            <td><?php echo $value['order_date']; ?></td>
                            <td><?php echo $value['request_date_time']; ?></td>
                            <td><?php echo $value['pickup_address']; ?></td>
                            <td><?php echo $value['o_pincode']; ?></td>
                            <td><?php echo $value['o_city']; ?></td>
                            <td><?php echo $value['d_city']; ?></td>
                            <td><?php echo $value['d_pincode']; ?></td>
                            <td><?php echo $value['vehicle_name']; ?></td>
                            <td><?php echo $value['vehicle_capacity']; ?></td>
                            <td><?php echo $value['contact_number']; ?></td>
                            <td><?php echo $value['delivery_address']; ?></td>
                            <td><?php echo $value['d_contact_name']; ?></td>
                            <td><?php echo $value['delivery_contact_no']; ?></td>
                            <td><?php echo $value['amount']; ?></td>
                            <td>
                              <?php echo $value['created_by'] . ' - ' . $value['username']; ?>

                            </td>
                            <td>
                              <?php if ($value['status'] == 0) { ?>
                                <button class="btn btn-warning btn-sm">Pending</button>
                                <button class="btn cancel_ftl btn-danger btn-sm" relid="<?php echo $value['id']; ?>">Cancel
                                  Order</button>
                              <?php } elseif ($value['status'] == 1) { ?>
                                <button class="btn btn-success">Approved</button>
                              <?php } else if ($value['status'] == 2) { ?>
                                  <button class="btn  btn-danger">Cancelled</button>
                              <?php } ?>
                            </td>


                          </tr>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="20" style="color:red;">No Data Found</td>
                        </tr>
                      <?php } ?>

                    </tbody>

                  </table>
                  <div class="row">
                    <div class="col-md-6">
                      <?php echo $this->pagination->create_links(); ?>
                    </div>
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


  <!-- ******************************* Cancel vendor ************************************************** -->

  <div id="show_cancel_modal" class="modal fade" role="dialog" style="background: #000;">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Are You Sure You Want To Cancel Order</h4>
          <form action="<?php echo base_url('FTLController/cancel_ftl_request'); ?>" method="POST">
            <input type="hidden" id="cancel_ftl_id" name="cancel_ftl_id" required>
            <input type="text" placeholder="Enter Cancel Reason" id="cancel_ftl_msg" name="cancel_ftl_msg"
              class="form-control" required><br>
            <input type="submit" class="btn btn-success" value="submit" name="submit">
          </form>
        </div>
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> -->

      </div>
    </div>
  </div>

  <!-- END: Content-->
  <!-- START: Footer-->

  <?php include (dirname(__FILE__) . '/../admin_shared/admin_footer.php'); ?>
  <!-- START: Footer-->
  <script src="<?= base_url('assets/js/domestic_shipment.js'); ?>"></script>
  <script>
    $(document).ready(function () {

      $('.cancel_ftl').click(function () {
        var id = $(this).attr('relid'); //get the attribute value
        $('#cancel_ftl_id').val(id);
        $('#show_cancel_modal').modal({ backdrop: 'static', keyboard: true, show: true });

      });
    });
  </script>
</body>
<!-- END: Body-->

</html>