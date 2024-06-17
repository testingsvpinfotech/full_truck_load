<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invoice</title>
        <base href="<?php echo base_url(); ?>">
        <link rel="shortcut icon" href="assets/admin_assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 
        
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/flags-icon/css/flag-icon.min.css">
        <link rel="stylesheet"  href="assets/admin_assets/dist/vendors/chartjs/Chart.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/starrr/starrr.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="assets/admin_assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" href="assets/multiselect/bootstrap-multiselect.css" type="text/css">
        <link rel="stylesheet" href="assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
        <style type="text/css">
            .table:not(.table-dark) td, .table:not(.table-dark) th { padding-bottom: 0em!important; }
            .card .card-body { font-size: 12px; font-weight: bold; padding: 0px; }
            tr.border-bottom {  border-bottom: 1px solid black!important; }
            address{font-size: 12px; padding: 0px 5px;}
            .viewInoviceHeader th {  text-align: left; }
            .viewInoviceHeader td,.viewInoviceHeader th{ height: 25px; font-family: Arial, Helvetica, sans-serif; font-size:12px; }
            .viewInoviceHeader { width: 100%; border: 1px solid #000; margin-bottom: 0px; padding: 5px !important; }
            .left{ float:left; padding-top: 6px; padding-left: 25px; }
            .headingf{ margin:0 auto; text-align: center; }
            table.table.table-borderless { padding: 5px !important; margin-bottom: 0px !important; border:0px; }
            .nodata td, .nodata{ border:none; }
            table.table.table-borderless td { padding: 0px 10px; border: 0px !important; }
            .border-bottom{ border-bottom: 1px solid #000!important; border-radius: 0px; }
            tr.border-bottom td.extra-border { border-right: 1px solid #000 !important; }
            .card-body.table-responsive.new-design {
                padding: 15px 0px;
                margin-top: 20px;
                margin-bottom: 20px;
                border-radius: 0px;
                border-color: #000;
            }
            .table:not(.table-dark) td{ padding: 0em 10px; }
            .card .card-body { font-size: 12px; font-weight: normal;}         
            b, strong {  font-weight: bold;}
            table.table.table-borderless.border-1px { border: 1px solid #000; }
            .border-1px{border-bottom: 1px solid #000 !important; }
            tr.border-bottom.remove-extra-border { border-bottom: 0px !important; }
            .card-body.table-responsive.remove-bottom-border { border-bottom: 0px; }
            .card.redial-border-light.redial-shadow.border-full1.remove-top-bottom { border-top: 1px solid #000; border-bottom: 1px solid #000; }

            .border-top1px { border-top: 1px solid #000 !important; border-radius: 0px !important; }
            .table:not(.table-dark) thead th, .table:not(.table-dark) tfoot th, .table:not(.table-dark) td, .table:not(.table-dark) th{border-color:#000!important;}
            .fontm{font-family: arial; color: black;}
            .card { position: initial; display: inherit; display: initial; -ms-flex-direction: column; flex-direction: initial; min-width: inherit; word-wrap: initial; background-color: inherit; background-clip: initial; border: inherit; border-radius: initial; }
            p { margin-top: 0; margin-bottom: 0rem; }
            .table td, .table th { border-top: 0px solid #000; padding: 0px 5px; }
            .border-1px th { border-bottom: 0px solid #000; } 

            .table thead th { border-bottom: 0px solid #dee2e6; }
            .table, table{ border: 1px solid #000; margin:0px; }
            table tr{ border-bottom: 1px solid #000; } 
            img.logo-css { margin-top: 2px; margin-bottom: 2px; }
            .border-right { border-right: 1px solid #000000!important; }
            body { color: #000!important; font-size: 12px; font-family: Arial, sans-serif !important; }

            table.table.table-borderless tr { border: 0px; }
            .main-div { max-width: 1400px; margin: auto; background: #bfc0c113; padding:10px 0px; }
        </style>
    </head>
    <body onload="window.print()">
        
     <div class="main-div" style="margin-top: 4rem;">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card border-0 border-top1px">                      
                        <div class="card-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong style="font-size: 25px;"> <?php echo $company_details->company_name;?> </strong><br>
                                            <p style="width: 50%;" class="fontm"><?php echo $branch->address;?></p> 
                                            <p style="font-size: 14px;color: black;">  
                                            <b>Telephone:</b><?php echo $branch->phoneno;?><br>
                                            <b>E-Mail:</b><?php echo $branch->email;?><br>
                                            <b>GST No : </b> <?php echo $branch->gst_number; ?><br>
                                            <b>PAN No. : </b> <?php echo $branch->pan; ?><br>
                                        </td>
                                        <td><img class="logo-css" src="<?php echo base_url();?>./assets/company/<?php echo $company_details->logo; ?>" alt="" style="height: auto;width: 205px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card border-0">
                        <div class="card-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <strong style="font-size: 20px;" >TAX INVOICE</strong><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card border-0">
                        <div class="card-body table-responsive remove-bottom-border">
                            <table class="viewInoviceHeader">                      
                                <tbody>
                                    <tr>
                                        <td><address>To,<br>
                                            <b style="font-size:15px!important;"><?php echo $invoice->consigner_name; ?></b><br> <?php echo $invoice->consigner_address; ?><br><b> Gst No : </b> <?php echo !empty($invoice->consigner_gstno)?$invoice->consigner_gstno:'NA'; ?><br>
                                            <b>PLACE OF SUPPLY : </b><?php $whr_u =array('id'=>$booking->reciever_state);
                                            $state_details = $this->basic_operation_m->get_table_row('state', $whr_u);
                                            echo $state_details->state; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>State Code : </b><?php echo substr($state_details->statecode, 0, 2); ?>
                                            </address>
                                        </td>
                                        <td><address>
                                            <b>Invoice No:</b> <?php echo $invoice->invoice_no; ?><br>
                                            <b>Invoice Date:</b> <?php $invoiceDate = $invoice->invoice_date;
                                                if(!$invoiceDate){ $invoiceDate = date('Y-m-d'); }
                                                echo date('d-m-y', strtotime($invoiceDate)); ?><br></address>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card border-full1">
                        <div class="card-body border-right">
                            <table class="table">
                                <thead>
                                <?php   $sub_total = 0; $fuelSubCharges = 0; $cnt=0;
                                    $total_fov = 0; 
                                    $total_handling = 0;
                                    $total_pickup = 0;
                                    $total_detention = 0;
                                    $total_other = 0;
                                    if(!empty($allpoddata)) {
                                        foreach ($allpoddata as $value) { 
                                            $total_fov += $value['fov_charges'];;
                                            $total_handling += $value['transportation_charges'];
                                            $total_pickup += $value['pickup_charges'];
                                            $total_detention += $value['delivery_charges'];
                                            $total_other += $value['other_charges'];
                                    } } ?>
                                    <tr class="border-1px">                      
                                        <th>SR NO</th>
                                        <th class="text-center">DATE</th>
                                        <th class="text-center">AWB NO</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">FROM</th>
                                        <th class="text-center">TO</th>
                                        <th class="text-center">CHARGEABLE WEIGHT</th>
                                        <th class="text-center">PIECE</th>
                                        <th class="text-center">RATE PER KG</th>
                                        <th class="text-center">FRIGHT</th>
                                        <th class="text-center">FUEL CHARGE</th>
                                        <th class="text-center">DOCKET CHARGE</th>
                                        <?php if($total_handling != 0) { ?><th class="text-center">HANDLING CHARGE</th><?php } ?>
                                        <?php if($total_pickup != 0) { ?><th class="text-center">PICKUP CHARGE</th><?php } ?>
                                        <?php if($total_detention != 0) { ?><th class="text-center">DETENTION CHARGE</th><?php } ?>
                                        <?php if($total_fov != 0) { ?><th class="text-center">FOV CHARGE</th><?php } ?>
                                        <?php if($total_other != 0) { ?><th class="text-center">Other CHARGE</th><?php } ?>
                                        <th colspan="2" class="text-center">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 14px;color: black;">
                                <?php
                                    if(!empty($allpoddata)) {
                                        foreach ($allpoddata as $value) {  $cnt++;  ?>
                                    <tr class="border-bottom">
                                        <td class="text-center" style="width: 5%;"><?php echo $cnt;?></td>
                                        <td class="text-center" style="width: 10%;"><?php echo date('d-m-Y', strtotime($value['booking_date'])); ?></td>
                                        <td class="text-center"><?php echo $value['pod_no']; ?></td>
                                        <td>Courier Services</td>
                                        <?php   $whr_c1 =array('pod_no'=>$value['pod_no']);
                                            $cust_details1 = $this->basic_operation_m->get_table_row('tbl_domestic_booking', $whr_c1);
                                            $whr_c2 =array('id'=>$cust_details1->sender_city);
                                            $cust_details2 = $this->basic_operation_m->get_table_row('city', $whr_c2); ?>
                                        <td class="text-center"><?php echo $cust_details2->city; ?></td>
                                        <td class="text-center"><?php $rec_city = $this->db->get_where('city', ['id' => $value['reciever_city']])->row('city');
                                            echo $rec_city; ?></td>
                                        <td class="text-center"><?php echo $value['chargable_weight']; ?></td>
                                        <td class="text-center"><?php echo $value['no_of_pack']; ?></td>
                                        <td class="text-center"><?= $cust_details1->frieht; ?></td>
                                        <td class="text-center"><?php  if($value['frieht']!="" && $value['frieht']!="0"){  echo number_format((float)$value['frieht'], 2, '.', ''); } ?>
                                        </td>
                                        <td class="text-center">
                                        <?php  if($value['fuel_subcharges']!="" && $value['fuel_subcharges']!="0"){
                                            echo number_format((float)$value['fuel_subcharges'], 2, '.', ''); }  ?>
                                        </td>
                                        <td class="text-center"><?php echo $value['awb_charges']; ?></td>
                                        
                                        <?php if($total_handling != 0) { ?><td class="text-center"><?php echo $value['transportation_charges']; ?></td><?php } ?>
                                        <?php if($total_pickup != 0) { ?><td class="text-center"><?php echo $value['pickup_charges']; ?></td><?php } ?>
                                        <?php if($total_detention != 0) { ?><td class="text-center"><?php echo $value['delivery_charges']; ?></td><?php } ?>
                                        <?php if($total_fov != 0) { ?><td class="text-center"><?php echo $value['fov_charges']; ?></td><?php } ?>
                                        <?php if($total_other != 0) { ?><td class="text-center"><?php echo $value['other_charges']; ?></td><?php } ?>

                                        <td class="text-center"><?php echo $value['amount']; ?></td>
                                        <td colspan="2" class="text-right">                                        
                                            <table  class="table table-borderless">                  
                                            <?php  
                                                
                                                $sub_total = $sub_total + $value['sub_total']; $totalpods = count($allpoddata);
                                                if($cnt >= $totalpods) {
                                                    $totalblankrows = 4;
                                                    for($i = 0; $i<=$totalblankrows; $i++){ ?>
                                                    <tr class="nodata"><td colspan="20">&nbsp;</td></tr>
                                            <?php } } ?>
                                            </table>
                                        </td>
                                    </tr>
                            <?php }  } ?>
                                    <tr class="border-bottom">
                                        <td colspan="8" class="extra-border">
                                            <b>BANK DETAILS: </b><br>
                                            <b> A/C NAME :</b> <?php echo $invoice->account_name; ?><br>
                                            <b>BRANCH :</b>  <?php echo $invoice->bank_name; ?>,<?php echo $invoice->branch_name; ?><br>
                                            <b>A/C NO : </b> <?php echo $invoice->account_number; ?><br>
                                            <b>IFSC : </b> <?php echo $invoice->ifsc; ?><br>
                                        </td>
                                        <td colspan="1" class="extra-border text-right">
                                            <b>Sub Total</b></br>
                                            <b>CGST <?php echo $invoice->cgst_per; ?>%</b></br>
                                            <b>SGST <?php echo $invoice->sgst_per; ?>%</b></br>
                                            <b>IGST&nbsp;<?php echo $invoice->igst_per; ?>%</b></br>
                                            <b>Grand Total<br>(Rounded Off)</b></br>
                                        </td>
                                        <td class="text-right" >
                                            <?php echo round($sub_total,2); ?></br>
                                            <?php echo $invoice->cgst_amount; ?></br>
                                            <?php echo $invoice->sgst_amount;?></br>
                                            <?php echo $invoice->igst_amount;?></br>
                                            <?php $tototal_amount =$invoice->grand_total; ?>
                                            <?php echo round($tototal_amount, 0).".00"; ?></b>
                                        </td>
                                    </tr>
                                    <tr class="termcond">
                                        <td colspan="13"><b>Amount in Words:    </b><?php echo ucwords(displaywords(round($tototal_amount, 0))); ?></td>
                                    </tr>
                                    <tr class="termcond">
                                        <td colspan="13" ><b>HSN CODE : 996812</b></td>
                                    </tr>
                                    <tr class="termcond">
                                        <td colspan="13" >Tax Amount ( in words ) : <b><?php 
                                         if($invoice->igst_amount == '0.00'){
                                            $sum_gst = $invoice->cgst_amount + $invoice->sgst_amount;
                                         }else{
                                            $sum_gst = $invoice->igst_amount;
                                         }

                                       echo ucwords(displaywords(round($sum_gst, 0))); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 ">
                    <div class="card redial-border-light redial-shadow border-full1 remove-top-bottom ">
                        <div class="card-body">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr class="border-bottom remove-extra-border">
                                        <td colspan='3' class="extra-border"><?php echo $company_details->invoice_term_condition; ?></td>
                                        <td style="text-align:center">For <?php echo $company_details->company_name; ?><br>
                                            <img src="assets/company/<?php echo $company_details->stamp; ?>" width="100" height="100"></br>Authorized Sign
                                        </td>
                                    </tr>
                                </thead>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>