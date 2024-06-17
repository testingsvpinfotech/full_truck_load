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
                                <h4 class="card-title"> FTL Customer Rate List</h4>
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
                                    <table  class="display table  table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col">Id</th> -->
                                                <th scope="col">Customer name</th>
                                                <th scope="col">Vehicle name</th>
                                                <th scope="col">Origin</th>
                                                <th scope="col">Destination</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">From date</th>
                                                <th scope="col">To Date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                            <?php
                                            if (!empty($ftl_customer_rate)) {
                                              
                                                $cnt = 1; 
                                                foreach ($ftl_customer_rate as  $ct) {  ?>
                                                    <tr>
                                                    <?php $customer_id =  $ct->ftl_customer_id ; $dd1 = $this->db->query("select customer_name from tbl_customers where customer_id = '$customer_id'")->row_array(); ?>
                                                        <td><?php echo $dd1['customer_name']; ?></td>
                                                        <?php $vehicle_name =  $ct->vehicle_type ; $dd1 = $this->db->query("select vehicle_name from vehicle_type_master where id = '$vehicle_name'")->row_array(); ?>
                                                         <td><?php echo $dd1['vehicle_name']; ?> </td>
                                                        <td><?php echo $ct->origin; ?></td>
                                                        <td><?php echo $ct->destination; ?></td>
                                                        <td><?php echo $ct->rate; ?></td>
                                                        <td><?php echo $ct->from_date; ?></td>
                                                        <td><?php echo $ct->to_date; ?></td>
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
            <!-- END: Listing-->
        </div>
    </main>


    <div id="show_modal" class="modal fade" role="dialog" style="background: #000;">
            <div class="modal-dialog" style="margin-top: 137px;">
                <div class="modal-content">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <form action="<?php echo base_url(); ?>Admin_TraficManager/update_ftl_payment_data" method="post">

                        <div class="modal-body">
                            <?php $approved = 1; ?>
                            <h4 style="margin-top: 50px;text-align: center;">Approve Payment Status</h4>
                            <input type="text" name="ftl_request_id" id="ftl_request_id" class="form-control" value="">
                            <br><label>UTR No</label>
                            <input type="text"  name="utr_no" placeholder="Enter UTR No" class="form-control">
                            <br><br><label>Payment Date</label>
                            <input type="datetime-local"  name="payment_date" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success m-2">submit</button>
                </div>
                </form>
            </div>
        </div>










    <!-- END: Content-->
    <!-- START: Footer-->
    <?php $this->load->view('admin/admin_shared/admin_footer');?>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $('.approve_status').click(function() {
            var id = $(this).attr('relid'); //get the attribute value
            // alert(id);

            $.ajax({
                url: "<?php echo base_url(); ?>Admin_TraficManager/get_ftl_id",
                data: {
                    id: id
                },
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    //response =  JSON.parse(response1);
                    console.log(response.vendor_customer_id);
                    $('#ftl_request_id').val(response.ftl_request_id); //hold the response in id and show on popup
                    $('#show_modal').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                }
            });
        });
    </script>
   
   
</body>
<!-- END: Body-->