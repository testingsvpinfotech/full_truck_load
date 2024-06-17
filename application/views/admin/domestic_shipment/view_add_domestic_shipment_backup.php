<?php include(dirname(__FILE__).'/../admin_shared/admin_header.php'); ?>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        
        <!-- END: Main Menu-->
   
    <?php include(dirname(__FILE__).'/../admin_shared/admin_sidebar.php'); ?>
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
                              <h4 class="card-title">Add Domestic Shipment</h4><span style="float: right;"></span>
                          </div>
						    <div class="card-content">
                          <div class="card-body">
						   <div class="row">                                           
                            <div class="col-12">
                           <form role="form" id="generatePOD" action="admin/add-domestic-shipment" method="post" >
								<div class="box-body">
								  <input type ="hidden" name="rate" id="rate" />
									<input type ="hidden" name="rate_pack" id="rate_pack" />
									<input type="hidden" name="amount_manual" id="amount_manual" value="0" />
									<input type="hidden" name="gst_rate" id="gst_rate" />
									<input type="hidden" name="roundoff_type" id="roundoff_type" />
									<div class="form-group row">
									<h5 class="col-sm-12 card-title">Shipment Info</h5>
								</div>
								
								<hr>
								<div class="form-group row">
										<!-- <label class="col-sm-2 col-form-label">Shipment Type</label>
										<div class="col-sm-2">
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio"  name="doc_type" class="custom-control-input" id="doc_typee" value="1" required>
												<label class="custom-control-label checkbox-primary outline" for="doc_typee">Non-Doc</label>
											</div>	
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" name="doc_type" class="custom-control-input" id="doc_type" value="0" required>
												<label class="custom-control-label checkbox-primary outline" for="doc_type">Doc</label>
											</div>
										</div> -->
										<label class="col-sm-2 col-form-label">Courier Company</label>
										<div class="col-sm-2">
											<select class="form-control" name="courier_company" id="courier_company" >
												<option value="">-Select Courier Company-</option>
        										<?php	
												if(!empty($courier_company))
												{
													foreach ($courier_company as $cc)
													{
														?>
														<option value='<?php echo $cc['c_id']; ?>' data-id="<?php echo $cc['c_company_name']; ?>"><?php echo $cc['c_company_name']; ?></option>
														<?php 
													}
												}
												?>
											</select>	
										</div>
										
										<label class="col-sm-2 col-form-label">Mode Of Dispatch</label>
										<div class="col-sm-2">
											<select class="form-control mode_dispatch" name="mode_dispatch" id="mode_dispatch">
												<option value="">-Select Mode-</option>
        										<?php	
												if(!empty($transfer_mode))												
												{
													foreach ($transfer_mode as $row)
													{
													?>	
														<option value='<?php echo $row->transfer_mode_id; ?>'><?php echo $row->mode_name; ?></option>
													<?php 	
													}
												}
													?>
												
											</select>		
										</div>
										<label  class="col-sm-2 col-form-label">Airway No</label>
										<div class="col-sm-2">
											<input type="text" name="awn" id="awn" class="form-control my-colorpicker1" value="<?php echo $bid; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label  class="col-sm-2 col-form-label">Forwording No.</label>
										<div class="col-sm-2">
											<input type="text" name="forwording_no" class="form-control my-colorpicker1">
										</div>	
										<label  class="col-sm-2 col-form-label">Forworder Name</label>
										<div class="col-sm-2">
										  <input type="text" name="forworder_name" class="form-control" id="forworder_name" readonly>
										</div>	
										<label  class="col-sm-2 col-form-label">Special Instruction</label>
										<div class="col-sm-2">
											<textarea name="special_instruction" class="form-control my-colorpicker1"></textarea>
										</div>
									</div>
									<div class="form-group row">										
										<label  class="col-sm-2 col-form-label">Booking Date</label>
										<div class="col-sm-2">
										<input type="text" name="booking_date" value="<?php echo date('d-m-Y H:i:s');?>" id="booking_date" class="form-control my-colorpicker1 datepicker">
										</div>
										<label  class="col-sm-2 col-form-label">Estimate Delivery Date</label>
										<div class="col-sm-2">
												<input type="text" id="delivery_date" name="delivery_date" value="<?php echo date('d-m-Y');?>" id="eod" class="form-control my-colorpicker1 datepicker">
										</div>	
									</div>
									<div class="form-group row">										
											<label   class="col-sm-2 col-form-label">Payment Details</label>
											<div class="col-sm-4">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" name="dispatch_details" class="custom-control-input" id="credit" value="credit">
													<label class="custom-control-label checkbox-primary outline" for="credit">Credit</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" name="dispatch_details" class="custom-control-input" id="cash" value="cash">
													<label class="custom-control-label checkbox-primary outline" for="cash">Cash</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" name="dispatch_details" class="custom-control-input" id="topay" value="To Pay">
													<label class="custom-control-label checkbox-primary outline" for="topay">To Pay</label>
												</div>												
											</div>
											
										</div>
									<hr>
									<div class="form-group row">
										<h5 class="col-sm-12 card-title">Consigner Detail</h5>
										<label  class="col-sm-2 col-form-label">Customer Name</label>
										<div class="col-sm-2" id="credit_div">
											 <select class="form-control"  name="customer_account_id" id="customer_account_id">
												<option value="">Select Customer</option>
												<?php
													if (count($customers)) {
														foreach ($customers as $rows) {
															?>
												<option value="<?php echo $rows['customer_id']; ?>">
													<?php echo $rows['customer_name']; ?>--<?php echo $rows['cid']; ?> 
												</option>
												<?php
													}
													} else {
													echo "<p>No Data Found</p>";
													}
													?>
											</select>
										</div>
											<label class="col-sm-2 col-form-label" id="credit_div_label">Name</label>
											<div class="col-sm-2">
												<input type="text" name="sender_name" readonly id="sender_name" class="form-control my-colorpicker1">
											</div>
											<label class="col-sm-2 col-form-label">Address</label>
											<div class="col-sm-2">
												<textarea name="sender_address" readonly id="sender_address" class="form-control"></textarea>
												<!-- <input type="text" name="sender_address" readonly id="sender_address" class="form-control my-colorpicker1"> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Pincode</label>
											<div class="col-sm-2">
												<input type="text" name="sender_pincode" readonly id="sender_pincode" class="form-control my-colorpicker1">
											</div>
											<label class="col-sm-2 col-form-label">City</label>
											<div class="col-sm-2">
												<select class="form-control"  name="sender_city" readonly id="sender_city" required>
													<option value="">Select City</option>
													<?php
														if (count($cities)) {
															foreach ($cities as $rows) {
																?>
													<option value="<?php echo $rows['id']; ?>">
														<?php echo $rows['city']; ?> 
													</option>
													<?php }
														} else {
														echo "<p>No Data Found</p>";
														}
														?>
												</select>
											</div>
											<label class="col-sm-2 col-form-label">State</label>
											<div class="col-sm-2">
												<select class="form-control" id="sender_state" name="sender_state">
												<option value="">Select State</option>													
													<?php 
														if(count($states)) {
															foreach ($states as $st) {
																?>
													<option value="<?php echo $st['id']; ?>">
														<?php echo $st['state']; ?> 
													</option>
													<?php }
														} else {
														echo "<p>No Data Found</p>";
														}
														?>
												</select>
											</div>
											</div>
											<div class="form-group row">
											<label class="col-sm-2 col-form-label">Contact No.</label>
											<div class="col-sm-2">
												<input type="text" name="sender_contactno" readonly id="sender_contactno" class="form-control my-colorpicker1">
											</div>										
											<label class="col-sm-2 col-form-label">Sender GST NO.</label>
											<div class="col-sm-2">
												<span><input type="text" name="sender_gstno" readonly id="sender_gstno" class="form-control my-colorpicker1" readonly></span>
											</div>
											</div>
											<hr>
									<div class="form-group row">
											<h5 class="col-sm-12 card-title">Consignee Detail</h5>
												<label class="col-sm-2 col-form-label">Name</label>
											<div class="col-sm-2">
												<input type="text" name="reciever_name" id="reciever" class="form-control my-colorpicker1" required>
											</div>
											<label   class="col-sm-2 col-form-label">Company Name</label>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="contactperson_name"  />
											</div>

											<label class="col-sm-1 col-form-label">Address</label>
											<div class="col-sm-3">
												<textarea name="reciever_address" id="reciever_address" class="form-control my-colorpicker1"></textarea>	
											</div>
											
									</div>
									<div class="form-group row">
										<label   class="col-sm-2 col-form-label">Contact No.</label>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="reciever_contact"/>
											</div>						
										<label class="col-sm-2 col-form-label">Pincode</label>
										<div class="col-sm-2">
											<input type="text" name="reciever_pincode" id="reciever_pincode" class="form-control my-colorpicker1">
										</div>
										<label   class="col-sm-2 col-form-label">City Name</label>
										<div class="col-sm-2">
											<select class="form-control" id="reciever_city" name="reciever_city">
											<option value="">Select City</option>
											</select>
										</div>
									</div>

									
									<div class="form-group row">
											<label   class="col-sm-2 col-form-label">State Name</label>
											<div class="col-sm-2">
												<select class="form-control" id="reciever_state" name="reciever_state">
												<option value="">Select State</option>
												</select>
											</div>
											<label class="col-sm-2 col-form-label">Reciever GST NO.</label>
											<div class="col-sm-2">
												<input type="text" name="receiver_gstno" id="receiver_gstno" class="form-control my-colorpicker1">
											</div>
											<label class="col-sm-2 col-form-label">Ref No</label>
											 <div class="col-sm-2">
													<input type="text" name="ref_no" id="ref_no" class="form-control">
											</div>
												
										</div>
										<div class="form-group row">
												<label class="col-sm-2 col-form-label">INV No.</label>
												<div class="col-sm-2">
												<input type="text" name="invoice_no" id="invoice_no" class="form-control my-colorpicker1">
												</div>
												<label class="col-sm-2 col-form-label">Inv. Value</label>
												<div class="col-sm-2">
												<input type="text" name="invoice_value" id="invoice_value" class="form-control my-colorpicker1">
												</div>
												<label class="col-sm-2 col-form-label">Eway No</label>
												<div class="col-sm-2">
												<input type="text" name="eway_no" id="eway_no" class="form-control">
												</div>
										</div>
										<hr>
									<div class="form-group row">
										<h5 class="col-sm-12 card-title">Measurement Units</h5>
											<div class="col-sm-12">
												<table class="weight-table">
													<thead>
														<tr><input type="hidden" class="form-control" name="length_unit" id="length_unit" class="custom-control-input" value="cm">
															<th>PKT</th>
															<th>Per Box Weight</th>
															<th>Actual Weight</th>
															<th>Chargeable Weight</th>
															<th>Valumetric Weight</th>
															<th>L</th>
															<th>B</th>
															<th>H</th>
															<!-- <th>1CFT(kg)</th> -->
														</tr>
													<thead>
													<tbody>
														<tr>
															<td><input type="text" name="no_pack_detail[]" class="form-control my-colorpicker1 no_of_pack"  data-attr="1" id="no_of_pack1" required="required"></td>
															<td><input type="text" name="per_box_weight_detail[]" class="form-control my-colorpicker1 per_box_weight"  data-attr="1" id="per_box_weight1" required="required"></td>
															<td><input type="text" name="actual_weight_detail[]" readonly class="form-control my-colorpicker1 actual_weight"  data-attr="1" id="actual_weight1"></td>
															<td><input type="text" name="chargable_weight" class="form-control" id="chargable_weight1"/></td>
															<td><input type="text" name="valumetric_weight_detail[]" readonly class="form-control my-colorpicker1 valumetric_weight" data-attr="1" id="valumetric_weight1"></td>
															<td><input type="text" name="length_detail[]" class="form-control my-colorpicker1 length" data-attr="1" id="length1" ></td>
															<td><input type="text" name="breath_detail[]" class="form-control my-colorpicker1 breath" data-attr="1" id="breath1" ></td>
															<td><input type="text" name="height_detail[]" class="form-control my-colorpicker1 height" data-attr="1" id="height1" ></td>
															<!-- <td><input type="text" name="one_cft_kg_detail[]" readonly class="form-control my-colorpicker1 one_cft_kg" data-attr="1" id="one_cft_kg1"></td> -->
														</tr>
													</tbody>
													<tfoot>
													<a href="javascript:void(0)" class="btn btn-sm btn-primary add-weight-row"><i class="icon-plus"></i></a>&nbsp;<a href="javascript:void(0)" class="btn btn-sm btn-danger remove-weight-row"><i class="icon-trash"></i></a>
													</tfoot>
												</table>
												<div>
													 <table >
														<tr>
															<th><input type="text" name="no_of_pack" readonly="readonly" class="form-control my-colorpicker1 no_of_pack" id="no_of_pack" required="required"></th>
															<th><input type="text" name="per_box_weight" readonly="readonly" class="form-control my-colorpicker1 per_box_weight" id="per_box_weight" required="required"></th>
															<th><input type="text" name="actual_weight" readonly="readonly" class="form-control my-colorpicker1 actual_weight" id="actual_weight"></th>

															<th><input type="text" name="chargable_weight" class="form-control my-colorpicker1 chargable_weight" id="chargable_weight"/></th>

															<th><input type="text" name="valumetric_weight" readonly="readonly" class="form-control my-colorpicker1 valumetric_weight" id="valumetric_weight"></th>

															<th><input type="text" name="length" readonly="readonly" class="form-control my-colorpicker1 length"  id="length" required="required"></th>
															<th><input type="text" name="breath" readonly="readonly" class="form-control my-colorpicker1 breath"  id="breath" required="required"></th>
															<th><input type="text" name="height" readonly="readonly" class="form-control my-colorpicker1 height" id="height" required="required"></th>
															<!-- <td><input type="text" name="one_cft_kg" readonly="readonly" class="form-control my-colorpicker1 one_cft_kg" id="one_cft_kg"></td> -->
														</tr>
													</table>
												</div>
												
											</div>
										</div>
										<hr>
										
										
										<div>
										<div class="form-group row">
											
											<h5 class="col-sm-12 card-title">Charges</h5>
													<label class="col-sm-2 col-form-label">Freight</label>
													<div class="col-sm-2">
													<input type="text" name="frieht" class="form-control" id="frieht"/>
													</div>													
													<label   class="col-sm-2 col-form-label">Pickup Charges</label>
													<div class="col-sm-2">
													<input type="number" name="pickup_charges" class="form-control" id="pickup_charges">
													</div>
													<label   class="col-sm-2 col-form-label">Delivery Charges</label>
													<div class="col-sm-2">
													<input type="number" name="delivery_charges" class="form-control" id="delivery_charges">
													</div>						
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Courier Charges</label>
													<div class="col-sm-2">
													<input type="text" name="courier_charges" class="form-control" id="courier_charges">
													</div>
													<label class="col-sm-2 col-form-label"> AWB Charges</label>
													<div class="col-sm-2">
													<input type="number" name="awb_charges" class="form-control" id="awb_charges">
													</div>
													<label class="col-sm-2 col-form-label">Other charges</label>
													<div class="col-sm-2">
													<input type="number" name="other_charges" class="form-control" id="other_charges">
													</div>											
													
												</div>
												<div class="form-group row">
													<label   class="col-sm-2 col-form-label">Total</label>
													<div class="col-sm-2">
														<input type="text" readonly name="amount" class="form-control" id="amount"/>
													</div>
													<label  class="col-sm-2 col-form-label">Fuel Surcharge</label>
													<div class="col-sm-2">
														<input type="number" readonly="readonly" class="form-control" name="fuel_subcharges" id="fuel_charges">
													</div>	
												</div>
											<hr>
										</div>                                       
								  <div class="form-group row">                                    
                                        <h5 class="col-sm-12 card-title">Final Charge</h5>
                                        <label  class="col-sm-2 col-form-label">Sub Total</label>
                                        <div class="col-sm-2">
										<input type="text" readonly name="sub_total" class="form-control" id="sub_total"/>
										</div>

									<label class="col-sm-2 col-form-label">CGST Tax</label>
                                    <div class="col-sm-2 gst_charges">
											<div class="input-group mb-3">
											<input value="<?php //echo $CGST; ?>" class="form-control" type="number" id="cgst" step="any" name="cgst" readonly>
												<div class="input-group-append">
													<span class="input-group-text bg-transparent border-right-0" id="basic-email1"><i class="fa fa-percent"></i></span>
												</div>
											</div>
                                    </div>                                    
                                    <input type="hidden" name="gst_charges" id="gst_charges" value="1">
                                        <label class="col-sm-2 col-form-label">SGST Tax</label>
	                                    <div class="col-sm-2">
											<div class="input-group mb-3 gst_charges">
												<input value="<?php //echo $SGST; ?>" class="form-control" type="number" id="sgst" step="any" name="sgst" readonly>
												<div class="input-group-append ">
													<span class="input-group-text bg-transparent border-right-0" id="basic-email1"><i class="fa fa-percent"></i></span>
												</div>
											</div>
										</div>
                                        
                                       <label class="col-sm-2 col-form-label">IGST Tax</label>
                                     <div class="col-sm-2 gst_charges">
                                       <div class="input-group mb-3">
                                            <input value="<?php //echo $IGST; ?>" class="form-control" type="number" id="igst" step="any" name="igst" readonly>
											<div class="input-group-append">
													<span class="input-group-text bg-transparent border-right-0" id="basic-email1"><i class="fa fa-percent"></i></span>
												</div>
                                        </div>
                                     </div>
                                      <label class="col-sm-1 col-form-label">Grand Total</label>
										<div class="col-sm-2">
										<div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" name="grand_total"  id="grand_total"/>
										<div class="input-group-append">
													<span class="input-group-text bg-transparent border-right-0" id="basic-email1"><i class="fa fa-usd" aria-hidden="true"></i>
													</span>
												</div>
										</div>
										</div>
										</div>
                            <!--  <input type="hidden" name="minimum_amount" id="minimum_amount" value=""> -->				
									<div class="form-group row">
										<div class="col-md-2">
											<div class="box-footer">
												<button type="submit"  class="btn btn-primary">Submit</button>
											</div>
										</div>
										<!-- /.box-body -->
									</div>
									
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
                <!-- END: Listing-->
            </div>
        </main>
        <!-- END: Content-->
        <!-- START: Footer-->
        
        <?php  include(dirname(__FILE__).'/../admin_shared/admin_footer.php'); ?>
        <!-- START: Footer-->
    </body>
    <!-- END: Body-->
