     <?php $this->load->view('admin/admin_shared/admin_header'); ?>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        
        <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar');
   // include('admin_shared/admin_sidebar.php'); ?>
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
                              <h4 class="card-title">Add DeliverySheet</h4>  
                          </div>
                          <div class="card-body">
                                <div class="card-body">
						   <div class="row">                                           
                            <div class="col-12">
								<form role="form" action="admin/insert-deliverysheet" method="post" enctype="multipart/form-data">

								<div class="box-body">
									<!--<table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr>
										<th></th>
										<th>Airway Number</th>
										<th>Source</th>
										<th>Destination</th>
										</tr>
										</thead>
										<tbody>
										
											<?php 
											if (!empty($pod))
											{
												foreach ($pod as  $value) 
												{
													$podno=$value->pod_no;
													$resAct=$this->db->query("select sender_address,reciever_address,is_delhivery_complete from tbl_domestic_booking where pod_no='$podno'"); 

													$sender_addr= $resAct->row()->sender_address;
													$reciver_address= $resAct->row()->reciever_address;
													$is_delhivery_complete= $resAct->row()->is_delhivery_complete;
													if($is_delhivery_complete==0)
													{	
														?>
														<tr>
															<td><input type="checkbox" name="pod_no[]" value="<?=$value->pod_no?>"></td>
															<td><?=$value->pod_no?></td>
															<td><?=$sender_addr?></td>
															<td><?=$reciver_address?></td>
														</tr>
														<?php 
													}
												}
											}
											else
											{
												echo "<p>No Data Found</p>";
											}
											?>
										</tbody>

									</table>    -->
								
								<div class="form-group row">
								<label class="col-sm-1 col-form-label">DeliverySheet Id</label>
								<div class="col-sm-2">
								<input type="text" class="form-control" name="deliverysheet_id" id="exampleInputEmail1" placeholder="Enter Id" value="<?=$did?>" readonly>
								</div>

								<label class="col-sm-1 col-form-label">Select Delivery Boy</label>
								<div class="col-sm-2">
									<select class="form-control" required name="username">
									<option value="">Select Delivery Boy</option>
										<?php 
										//print_r($users);
										if (count ($users)){
										foreach ($users as $rows ) { 

										?>
										<option value="<?=$rows->username?>">

										<?=$rows->full_name?>--<?=$rows->username?> 
										</option>
										<?php 
										}
										}
										else{
										echo "<p>No Data Found</p>";
										}
										?>
									</select>
								</div>
								
								<label class="col-sm-1 col-form-label">Delivery Date:</label>
								<div class="col-sm-2">
									<input type="datetime-local" class="form-control" required name="datetime" id="exampleInputEmail1" >
								</div>
								<label class="col-sm-1 col-form-label">Pod csv:</label>
								<div class="col-sm-2">
									<input type="file" class="form-control" id="jq-validation-email" name="csv_zip" accept=".csv" placeholder="Slider Image">
								</div>
								</div>
								<div class="form-group row">
								<label class="col-sm-1 col-form-label">Search Pod:</label>
								<div class="col-sm-2">
									<input type="text" id="serach_data" value="" class="form-control" >
								</div>
</div>
								<div class="col-md-9">
								<br>
								<!--  col-sm-4--> 
								<table class="table table-bordered table-striped">
								<thead>
								<tr>
								<th></th>
								<th>AWB No.</th>
								<th>Sender Name </th>
								<th>Consignor Name </th>
								<th>Destination City</th>
								<th>Forwader</th>
								<th>Weight</th>
								<th>Pcs</th>
								</tr>
								</thead>
								<tbody id="change_status_id">

								</tbody>

								</table> 
								</div>
								<div class="col-md-3">
								<div class="box-footer pull right">
								<button type="submit" name="submit"  class="btn btn-primary">Submit</button>
								</div>
								</div>
								<!--  col-sm-4--> 

								<!--  box body-->
								</div>
								</form>  
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
</body>
<!-- END: Body-->
<script type="text/javascript" src="<?php echo base_url();?>assets/jQueryScannerDetectionmaster/jquery.scannerdetection.js"></script>
<script type="text/javascript">
$(document).scannerDetection({
	timeBeforeScanTest: 200, // wait for the next character for upto 200ms
	startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
	endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
	avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
	onComplete: function(barcode, qty){ 
		var awb_no= barcode;
		
			
		$.ajax({
					   url: "Admin_deliverysheet/awbnodata",
					   type: 'POST',
					   dataType: "html",
					   data: {awb_no: awb_no},
					   error: function() {
						  alert('Please Try Again Later');
					   },
					   success: function(data) {
						//console.log(data);
						
						if(data !=""){
						  $("#change_status_id").append(data);  
						  var array = []; 
						
							tw=0;
							tp =0;
				
						$("input.cb[type=checkbox]:checked").each(function() { 
							
							tw = tw + parseFloat($(this).attr("data-tw"));
							tp = tp + parseFloat($(this).attr("data-tp"));
						
								 }); 	
							 $("#serach_data").val('');
						}
						else{
						  $("#change_status_id").append('');  
						}
							
							//alert("Record added successfully");  
							$('#serach_data').val('');
							$('#serach_data').focus();
					   }
					});
		} // main callback function	
});

      
$(document).ready(function()
{
	$(window).keydown(function(event)
	{
		if(event.keyCode == 13) 
		{		
			get_Data();
			event.preventDefault();
					return false;
		}
	});
    
  });
  
  $('#serach_data').blur(function()
  {
	  var awb_no=$('#serach_data').val();
		$.ajax({
		   url: "Admin_deliverysheet/awbnodata",
		   type: 'POST',
		   dataType: "html",
		   data: {awb_no: awb_no},
		   error: function() {alert('Please Try Again Later');},
		   success: function(data) 
		   {
				if(data !="")
				{
					$("#change_status_id").append(data);  
					var array = []; 
					tw=0;
					tp =0;

					$("input.cb[type=checkbox]:checked").each(function() 
					{ 
						tw = tw + parseFloat($(this).attr("data-tw"));
						tp = tp + parseFloat($(this).attr("data-tp"));
					 }); 	
					$("#serach_data").val('');
				}
				else
				{
					$("#change_status_id").append('');  
				}
				$('#serach_data').val('');
				$('#serach_data').focus();
				
				
		   }
		});
  });
  
  function get_Data()
  {
	  var awb_no=$('#serach_data').val();
		$.ajax({
		   url: "Admin_deliverysheet/awbnodata",
		   type: 'POST',
		   dataType: "html",
		   data: {awb_no: awb_no},
		   error: function() {alert('Please Try Again Later');},
		   success: function(data) 
		   {
				if(data !="")
				{
					$("#change_status_id").append(data);  
					var array = []; 
					tw=0;
					tp =0;

					$("input.cb[type=checkbox]:checked").each(function() 
					{ 
						tw = tw + parseFloat($(this).attr("data-tw"));
						tp = tp + parseFloat($(this).attr("data-tp"));
					 }); 	
					$("#serach_data").val('');
				}
				else
				{
					$("#change_status_id").append('');  
				}
				$('#serach_data').val('');
				$('#serach_data').focus();
				
				
		   }
		});
  }

</script>