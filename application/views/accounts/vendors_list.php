<style type="text/css">
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                            <div class="box-tools">
                        <form action="<?php echo base_url() ?>accounts-vendor" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                <a href="<?= base_url().'accounts-vendor'; ?>" class="btn btn-sm btn-default"><i class="fa fa-sync"></i></a>
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
                                            <th scope="col">Code</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">address</th>
                                            <th scope="col">GST No</th>
                                            <th scope="col">PAN NO</th>
                                            <th scope="col">Registered On</th>
                                            <th scope="col">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($vlist)): foreach ($vlist as $value): ?>
                                        <tr>
                                            <td><?= $value->vcode; ?></td>
                                            <td><a href="<?= base_url().'single-vendor/'.$value->customer_id ?>"><?= $value->vendor_name; ?></a></td>
                                            <!-- <td><a href="javascript:void(0)" onclick="getVendorDetails(<?= $value->customer_id; ?>)"><?= $value->vendor_name; ?></a></td> -->
                                            <td><?= $value->email; ?></td>
                                            <td><?= $value->mobile_no; ?></td>
                                            <td><?= $value->address; ?></td>
                                            <td><?= $value->gst_number; ?></td>
                                            <td><?= $value->pan_number; ?></td>
                                            <td><?= $value->register_date; ?></td>
                                            <td>
                                                <label class="switch">
                                                  <input type="checkbox" <?= ($value->status == 1)?"checked":""; ?>checked disabled>
                                                  <span class="slider round"></span>
                                                </label>
                                            </td>
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



