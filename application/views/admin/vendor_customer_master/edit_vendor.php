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
                                <h4 class="card-title"> Edit Vendor</h4>
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
                                        <form class="p-a30 dez-form"
                                            action="<?php echo base_url('admin/edit-vendor/'.$edit_vendor->customer_id); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <!-- <h3 class="form-title m-t0" style="color:#e95421;">Sign UP</h3> -->
                                            <input type="hidden" class="form-control" value="<?php echo $edit_vendor->customer_id; ?>"
                                                name="id">

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Vendor Name<span
                                                                style="color:red;"><i class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input name="vendor_name" required="" class="form-control"
                                                            placeholder="Enter full Name" type="text"
                                                            value="<?= $edit_vendor->vendor_name; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input name="email" required="" class="form-control"
                                                            placeholder="Enter Email Id"
                                                            value="<?= $edit_vendor->email; ?>" required type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input name="alternate_email" class="form-control"
                                                            placeholder="Enter Alternate Email Id"
                                                            value="<?= $edit_vendor->alternate_email; ?>" type="email" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Username<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input name="username" required="" readonly autocomplete="off"
                                                            class="form-control" value="<?= $edit_vendor->username; ?>"
                                                            placeholder="Enter Username" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Password<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input name="password"  class="form-control "
                                                            autocomplete="off" placeholder="Please Enter Password"
                                                            type="password" />
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Mob.No.<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="text" name="phone" required=""
                                                            value="<?= $edit_vendor->mobile_no; ?>"
                                                            class="form-control manifest_driver_contact" maxlength="10"
                                                            minlength="10" pattern='^\+?\d{0,10}'
                                                            placeholder=" Please Enter Mobile No" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Alternate Number</label>
                                                        <input type="text" name="alternate_number"
                                                            value="<?= $edit_vendor->alternate_phone_number; ?>"
                                                            class="form-control manifest_driver_contact" maxlength="10"
                                                            minlength="10" pattern='^\+?\d{0,10}'
                                                            placeholder="Enter Alternate Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Refrence Persone Name<span
                                                                style="color:red;"><i class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="text" name="reference_person_name"
                                                            class="form-control "
                                                            value="<?= $edit_vendor->reference_person_name; ?>"
                                                            placeholder="Enter Reference Person Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Address<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <textarea name="address" required="" placeholder="Enter Address"
                                                            class="form-control"><?= $edit_vendor->address; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Pincode<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="text" name="pincode" id="v_pincode"
                                                            value="<?= $edit_vendor->pincode; ?>" maxlength="6"
                                                            minlength="6" required="" class="form-control "
                                                            placeholder="Enter Pincode" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">State<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <select class="form-control fillter" name="state"
                                                            id="v_state_id" required>
                                                            <option value="">Select State</option>
                                                            <?php

                                                            if (count($states)) {
                                                                foreach ($states as $st) {
                                                                    ?>
                                                                    <option value="<?php echo $st['id']; ?>" <?php if ($st['id'] == $edit_vendor->state) {
                                                                           echo 'selected';
                                                                       } ?>>
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
                                                        <label class="control-label">City<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <select class="form-control fillter" name="city" id="v_city_id"
                                                            required>
                                                            <option value="">Select City</option>
                                                            <?php
                                                            if (count($cities)) {
                                                                foreach ($cities as $c) { ?>
                                                                    <option value="<?php echo $c['id']; ?>" <?php if ($c['id'] == $edit_vendor->city) {
                                                                           echo 'selected';
                                                                       } ?>>
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
                                                        <input type="text" name="pan_number"
                                                            placeholder="Enter Pan Number" maxlength="10"
                                                            value="<?= $edit_vendor->pan_number; ?>"
                                                            data-parsley-error-message="Please Enter Pan Card Number"
                                                            class="form-control pan">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>GST Number</label>
                                                    <div class="form-group">
                                                        <input type="text" name="gst_number"
                                                            data-parsley-error-message="Please Enter GST Number"
                                                            value="<?= $edit_vendor->gst_number; ?>" maxlength="15"
                                                            title="Please Enter GST Number"
                                                            class="form-control required_gst gst"
                                                            placeholder="Enter GST Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Credit Days</label>
                                                    <div class="form-group">
                                                        <input type="text" name="credit_days"
                                                            class="form-control manifest_driver_contact"
                                                            value="<?= $edit_vendor->credit_days; ?>" maxlength="2"
                                                            minlength="1" pattern='^\+?\d{0,10}'
                                                            placeholder=" Enter Credit Day" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Bank Name</label>
                                                        <input type="text" name="bank_name" class="form-control"
                                                            value="<?= $edit_vendor->bank_name; ?>"
                                                            placeholder=" Enter bank Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Account Number</label>
                                                        <input type="text" name="acc_number"
                                                            class="form-control manifest_driver_contact"
                                                            value="<?= $edit_vendor->acc_number; ?>" maxlength="18"
                                                            pattern='^\d{9,18}$' placeholder=" Enter Account Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">IFSC Code</label>
                                                        <input type="text" name="ifsc_code" class="form-control"
                                                            value="<?= $edit_vendor->ifsc_code; ?>"
                                                            placeholder=" Enter IFSC code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Upload Cancel cheque<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="file" name="cancel_cheque" class="form-control"
                                                           >
                                                        <?php if (!empty($edit_vendor->cancel_cheque)) {
                                                            $ext = explode('.', $edit_vendor->cancel_cheque);
                                                            if ($ext[1] == 'pdf') { ?>
                                                                <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $edit_vendor->cancel_cheque); ?>"
                                                                    target="_blank"><i class="fa fa-link" aria-hidden="true">
                                                                        View GST PDF</i></a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->cancel_cheque; ?>"
                                                                    src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->cancel_cheque; ?>"
                                                                    title="<?php echo $edit_vendor->cancel_cheque; ?>"
                                                                    onclick="show_image(this);return false;"
                                                                    style="color:blue;">View-Image</a>
                                                                <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                    | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->cancel_cheque; ?>"
                                                                        download>Download</a>
                                                                <?php }
                                                            }
                                                        } else { ?>
                                                            <span style="color:red">Data Not Found</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Upload Photo</label>
                                                        <input type="File" name="profile_image" class="form-control">
                                                        <?php if (!empty($edit_vendor->profile_image)) {
                                                            $ext = explode('.', $edit_vendor->profile_image);
                                                            if ($ext[1] == 'pdf') { ?>
                                                                <a href="<?= base_url('assets/ftl_documents/vendor_profile_image/' . $edit_vendor->profile_image); ?>"
                                                                    target="_blank"><i class="fa fa-link" aria-hidden="true">
                                                                        View GST PDF</i></a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_profile_image/<?php echo $edit_vendor->profile_image; ?>"
                                                                    src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_profile_image/<?php echo $edit_vendor->profile_image; ?>"
                                                                    title="<?php echo $edit_vendor->profile_image; ?>"
                                                                    onclick="show_image(this);return false;"
                                                                    style="color:blue;">View-Image</a>
                                                                <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                    | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_profile_image/<?php echo $edit_vendor->profile_image; ?>"
                                                                        download>Download</a>
                                                                <?php }
                                                            }
                                                        } else { ?>
                                                            <span style="color:red">Data Not Found</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Address Proof<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="file" name="address_proof" class="form-control"
                                                            >
                                                        <?php if (!empty($edit_vendor->address_proof)) {
                                                            $ext = explode('.', $edit_vendor->address_proof);
                                                            if ($ext[1] == 'pdf') { ?>
                                                                <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $edit_vendor->address_proof); ?>"
                                                                    target="_blank"><i class="fa fa-link" aria-hidden="true">
                                                                        View GST PDF</i></a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->address_proof; ?>"
                                                                    src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->address_proof; ?>"
                                                                    title="<?php echo $edit_vendor->address_proof; ?>"
                                                                    onclick="show_image(this);return false;"
                                                                    style="color:blue;">View-Image</a>
                                                                <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                    | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->address_proof; ?>"
                                                                        download>Download</a>
                                                                <?php }
                                                            }
                                                        } else { ?>
                                                            <span style="color:red">Data Not Found</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Pan card<span style="color:red;"><i class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="file" name="pan_card_proof" class="form-control "
                                                            >
                                                        <?php if (!empty($edit_vendor->pan_card_proof)) {
                                                            $ext = explode('.', $edit_vendor->pan_card_proof);
                                                            if ($ext[1] == 'pdf') { ?>
                                                                <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $edit_vendor->pan_card_proof); ?>"
                                                                    target="_blank"><i class="fa fa-link" aria-hidden="true">
                                                                        View GST PDF</i></a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->pan_card_proof; ?>"
                                                                    src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->pan_card_proof; ?>"
                                                                    title="<?php echo $edit_vendor->pan_card_proof; ?>"
                                                                    onclick="show_image(this);return false;"
                                                                    style="color:blue;">View-Image</a>
                                                                <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                    | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->pan_card_proof; ?>"
                                                                        download>Download</a>
                                                                <?php }
                                                            }
                                                        } else { ?>
                                                            <span style="color:red">Data Not Found</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 hide_gst_certificate" style="display:none;">
                                                    <div class="form-group">
                                                        <label>Gst Certificate<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <input type="file" name="gst_proof" class="form-control"
                                                            >
                                                        <?php if (!empty($edit_vendor->gst_proof)) {
                                                            $ext = explode('.', $edit_vendor->gst_proof);
                                                            if ($ext[1] == 'pdf') { ?>
                                                                <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $edit_vendor->gst_proof); ?>"
                                                                    target="_blank"><i class="fa fa-link" aria-hidden="true">
                                                                        View GST PDF</i></a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->gst_proof; ?>"
                                                                    src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->gst_proof; ?>"
                                                                    title="<?php echo $edit_vendor->gst_proof; ?>"
                                                                    onclick="show_image(this);return false;"
                                                                    style="color:blue;">View-Image</a>
                                                                <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                    | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $edit_vendor->gst_proof; ?>"
                                                                        download>Download</a>
                                                                <?php }
                                                            }
                                                        } else { ?>
                                                            <span style="color:red">Data Not Found</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Registration Type<span style="color:red;"><i
                                                                    class="fa fa-star"
                                                                    aria-hidden="true"></i></span></label>
                                                        <select class="form-control fillter" name="register_type"
                                                            id="register_type" >
                                                            <option value="">Select registration Type</option>
                                                            <?php foreach (register_type as $key => $val) { ?>
                                                                <option value="<?= $key; ?>" <?php if ($key == $edit_vendor->register_type) {
                                                                      echo 'selected';
                                                                  } ?>><?= $val; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Service Provider</label>
                                                        <select class="form-control fillter" name="service_provider"
                                                            id="service_provider">
                                                            <option value="">Select Service Provider</option>
                                                            <?php foreach (service_provider as $key => $val) { ?>
                                                                <option value="<?= $key; ?>" <?php if ($key == $edit_vendor->service_provider) {
                                                                    echo 'selected';
                                                                } ?>><?= $val; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-12">
                                                    <h5 class="text-danger">Add Services Area</h5>
                                                </div>
                                            </div>

                                            <div class="row mb-4" id="1001" data-id="1001">
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Origin</label>
                                                    <select class="form-control fillter" name="origin[]" id="origin"
                                                        >
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
                                                    <select class="form-control fillter" name="destination[]"
                                                        id="destination" >
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
                                                    <select class="form-control fillter" name="vehicle_type[]"
                                                        id="vehicle_type">
                                                        <option value="">Select Vehicle Type</option>
                                                        <?php if (!empty($vehicle_type)) { ?>
                                                            <?php foreach ($vehicle_type as $value): ?>
                                                                <option value="<?php echo $value->id; ?>">
                                                                    <?php echo $value->vehicle_name; ?> </option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3 mt-4">
                                                    <button type="button" class="btn btn-success"
                                                        id="add_data">Add</button>
                                                </div>
                                            </div>

                                            <div id="show_column"></div>

                                            <div class="form-group text-left  mt-2">
                                                <button type="submit" name="submit"
                                                    class="button btn-info btn-sm">Submit</button>
                                            </div>
                                            <br>
                                            <div class="row mb-2">
                                                <div class="col-sm-12">
                                                    <h5 class="text-danger">Services Area</h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="display table  table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">SR NO</th>
                                                            <th scope="col">Origin</th>
                                                            <th scope="col">Destination</th>
                                                            <th scope="col">Vehicle Name</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($service)) {

                                                            $cnt = 1;
                                                            foreach ($service as $ct) { ?>
                                                                <tr>
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><?php echo $ct->origin; ?></td>
                                                                    <td><?php echo $ct->destiontion; ?></td>
                                                                    <td><?php echo $ct->vehicle_name; ?></td>
                                                                    <td><?php if ($ct->isdeleted == '0') {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'No Service';
                                                                    } ?>
                                                                    </td>
                                                                    <td> <a href="javascript:void(0);" title="Status" class="deletedata" onclick="delete_customer(<?php echo $ct->id; ?>)"><i class="ion-trash-b" style="color:var(--danger)"></i></a></td>


                                                                </tr>
                                                                <?php
                                                                $cnt++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
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


                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> 
                <script src="assets/js/domestic_shipment.js"></script>
                <script>
                    checkGST();
                    function delete_customer(getid) {
                        // var getid = $(this).attr("relid");
                        // alert(getid);
                        var baseurl = '<?php echo base_url(); ?>'
                        swal({
                            title: 'Are you sure?',
                            text: "You won't Changes status!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: baseurl + 'Admin_vendore_registration/delete_customer',
                                    type: 'POST',
                                    data: 'getid=' + getid,
                                    dataType: 'json'
                                })
                                    .done(function (response) {
                                        swal('Deleted!', response.message, response.status);
                                        location.reload();
                                    })
                                    .fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            }

                        })

                    }
                </script>
                <div id="myModal" class="modal">
                    <span class="close-image-modal">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <style type="text/css">
                    /* The Modal (background) */
                    .modal {
                        display: none;
                        /* Hidden by default */
                        position: fixed;
                        /* Stay in place */
                        z-index: 1;
                        /* Sit on top */
                        padding-top: 100px;
                        /* Location of the box */
                        left: 0;
                        top: 0;
                        width: 100%;
                        /* Full width */
                        height: 100%;
                        /* Full height */
                        overflow: auto;
                        /* Enable scroll if needed */
                        background-color: rgb(0, 0, 0);
                        /* Fallback color */
                        background-color: rgba(0, 0, 0, 0.9);
                        /* Black w/ opacity */
                    }

                    /* Modal Content (image) */
                    .modal-content {
                        margin: auto;
                        display: block;
                        width: 50%;
                        max-width: 700px;
                    }

                    /* Caption of Modal Image */
                    #caption {
                        margin: auto;
                        display: block;
                        width: 80%;
                        max-width: 700px;
                        text-align: center;
                        color: #ccc;
                        padding: 10px 0;
                        height: 150px;
                    }

                    /* Add Animation */
                    .modal-content,
                    #caption {
                        -webkit-animation-name: zoom;
                        -webkit-animation-duration: 0.6s;
                        animation-name: zoom;
                        animation-duration: 0.6s;
                    }

                    @-webkit-keyframes zoom {
                        from {
                            -webkit-transform: scale(0)
                        }

                        to {
                            -webkit-transform: scale(1)
                        }
                    }

                    @keyframes zoom {
                        from {
                            transform: scale(0)
                        }

                        to {
                            transform: scale(1)
                        }
                    }

                    /* The Close Button */
                    .close-image-modal {
                        position: absolute;
                        /*top: 15px;*/
                        right: 35px;
                        color: #f1f1f1;
                        font-size: 40px;
                        font-weight: bold;
                        transition: 0.3s;
                    }

                    .close-image-modal:hover,
                    .close-image-modal:focus {
                        color: #bbb;
                        text-decoration: none;
                        cursor: pointer;
                    }

                    /* 100% Image Width on Smaller Screens */
                    @media only screen and (max-width: 700px) {
                        .modal-content {
                            width: 100%;
                        }
                    }
                </style>
                <script>
                    // Get the modal
                    var modal = document.getElementById("myModal");

                    function show_image(obj) {
                        var captionText = document.getElementById("caption");
                        var modalImg = document.getElementById("img01");
                        modal.style.display = "block";
                        // alert(obj.tagName);
                        if (obj.tagName == 'A') {
                            modalImg.src = obj.href;
                            captionText.innerHTML = obj.title;
                        }
                        if (obj.tagName == 'img') {
                            modalImg.src = obj.src;
                            captionText.innerHTML = obj.alt;
                        }

                        // modalImg.src = 'http://www.safedart.in/assets/pod/pod_1.jpg';

                    }
                    var span = document.getElementsByClassName("close-image-modal")[0];

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function () {
                        modal.style.display = "none";
                    }


                    // Get the image and insert it inside the modal - use its "alt" text as a caption




                    // Get the <span> element that closes the modal
                </script>