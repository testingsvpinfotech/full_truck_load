<!DOCTYPE html>
<html>
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>Accounts | <?= $title; ?></title>
		<base href="<?php echo base_url(); ?>">
        <link rel="shortcut icon" href="assets/admin_assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 
		
        <!-- START: Template CSS-->
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/flags-icon/css/flag-icon.min.css">         
        <!-- END Template CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="assets/admin_assets/dist/vendors/chartjs/Chart.min.css">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/starrr/starrr.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="assets/admin_assets/dist/css/main.css">
         <!-- <link rel="stylesheet" href="assets/plugins/bootstrap-select/bootstrap-select.min.css"> -->
         <link rel="stylesheet" href="assets/multiselect/bootstrap-multiselect.css" type="text/css">
        <!-- END: Custom CSS-->


         <link rel="stylesheet" href="assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>

         <link  href="<?php echo base_url(); ?>assets/dist/css/select2.min.css" rel="stylesheet" />
        <style type="text/css">
            nav .pagination li{
                padding: 2px 8px;
                border: 1px solid #265283;
            }
            nav .pagination li.active{
                background: #265283;
            }
            nav .pagination li.arrow{
                background: #265283;
            }
            nav .pagination li.arrow a{
                color:#fff;
            }
            nav .pagination li a.active{
                color: #fff;
            }
            .error{
                color:red;
            }
            
        </style>
        <script>var baseURL = '<?= base_url(); ?>'; </script>
    </head>
    <!-- END Head-->

    <?php $this->load->view('accounts/template/sidebar'); ?>
    <?php $this->load->view($page); ?>

    <!-- DYNAMIC MODALS -->
    <div class="modal fade" id="masterModal" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal_title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal_content">
            
          </div>
         <!--  <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>

    <!-- LARGE MODAL -->
    <!-- DYNAMIC MODALS -->
    <div class="modal fade" id="masterModal_lg" tabindex="-1" role="dialog" aria-labelledby="modal_title_lg" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal_title_lg"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal_content_lg">
            
          </div>
         <!--  <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>

     <!-- START: Footer-->
        <footer class="site-footer">
<strong> <font color="red">contact us on email: Customercare@boxnfreight.com Phone: +91 98195 98197 </font></strong><br>
           <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://svpinfotech.com" target="_blank">Logistics Software SVP Infotech</a>.All rights
    reserved. </strong> <br>
  <!-- <div><marquee>
       For Logistics Software, Mobile Apps, Website Designing, Custom Software, eCommerce Website, MLM Software, College Admission Software Call 9022062666 Email: info@svpinfotech.com , svpinfotech@gmail.com Website : www.svpinfotech.com
   </marquee> </div>  -->
        </footer>
        <!-- END: Footer-->


        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->


        <!-- START: Template JS-->
        <script src="assets/admin_assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/moment/moment.js"></script>
        <script src="assets/admin_assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="assets/admin_assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/admin_assets/dist/js/jquery.validate.min.js"></script>

        
        <!-- END: Template JS-->

        <!-- START: APP JS-->
        <script src="<?= base_url(); ?>assets/admin_assets/dist/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page Vendor JS-->
        <script src="assets/admin_assets/dist/vendors/raphael/raphael.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/morris/morris.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/chartjs/Chart.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/starrr/starrr.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>        
        <script src="assets/admin_assets/dist/vendors/chartjs/Chart.min.js"></script>  
        <script src="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
        <script src="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
        <script src="assets/admin_assets/dist/vendors/apexcharts/apexcharts.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page JS-->
        <script src="assets/admin_assets/dist/js/home.script.js"></script>
        <!-- END: Page JS-->

         <!-- START: Page Vendor JS-->
        <script src="assets/admin_assets/dist/vendors/footable/js/footable.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->
        <script src="assets/admin_assets/dist/js/footable.script.js"></script>
        <!-- END: Page Script JS-->

        <script src="assets/dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="assets/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>

        <script src="assets/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="assets/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->        
        <script src="assets/dist/js/datatable.script.js"></script>
        <!--  <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script> -->
        <script type="text/javascript" src="assets/multiselect/bootstrap-multiselect.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/select2.min.js"></script>
        <script src="<?php echo base_url();?>snehal_asset/master.js"></script>
        <!-- END: Page Script JS-->