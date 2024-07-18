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
                                <h4 class="card-title">View Vendor Master</h4>
                            </div>
                            <div class="card-header">
                                <form role="form" action="admin/ftl-vendor-list" method="GET"
                                    enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-1">
                                            <label for="">Filter Name</label>
                                            <select class="form-control fillter" name="filter">
                                                <option selected disabled>Select Filter</option>
                                                <option value="Vcode" <?php echo (isset($filter) && $filter == 'Vcode') ? 'selected' : ''; ?>>Vcode</option>
                                                <option value="vendor_name" <?php echo (isset($filter) && $filter == 'vendor_name') ? 'selected' : ''; ?>>Vendor Name</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="">Filter Value</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo (isset($filter_value)) ? $filter_value : ''; ?>"
                                                name="filter_value" />
                                        </div>
                                        <div class="col-md-1">
                                            <label for="">Status</label>
                                            <select class="form-control fillter" name="user_id" id="user_id">
                                                <option value="ALL" <?php if(isset($_GET['user_id'])){ if($_GET['user_id']=='ALL'){echo 'selected';} } ?>>ALL</option>
                                                <option value="0" <?php if(isset($_GET['user_id'])){ if($_GET['user_id']=='0'){echo 'selected';} }?>>Pending</option>
                                                <option value="1" <?php if(isset($_GET['user_id'])){ if($_GET['user_id']=='1'){echo 'selected';} }?>>Approved</option>
                                                <option value="2" <?php if(isset($_GET['user_id'])){ if($_GET['user_id']=='2'){echo 'selected';} }?>>Rejected</option>

                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="">From Date</label>
                                            <input type="date" name="from_date"
                                                value="<?php echo (isset($from_date)) ? $from_date : ''; ?>"
                                                id="from_date" autocomplete="off" class="form-control">
                                        </div>

                                        <div class="col-sm-1">
                                            <label for="">To Date</label>
                                            <input type="date" name="to_date"
                                                value="<?php echo (isset($to_date)) ? $to_date : ''; ?>" id="to_date"
                                                autocomplete="off" class="form-control">
                                        </div>
                                        <div class="col-sm-2 mt-2">
                                            <br>
                                            <input type="submit" class="btn btn-primary btn-sm" name="submit"
                                                value="Search">
                                            <a href="admin/ftl-vendor-list" class="btn btn-danger btn-sm">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <?php if ($this->session->flashdata('notify') != '') { ?>
                                    <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-colored">
                                        <?php echo $this->session->flashdata('notify'); ?>
                                    </div>
                                    <?php unset($_SESSION['class']);
                                    unset($_SESSION['notify']);
                                } ?>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table  table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">SR NO</th>
                                                <th scope="col">Vcode</th>
                                                <th scope="col">Vendor Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Reference Person Name</th>
                                                <th scope="col">Mobile Number</th>
                                                <th scope="col">Alternate Phone Number</th>
                                                <th scope="col">Alternate Email </th>
                                                <th scope="col">Pincode</th>
                                                <th scope="col">City</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Service Provider</th>
                                                <th scope="col">Credit Days</th>
                                                <th scope="col">Register Date</th>
                                                <th scope="col">Register Type</th>
                                                <th scope="col">Pan Number</th>
                                                <th scope="col">Gst Number</th>
                                                <th scope="col">Bank Name</th>
                                                <th scope="col">Account Number</th>
                                                <th scope="col">IFSC Code</th>
                                                <th scope="col">Pan Card Proof</th>
                                                <th scope="col">Cancel Cheque</th>
                                                <th scope="col">Address Proof</th>
                                                <th scope="col">Gst Proof</th>
                                                <th scope="col">Service</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($ftl_customer_vendor)) {

                                                $cnt = 1;
                                                foreach ($ftl_customer_vendor as $ct) { ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $ct->vid; ?></td>
                                                        <td><?php echo $ct->vendor_name; ?></td>
                                                        <td><?php echo $ct->email; ?></td>
                                                        <td><?php echo $ct->reference_person_name; ?></td>
                                                        <td><?php echo $ct->mobile_no; ?></td>
                                                        <td><?php echo $ct->alternate_phone_number; ?></td>
                                                        <td><?php echo $ct->alternate_email; ?></td>
                                                        <td><?php echo $ct->pincode; ?></td>
                                                        <td><?php echo $ct->city ?></td>
                                                        <td><?php echo $ct->state ?></td>
                                                        <td><?php echo $ct->address; ?></td>
                                                        <td><?php if (!empty($ct->service_provider)) {
                                                            echo service_provider[$ct->service_provider];
                                                        } ?>
                                                        </td>
                                                        <td><?php echo $ct->credit_days; ?></td>
                                                        <td><?php echo $ct->register_date; ?></td>
                                                        <td><?php if (!empty($ct->register_type)) {
                                                            echo register_type[$ct->register_type];
                                                        } ?>
                                                        </td>
                                                        <td><?php echo $ct->pan_number; ?></td>
                                                        <td><?php echo $ct->gst_number; ?></td>
                                                        <td><?php echo $ct->bank_name; ?></td>
                                                        <td><?php echo $ct->acc_number; ?></td>
                                                        <td><?php echo $ct->ifsc_code; ?></td>
                                                        <td>
                                                            <?php if (!empty($ct->pan_card_proof)) {
                                                                $ext = explode('.', $ct->pan_card_proof);
                                                                if ($ext[1] == 'pdf') { ?>
                                                                    <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $ct->pan_card_proof); ?>"
                                                                        target="_blank"><i class="fa fa-link" aria-hidden="true"> View
                                                                            GST PDF</i></a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->pan_card_proof; ?>"
                                                                        src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->pan_card_proof; ?>"
                                                                        title="<?php echo $ct->pan_card_proof; ?>"
                                                                        onclick="show_image(this);return false;"
                                                                        style="color:blue;">View-Image</a>
                                                                    <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                        | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->pan_card_proof; ?>"
                                                                            download>Download</a>
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <span style="color:red">Data Not Found</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($ct->cancel_cheque)) {
                                                                $ext = explode('.', $ct->cancel_cheque);
                                                                if ($ext[1] == 'pdf') { ?>
                                                                    <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $ct->cancel_cheque); ?>"
                                                                        target="_blank"><i class="fa fa-link" aria-hidden="true"> View
                                                                            GST PDF</i></a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->cancel_cheque; ?>"
                                                                        src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->cancel_cheque; ?>"
                                                                        title="<?php echo $ct->cancel_cheque; ?>"
                                                                        onclick="show_image(this);return false;"
                                                                        style="color:blue;">View-Image</a>
                                                                    <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                        | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->cancel_cheque; ?>"
                                                                            download>Download</a>
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <span style="color:red">Data Not Found</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($ct->address_proof)) {
                                                                $ext = explode('.', $ct->address_proof);
                                                                if ($ext[1] == 'pdf') { ?>
                                                                    <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $ct->address_proof); ?>"
                                                                        target="_blank"><i class="fa fa-link" aria-hidden="true"> View
                                                                            GST PDF</i></a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->address_proof; ?>"
                                                                        src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->address_proof; ?>"
                                                                        title="<?php echo $ct->address_proof; ?>"
                                                                        onclick="show_image(this);return false;"
                                                                        style="color:blue;">View-Image</a>
                                                                    <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                        | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->address_proof; ?>"
                                                                            download>Download</a>
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <span style="color:red">Data Not Found</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($ct->gst_proof)) {
                                                                $ext = explode('.', $ct->gst_proof);
                                                                if ($ext[1] == 'pdf') { ?>
                                                                    <a href="<?= base_url('assets/ftl_documents/vendor_register_doc/' . $ct->gst_proof); ?>"
                                                                        target="_blank"><i class="fa fa-link" aria-hidden="true"> View
                                                                            GST PDF</i></a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->gst_proof; ?>"
                                                                        src="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->gst_proof; ?>"
                                                                        title="<?php echo $ct->gst_proof; ?>"
                                                                        onclick="show_image(this);return false;"
                                                                        style="color:blue;">View-Image</a>
                                                                    <?php if ($_SESSION['userType'] == 7 || $_SESSION['userType'] == 1) { ?>
                                                                        | <a href="<?php echo base_url(); ?>/assets/ftl_documents/vendor_register_doc/<?php echo $ct->gst_proof; ?>"
                                                                            download>Download</a>
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <span style="color:red">Data Not Found</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('admin/vendor-service/' . $ct->customer_id); ?>"
                                                                target="_blank" style="color:blue;"> View
                                                                Service</i></a>
                                                        </td>
                                                        <td>

                                                            <?php if ($ct->status == '0') { ?>
                                                                <span style="color:chocolate;"> Pending </span>
                                                            <?php } elseif ($ct->status == '1') { ?>
                                                                <span style="color:green">Approved</span>
                                                            <?php } elseif ($ct->status == '2') { ?>
                                                                <span style="color:red">Rejected</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>


                                                            <?php
                                                            if (!empty($ct->customer_id) && $ct->customer_id != 0) {
                                                                if ($_SESSION['userType'] == '1' || $_SESSION['userType'] == '7') { ?>
                                                                    <a href="<?= base_url('admin/edit-vendor/' . $ct->customer_id); ?>"><i
                                                                            class="ion-edit"
                                                                            style="color:var(--primarycolor); font-size: medium;"></i></a>
                                                                    | &nbsp; <a href="javascript:void(0)"
                                                                        relid="<?php echo $ct->customer_id; ?>" title="Delete"
                                                                        class="deletedata"><i class="ion-trash-b"
                                                                            style="color:var(--danger)"></i></a>
                                                                <?php } else {
                                                                    echo '<span style="color:red;">No Access</span>';
                                                                }
                                                            } ?>
                                                            <?php
                                                            if (!empty($ct->customer_id) && $ct->customer_id != 0) {
                                                                if ($_SESSION['userType'] == '1') {
                                                                    if ($ct->status == '0') {
                                                                        ?>
                                                                        | &nbsp; <a href="javascript:void(0)"
                                                                            relid="<?php echo $ct->customer_id; ?>" title="Approve"
                                                                            class="approve_vendor"><img
                                                                                src="<?= base_url('assets/icons/approve.png'); ?>"
                                                                                style="width:15px; height:15px;" alt="Approve"></a>
                                                                        | &nbsp; <a href="javascript:void(0)"
                                                                            relid="<?php echo $ct->customer_id; ?>" title="Reject"
                                                                            class="reject_vendor"><img
                                                                                src="<?= base_url('assets/icons/rejected.png'); ?>"
                                                                                style="width:15px; height:15px;" alt="Reject"></a>
                                                                    <?php } elseif ($ct->status == '2') { ?>
                                                                        | &nbsp; <a href="javascript:void(0)"
                                                                            relid="<?php echo $ct->customer_id; ?>" title="Approve"
                                                                            class="approve_vendor"><img
                                                                                src="<?= base_url('assets/icons/approve.png'); ?>"
                                                                                style="width:15px; height:15px;" alt="Approve"></a>
                                                                    <?php } else { ?>
                                                                        | &nbsp; <a href="javascript:void(0)"
                                                                            relid="<?php echo $ct->customer_id; ?>" title="Reject"
                                                                            class="reject_vendor"><img
                                                                                src="<?= base_url('assets/icons/rejected.png'); ?>"
                                                                                style="width:15px; height:15px;" alt="Reject"></a>


                                                                    <?php }
                                                                }
                                                            } ?>


                                                        </td>



                                                    </tr>
                                                    <?php
                                                    $cnt++;
                                                }
                                            }else{ ?>
                                            <tr><td colspan="28" style="color: red;">NO DATA FOUND</td></tr>
                                       <?php     }
                                            ?>
                                        </tbody>
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


    <!--******************* Inactive Process *******************************-->



    <!-- END: Content-->
    <!-- START: Footer-->
    <?php $this->load->view('admin/admin_shared/admin_footer'); ?>


</body>
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

    $('.deletedata').click(function () {
        var getid = $(this).attr("relid");
        // alert(getid);
        var baseurl = '<?php echo base_url(); ?>'
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseurl + 'Admin_vendore_registration/delete_customer',
                    type: 'POST',
                    data: 'getid=' + getid,
                    dataType: 'json'
                })
                    .done(function (response) {
                        swal('Deleted!', response.message, response.status)

                            .then(function () {
                                location.reload();
                            })

                    })
                    .fail(function () {
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }

        })

    });

</script>
<!-- END: Body-->