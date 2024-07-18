<?php include (dirname(__FILE__) . '/../admin_shared/admin_header.php'); ?>
<!-- END Head-->
<style>
    .fade:not(.show) {
        opacity: 1;
    }
</style>
<!-- START: Body-->

<body id="main-container" class="default">


    <!-- END: Main Menu-->
    <?php include (dirname(__FILE__) . '/../admin_shared/admin_sidebar.php'); ?>
    <!-- END: Main Menu-->
    <style>
        .table.layout-primary tbody td:last-child {
            background-color: #ffffff;
            color: aliceblue;
        }
        span .fa {
        color: red;
        font-size: 8px;
        position: relative;
        top: -5px;
      /* margin-top: 16px; */
    }
        .fillter {
        height: 27px !important;
    }

        .form-control {
            height: 36px !important;
            font-size: 14px !important;
            border: 1px solid #000;
            border-radius: 0.2rem;
            -webkit-border-radius: 0.2rem;
            -moz-border-radius: 0.2rem;
            -ms-border-radius: 0.2rem;
            -o-border-radius: 0.2rem;
        }
    </style>
    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Listing-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="col-12 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header justify-content-between align-items-center">
                                <h4 class="card-title"> Vendor Registration</h4>
                            </div>

                            <div class="col-sm-6">
                                <?php if (!empty($this->session->flashdata('msg'))) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">X</button>
                                        <?php echo $this->session->flashdata('msg'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <div class=" p-4">
                                    <div class="">
                                        <form class="p-a30 dez-form" action="<?php echo base_url('admin/add-ftl-vendor'); ?>" method="POST" enctype="multipart/form-data">
                                            <!-- <h3 class="form-title m-t0" style="color:#e95421;">Sign UP</h3> -->
                                         <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Vendor Name<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input name="vendor_name" required="" class="form-control" placeholder="Enter full Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input name="email" required="" class="form-control" placeholder="Enter Email Id" required type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input name="alternate_email" class="form-control" placeholder="Enter Alternate Email Id" type="email" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Username<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input name="username" required="" autocomplete="off" class="form-control" placeholder="Enter Username" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Password<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input name="password" required="" class="form-control " autocomplete="off" placeholder="Please Enter Password" type="password" />
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Mob.No.<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input type="text" name="phone" required="" class="form-control manifest_driver_contact" maxlength="10" minlength="10" pattern='^\+?\d{0,10}' placeholder=" Please Enter Mobile No" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Alternate Number</label>
                                                        <input type="text" name="alternate_number" class="form-control manifest_driver_contact" maxlength="10" minlength="10" pattern='^\+?\d{0,10}' placeholder="Enter Alternate Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Refrence Persone Name<span style="color:red;"><i class="fa fa-star"
                                                    aria-hidden="true"></i></span></label>
                                                        <input type="text" name="reference_person_name" class="form-control " placeholder="Enter Reference Person Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Address<span style="color:red;"><i class="fa fa-star"
                                                    aria-hidden="true"></i></span></label>
                                                        <textarea name="address" required="" placeholder="Enter Address" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Pincode<span style="color:red;"><i class="fa fa-star"
                                                    aria-hidden="true"></i></span></label>
                                                        <input type="text" name="pincode" id="v_pincode" value="<?php echo set_value('pincode') ?>" maxlength="6" minlength="6" required="" class="form-control " placeholder="Enter Pincode" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">State<span style="color:red;"><i class="fa fa-star"
                                                    aria-hidden="true"></i></span></label>
                                                         <select class="form-control fillter" name="state" id="v_state_id" required>
                                                            <option value="">Select State</option>
                                                            <?php

                                                                if (count($states)) {
                                                                foreach ($states as $st) {
                                                                    ?>
                                                                    <option value="<?php echo $st['id']; ?>">
                                                                    <?php echo $st['state']; ?>
                                                                    </option>
                                                                <?php }
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">City<span style="color:red;"><i class="fa fa-star"
                                                    aria-hidden="true"></i></span></label>
                                                        <select class="form-control fillter" name="city" id="v_city_id" required>
                                                            <option value="">Select City</option>
                                                            <?php
                                                                if (count($cities)) {
                                                                foreach ($cities as $c) { ?>
                                                                    <option value="<?php echo $c['id']; ?>">
                                                                    <?php echo $c['city']; ?>
                                                                    </option>
                                                                <?php }
                                                                } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Pan Number</label>
                                                        <input type="text" name="pan_number" placeholder="Enter Pan Number" maxlength="10" data-parsley-error-message="Please Enter Pan Card Number" class="form-control pan">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>GST Number</label>
                                                    <div class="form-group">
                                                        <input type="text" name="gst_number" data-parsley-error-message="Please Enter GST Number" maxlength="15" title="Please Enter GST Number" class="form-control required_gst gst" placeholder="Enter GST Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Credit Days</label>
                                                    <div class="form-group">
                                                        <input type="text" name="credit_days" class="form-control manifest_driver_contact" maxlength="2" minlength="1" pattern='^\+?\d{0,10}' placeholder=" Enter Credit Day" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Bank Name</label>
                                                        <input type="text" name="bank_name" class="form-control" placeholder=" Enter bank Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Account Number</label>
                                                        <input type="text" name="acc_number" class="form-control manifest_driver_contact" maxlength="18" pattern='^\d{9,18}$' placeholder=" Enter Account Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">IFSC Code</label>
                                                        <input type="text" name="ifsc_code" class="form-control" placeholder=" Enter IFSC code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Upload Cancel cheque<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input type="file" name="cancel_cheque" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Upload Photo</label>
                                                        <input type="File" name="profile_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Address Proof<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input type="file" name="address_proof" class="form-control" required>
                                                    </div>
                                                </div>                                            
                                               
                                            </div>
                                          
                                           
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Pan card<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input type="file" name="pan_card_proof" class="form-control " required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 hide_gst_certificate" style="display:none;">
                                                    <div class="form-group">
                                                        <label>Gst Certificate<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <input type="file" name="gst_proof" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Registration Type<span style="color:red;"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span></label>
                                                        <select class="form-control fillter" name="register_type" id="register_type" required>
                                                            <option value="">Select registration Type</option>
                                                            <?php foreach(register_type as $key => $val){ ?>
                                                            <option value="<?= $key; ?>"><?=$val; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Service Provider</label>
                                                        <select class="form-control fillter" name="service_provider" id="service_provider">
                                                            <option value="">Select Service Provider</option>
                                                            <?php foreach(service_provider as $key => $val){ ?>
                                                            <option value="<?=$key;?>"><?=$val;?></option>
                                                             <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-12">
                                                    <h5 class="text-danger">Services Area</h5>
                                                </div>
                                            </div>

                                            <div class="row mb-4" id="1001" data-id="1001">
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Origin</label>
                                                    <select class="form-control fillter" name="origin[]" id="origin" required>
                                                            <option value="">Select City</option>
                                                            <?php
                                                                if (count($cities)) {
                                                                foreach ($cities as $c) { ?>
                                                                    <option value="<?php echo $c['id']; ?>">
                                                                    <?php echo $c['city']; ?>
                                                                    </option>
                                                                <?php }
                                                                } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Destination</label>
                                                    <select class="form-control fillter" name="destination[]" id="destination" required>
                                                            <option value="">Select City</option>
                                                            <?php
                                                                if (count($cities)) {
                                                                foreach ($cities as $c) { ?>
                                                                    <option value="<?php echo $c['id']; ?>">
                                                                    <?php echo $c['city']; ?>
                                                                    </option>
                                                                <?php }
                                                                } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Vehicle Type</label>
                                                    <select class="form-control fillter" name="vehicle_type[]" id="vehicle_type">
                                                        <option value="">Select Vehicle Type</option>
                                                        <?php if (!empty($vehicle_type)) { ?>
                                                        <?php foreach ($vehicle_type as $value): ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->vehicle_name; ?> </option>
                                                        <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3 mt-4">
                                                    <button type="button" class="btn btn-success" id="add_data">Add</button>
                                                </div>
                                            </div>

                                            <div id="show_column"></div>

                                            <div class="form-group text-left  mt-2">
                                                <button type="submit" name="submit" class="button btn-info btn-sm">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Client logo END -->
                </div>
                <?php include (dirname(__FILE__) . '/../admin_shared/admin_footer.php'); ?>
                <!-- Content END-->
                <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>                
                
                <script src="assets/js/domestic_shipment.js"></script>