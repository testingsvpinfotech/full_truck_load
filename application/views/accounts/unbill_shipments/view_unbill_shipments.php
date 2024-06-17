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
                        <form action="<?php echo base_url() ?>unbill-shipments" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                <a href="<?= base_url().'unbill-shipments'; ?>" class="btn btn-sm btn-default"><i class="fa fa-sync"></i></a>
                              </div>
                            </div>
                        </form>
                    </div> <br>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th  scope="col">DOC No.</th>
                                            <th  scope="col">Sender</th>
                                            <th  scope="col">Receiver</th>
                                            <th  scope="col">Receiver City</th>
                                            <th  scope="col">Date</th>
                                            <th  scope="col">Mode</th>
                                            <th  scope="col">Payment</th>
                                            <th scope="col">Amount</th>			
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($vlist)): foreach ($vlist as $value): ?>
                                        <tr>
                                            <td><?= $value->pod_no; ?></td>
                                            <td><?= $value->sender_name; ?></td>
                                            <td><?= $value->reciever_name; ?></td>
                                            <td><?php if(!empty($value->reciever_city)){
                                            $whr = array('id'=>$value->reciever_city);
												$city_details = $this->basic_operation_m->get_table_row("city",$whr);
												echo $city_details->city; } ?></td>    </td>
                                            <td><?php echo date('d-m-Y',strtotime($value->booking_date));?></td>
                                            <td><?= $value->mode_name; ?></td>
                                            <td><?= $value->dispatch_details; ?></td>
                                            <td><?= $value->grand_total; ?></td>
                                           
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



