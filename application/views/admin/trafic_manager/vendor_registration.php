<?php $this->load->view('admin/admin_shared/admin_header'); ?>
<!-- END Head-->
<style>
    .fade:not(.show) {
        opacity: 1;
    }
</style>
<!-- START: Body-->

<body id="main-container" class="default">


    <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar');
    // include('admin_shared/admin_sidebar.php'); 
    ?>
    <!-- END: Main Menu-->
    <style>
        .table.layout-primary tbody td:last-child {
            background-color: #ffffff;
            color: aliceblue;
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
                                <div class="card p-4">
                                    <div class="card-body">


                                        <form class="p-a30 dez-form" action="<?php echo base_url('admin/add-ftl-vendor'); ?>" method="POST" enctype="multipart/form-data">
                                            <!-- <h3 class="form-title m-t0" style="color:#e95421;">Sign UP</h3> -->
                                            <input type="hidden" class="form-control" value="<?php echo $VCI; ?>" name="vci">

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Vendor Name</label>
                                                        <input name="vendor_name" required="" class="form-control" placeholder="Enter full Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
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
                                                        <label class="control-label">Username</label>
                                                        <input name="username" required="" autocomplete="off" class="form-control" placeholder="Enter Username" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input name="password" required="" class="form-control " autocomplete="off" placeholder="Please Enter Password" type="password" />
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Mob.No.</label>
                                                        <input type="text" name="phone" required="" class="form-control " placeholder=" Please Enter Mobile No" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Alternate Number</label>
                                                        <input type="text" name="alternate_number" class="form-control " placeholder="Enter Alternate Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Refrence Persone Name</label>
                                                        <input type="text" name="reference_person_name" class="form-control " placeholder="Enter Reference Person Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                        <input type="text" name="address" required="" placeholder="Enter Address" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Pincode</label>
                                                        <input type="number" name="pincode" id="pincode" required="" class="form-control " placeholder="Enter Pincode" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">State</label>
                                                        <input class="form-control " id="state" placeholder="Enter state" type="text" readonly />
                                                        <input name="state" required="" class="form-control " id="state_id" placeholder="Enter state" type="hidden" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">City</label>
                                                        <input type="text" id="city" class="form-control " placeholder="Enter City" readonly />
                                                        <input type="hidden" name="city" required="" id="city_id" class="form-control" readonly />
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
                                                    <div class="form-group">
                                                        <label>Upload Photo</label>
                                                        <input type="File" name="profile_image" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Service Provider</label>
                                                        <select class="form-control" name="service_provider" id="service_provider">
                                                            <option value="">Select Service Provider</option>
                                                            <option value="Fleet Owner">Fleet Owner</option>
                                                            <option value="Broker">Broker</option>
                                                            <option value="Attach Vehicle">Attach Vehicle</option>
                                                            <option value="other">Other</option>

                                                        </select>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Bank Name</label>
                                                        <input type="text" name="bank_name" class="form-control " placeholder=" Enter bank Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label class="control-label">ACCount Number</label>
                                                        <input type="number" name="acc_number" class="form-control" placeholder=" Enter Account Number">
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
                                                        <label>Upload Cancel cheque</label>
                                                        <input type="file" name="cancel_cheque" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Registration Type</label>
                                                        <select class="form-control" name="register_type" id="register_type" required>
                                                            <option value="">Select registration Type</option>
                                                            <option value="Registered">Registered</option>
                                                            <option value="Unregistered">Unregistered</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>GST Number</label>
                                                    <div class="form-group">
                                                        <input type="text" name="gst_number" data-parsley-error-message="Please Enter Aadhar card Number" maxlength="15" title="Please Enter GST Number" class="form-control required_gst" placeholder=" Enter GST Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" name="credit_days" class="form-control" placeholder=" Enter Credit Day" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Address Proof</label>
                                                        <input type="file" name="address_proof" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Pan card</label>
                                                        <input type="file" name="pan_card_proof" class="form-control " required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 hide_gst_certificate" style="display:none;">
                                                    <div class="form-group">
                                                        <label>Gst Certificate</label>
                                                        <input type="file" name="gst_proof" class="form-control" required>
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
                                                    <input type="text" name="origin[]" data-id="1001" class="form-control" placeholder="Enter origin">
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Destination</label>
                                                    <input type="text" class="form-control" name="destination[]" data-id="1001" placeholder="Enter Destination">
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label class="control-label">Vehicle Type</label>
                                                    <input type="text" class="form-control" name="vehicle_type[]" data-id="1001" placeholder="Enter vehicle Type">
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
                <?php $this->load->view('admin/admin_shared/admin_footer'); ?>
                <!-- Content END-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    $(document).ready(function() {

                        $(".pan").change(function() {
                            var inputvalues = $(this).val();
                            var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
                            if (!regex.test(inputvalues)) {
                                $(".pan").val("");

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid...',
                                    text: 'Invalid PAN Number',
                                    showConfirmButton: true
                                }).then(function() {
                                    window.location.reload();
                                });
                                return regex.test(inputvalues);
                            }
                        });

                        $("#register_type").change(function() {
                            var registered = $(this).val();


                            if (registered == 'Registered') {
                                $(".required_gst").attr("required", "true");
                                $(".hide_gst_certificate").show();
                            } else {
                                $(".hide_gst_certificate").hide();
                            }


                        });

                        $('#pincode').on('blur', function() {
                            var pincode = $(this).val();
                            if (pincode != null || pincode != '') {

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>Admin_TraficManager/getCityList',
                                    data: 'pincode=' + pincode,
                                    dataType: "json",
                                    success: function(data) {
                                        $('#city').val(data.city);
                                        $('#city_id').val(data.id);
                                    }
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>Admin_TraficManager/getState',
                                    data: 'pincode=' + pincode,
                                    dataType: "json",
                                    success: function(data) {
                                        $('#state').val(data.state);
                                        $('#state_id').val(data.id);
                                    }
                                });
                            }
                        });


                        var cnt = 1;
                        $('#add_data').click(function() {
                            var $html = '<div class="row" id="RANDOM_NO_' + cnt + '" data-id="#RANDOM_NO#"><div class="form-group col-sm-3">\
                                            <input type="text" name="origin[]" data-id="#RANDOM_NO#" class="form-control" placeholder="Enter origin">\
                                        </div>\
                                        <div class="form-group col-sm-3">\
                                            <input type="text" class="form-control"name="destination[]"  data-id="1001"placeholder="Enter Destination">\
                                        </div>\
                                        <div class="form-group col-sm-3">\
                                            <input type="text" class="form-control"name="vehicle_type[]"  data-id="1001"placeholder="Enter Vehicle type">\
                                        </div>\
                                        <div class="form-group col-sm-3 mt-4"><button type="button" class="btn btn-danger removebutton" id="remove_row" onClick="remove_row123(' + cnt + ')">Delete</button></div></div>'





                            // let time_stamp = Date.now();
                            // let new_html = '';
                            // new_html = $html.replace('#RANDOM_NO#', time_stamp);
                            // new_html = new_html.replace('#RANDOM_NO#', time_stamp);
                            // new_html = new_html.replace('#RANDOM_NO#', time_stamp);
                            // new_html = new_html.replace('#RANDOM_NO#', time_stamp);
                            // new_html = new_html.replace('#RANDOM_NO#', time_stamp);

                            $('#show_column').append($html);
                            cnt++;

                        });


                        // $(document).on('click', '#remove_row', function () {

                        //    $(this).parents('#remove_row').remove();
                        //     return false;
                        // });


                    });

                    function remove_row123(cnt1) {
                        $("#RANDOM_NO_" + cnt1).remove();
                    }
                </script>