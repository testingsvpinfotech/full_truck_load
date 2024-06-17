 <?php  $this->load->view('admin/admin_shared/admin_header'); ?>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

    	 <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar'); ?>

        <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar');
   // include('admin_shared/admin_sidebar.php'); ?>
        <!-- END: Main Menu-->
    
        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Listing-->
                <div class="row">
                 <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title">Add Vendor</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form role="form" action="<?php echo base_url();?>admin/add-vendor" method="post" enctype="multipart/form-data">

                                                <div class="form-row">
                                                    <div class="col-3 mb-3">
                                                        <label>Vendor Name</label>
                                                        <input type="text" name="vendor_name" class="form-control" >
                                                    </div>
													 <div class="col-3 mb-3">
                                                        <label>Contact</label>
                                                        <input type="text" name="v_contact" class="form-control" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Address</label>
                                                        <input type="text" name="v_add" class="form-control" >
                                                    </div>
													 <div class="col-3 mb-3">
                                                        <label>Pincode</label>
                                                        <input type="text" name="v_pincode" id="v_pincode" class="form-control" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>State</label>
														<input type="text" name="v_state" id="v_state" class="form-control" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>City</label>
														<input type="text" name="v_city" id="v_city" class="form-control" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Rate Per KG</label>
                                                        <input type="text" name="v_rate_perkg" class="form-control" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Minimum</label>
                                                        <input type="text" name="v_minimum" class="form-control" >
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-row">
                                                    <div class="col-3 mb-3">
                                                        <label>Vendor Full Name</label>
                                                        <input name="vendor_name" class="form-control" placeholder="Enter Full Name" >
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Reference Person Name</label>
                                                        <input type="text" name="v_rate_perkg" class="form-control" placeholder="Enter reference person">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Contact No</label>
                                                        <input type="text" name="v_contact" class="form-control" placeholder="Enter contact number">
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Email</label>
                                                        <input type="text" name="v_add" class="form-control" placeholder="Enter Email">
                                                    </div>
													 <div class="col-3 mb-3">
                                                        <label>Username</label>
                                                        <input type="text" name="v_pincode" id="v_pincode" class="form-control" placeholder="Enter username">
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Address</label>
                                                        <textarea name="v_minimum" class="form-control" placeholder="Enter address" rows="1"></textarea>
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Alternate Contact No</label>
														<input type="text" name="v_state" id="v_state" class="form-control" placeholder="Enter alternate contact number">
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Alternate Email</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Alternate Email">
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>State</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter State">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>City</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter City">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Pincode</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter Pincode">
                                                    </div>
													<div class="col-3 mb-3">
                                                        <label>Credit Days</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter credit days">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Service Provider</label>
														<select name="v_city" id="v_city" class="form-control">
                                                            <option value="">Please Select</option>
                                                            <option value="Fleet Owner">Fleet Owner</option>
                                                            <option value="Broker">Broker</option>
                                                            <option value="Attach Vehicle">Attach Vehicle</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Bank Name</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter bank name">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Account No</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter account no">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>IFSC Code</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter IFSC code">
                                                    </div>

                                                    <div class="col-3 mb-3">
                                                        <label>Registration Type</label>
														<select name="v_city" id="v_city" class="form-control">
                                                            <option value="">Please Select</option>
                                                            <option value="Registered">Registered</option>
                                                            <option value="Unregistered">Unregistered</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>PAN No</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter PAN No">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>GST No</label>
														<input type="text" name="v_city" id="v_city" class="form-control" placeholder="Enter GST No">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                    <label>Assign Branch</label>
														<select name="v_city" id="v_city" class="form-control">
                                                            <option value="">Please Select</option>
                                                            <option value="Registered">Registered</option>
                                                            <option value="Unregistered">Unregistered</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-3 mb-3">
                                                        <label>Upload Cancel Cheque</label>
														<input type="file" name="v_city" id="v_city" class="form-control" placeholder="Enter GST No">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>PAN Card</label>
														<input type="file" name="v_city" id="v_city" class="form-control" placeholder="Enter GST No">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>GST Certification</label>
														<input type="file" name="v_city" id="v_city" class="form-control" placeholder="Enter GST No">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label>Address Proof</label>
														<input type="file" name="v_city" id="v_city" class="form-control" placeholder="Enter GST No">
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <hr>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tr>    
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>State</th>
                                                                    <th>Pincode</th>
                                                                    <th></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="form-control" placeholder="Enter Address"></td>
                                                                    <td><input class="form-control" placeholder="Enter City"></td>
                                                                    <td><input class="form-control" placeholder="Enter State"></td>
                                                                    <td><input class="form-control" placeholder="Enter Pincode"></td>
                                                                    <td><button class="btn btn-sm btn-primary">Add New</button></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    </div>
                                                </div> -->
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
        <?php $this->load->view('admin/admin_shared/admin_footer');
         //include('admin_shared/admin_footer.php'); ?>
        <!-- START: Footer-->
		<script type="text/javascript">
$("#v_pincode").on('blur', function () 
  {
    var pincode = $(this).val();
    if (pincode != null || pincode != '') {

    
      $.ajax({
        type: 'POST',
        url: 'Admin_vendor/getPincodeInfo',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) 
		{         
          $('#v_city').val(d.city);
          $('#v_state').val(d.state);
          
        }
      });
    
    }
  }); 
</script>		
    </body>
    <!-- END: Body-->
</html>