</html>
<script>
$("#sender_pincode").on('blur', function () 
	{
		var pincode = $(this).val();
		if (pincode != null || pincode != '') {		
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getcity',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (d) {					
					var option;					
					option += '<option value="' + d.id + '">' + d.city + '</option>';
					$('#sender_city').html(option);
					
				}
			});
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getState',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (d) {					
					var option;					
					option += '<option value="' + d.id + '">' + d.state + '</option>';
					$('#sender_state').html(option);					
				}
			});
		}
	});
$("input[type='radio']").change(function () {

	var dispatch_details = $('input[name="dispatch_details"]:checked').val();
	if(dispatch_details=="credit")
	{
		$("#credit_div").show();
		$("#credit_div_label").show();		
	}else if(dispatch_details=="cash")
	{
		$("#credit_div").hide();
		$("#credit_div_label").hide();		
		$("#sender_name").attr("readonly", false); 
		$("#sender_address").attr("readonly", false); 
		$("#sender_city").attr("readonly", false); 
		$("#sender_pincode").attr("readonly", false);
		$("#sender_contactno").attr("readonly", false);
		$("#sender_gstno").attr("readonly", false);

		
	}else if(dispatch_details=="To Pay")
	{	
		$("#credit_div").hide();
		$("#credit_div_label").hide();
		$('#sender_name').attr("readonly", false); 
		$("#sender_address").attr("readonly", false); 
		$("#sender_city").attr("readonly", false); 
		$("#sender_pincode").attr("readonly", false);
		$("#sender_contactno").attr("readonly", false);
		$("#sender_gstno").attr("readonly", false);
	}

});
// var rateMasterGet = true;
 weightChangeEvent();
 // /this is use for getting receiver city info by pincode
	$("#reciever_pincode").on('blur', function () 
	{
		var pincode = $(this).val();
		if (pincode != null || pincode != '') {

		
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getcity',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (d) {					
					var option;					
					option += '<option value="' + d.id + '">' + d.city + '</option>';
					$('#reciever_city').html(option);
					
				}
			});
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getState',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (d) {					
					var option;					
					option += '<option value="' + d.id + '">' + d.state + '</option>';
					$('#reciever_state').html(option);					
				}
			});


		}
	});
