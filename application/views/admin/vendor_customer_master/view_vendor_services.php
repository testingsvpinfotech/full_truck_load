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
                                <h4 class="card-title">View Vendor Service</h4>
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
                                <div class="table-responsive">
                                    <table  class="display table  table-striped table-bordered" id="example">
                                    <thead>
                                        <tr>                                           
                                                <th scope="col">SR NO</th>
                                                <th scope="col">Origin</th>
                                                <th scope="col">Destination</th>
                                                <th scope="col">Vehicle Name</th>                                                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                    if (!empty($service)) {
                                              
                                        $cnt = 1; 
                                        foreach ($service as  $ct) {  ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $ct->origin; ?></td>
                                                <td><?php echo $ct->destiontion; ?></td>
                                                <td><?php echo $ct->vehicle_name; ?></td>                                           


                                                
                                            </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                    </table>
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
    <?php $this->load->view('admin/admin_shared/admin_footer');?>

   
</body>
<!-- END: Body-->