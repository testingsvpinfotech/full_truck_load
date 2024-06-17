<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12 align-self-center">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <button class="btn btn-sm btn-primary" onclick="openexpSubGrpModal()"> Add New</button>
                            <div class="box-tools mt-2">
                            <form action="<?php echo base_url() ?>expense_subgrp_master" method="POST" id="searchList">
                                <div class="input-group">
                                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                  <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    <a href="<?= base_url().'expense_subgrp_master'; ?>" class="btn btn-sm btn-danger"><i class="fa fa-sync"></i></a>
                                    
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
                                            <th scope="col">Group Name</th>
                                            <th scope="col">Sub Group Name</th>
                                            <th scope="col">Alias Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                        <?php if(!empty($expSubGrpData)): foreach ($expSubGrpData as $value): ?>
                                        <tr>
                                            <td><?= $value->group_name; ?></td>
                                            <td><?= $value->sub_name; ?></td>
                                            <td><?= $value->alias_name; ?></td>
                                            <td>
                                                <a onclick="openexpSubGrpModal(<?= $value->id; ?>)"><i class="fa fa-edit"></i></a>
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
