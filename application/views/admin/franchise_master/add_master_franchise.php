<?php $this->load->view('admin/admin_shared/admin_header'); ?>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default">

    <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar'); ?>

    <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar');
    // include('admin_shared/admin_sidebar.php'); 
    ?>
    <!-- END: Main Menu-->


    <!-- START: Card Data-->
    <div class="row" style="margin-top: 100px;">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-md-6">
                        <div><a href="<?php base_url(); ?>admin/view-franchise-master" class="btn btn-primary">
                                    view Franchise Details </a></div>
                        </div>
                        <hr>
                       
                    </div>

                    <div class="col-12 col-md-12 mt-3">
                        <div class="card p-4">
                            <div class="card-body">
                                
                                <?php echo validation_errors(); ?>
                                
                                <form name="form" action="<?php echo base_url();?>MasterFranchiseController/store_master_franchise_data" enctype="multipart/form-data" method="POST" >
                                    
                                   
                               
                                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                                    <h6 class="mb-0 text-uppercase font-weight-bold">Personal Information</h6>
                                </div>
                                 
                                 <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Franchise ID</label>
                                                 <input type="text"  value="<?php echo $fid; ?>" name="fid" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-row">-->
                                    <!--        <div class="form-group col-md-12">-->
                                    <!--            <label>Username</label>-->
                                    <!--             <input type="text" class="form-control" name="username" placeholder="Enter Username" value="" >-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Password</label>
                                                 <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo set_value('password') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Confirm Password</label>
                                                 <input type="text" class="form-control" name="passconf"  value="<?php echo set_value('passconf') ?>" placeholder="Enter Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12"> <hr></div><br>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label"> Name</label>
                                            <input type="text" name="franchise_name" placeholder="Enter Name" value="<?php echo set_value('franchise_name') ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group  col-md-3 required">
                                        <div class="form-group">
                                            <label class="control-label">S/O or D/O</label>
                                            <input type="text" name="franchise_relation" class="form-control"  value="<?php echo set_value('franchise_relation') ?>" placeholder="Enter Relation Name" required="">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 required">
                                        <div class="form-group">
                                            <label class="control-label">Age</label>
                                            <input type="text" name="age" class="form-control" value="<?php echo set_value('age') ?>" placeholder="Enter Age" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter Email-Id"  value="<?php echo set_value('email') ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"> <hr></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">Residential Address </label>
                                            <textarea class="form-control" autocomplete="nope" rows="5" name="address" placeholder ="Enter Your Addres.."> <?php echo set_value('address') ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label">Pin Code</label>
                                                <input type="text"  name="pincode" id="pincode"  value="<?php echo set_value('pincode') ?>"  class="form-control" placeholder="Enter Pincode Number">
                                                <span class="errormsg" id="errormsg" style="color: #8b0001;font-weight: bold;"></span>
                                            </div>
                                           
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">State</label>
                                                 <select class="form-control"  name="franchaise_state_id"  id="franchaise_state">
                                                    <option value="">Select State</option>           
                                                </select>
                                            </div>
                                            
                                             <div class="form-group col-md-4 ">
                                                <label class="control-label">City</label>
                                                <select class="form-control"  name="franchaise_city_id" id="franchaise_city" >
                                                    <option value="">Select City</option>           
                                                </select>
                                              </div>
                                            
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">Contact No</label>
                                                <input type="text" autocomplete="nope" name="contact_number"  value="<?php echo set_value('contact_number') ?>" pattern='^\+?\d{0,10}' class="form-control"  title ="please check Contact Number" placeholder="contact_number" required>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">Alternate Contact No</label>
                                                <input type="text" autocomplete="nope" name="alt_contact"  value="<?php echo set_value('alt_contact') ?>" class="form-control" pattern='^\+?\d{0,10}' title ="please check Alternate Contact Number" placeholder="Enter Alt Number">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                                    <h6 class="mb-0 text-uppercase font-weight-bold">KYC</h6>
                                </div>

                              
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Select Type of KYC</label>
                                                <select class="form-control" name="companytype" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Sole Proprietorship" selected="selected">Sole Proprietorship</option>
                                                    <option value="Partnership">Partnership</option>
                                                    <option value="Limited Liability Partnership">Limited Liability Partnership</option>
                                                    <option value="Public Limited Company">Public Limited Company</option>
                                                    <option value="Private Limited Company">Private Limited Company</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong style="margin-left:38%; font-size:20px;color:#ea6435;">Pan Card Details</strong>
                                        <div class="form-group required">
                                            <label class="control-label">Pan Name </label>
                                            <div class="input-group">
                                                <input type="text"  class="form-control" name="pan_name" value="<?php echo set_value('pan_name') ?>"  placeholder="Enter Pan Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Pan Number </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" title="Places check Pan Number" value="<?php echo set_value('pan_number') ?>"  name="pan_number" maxlength="10" minlength="10" placeholder="Enter Pan Card Number"required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6 required">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Upload PANCard Photo</label>
                                                <input type="file" name="pancard_photo" id="pancard_photo" value="<?php echo set_value('pancard_photo') ?>"   formenctype="multipart/form-data">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6" style="margin-top: -30px;">
                                        <strong style="margin-left:38%; font-size:20px;color:#ea6435;">Aadhar Card Details</strong>
                                        <!--<hr>-->
                                        <!--<hr style="border-bottom: 2px solid #000;">-->
                                        <div class="form-row">
                                            
                                            
                                             <div class="col-md-6 form-group required">
                                                <label class="control-label">Aadhar Number </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" title="places check Aadhar Number" value="<?php echo set_value('aadhar_number') ?>"  name="aadhar_number" maxlength="12" minlength="12" placeholder="Enter Aadhar Number" required>
                                                </div>
                                            </div>
                                             <div class="col-md-6 form-group required">
                                                <label class="control-label">Full Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"  name="aadharin_name" value="<?php echo set_value('aadharin_name') ?>" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                       </div>

                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label class="control-label">DOB<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" value="<?php echo set_value('dob') ?>" name="dob" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group" required>
                                                <label class="control-label">Gender<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input type="radio"  class="form-control" value="Male" name="gender">Male
                                                    <input type="radio" class="form-control" value ="Female" name="gender">Female
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6" required>
                                                <label class="control-label">Address<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <textarea type="text" class="form-control" value="<?php echo set_value('aadhar_address') ?>" name=" aadhar_address" placeholder="Enter Address" required> </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Upload AadharCard Photo</label>
                                                    <input type="file" name="aadharcard_photo" id="aadharcard_photo" value="<?php echo set_value('aadharcard_photo') ?>" formenctype="multipart/form-data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                                    <h6 class="mb-0 text-uppercase font-weight-bold">Company Information</h6>
                                </div>




                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Firm Name </label>
                                                <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">PAN Number</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="nope" id="pan_no" value="<?php echo set_value('pan_no') ?>" name="cmp_pan_number" title="Places Check Pan Number" maxlength="10" minlength="10" placeholder="Enter Pan Number" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0)" class="btn btn" style="background-color:#109693;color:#fff;">Verified</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">GST Number</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="nope" id="gst_no" value="<?php echo set_value('gst_no') ?>" name="cmp_gstno"  title="Places Check GST Number" placeholder="GST Number"class="form-control" maxlength="15" minlength="1" required>
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0)" class="btn btn" style="background-color:#109693;color:#fff;">Verified</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Legal Name</label>
                                                <input type="text" class="form-control" value="<?php echo set_value('legal_name') ?>" name="legal_name" placeholder="Enter Legal Name" requird> 
                                            </div>
                                            <div class="form-group col-md-3 required">
                                                <label class="control-label">Constitution of Business</label>
                                                <input type="text" autocomplete="nope" name="constitution_of_business" value="<?php echo set_value('constitution_of_business') ?>" placeholder="Enter Constitution of Business" class="form-control"requird>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">Taxpayer Type</label>
                                                <div class="input-group">
                                                    <input type="text" id="taxpayer_type" autocomplete="nope" value="<?php echo set_value('taxpayer_type') ?>" name="taxpayer_type" class="form-control" placeholder="Enter Taxpayer Type" requird>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">GST Status</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="nope" name="gstin_status" value="<?php echo set_value('gstin_status') ?>" placeholder="" class="form-control" requird>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="padding-top:10px;"> <hr></div><br>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                <label class="control-label">Office Address</label>
                                                <textarea autocomplete="nope" class="form-control" placeholder="Enter office address"  rows="5" name="cmp_address" required=""> <?php echo set_value('cmp_address') ?> </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-row">
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">Pin Code</label>
                                                    <input type="text" id="cmppincode" autocomplete="nope" value="<?php echo set_value('cmp_pincode') ?>" name="cmp_pincode" class="form-control" placeholder="Enter Pincode Number" title="Places Check Pincode Number" required />
                                                    <span class="errormsg" id="officeerrormsg" style="color: #8b0001;font-weight: bold;"></span>
                                                </div>
                                                
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">State</label>
                                                    <select class="form-control"  name="cmp_state" id="cmp_state" >
                                                      <option value="">Select State</option>           
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">City</label>
                                                     <select class="form-control"  name="cmp_city" id="cmp_city">
                                                        <option value="">Select City</option>           
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">Telephone No</label>
                                                    <input type="text" autocomplete="nope" value="<?php echo set_value('cmp_office_phone') ?>"  name="cmp_office_phone" pattern='^\+?\d{0,10}' title ="please check Telephone Number" placeholder="Enter Telephone No" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               


                                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                                    <h6 class="mb-0 text-uppercase font-weight-bold">Bank Details</h6>
                                </div>


                                <div class="row">
                                    <div class="form-row">
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Upload Cancel Check</label>
                                            <input type="file" name="cancel_check"  id="cancel_check" class="form-control" formenctype="multipart/form-data" >
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">A/C Name</label>
                                            <input type="text" autocomplete="nope" name="cmp_account_name" placeholder=" Enter Account Name" value="<?php echo set_value('cmp_account_name') ?>" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">A/C Number</label>
                                            <input type="text" autocomplete="nope" name="cmp_account_number" class="form-control"  value="<?php echo set_value('cmp_account_number') ?>" placeholder="Enter Account Number" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Bank Name</label>
                                            <input type="text" autocomplete="nope" name="cmp_bank_name" class="form-control" value="<?php echo set_value('cmp_bank_name') ?>" placeholder ="Enter Bank Name" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Branch</label>
                                            <input type="text" autocomplete="nope" name="cmp_bank_branch" class="form-control" value="<?php echo set_value('cmp_bank_branch') ?>" Placeholder="Enter Branch Name" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Acc. Type</label>
                                            <input type="text" autocomplete="nope" name="cmp_acc_type" class="form-control" value="<?php echo set_value('cmp_acc_type') ?>" Placeholder="Enter Account Type" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">IFSC Code</label>
                                            <input type="text" autocomplete="nope" name="cmp_ifsc_code"  value="<?php echo set_value('cmp_ifsc_code') ?>" class="form-control" placeholder="Enter IFSC Code" required="">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <button type="submit" name="submit" class="btn  btn-lg btn-primary mt-2">Submit</button>
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
    </div>
    <style>
        input:read-only {
            background-color: #ddd;
        }

        .form-group {
            margin-bottom: 20px !important;
        }
    </style>



    <?php $this->load->view('admin/admin_shared/admin_footer');?>
    
    <script type="text/javascript">

