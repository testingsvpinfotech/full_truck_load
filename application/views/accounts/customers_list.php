<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
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
                                <table class="table layout-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cid</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">address</th>
                                            <th scope="col">GST No</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($custlist)): foreach ($custlist as $value): ?>
                                        <tr>
                                            <td><?= $value->cid; ?></td>
                                            <td><?= $value->customer_name; ?></td>
                                            <td><?= $value->contact_person; ?></td>
                                            <td><?= $value->email; ?></td>
                                            <td><?= $value->phone; ?></td>
                                            <td><?= $value->address; ?></td>
                                            <td><?= $value->gstno; ?></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <div class="box-footer float-right clearfix">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>



