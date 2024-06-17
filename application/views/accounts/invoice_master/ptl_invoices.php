<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <div class="box-tools">
                        <form action="<?php echo base_url() ?>accounts-customer" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                <a href="<?= base_url().'accounts-customer'; ?>" class="btn btn-sm btn-default"><i class="fa fa-sync"></i></a>
                              </div>
                            </div>
                        </form>
                    </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr No</th>
                                            <th scope="col">Invoice Type</th>
                                              <th scope="col">Branch</th>
                                              <th scope="col">Invoice No</th>
                                              <th scope="col">Invoice Date</th>
                                              <th scope="col">Invoice Amount</th>
                                              <th scope="col">Consignee Name</th>
                                              <th scope="col">CGST</th>
                                              <th scope="col">SGST</th>
                                              <th scope="col">IGST</th>
                                              <th scope="col">Total</th>
                                              <th scope="col">Grand Total</th>
                                              <th scope="col">Created By</th>
                                              <th scope="col">Status</th>
                                              <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($allpoddata)) { $cnt=0;
                                            foreach ($allpoddata as $value) { $cnt++; ?>
                                            <tr> 
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $value['payment_type']; ?></td>
                                                <td><?php echo $value['branch_name']; ?></td>
                                                <td><?php echo $value['invoice_no']; ?></td>
                                                <td><?php if($value['invoice_date']!=""){ echo date("d-m-Y",strtotime($value['invoice_date']) ); } ?></td>
                                                <td><?php echo $value['total_amount']; ?></td>
                                                <td><?php echo $value['consigner_name']; ?></td>
                                              
                                                <td><?php echo $value['cgst_amount']; ?></td>
                                                <td><?php echo $value['sgst_amount']; ?></td>
                                                <td><?php echo $value['igst_amount']; ?></td>
                                                <td><?php echo $value['total_amount']; ?></td>
                                                <td><?php echo $value['grand_total']; ?></td>
                                                <td><?php echo $value['created_by']; ?></td>
                                                <td><?php if($value['payment_type'] == 'CASH' || $value['payment_type'] == 'TOPAY'){ ?>
                                                    <span class="btn btn-sm btn-success">PAID</span>
                                                  <?php }else{ ?>
                                                    <span class="btn btn-sm btn-danger">UNPAID</span>
                                                  <?php  } ?>
                                                </td>
                                                
                                                <td>
                                                  <a title="View" href="<?php base_url();?>courier-service-ptl-view/<?php echo $value['id'];?>" class=""><i class="icon-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php } } else {
                                        echo "<p>No Data Found</p>";
                                    }
                                    ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <!-- <div class="box-footer float-right clearfix"> -->
                            <?php //echo $this->pagination->create_links(); ?>
                        <!-- </div> -->
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>