// ***************franchise persnal Details use Pincode
  $("#cpincode").on('blur', function () 
  {
    var pincode = $(this).val();
    if (pincode != null || pincode != '') {

    
      $.ajax({
        type: 'POST',
        url: 'MasterFranchiseController/getCityList',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.city + '</option>';
          $('#cityp').html(option);
          
        }
      });
    }
  }); 
  $("#pincode").on('blur', function () 
  {
    var pincode = $(this).val();
    if (pincode != null || pincode != '') {

    
      $.ajax({
        type: 'POST',
        url: 'MasterFranchiseController/getCityList',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.city + '</option>';
          $('#franchaise_city').html(option);
          
        }
      });
      $.ajax({
        type: 'POST',
        url: 'MasterFranchiseController/getState',
        data: 'pincode=' + pincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.state + '</option>';
          $('#franchaise_state').html(option);          
        }
      });
    }
  }); 
  
// ***************company Details use Pincode
  $("#cmppincode").on('blur', function () 
  {
    var cmppincode = $(this).val();
    if (cmppincode != null || cmppincode != '') {

    
      $.ajax({
        type: 'POST',
        url: 'MasterFranchiseController/getCityList1',
        data: 'cmppincode=' + cmppincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.city + '</option>';
          $('#cmp_city').html(option);
          
        }
      });
      $.ajax({
        type: 'POST',
        url: 'MasterFranchiseController/getState1',
        data: 'cmppincode=' + cmppincode,
        dataType: "json",
        success: function (d) {         
          var option;         
          option += '<option value="' + d.id + '">' + d.state + '</option>';
          $('#cmp_state').html(option);          
        }
      });
    }
  }); 
  
  
</script>

