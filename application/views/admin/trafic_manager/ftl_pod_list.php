<?php $this->load->view('admin/admin_shared/admin_header'); ?>
<!-- END Head-->

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
                                <h4 class="card-title">FTL POD List</h4>
                            </div>

                            <div class="col-md-6">
                            <?php if (!empty($this->session->flashdata('msg'))) { ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <?php echo $this->session->flashdata('msg'); ?>
                                </div>
                            <?php } ?>
                            </div>

                            <div class="card-body">

                                <div class="">
                                    <table class="table  table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Vendor ID</th>
                                                <th scope="col">FTL Request Id</th>
                                                <th scope="col">Exit Date</th>
                                                <th scope="col">Exit Time</th>
                                                <th scope="col">FTL POD Image</th>
                                                <th scope="col">Payment Confirmation</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (!empty($ftl_pod)) {
                                                // print_r($get_quotation_list);
                                                $cnt = 1;
                                                foreach ($ftl_pod as  $ct) {  ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <?php  $VID = $ct->vendor_id; $dd = $this->db->query("select * from vendor_customer_tbl where customer_id = '$VID'")->row_array();?>
                                                        <td><?php echo $dd['vendor_name']; ?></td>
                                                        <td><?php echo $ct->ftl_request_id; ?></td>
                                                        <td><?php echo $ct->exit_date; ?></td>
                                                        <td><?php echo $ct->exit_time; ?></td>
                                                        <td><a href="<?php echo base_url("assets/ftl_documents/ftl-pod/".$ct->after_reach_pod); ?>" download><img src="<?php echo base_url("assets/ftl_documents/ftl-pod/".$ct->after_reach_pod); ?>"  style="width:100px;height:auto;"></a></td>
                                                        <td><?php echo $ct->payment_confirm; ?></td>
                                                    </tr>
                                            <?php
                                                    $cnt++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php  echo $this->pagination->create_links(); ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END: Listing-->
        </div>
        <style>
        
            .fade:not(.show) {
                opacity: 0.80;
            }
        </style>

    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <?php $this->load->view('admin/admin_shared/admin_footer');
    //include('admin_shared/admin_footer.php'); 
    ?>
  