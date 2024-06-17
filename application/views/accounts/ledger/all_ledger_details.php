<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <div class="box-tools">
                            <form action="<?php echo base_url() ?>ledger-list" method="POST" id="searchList">
                                <div class="input-group">
                                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                  <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    <a href="<?= base_url().'ledger-list'; ?>" class="btn btn-sm btn-default"><i class="fa fa-sync"></i></a>
                                  </div>
                                </div>
                            </form>
                    </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table layout-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Under</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">Financial Year</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if(!empty($ledger_list)): foreach ($ledger_list as $value): ?>
                                           <tr>
                                               <td><?= ($value->date == '0000-00-00')?"": date('d-m-Y',strtotime($value->date)); ?></td>
                                               <td><?= $value->ledger_code; ?></td>
                                               <td><?= $value->name.'<br/>('.$value->alias.')'; ?></td>
                                               <td><?= $value->under_group; ?></td>
                                               <td><?= $value->branch_name; ?></td>
                                               <td><?= $value->fin_year; ?></td>
                                               <td><a href="<?= base_url().'view_ledger_voucher/'.$value->id ?>"><i class="fa fa-eye"></i></a></td>
                                           </tr>
                                       <?php endforeach; endif; ?>
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



