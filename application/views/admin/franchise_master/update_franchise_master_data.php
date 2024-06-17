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
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-md-6">
                            <h6 class=""><i class="fas fa-star mr-2"></i>Company Profile</h6>
                        </div>
                        <hr>

                    </div>

                    <div class="col-12 col-md-12 mt-3">
                        <div class="card p-4">
                            <div class="card-body">
                               
                               
                               
                                <form name="form" action="<?php echo base_url('MasterFranchiseController/update_master_franchise_data/'.$franchise_data->franchise_id.'/'.$franchise_data->fid);?>" enctype="multipart/form-data" method="POST" >
                                    
                                   

                                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                                    <h6 class="mb-0 text-uppercase font-weight-bold">Personal Information</h6>
                                </div>
                                 
                                 <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Franchise ID</label>
                                                 <input type="text"  value="<?php echo $franchise_data->fid ; ?>" name="fid" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Username</label>
                                                 <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo $customer->customer_name ; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-row">-->
                                    <!--        <div class="form-group col-md-12">-->
                                    <!--            <label>Password</label>-->
                                    <!--             <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo set_value('password') ?>">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-row">-->
                                    <!--        <div class="form-group col-md-12">-->
                                    <!--            <label>Confirm Password</label>-->
                                    <!--             <input type="text" class="form-control" name="passconf"  value="<?php echo set_value('passconf') ?>" placeholder="Enter Confirm Password">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                     <div class="col-md-12"> <hr></div><br>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label"> Name</label>
                                            <input type="text" name="franchise_name" placeholder="Enter Name" value="<?php echo $customer->customer_name ; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group  col-md-3 required">
                                        <div class="form-group">
                                            <label class="control-label">S/O or D/O</label>
                                            <input type="text" name="franchise_relation" class="form-control"  value="<?php echo $franchise_data->franchise_relation ; ?>" placeholder="Enter Relation Name" required="">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 required">
                                        <div class="form-group">
                                            <label class="control-label">Age</label>
                                            <input type="text" name="age" class="form-control" value="<?php echo $franchise_data->age ; ?>" placeholder="Enter Age" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter Email-Id"  value="<?php echo $customer->email ; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"> <hr></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">Residential Address </label>
                                            <textarea class="form-control" autocomplete="nope" rows="5" name="address" placeholder ="Enter Your Addres.."> <?php echo $customer->address ; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label">Pin Code</label>
                                                <input type="text"  name="pincode" id="pincode"  value="<?php echo $customer->pincode ; ?>"  class="form-control" placeholder="Enter Pincode Number">
                                                <span class="errormsg" id="errormsg" style="color: #8b0001;font-weight: bold;"></span>
                                            </div>
                                           
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">State</label>
                                                 <select class="form-control"  name="franchaise_state_id"  id="franchaise_state" required="">
                                                    <option value="">Select State</option>    
                                                     <?php foreach($states as $state){  ?>
                                                     <option value="<?=$state['id'];?>" <?php if($customer->state == $state['id']){ ?> Selected <?php } ?>><?=$state['state'];?></option> 
                                                    <?php }  ?>
                                                </select>
                                            </div>
                                            
                                             <div class="form-group col-md-4 ">
                                                <label class="control-label">City</label>
                                                <select class="form-control"  name="franchaise_city_id" id="franchaise_city" required="">
                                                    <option value="">Select City</option>  
                                                    <?php foreach($cities as $city){  ?>
                                                     <option value="<?=$city['id'];?>" <?php if($customer->city == $city['id']){ ?> Selected <?php } ?>><?=$city['city'];?></option> 
                                                    <?php }  ?>
                                                </select>
                                              </div>
                                            
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">Contact No</label>
                                                <input type="text" autocomplete="nope" name="contact_number"  value="<?php echo $customer->phone ; ?>" pattern='^\+?\d{0,10}' class="form-control"  title ="please check Contact Number" placeholder="contact_number" required>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label class="control-label">Alternate Contact No</label>
                                                <input type="text" autocomplete="nope" name="alt_contact"  value="<?php echo $customer->contact_person ; ?>" class="form-control" pattern='^\+?\d{0,10}' title ="please check Alternate Contact Number" placeholder="Enter Alt Number">
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
                                                    <!-- <option value="">Select Type</option> -->
                                                    <option value="Sole Proprietorship" <?php if($customer->company_id == 'Sole Proprietorship'){ echo 'selected';}?>>Sole Proprietorship</option>
                                                    <option value="Partnership" <?php if($customer->company_id == 'Partnership'){ echo 'selected';}?>>Partnership</option>
                                                    <option value="Limited Liability Partnership" <?php if($customer->company_id == 'Limited Liability Partnership'){ echo 'selected';}?>>Limited Liability Partnership</option>
                                                    <option value="Public Limited Company" <?php if($customer->company_id == 'Public Limited Company'){ echo 'selected';}?>>Public Limited Company</option>
                                                    <option value="Private Limited Company" <?php if($customer->company_id == 'Private Limited Company'){ echo 'selected';}?>>Private Limited Company</option>
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
                                                <input type="text"  class="form-control" name="pan_name" value="<?php echo $franchise_data->pan_name ; ?>"  placeholder="Enter Pan Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Pan Number </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" title="Places check Pan Number" value="<?php echo $franchise_data->pan_number ; ?>"  name="pan_number" maxlength="10" minlength="10" placeholder="Enter Pan Card Number"required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6 required">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Upload PANCard Photo</label>
                                                <input type="file" name="pancard_photo" id="pancard_photo" value="<?php echo set_value('pancard_photo') ?>" >
                                                <?php if($franchise_data->pancard_photo){ ?>
                                                  <img src="assets/franchise-documents/pancard_document/<?= $franchise_data->pancard_photo; ?>" width='200px' heigh="auto";>
                                               <?php  } ?>
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
                                                    <input type="text" class="form-control" title="places check Aadhar Number" value="<?php echo $franchise_data->aadhar_number ; ?>"  name="aadhar_number" maxlength="12" minlength="12" placeholder="Enter Aadhar Number" required>
                                                </div>
                                            </div>
                                             <div class="col-md-6 form-group required">
                                                <label class="control-label">Full Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"  name="aadharin_name" value="<?php echo $franchise_data->aadharin_name ; ?>" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                       </div>

                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label class="control-label">DOB<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" value="<?php echo $franchise_data->dob ; ?>" name="dob" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group" required>
                                                <label class="control-label">Gender<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input type="radio"  class="form-control" value="Male"<?php if($franchise_data->gender == Male){ echo 'checked="checked"'; } ?> name="gender">Male
                                                    <input type="radio" class="form-control" value ="Female"<?php if($franchise_data->gender == Female){ echo 'checked="checked"'; } ?> name="gender">Female
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6" required>
                                                <label class="control-label">Address<span class="required">*</span></label>
                                                <div class="input-group">
                                                    <textarea type="text" class="form-control" name=" aadhar_address" placeholder="Enter Address" required> <?php echo $franchise_data->aadhar_address ; ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Upload AadharCard Photo</label>
                                                    <input type="file" name="aadharcard_photo" id="aadharcard_photo" value="<?php echo set_value('aadharcard_photo') ?>" formenctype="multipart/form-data">
                                               <?php if($franchise_data->aadharcard_photo){ ?>
                                                  <img src="assets/franchise-documents/aadharcard_document/<?= $franchise_data->aadharcard_photo; ?>" width='200px' heigh="auto";>
                                               <?php  } ?>
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
                                                <input type="text" name="company_name" value="<?php echo $franchise_data->company_name ; ?>" placeholder="Enter Company Name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">PAN Number</label>
                                                <div class="input-group">
                                                    <input type="text"  value="<?php echo $franchise_data->cmp_pan_number ; ?>" name="cmp_pan_number" title="Places Check Pan Number" maxlength="10" minlength="10" placeholder="Enter Pan Number" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0)" class="btn btn" style="background-color:#109693;color:#fff;">Verified</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">GST Number</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="nope" id="gst_no" value="<?php echo $franchise_data->cmp_gstno ; ?>" name="cmp_gstno"  title="Places Check GST Number" placeholder="GST Number"class="form-control" maxlength="15" minlength="1" required>
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
                                                <input type="text" class="form-control" value="<?php echo $franchise_data->legal_name ; ?>" name="legal_name" placeholder="Enter Legal Name" requird> 
                                            </div>
                                            <div class="form-group col-md-3 required">
                                                <label class="control-label">Constitution of Business</label>
                                                <input type="text" autocomplete="nope" name="constitution_of_business" value="<?php echo $franchise_data->constitution_of_business ; ?>" placeholder="Enter Constitution of Business" class="form-control"requird>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">Taxpayer Type</label>
                                                <div class="input-group">
                                                    <input type="text" id="taxpayer_type" autocomplete="nope" value="<?php echo $franchise_data->taxpayer_type ; ?>" name="taxpayer_type" class="form-control" placeholder="Enter Taxpayer Type" requird>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">GST Status</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="nope" name="gstin_status" value="<?php echo $franchise_data->gstin_status ; ?>" placeholder="" class="form-control" requird>
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
                                                <textarea autocomplete="nope" class="form-control" placeholder="Enter office address"  rows="5" name="cmp_address" required=""> <?php echo $franchise_data->cmp_address ; ?> </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-row">
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">Pin Code</label>
                                                    <input type="text" id="cmppincode" autocomplete="nope" value="<?php echo $franchise_data->cmp_pincode ; ?>" name="cmp_pincode" class="form-control" placeholder="Enter Pincode Number" title="Places Check Pincode Number" required />
                                                    <span class="errormsg" id="officeerrormsg" style="color: #8b0001;font-weight: bold;"></span>
                                                </div>
                                                
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">State</label>
                                                    <select class="form-control"  name="cmp_state" id="cmp_state" required="">
                                                    <?php foreach($states as $state){  ?>
                                                     <option value="<?=$state['id'];?>" <?php if($franchise_data->cmp_state == $state['id']){ ?> Selected <?php } ?>><?=$state['state'];?></option> 
                                                    <?php }  ?>           
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">City</label>
                                                     <select class="form-control"  name="cmp_city" id="cmp_city" required="">
                                                       
                                                       <?php foreach($cities as $city){  ?>
                                                         <option value="<?=$city['id'];?>" <?php if($franchise_data->cmp_city == $city['id']){ ?> Selected <?php } ?>><?=$city['city'];?></option> 
                                                       <?php }  ?>       
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4 required">
                                                    <label class="control-label">Telephone No</label>
                                                    <input type="text" autocomplete="nope" value="<?php echo $franchise_data->cmp_office_phone ; ?>"  name="cmp_office_phone" pattern='^\+?\d{0,10}' title ="please check Telephone Number" placeholder="Enter Telephone No" class="form-control" required="">
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
                                            <input type="file" name="cancel_check"  id="cancel_check"  class="form-control" formenctype="multipart/form-data" >
                                            <?php if($franchise_data->aadharcard_photo){ ?>
                                                  <img src="assets/franchise-documents/bank_document/<?= $franchise_data->cancel_check; ?>" width='200px' heigh="auto";>
                                               <?php  } ?>
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">A/C Name</label>
                                            <input type="text" autocomplete="nope" name="cmp_account_name" placeholder=" Enter Account Name" value="<?php echo $franchise_data->cmp_account_name ; ?>" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">A/C Number</label>
                                            <input type="text" autocomplete="nope" name="cmp_account_number" class="form-control"  value="<?php echo $franchise_data->cmp_account_number ; ?>" placeholder="Enter Account Number" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Bank Name</label>
                                            <input type="text" autocomplete="nope" name="cmp_bank_name" class="form-control" value="<?php echo $franchise_data->cmp_bank_name ; ?>" placeholder ="Enter Bank Name" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Branch</label>
                                            <input type="text" autocomplete="nope" name="cmp_bank_branch" class="form-control" value="<?php echo $franchise_data->cmp_bank_branch ; ?>" Placeholder="Enter Branch Name" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">Acc. Type</label>
                                            <input type="text" autocomplete="nope" name="cmp_acc_type" class="form-control" value="<?php echo $franchise_data->cmp_acc_type ; ?>" Placeholder="Enter Account Type" required="">
                                        </div>
                                        <div class="form-group col-md-4 required">
                                            <label class="control-label">IFSC Code</label>
                                            <input type="text" autocomplete="nope" name="cmp_ifsc_code"  value="<?php echo $franchise_data->cmp_ifsc_code ; ?>" class="form-control" placeholder="Enter IFSC Code" required="">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <button type="submit" name="submit" value="submit" class="btn  btn-lg btn-primary mt-2">Submit</button>
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
  //======================

// ***************franchise persnal Details use Pincode
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
