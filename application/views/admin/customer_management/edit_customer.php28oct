 <?php $this->load->view('admin/admin_shared/admin_header'); ?>
    <!-- END Head-->
<style>
    .form-control{
      color:black!important;
      border: 1px solid var(--sidebarcolor)!important;
      height: 27px;
      font-size: 10px;
  }
  .hgt-mltpl-select{
    height: 60% !important;
  }
  </style>    
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
        <h4 class="card-title">Update Customer</h4>                                
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">                                           
                <div class="col-12">
                 <form role="form" action="<?php echo base_url();?>admin/edit-customer/<?php echo $customer->customer_id?>" method="post"> 
                        <div class="form-row">
                            <div class="col-3 mb-3">
                                <label for="username">Customer Code</label>
                                <input type="text" class="form-control" name="cid" value="<?php echo $customer->cid;?>" placeholder="Enter Name" readonly>

                            </div>
                            <div class="col-3 mb-3"> 
                                <label for="email">Customer Name</label>    
                                <input type="text" class="form-control" name="customer_name" value="<?php echo $customer->customer_name;?>">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="username">Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" placeholder="Contact Person" value="<?php echo $customer->contact_person;?>" >
                            </div>
                            <div class="col-3 mb-3">
                                        <label for="username">Select Parent</label>
                                        <select class="form-control"  name="parent_cust"  required="">
                                            <option selected disabled>self parent</option>
                                                    <?php
                                            foreach ($allcustomer as $row) 
                                                    {
                                                      ?>
                                         <option value="<?php echo $row['customer_id'];?>" <?php if($row['customer_id'] == $customer->parent_cust_id) { echo 'selected'; } ?>><?php echo $row['customer_name'];?></option>
                                           <?php
                                                    }
                                          ?>
                                       </select>
                                    </div>
                            <div class="col-3 mb-3"> 
                                        <label for="email">Phone</label>    
                                        <input type="number" class="form-control" name="phone"  value="<?php echo $customer->phone;?>" >
                                    </div>
                            <div class="col-3 mb-3">
                                <label for="username">Email</label>
								            <input type="text" class="form-control" name="email"  value="<?php echo $customer->email;?>">
                            </div>                           
                            <div class="col-3 mb-3">
                                <label for="username">Password</label>
                                <input type="password" class="form-control" name="password"  value="<?php echo $customer->password;?>"  >
                            </div> 
                             <div class="col-3 mb-3"> 
                                <label for="email">Address</label>      
                                 <textarea class="form-control" rows="3" placeholder="Enter Address" name="address" ><?php echo $customer->address;?></textarea>
                            </div>
                            
                            <div class="col-3 mb-3">
                                <label for="username">Staff Allotment</label>
                                 <select class="form-control"  name="user_id"  required="" >
                                    <option selected disabled>Select Staff</option>
                                    <?php
                                    
                                    //print_r($selected_staff);die;
                                    foreach ($all_staff as $staff_row) 
                                    {
                                        $sel='';
                                        foreach ($selected_staff as $selected_staff_var) 
                                        {
                                             if($staff_row['user_id'] == $selected_staff_var['staff_id'] ) { 
                                                $sel="selected='selected'"; 
                                         }
                                     }

                                      ?>
                                        <option value="<?php echo $staff_row['user_id'];?>" <?php echo $sel; ?>  ><?php echo $staff_row['username'];?></option> 
                                      <?php
                                        
                                    }
                                    ?>
                                  </select>
                            </div> 
                             <div class="col-3 mb-3">
                                <label for="username">Pincode</label>
                                <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $customer->pincode;?>">
                            </div> 
                             <div class="col-3 mb-3"> 
                                <label for="email">State</label>      
                                 <select class="form-control" id="state" name="state_id" required>
                                    <option value="">Select State</option>
                                    <?php
                                    foreach ($states as $state_row) 
                                    {
                                      ?>
                                      <option value="<?php echo $state_row['id'];?>" <?php if($state_row['id'] == $customer->state) { echo 'selected'; } ?>>
                                        <?php echo $state_row['state'];?>
                                      </option>
                                      <?php
                                    }
                                    ?>
                                  </select>
                            </div>
                             <div class="col-3 mb-3"> 
                                <label for="email">City</label>      
                                 <select class="form-control" name="city" id="city" required>
                                    <option value="">Select City</option>
                                    <?php 
                                    foreach ($cities as $city_rows ) 
                                    { 

                                    ?>
                                      <option value="<?php echo $city_rows['id'];?>" <?php if($city_rows['id'] == $customer->city) { echo 'selected'; } ?>>
                                        <?php echo $city_rows['city'];?> 
                                      </option>
                                    <?php 
                                    }
                                    ?>
                                  </select>
                            </div>
							<div class="col-3 mb-3"> 
								<label for="username">Comapany</label> 
								  <select class="form-control select" name="company_id" id="company_id" required>
								    <option value="">Select Company</option>
									<?php foreach($company_list AS $val){ ?>
									<option value="<?php echo $val['id'];?>" <?php if($val['id'] == $customer->company_id) { echo 'selected'; } ?> ><?php echo $val['company_name'];?></option>
									<?php } ?>
							   </select>
							</div>
                           
                            <div class="col-3 mb-3">
                                <label for="username">Gst No</label>
                                <input type="text" class="form-control" name="gstno"  value="<?php echo $customer->gstno;?>">
                            </div> 
                            <div class="col-3 mb-3">
                                <label for="username">GST Charges</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input"  value="1"  <?php if($customer->gst_charges == 1) { echo 'checked="checked"';} ?> name="gst_charges" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="gst_charges" class="custom-control-input" value ="0" <?php if($customer->gst_charges == 0) { echo 'checked="checked"';} ?>  id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">No</label>
                                </div>
                            </div>                            
                            <div class="col-3 mb-3">
                                <label for="username">Api Access</label>
                                <select class="form-control" id="exampleInputEmail1" name="api_access" >
                                <option value="">Select Access</option>
                                <option value="Yes" <?php if($customer->api_access == 'Yes'){ echo 'selected';} ?>>Yes</option>
                                <option value="No" <?php if($customer->api_access == 'No'){ echo 'selected';} ?>>No</option>
                              </select>
                            </div> 
                             <div class="col-3 mb-3">
                                <label for="username">SAC Code</label>
                               <input type="text" class="form-control" name="sac_code" id="sac_code" placeholder="Enter SAC Code" value="<?php echo $customer->sac_code;?>">
                            </div> 
                             <div class="col-3 mb-3">
                                <label for="username">Credit Days</label>
                                <input type="number" class="form-control" name="credit_days" id="credit_days" placeholder="Enter Credit Days" value="<?php echo $customer->credit_days;?>">
                            </div> 
							<div class="col-3 mb-3">
                                        <label for="username">Sales Person Allotment</label>
                                        <select class="form-control"  name="sales_person_id"  required="">
                                            <option selected disabled>Select Sales Person</option>
                                                    <?php
                                            foreach ($all_sales_person as $row) 
                                                    {
                                                      ?>
                                         <option value="<?php echo $row['user_id'];?>" <?php echo ($row['sales_person_id'] == $customer->sales_person_id)?'selected':''; ?>><?php echo $row['username'];?></option>
                                           <?php
                                                    }
                                          ?>
                                       </select>
                                    </div> 
                            <div class="col-10 mb-3">
                                <label for="username">MIS Email Ids</label>
                                <input type="text" class="form-control" name="mis_emailids" id="mis_emailids" placeholder="Enter Email Ids with semicolon" value="<?php echo $customer->mis_emailids;?>">
                            </div> 
                <div class="col-12 mb-3">
                     <div class="col-3 mb-3">
                        <label for="username"><b>MIS Formats</b></label>  
                      </div>
                       <div class="col-4 mb-3 custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" checked="checked" name="mis_formate" value="1" <?php //if($customer->mis_formate == '1'){ echo 'checked'; } ?> id="mis_formate1">
                                <label class="custom-control-label" for="mis_formate1"></label>
                                 <div class="table-responsive">
                                   <table class="table layout-primary bordered">
                                         <thead>
                                          <tr>
                                            <?php
                                            $coulums = mis_formate_columns(1);
                                            foreach($coulums as $coulum)
                                            {
                                            ?>
                                            <th><?php echo $coulum?></th>
                                            <?php
                                             }
                                            ?>
                                        </tr>
                                      </thead>
                                    </table> 
                                </div>                          
                        </div>
                        <div class="col-4 mb-3 custom-control custom-radio custom-control-inline">
                            <input type="radio" name="mis_formate"  value="2" class="custom-control-input" value="2" <?php if($customer->mis_formate == '2'){ echo 'checked'; } ?> id="mis_formate2">
                            <label class="custom-control-label" for="mis_formate2"></label>
                              <div class="table-responsive">
                                   <table class="table layout-primary bordered">
                                         <thead>
                                          <tr>
                                            <?php
                                            $coulums = mis_formate_columns(2);
                                            foreach($coulums as $coulum)
                                            {
                                            ?>
                                            <th><?php echo $coulum?></th>
                                            <?php
                                             }
                                            ?>
                                        </tr>
                                      </thead>
                                    </table> 
                                </div>                       
                        </div> 
                       <div class="col-3 mb-3 custom-control custom-radio custom-control-inline" >
                            <input type="radio" name="mis_formate" value="3" class="custom-control-input" value="3" <?php if($customer->mis_formate == '3'){ echo 'checked'; } ?> id="mis_formate3">
                            <label class="custom-control-label" for="mis_formate3"></label>
                              <div class="table-responsive">
                                   <table class="table layout-primary bordered">
                                         <thead>
                                          <tr>
                                            <?php
                                            $coulums = mis_formate_columns(3);
                                            foreach($coulums as $coulum)
                                            {
                                            ?>
                                            <th><?php echo $coulum?></th>
                                            <?php
                                             }
                                            ?>
                                        </tr>
                                      </thead>
                                    </table> 
                                </div>                                          
                        </div> 
                    </div>            



                            <div class="col-12">
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
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
        <?php $this->load->view('admin/admin_shared/admin_footer');
         //include('admin_shared/admin_footer.php'); ?>
        <!-- START: Footer-->
    </body>
    <!-- END: Body-->
<script type="text/javascript">
  //======================
   function getCityList()
        {
            var state = $('#state').val();           
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>Admin_ratemaster/getCityList',
                data: 'state=' + state,
                dataType: "json",
                success: function(data) {
                    var option = '';
                    $.each(data, function(i, city) {                       
                        option += '<option value="'+city.id+'">'+city.city+'</option>';
                    });
                    $('#city').html(option);
                    
                }
            });  
        }
      
  $("#pincode").on('blur', function () 
  {
    var pincode = $(this).val();
    if (pincode != null || pincode != '') {

    
      $.ajax({
        type: 'POST',
        url: 'Admin_customer/getCityList',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.city + '</option>';
          $('#cust_city').html(option);
          
        }
      });
      $.ajax({
        type: 'POST',
        url: 'Admin_customer/getState',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.state + '</option>';
          $('#cust_state').html(option);          
        }
      });
    }
  }); 
        
</script>
		
		