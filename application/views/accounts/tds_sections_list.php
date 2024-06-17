<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12 align-self-center">
                <div class="offset-md-3 col-md-6 col-sm-12 mt-2">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <button class="btn btn-sm btn-primary" onclick="opentdsSectionModal()"> Add New</button>
                            <div class="box-tools mt-2">
                            <form action="<?php echo base_url() ?>tds-sections" method="POST" id="searchList">
                                <div class="input-group">
                                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                  <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    <a href="<?= base_url().'tds-sections'; ?>" class="btn btn-sm btn-danger"><i class="fa fa-sync"></i></a>
                                    
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
                                            <th scope="col">Section Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                        <?php if(!empty($secData)): foreach ($secData as $value): ?>
                                        <tr>
                                            <td><?= $value->section_name; ?></td>
                                            <td>
                                                <a onclick="opentdsSectionModal(<?= $value->sec_id; ?>)"><i class="fa fa-edit"></i></a>
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
