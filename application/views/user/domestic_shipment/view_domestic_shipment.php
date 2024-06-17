<?php include(dirname(__FILE__).'/../admin_shared/admin_header.php'); ?>
    <!-- END Head-->
<style>
  .buttons-copy{display: none;}
  .buttons-csv{display: none;}
  /*.buttons-excel{display: none;}*/
  .buttons-pdf{display: none;}
  .buttons-print{display: none;}
  /*#example_filter{display: none;}*/
  .input-group{
    width: 60%!important;
  }
</style>
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
                  <div class="col-12  align-self-center">
                      <div class="col-12 col-sm-12 mt-3">
                      <div class="card">
                          <div class="card-header justify-content-between align-items-center">                               
                              <h4 class="card-title">Domestic Shipment</h4>
                             <!--  <span style="float: right;"><a href="admin/view-add-domestic-shipment" class="fa fa-plus btn btn-primary">Add Domestic Shipment</a></span> -->
                             <span style="float: right;">
                                 <a href="User_panel/add_domestic_shipment" class="btn btn-primary">Add Domestic Shipment</a>
                             </span>
                          </div>

						   <div class="card-header justify-content-between align-items-center">                             
							  <span>
									
							  </span>
                          </div>
                          <div class="card-body">
                          	<?php if($this->session->flashdata('notify') != '') {?>
  <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-colored"><?php echo $this->session->flashdata('notify'); ?></div>
  <?php  unset($_SESSION['class']); unset($_SESSION['notify']); } ?> 
                              <div class="table-responsive">
                                 <table class="display table dataTable table-striped table-bordered layout-primary" data-sorting="true"><!-- id="example"-->
                                      <thead>
                                          <tr>
											    <th  scope="col">Date</th>
											    <th  scope="col">AWB No.</th>
											    <th  scope="col">Origin</th>
											    <th  scope="col">Destination</th>
												<th  scope="col">Mode</th>
											    <th  scope="col">Doc/non-doc </th>
											    <th  scope="col">Receiver</th>
											    <th  scope="col">Weight</th>
												<th  scope="col">NOP</th>
											    <th  scope="col">Invoice No.</th>
											    <th  scope="col">Invoice Value</th>
												<th  scope="col">Status</th>
												<th  scope="col">Print Icon</th>
											   
                                          </tr>
                                      </thead>
                                      <tbody>
                                 <?php 
                                    if (!empty($allpoddata))
									{
										$cnt = 1;
										//echo "<pre>";
										//print_r($allpoddata);
										foreach ($allpoddata as $value) 
										{
											$cnt++;
										    $whr=array('transfer_mode_id'=>$value['mode_dispatch']);
                                            $mode_details = $this->basic_operation_m->get_table_row('transfer_mode',$whr);
											
											  $whrr=array('id'=>$value['sender_city']);
                                            $city_details = $this->basic_operation_m->get_table_row('city',$whrr);

											$whrre=array('c_id'=>$value['courier_company_id']);
                                            $courier_company_details = $this->basic_operation_m->get_table_row('courier_company',$whrre);
											
											$whrre=array('booking_id'=>$value['booking_id']);
                                            $status_details = $this->basic_operation_m->get_query_row("select * from tbl_domestic_tracking where booking_id = '".$value['booking_id']."' order by id desc limit 1");

											$whrre=array('booking_id'=>$value['booking_id']);
                                            $dd = $this->basic_operation_m->get_query_row("select * from tbl_domestic_weight_details where booking_id = '".$value['booking_id']."'");
										    //print_r($dd->no_of_pack);
                   
                                    ?>
											<tr class="odd gradeX">
												<td><?php echo date('d-m-Y',strtotime($value['booking_date']));?>
												<td><?php echo $value['pod_no']; ?></td>
												<td><?php echo $city_details->city;?></td>
												<td><?php echo $value['city'];?></td>
												<td><?php echo $mode_details->mode_name;?></td>
												<td><?php echo $value['doc_nondoc'];?></td>
												<td><?php echo $value['reciever_name'];?></td>
												<td><?php echo $value['actual_weight'];?></td>
												<td><?php echo $dd->no_of_pack ; ?></td>
												<td><?php echo $value['invoice_no'];?></td>
												<td><?php echo $value['invoice_value'];?></td>
												<td><?php echo $status_details->status;?></td>
												
												<td>													
													<a href="User_panel/domestic_printpod/<?php echo $value['booking_id'];?>" target="_blank" title="Print"><i class="fas fa-print" style="color:var(--success)"></i></a>&nbsp;
												</td>
											 </tr>
									<?php 
										$cnt++;
										}
									}
									else
									{
										echo str_repeat("<td>",12);
									}
										?>
                                 </tbody>
                                 <input type="hidden" name="selected_campaing" id="selected_campaingss" value="">
                                 </table> 
                              </div>
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
	$('#select_multiple_camp').click(function()
	{	
		var pre_selected_cam 	= $('#selected_campaingss').val();
		if(pre_selected_cam !== null)
		{
			var nes = 		pre_selected_cam.slice(0,-1);
			var favorite = [];
            $.each($("input[name='multiple_delete[]']:checked"), function(){            
                favorite.push($(this).val());
            });
			favorite = favorite.join("-");
			
			if(favorite != '')
			{
				window.location = 'Admin_domestic_shipment_manager/all_printpod/'+favorite+'-'+nes;
			}
			else
			{
				alert('Pleaese choose at least one Shipment');
			}	
		}
		else
		{
			var favorite = [];
            $.each($("input[name='multiple_delete[]']:checked"), function(){            
                favorite.push($(this).val());
            });
			favorite = favorite.join("-");
			
			if(favorite != '')
			{
				window.location = 'Admin_domestic_shipment_manager/all_printpod/'+favorite;
			}
			else
			{
				alert('Pleaese choose at least one Shipment');
			}
		}	
	});
	// this function is use for redirecting page on preseleted campaing on schedule page  
			
	function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
 
	$('.multiple_campings').click(function()
	{
		var new_sel_cam		 	= $(this).val();
		var pre_selected_cam 	= $('#selected_campaingss').val();
		if($(this).prop("checked") == true)
		{
			$('#selected_campaingss').val(new_sel_cam+'-'+pre_selected_cam);
		}
		else if($(this).prop("checked") == false)
		{
			pre_selected_cam = pre_selected_cam.replace(new_sel_cam+'-','');
			$('#selected_campaingss').val(pre_selected_cam);
		}
		
	});
	
	// this function is use for redirecting page on preseleted campaing on schedule page  
	$('#select_multiple_camp').click(function()
	{
		var pre_selected_cam 	= $('#selected_campaingss').val();
		
		if(pre_selected_cam !== null)
		{
			var nes = 		pre_selected_cam.slice(0,-1);
			var favorite = [];
            $.each($("input[name='multiple_delete[]']:checked"), function(){            
                favorite.push($(this).val());
            });
			favorite = favorite.join("-");
			
			if(favorite != '')
			{
				window.location = 'Admin_domestic_shipment_manager/all_printpod/'+favorite+'-'+nes;
			}
			else
			{
				alert('Pleaese choose at least one Shipment');
			}	
		}
		else
		{
			var favorite = [];
            $.each($("input[name='multiple_delete[]']:checked"), function(){            
                favorite.push($(this).val());
            });
			favorite = favorite.join("-");
			
			if(favorite != '')
			{
				window.location = 'Admin_domestic_shipment_manager/all_printpod/'+favorite;
			}
			else
			{
				alert('Pleaese choose at least one Shipment');
			}
		}
		
			
	});
	
  
