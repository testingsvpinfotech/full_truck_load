<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                        </div>
                    </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table layout-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Particulars</th>
                                            <th scope="col">Voucher Type</th>
                                            <th scope="col">Voucher No</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">Debit</th>
                                            <th scope="col">Credit</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if(!empty($voucher)): foreach ($voucher as $value): ?>
                                           <tr>
                                              <td><?= ($value->voucher_date == '0000-00-00')?"": date('d-m-Y',strtotime($value->voucher_date)); ?></td>
                                              <td><?= $value->name; ?></td>
                                              <td><?= $value->voucher_type; ?></td>
                                              <td><?= $value->voucher_no; ?></td>
                                              <td><?= $value->state; ?></td>
                                              <td><?= $value->branch_name; ?></td>
                                              <?php if($value->voucher_type == 'Purchase'){ ?>
                                                <td><?= $value->total_amount; ?></td>
                                                <td></td>
                                              <?php }else if($value->voucher_type == 'Sale'){ ?>
                                                  <td></td>
                                                  <td><?= $value->total_amount; ?></td>           
                                              <?php  } ?>
                                              <td></td>
                                           </tr>
                                      <?php endforeach; else: ?>
                                        <tr>
                                          <td colspan="8" class="text-center"><p>No Records Found</p></td>
                                        </tr>
                                      <?php endif; ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <div class="box-footer float-right clearfix">
                            <?php //echo $this->pagination->create_links(); ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>



