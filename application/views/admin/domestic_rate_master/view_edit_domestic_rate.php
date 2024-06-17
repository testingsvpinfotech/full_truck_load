<?php include(dirname(__FILE__).'/../admin_shared/admin_header.php'); ?>
    <!-- END Head-->
<style>
    .form-control{
      color:black!important;
      border: 1px solid var(--sidebarcolor)!important;
      height: 27px;
      font-size: 10px;
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
                  <div class="col-12">
                      <div class="col-12 col-sm-12 mt-3">
                      <div class="card">
					  
                          <div class="card-header">                               
                              <h4 class="card-title">Update Rate</h4>
                          </div>
						    <div class="card-content">
                          <div class="card-body">
						   <div class="row">                                           
                           <div class="col-12">
                             <form role="form" action="admin/edit-domestic-rate/<?php echo $domestic_rate->rate_id; ?>/<?php echo $edit_cust_id; ?>" method="post" >
            								  <div class="box-body">	
                               <div class="form-group row">
                                      <label for="ac_name" class="col-sm-3 col-form-label">Customer Name</label>
                                      <div class="col-sm-3">
                                         <select name="customer_id" class="form-control" >
                                           <option value="">-Select Customer-</option>
                                           <?php foreach ($customer_list as $cusl) { ?>
                                          <option value="<?php echo $cusl['customer_id']; ?>" <?php if($domestic_rate->customer_id==$cusl['customer_id']){echo "selected";} ?> ><?php echo $cusl['customer_name'] ?></option>                                          
                                           <?php } ?>
                                         </select>
                                      </div>                 
                                  
                                      <label for="ac_name" class="col-sm-3 col-form-label">Courier Name</label>
                                      <div class="col-sm-3">
                                         <select class="form-control" name="c_courier_id">

                                          <option value="">-Select Courier Name-</option>
                                          <option value="0" <?php if($domestic_rate->c_courier_id==0){echo "selected";} ?>>All</option>
                                         <?php foreach ($courier_company as $cc) { ?>
                                         <option value="<?php echo $cc['c_id'];?>" <?php if($domestic_rate->c_courier_id==$cc['c_id']){echo "selected";} ?>><?php echo $cc['c_company_name'];?></option>
                                        <?php } ?>

                                      </select>
                                      </div>                  
                                  </div>
                                  <div class="form-group row">
                                      
                                       <label for="ac_name" class="col-sm-3 col-form-label">From Zone Name</label>
                                      <div class="col-sm-3">
                                         <select class="form-control" name="from_zone_id">
                                           <option value="">-Select Zone-</option>
                                           <?php foreach ($zone_list as $zl) {
                                            ?>
                                            <option value="<?php echo $zl['region_id'];?>"  <?php if($domestic_rate->from_zone_id==$zl['region_id']){echo "selected";} ?>><?php echo $zl['region_name'];?> 
                                            </option>
                                          <?php } ?>
                                        </select>
                                      </div>
									    <label for="ac_name" class="col-sm-3 col-form-label">To Zone Name</label>
                                      <div class="col-sm-3">
                                         <select class="form-control" name="to_zone_id">
                                           <option value="">-Select Zone-</option>
                                           <?php foreach ($zone_list as $zl) {
                                            ?>
                                            <option value="<?php echo $zl['region_id'];?>"  <?php if($domestic_rate->to_zone_id==$zl['region_id']){echo "selected";} ?>><?php echo $zl['region_name'];?> 
                                            </option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                      </div>
									   <div class="form-group row">
										 <label for="ac_name" class="col-sm-3 col-form-label">State Wise</label>
                                      <div class="col-sm-3">
                                         <select class="form-control"  id="state_id"  onchange="return select_city(this.value)" name="state_id">
                                          <option value="">-Select State-</option>
                                       <?php foreach ($states as $sl) {
                                        ?>
                                        <option value="<?php echo $sl['id'];?>" <?php if($domestic_rate->state_id==$sl['id']){echo "selected";} ?>><?php echo $sl['state'];?> 
                                        </option>
                                      <?php } ?>
                                    </select>
                                      </div>  
									  <label for="ac_name" class="col-sm-3 col-form-label">City Wise</label>
                                      <div class="col-sm-3">
                                         <select class="form-control" id="city_id" name="city_id">
                                          <option value="">-Select City-</option>
                                    </select>
                                      </div> 
</div>	
                                  <div class="form-group row">
                                      <label for="ac_name" class="col-sm-3 col-form-label">Mode Name</label>
                                      <div class="col-sm-3">
                                         <select class="form-control" name="mode_id">
                                          <option value="">-Select Mode-</option>
                                       <?php foreach ($mode_list as $ml) {
                                        ?>
                                        <option value="<?php echo $ml['transfer_mode_id'];?>" <?php if($domestic_rate->mode_id==$ml['transfer_mode_id']){echo "selected";} ?>><?php echo $ml['mode_name'];?> 
                                        </option>
                                      <?php } ?>
                                    </select>
                                      </div>   
<label for="ac_name" class="col-sm-3 col-form-label">TAT</label>
                                      <div class="col-sm-3">
									    <input type="text" name="tat" value="<?php echo $domestic_rate->tat; ?>" class="form-control" id="tat" >
                                   </div>									  
                                  </div>
                                  <div class="form-group row">
                                     <label class="col-sm-3 col-form-label">Shipment</label>
                                      <div class="col-sm-3">
                                        <select class="form-control" name="doc_type" id="doc_type">
                                          <option value="">-Select-</option>
                                          <option value="1" <?php if($domestic_rate->doc_type=='1'){echo "selected";} ?>>Non-Doc</option>
                                          <option value="0" <?php if($domestic_rate->doc_type=='0'){echo "selected";} ?>>Doc</option>
                                        </select>
                                      </div>  
                                      <label for="ac_name" class="col-sm-3 col-form-label">Applicable From</label>
                                      <div class="col-sm-3">
                                         <input type="date" name="applicable_from" value="<?php echo $domestic_rate->applicable_from; ?>" class="form-control" placeholder="Applicable From">
                                      </div>                  
                                  </div>
                                   <div class="form-group row">
                                     <div class="col-sm-12">
                                        <div class="table-responsive">
                                      <table class="table layout-primary bordered weight-table">
                                        <thead>
                                            <tr>
                                              <th>Weight Range-From</th>
                                              <th>Weight Range-To</th>
                                              <th>Rate</th>
                                              <th>Rate Type</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                            <td><input type="text" name="weight_range_from" class="form-control" placeholder="From" value="<?php echo $domestic_rate->weight_range_from; ?>" ></td>
                                            <td><input type="text" name="weight_range_to" class="form-control" placeholder="To" value="<?php echo $domestic_rate->weight_range_to; ?>" ></td>
                                            <td><input type="text" name="rate" class="form-control rate" placeholder="Enter Rate" value="<?php echo $domestic_rate->rate; ?>" ></td>
                                            <td>
                                              <select class="form-control" name="fixed_perkg">
                                                <option value="">-Select Type-</option>
                                                <option value="0" <?php if($domestic_rate->fixed_perkg==0){echo "selected";} ?> >Fixed</option>
                                                <option value="1" <?php if($domestic_rate->fixed_perkg==1){echo "selected";} ?>>Addtion 250GM</option>
                                                <option value="2" <?php if($domestic_rate->fixed_perkg==2){echo "selected";} ?>>Addtion 500GM</option>
                                                <option value="3" <?php if($domestic_rate->fixed_perkg==3){echo "selected";} ?>>Addtion 1000GM</option>
												<option value="4" <?php if($domestic_rate->fixed_perkg==4){echo "selected";} ?>>Per Kg</option>
                                              </select>
                                          </td>
                                          </tr>
                                       </tbody>
                                      </table>
                                    </div>
                                    </div>                                           
                                  </div>
								    <div class="col-md-2">
								  	<div class="box-footer">
										<button type="submit" class="btn btn-primary">Update Rate</button>
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
        
        <?php  include(dirname(__FILE__).'/../admin_shared/admin_footer.php'); ?>
        <!-- START: Footer-->
    </body>
	<script type="text/javascript">
 
			  $('#state_id').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                maxHeight: 150
              }); 
$('#city_id').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                maxHeight: 150
              }); 
			  
			    function select_city(state_id)
    {
       var state_id= $('#state_id').val(); 
        $.ajax({
                type: 'POST',
                url: 'Admin_domestic_rate_manager/getStatewiseCity_foredit',
                data:{state_id:state_id},
                dataType: "json",
                success: function (d) { 
                    $('#city_id').html(d);
                    
                    $('#city_id').multiselect('rebuild'); 
                }
            });

    }

// $('#sel_courier_id').multiselect({
//                 includeSelectAllOption: true,
//                 enableFiltering: true,
//                 maxHeight: 150
//               }); 

  
</script>

    <!-- END: Body-->
</html>