//  // this is use for getting the customer information 
	$("#customer_account_id").change(function () 
	{
		var customer_name = $(this).val();
		if (customer_name != null || customer_name != '') {
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: 'Admin_domestic_shipment_manager/getsenderdetails',
				data: 'customer_name=' + customer_name,
				success: function (data) {
					$("#sender").val(data.user.customer_name);
					$("#sender_address").val(data.user.address);
					$("#sender_pincode").val(data.user.pincode);
					$("#sender_contactno").val(data.user.phone);
					$("#sender_gstno").val(data.user.gstno);
					$("#gst_charges").val(data.user.gst_charges);
					$("#sender_city").val(data.user.city);
					//$("#sender_city").select2();
					$("#customer_account_id").val(customer_name);
					if (data.user.gst_charges == 0) {
						$('.gst_charges').hide();
					} else {
						$('.gst_charges').show();
					}
				}
			});
		}
	});
// 	// this is use for adding the new row for in Measurement Units
	$(".add-weight-row").on('click', function () 
	{
		var allTrs = $('table.weight-table tbody').find('tr');
		var lastTr = allTrs[allTrs.length - 1];
		var $clone = $(lastTr).clone();

		var countrows = $(".height").length;
		$clone.find('td').each(function () 
		{
			var el = $(this).find(':first-child');
			var id = el.attr('id') || null;
			if (id) 
			{
				var i = id.substr(id.length - 1);

				var nextElament = countrows; //parseInt(i)+1;
				var remove = 1;
				if (countrows > 10) 
				{
					var remove = 2;
				}
				var removeChar = (id.length - remove);
				var prefix = id.substr(0, removeChar);

				
				//console.log('prefix:::' + prefix + '::::' + id + '::::' + removeChar);
				el.attr('id', prefix + (nextElament));
				el.attr('data-attr', (nextElament));
			}
		});
		$clone.find('input:text').val('');
		$('table.weight-table tbody').append($clone);
		var totalRow = $('table.weight-table tbody').find('tr').length;
		
		if (totalRow > 1) 
		{
			$('.remove-weight-row').show();			
		} else {
			$('.remove-weight-row').hide();
		}
		weightChangeEvent();
		
		
	});
		// this fucntion is use for removing the row from table 
	$(".remove-weight-row").on('click', function () 
	{
		var totalRow = $('table.weight-table tbody').find('tr').length;
		if (totalRow > 1) {
			$('table.weight-table tbody').find('tr:last').remove();
			totalRow--;

		}
		if (totalRow == 1) {
			$(this).hide();
		}
		calculateTotalWeight();			
	});
	// this function is use for refresh the chrages when weight is changed in input box 
	function weightChangeEvent() 
	{

		$(".no_of_pack, .per_box_weight, .actual_weight, .length, .breath, .height, .no_of_pack, .one_cft_kg").change(function () {
			
			var idNo = $(this).attr('data-attr');			
				calculateTotalWeight();
			
		});
		$("#frieht,#pickup_charges,#delivery_charges,#courier_charges,#awb_charges,#other_charges").change(function () {
			
			var frieht = parseFloat(($('#frieht').val() != '') ? $('#frieht').val() : 0);
			var pickup_charges 	 = parseFloat(($('#pickup_charges').val() != '') ? $('#pickup_charges').val() : 0);
			var delivery_charges = parseFloat(($('#delivery_charges').val() != '') ? $('#delivery_charges').val() : 0);
			var courier_charges  = parseFloat(($('#courier_charges').val() != '') ? $('#courier_charges').val() : 0);
			var awb_charges		 = parseFloat(($('#awb_charges').val() != '') ? $('#awb_charges').val() : 0);
			var other_charges 	 = parseFloat(($('#other_charges').val() != '') ? $('#other_charges').val() : 0);

			var totalAmount = (frieht + pickup_charges + delivery_charges + courier_charges +awb_charges + other_charges);
			$('#amount').val(totalAmount);
		});


		$("#amount").blur(function () {

			var courier_id = parseFloat(($('#courier_company').val() != '') ? $('#courier_company').val() : 0);			
			var amount = parseFloat(($('#amount').val() != '') ? $('#amount').val() : 0);
			var fuel_charges = parseFloat(($('#fuel_charges').val() != '') ? $('#fuel_charges').val() : 0);				
			var sub_total =(amount + fuel_charges);
			var receiver_gstno = $("#receiver_gstno").val();
			var first_two_char = receiver_gstno.substring(0, 2);
			
			if(first_two_char==27)
			{
				var cgst = (sub_total*9/100);
				var sgst = (sub_total*9/100);
				var igst = 0;
				var grand_total = sub_total + igst;

			}else{
				var cgst = 0;
				var sgst = 0;
				var igst = (sub_total*18/100);
				var grand_total = sub_total + igst;


			}
			
			$('#sub_total').val(sub_total);

			$('#cgst').val(cgst);
			$('#sgst').val(sgst);
			$('#igst').val(igst);
			$('#grand_total').val(grand_total);

				///var sub_amount = $('#amount').val();
				$.ajax({
					type: 'POST',
					url: 'Admin_international_shipment_manager/getFuelcharges',
					data: 'courier_id='+courier_id +'&sub_amount='+amount,
					dataType: "json",
					success: function(data) {					
						$('#fuel_charges').val(data.final_fuel_charges);			
				
					}
				});
		});
	}
	// ========
	$("#courier_company").change(function () {
			var courier_company_name = $("#courier_company option:selected").attr('data-id');
			$('#forworder_name').val(courier_company_name);
	});	
 	// this functin is use for calculating total weight 
	function calculateTotalWeight() 
	{
		var totalRow = $('table.weight-table tbody').find('tr').length;	
		var totalActualWeight = 0;
		var totalValumetricWeight = 0;
		var totalLength = 0;
		var totalBreath = 0;
		var totalHeight = 0;
		var totalOneCftKg = 0;
		var totalNoOfPack = 0;
		var totalPerBoxWeight = 0;
		//one_cft_kg
		for (var i = 1; i <= totalRow; i++) {
			var noOfPackCurrent = parseFloat(($('#no_of_pack' + i).val() != '') ? $('#no_of_pack' + i).val() : 0);
			var perBoxWeightCurrent = parseFloat(($('#per_box_weight' + i).val() != '') ? $('#per_box_weight' + i).val() : 0);
			
			var currentActualWeight = noOfPackCurrent * perBoxWeightCurrent;

			if (currentActualWeight > 0) {
				$('#actual_weight' + i).val(currentActualWeight);
			}

			var length = $("#length" + i).val();
			var breath = $("#breath" + i).val();
			var height = $("#height" + i).val();
			if (length != '' && breath != '' && height != '' && noOfPackCurrent != '') 
			{		
					valumetric_weight = ((length * breath * height) / 5000) * noOfPackCurrent;	
					
					total_valumetric_weight = valumetric_weight.toFixed(2);

					$("#valumetric_weight" + i).val(total_valumetric_weight);

					if(total_valumetric_weight > currentActualWeight)
					{
						$("#chargable_weight" + i).val(total_valumetric_weight.toFixed(2));
					}else{
						$("#chargable_weight" + i).val(currentActualWeight.toFixed(2));
					}
			} else {
					$("#valumetric_weight" + i).val('');
			}

			totalNoOfPack = parseFloat(totalNoOfPack) + parseFloat(($('#no_of_pack' + i).val() != '') ? $('#no_of_pack' + i).val() : 0);
			totalPerBoxWeight = parseFloat(totalPerBoxWeight) + parseFloat(($('#per_box_weight' + i).val() != '') ? $('#per_box_weight' + i).val() : 0);
			totalActualWeight = parseFloat(totalActualWeight) + parseFloat(($('#actual_weight' + i).val() != '') ? $('#actual_weight' + i).val() : 0);
			totalValumetricWeight = parseFloat(totalValumetricWeight) + parseFloat(($('#valumetric_weight' + i).val() != '') ? $('#valumetric_weight' + i).val() : 0);

			if(totalValumetricWeight > totalActualWeight)
			{
				$("#chargable_weight").val(totalValumetricWeight.toFixed(2));
			}else{
				$("#chargable_weight").val(totalActualWeight.toFixed(2));
			}

	

			totalLength = parseFloat(totalLength) + parseFloat(($('#length' + i).val() != '') ? $('#length' + i).val() : 0);
			totalBreath = parseFloat(totalBreath) + parseFloat(($('#breath' + i).val() != '') ? $('#breath' + i).val() : 0);
			totalHeight = parseFloat(totalHeight) + parseFloat(($('#height' + i).val() != '') ? $('#height' + i).val() : 0);
			totalOneCftKg = parseFloat(totalOneCftKg) + parseFloat(($('#one_cft_kg' + i).val() != '') ? $('#one_cft_kg' + parseInt(i)).val() : 0);
		
		}
		if (totalNoOfPack) {
			$('#no_of_pack').val(totalNoOfPack);
		}
		if (totalPerBoxWeight) {
			$('#per_box_weight').val(totalPerBoxWeight.toFixed(2));
		}
		if (totalActualWeight) {
			$('#actual_weight').val(totalActualWeight.toFixed(2));
		}
		if (totalValumetricWeight) {
			var roundoff_type = $("#roundoff_type").val();
			// $('#valumetric_weight').val(totalValumetricWeight); ttttttt
			if (roundoff_type == '1') {
				$('#valumetric_weight').val(totalValumetricWeight.toFixed(2));
			} else {
				$('#valumetric_weight').val(totalValumetricWeight.toFixed(2));
			}
		}
		if (totalLength) {
			$('#length').val(totalLength.toFixed(2));
		}
		if (totalBreath) {
			$('#breath').val(totalBreath.toFixed(2));
		}
		if (totalHeight) {
			$('#height').val(totalHeight.toFixed(2));
		}

		
	}	
	// this function is use for getting charges acording chargeble weight input field 
	$("#chargable_weight").blur(function () 
	{		
		var customer_id   = $('#customer_account_id').val();
		var c_courier_id   = $('#courier_company').val();
		var mode_id   = $('#mode_dispatch').val();

		var state  = $("#reciever_state").val();		
		var city  = $("#reciever_city").val();

		console.log(customer_id);
		console.log(c_courier_id);	
		console.log(mode_id);
		console.log(state);
		console.log(city);		
		var chargable_weight = parseFloat($('#chargable_weight').val()) > 0 ? $('#chargable_weight').val() : 0;
		

		if(customer_id != '' && state != '' && city!='')
		{
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/add_new_rate_domestic',
				data: 'customer_id=' + customer_id  +'&c_courier_id=' + c_courier_id+'&mode_id=' + mode_id+'&state=' + state +'&city=' + city +'&chargable_weight='+chargable_weight,
				dataType: "json",
				success: function (data) {	
				
					console.log("final_rate====="+data.query);
					console.log("====="+data.frieht);
					$('#frieht').val(data.frieht);
					// $('#sub_total').val(data.sub_total);
					// $('#grand_total').val(data.grand_total);
				}
			});
		}else{
			$('#frieht').val(0);
		}

	});
	
	</script>
										
										