/* $("#filterpod").validate({
   rules: {
		from_date: "required",
		to_date: "required"
	},
	errorPlacement: function(error, element) {
		error.insertAfter(element);
	},
	messages: {
		 //email: "Please provide email address"       
	},      
	submitHandler: function(form)
	{
		form.submit();
	}     
}); */
</script>
<div class="modal fade in" id="modal-default" style="padding-right: 17px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Print Bulk Shipment</h4>
              </div>
                <form name="filterpod" id="filterpod" action="Admin_domestic_shipment_manager/all_printpod" method="POST">
              <div class="modal-body">
						<div class="col-md-4">
							<label>Customer</label>
							<select class="form-control" name="user_id">
							<?php if(!empty($customer))
							{
								foreach($customer as $key => $values)
								{ ?>
									<option value="<?php echo $values->customer_id; ?>" ><?php echo $values->customer_name; ?></option>
									<?php
								}
							} ?>
							</select>

						</div>
						<div class="col-md-4">
							<label>From Date</label>
							<input type="date" class="form-control" name="from_date" value="<?php echo $_GET['from_date'];?>" />
						</div>
						<div class="col-md-4">
							<label>To Date</label>
							<input type="date" class="form-control" name="to_date" value="<?php echo $_GET['to_date'];?>" />
						</div>
						<div class="col-md-4">
							
						</div>
              </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Print</button>
			  </div>
					</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>
<script>
function matchStart (term, text) {
  if (text.toUpperCase().indexOf(term.toUpperCase()) == 0) {
    return true;
  }
 
  return false;
}
 
$.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
  $("#user_id").select2({
    matcher: oldMatcher(matchStart)
  })

});