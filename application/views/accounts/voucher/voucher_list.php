<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <div class="box-tools">
                        <form action="<?php echo base_url() ?>voucher-list" method="POST" id="searchList">
                            <div class="input-group">
                                <select name="fieldname" id="fieldname" class="form-control col-2">
                                    <option value="">Please select</option>
                                    <option value="voucher_no" <?= ($fieldname == 'voucher_no')?'selected':""; ?>>Voucher No</option>
                                    <option value="voucher_type" <?= ($fieldname == 'voucher_type')?'selected':""; ?>>Voucher Type</option>
                                    <option value="inv_no" <?= ($fieldname == 'inv_no')?'selected':""; ?>>Invoice No</option>
                                    <option value="name" <?= ($fieldname == 'name')?'selected':""; ?>>Party A/C Name</option>
                                    <option value="branch_name" <?= ($fieldname == 'branch_name')?'selected':""; ?>>Branch</option>
                                    <option value="total_amount" <?= ($fieldname == 'total_amount')?'selected':""; ?>>Amount</option>
                                </select>
                              <input type="text" name="searchResult" value="<?php echo $searchResult; ?>" class="form-control  col-2 input-sm pull-right" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                <a href="<?= base_url().'voucher-list'; ?>" class="btn btn-sm btn-default"><i class="fa fa-sync"></i></a>
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
                                            <th scope="col">Voucher No</th>            
                                            <th scope="col">Voucher type</th>
                                            <th scope="col">Invoice Number</th>
                                            <th scope="col">Party A/C Name</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">Opening Balance</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($vlist)): foreach($vlist as $v): ?>
                                        <tr>
                                            <td><?= date('d-m-Y', strtotime($v->voucher_date)); ?></td>
                                            <td><?= $v->voucher_no; ?></td>
                                            <td><?= $v->voucher_type; ?></td>
                                            <td><?= $v->inv_no; ?></td>
                                            <td><?= $v->name; ?></td>
                                            <td><?= $v->branch_name; ?></td>
                                            <td><?= $v->total_amount; ?></td>
                                            <td>
                                                <a href="<?= base_url().'voucher_details/'.$v->id; ?>"><i class="fa fa-eye"></i></a>
                                                <a href="<?= base_url().'voucher_print/'.$v->id; ?>"><i class="fa fa-print"></i></a>
                                            </td>
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



