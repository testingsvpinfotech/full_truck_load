<?php include (dirname(__FILE__) . '/../admin_shared/admin_header.php'); ?>

<style>
  .form-control {
    color: black !important;
    border: 1px solid var(--sidebarcolor) !important;
    height: 27px;
    font-size: 10px;
  }

  .fillter {
    height: 27px !important;
  }

  .select2-container--default .select2-selection--single {
    background: lavender !important;
  }

  form .error {
    color: #ff0000;
  }

  .compulsory_fields {
    color: #ff0000;
    font-weight: bolder;
  }

  .select2-container *:focus {
    border: 1px solid #3c8dbc !important;
    border-radius: 8px 8px !important;
    background: #ffff8f !important;
  }

  input:focus {
    background-color: #ffff8f !important;
  }

  select:focus {
    background-color: #ffff8f !important;
  }

  textarea:focus {
    background-color: #ffff8f !important;
  }

  .btn:focus {
    color: red;
    background-color: #ffff8f !important;
  }


  input,
  textarea {
    text-transform: uppercase;
  }

  ::-webkit-input-placeholder {
    /* WebKit browsers */
    text-transform: none;
  }

  :-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    text-transform: none;
  }

  ::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    text-transform: none;
  }

  :-ms-input-placeholder {
    /* Internet Explorer 10+ */
    text-transform: none;
  }

  ::placeholder {
    /* Recent browsers */
    text-transform: none;
  }
</style>
<!-- START: Body-->

<body id="main-container" class="default">

  <!-- END: Main Menu-->

  <?php include (dirname(__FILE__) . '/../admin_shared/admin_sidebar.php'); ?>
  <!-- END: Main Menu-->

  <!-- START: Main Content-->

  <style>
    span .fa {
      color: red;
      font-size: 8px;
      position: relative;
      top: -5px;
      /* margin-top: 16px; */
    }

    .form-control {
      height: 36px !important;
      font-size: 14px !important;
      border: 1px solid #000;
      border-radius: 0.2rem;
      -webkit-border-radius: 0.2rem;
      -moz-border-radius: 0.2rem;
      -ms-border-radius: 0.2rem;
      -o-border-radius: 0.2rem;
    }
  </style>
  <main>
    <div class="container-fluid site-width">


      <!-- START: Card Data-->
      <div class="row" style="margin-top: 100px;">
        <div class="col-12 col-md-12 mt-3">
          <div class="card p-4">
            <div class="card-body">



              <form action="<?php echo base_url('admin/update_ftl_request/'.$ftl['id']); ?>" enctype="multipart/form-data" method="POST">


                <div class="" style="margin-bottom:20px;color:#e95320;padding:10px;">
                  <h5 class="mb-0 text-uppercase font-weight-bold">Update Indent ( tripsheet )</h5>
                </div>


                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Order Date & Time</label>
                      <?php $date = date('Y-m-d H:i:s'); ?>
                      <?php // $customer_id = $this->session->userdata('customer_id');
                      //  $contract_customer =  $this->db->query("select * from tbl_customers where customer_id = '$customer_id'")->row();
                      ?>
                      <input type="text" name="order_date" id="current_date" value="<?php echo date('Y-m-d H:i:s',strtotime($ftl['order_date'])); ?>"
                        class="form-control" readonly>
                    </div>
                  </div>

                  <div class="form-group  col-md-2">
                    <div class="form-group">
                      <label class="control-label">request Date<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>                     
                      <input type="text" id="inputdate" name="date" class="form-control" value="<?php echo date('Y-m-d H:i:s',strtotime($ftl['request_date_time'])); ?>" readonly required>
                    </div>
                  </div>
                  <div class="form-group  col-md-2">
                    <div class="form-group">
                      <label class="control-label">request time<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <!-- <input type="datetime-local" name="request_date_time"  class="form-control" value="<?php echo set_value('request_date_time') ?>" required=""> -->
                      <input type="time" name="time" class="form-control" value="<?php echo date('H:i:s',strtotime($ftl['order_time'])); ?>" required>
                    </div>
                  </div>

                  <h6 class="" style="margin-top: 37px;">I am </h6>
                  <div class="form-group col-md-3"> <br><br>
                    <select name="customer_type" id="customer" class="form-control fillter"
                      style="margin-top: 26px;border: 1px solid rgb(255 255 255 / 80%) !IMPORTANT;" required>
                      <option value="">Select Customer Type</option>
                      <option value="1" <?php if($ftl['customer_type']=='1'){echo 'selected';} ?>>Consignor</option>
                      <option value="2" <?php if($ftl['customer_type']=='2'){echo 'selected';} ?>>Consignee</option>
                    </select>
                  </div>
                </div>
                <div class="row consignee_details" style="display:none">
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">Name <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" name="consignee_name" class="form-control" placeholder="Enter Name"
                        value="<?php echo $ftl['consignee_name']; ?>">
                    </div>
                  </div>
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">Address<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" name="consignee_address" placeholder="Enter Address" class="form-control"
                        value="<?php echo $ftl['consignee_address']; ?>">
                    </div>
                  </div>
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">ContactNo<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" name="consignee_contact_no" maxlength="10" minlength="10"
                        placeholder="Enter Contact Number" class="form-control manifest_driver_contact"
                        value="<?php echo $ftl['consignee_contact_no']; ?>">
                    </div>
                  </div>
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">Pincode<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" name="consignee_pincode" id="consignee_pincode" placeholder="Enter pincode"
                        maxlength="6" minlength="6" class="form-control manifest_driver_contact"
                        value="<?php echo $ftl['consignee_pincode']; ?>">
                    </div>
                  </div>
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">State<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label> <br>
                      <select class="form-control fillter" id="consignee_state" name="consignee_state"
                        style="width:100%;">
                        <option value="">Select State</option>
                        <?php

                        if (count($states)) {
                          foreach ($states as $st) {
                            ?>
                            <option value="<?php echo $st['id']; ?>" <?php if($st['id']==$ftl['consignee_state']){echo 'selected';}  ?>  >
                              <?php echo $st['state']; ?>
                            </option>
                          <?php }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">City<span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label><br>
                      <select class="form-control fillter" id="consignee_city" name="consignee_city"
                        style="width:100%;">
                        <option value="">Select City</option>
                        <?php
                        if (count($cities)) {
                          foreach ($cities as $c) { ?>
                            <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$ftl['consignee_city']){echo 'selected';}  ?>>
                              <?php echo $c['city']; ?>
                            </option>
                          <?php }
                        } ?>
                      </select>
                    </div>
                  </div>

                </div>

             
                <div class="row consignor_details" style="display:none">
                  <div class="form-group  col-md-4">
                    <div class="form-group">
                      <label class="control-label">Customer <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <select name="customer_id" id="customer_id" class="form-control fillter" style="width:100%;">
                        <option value="">Select Customer</option>
                        <?php foreach ($customer as $v) { ?>
                          <option value="<?= $v->customer_id; ?>" <?php if($ftl['customer_id'] !=0){
                            if($v->customer_id==$ftl['customer_id']){echo 'selected';}
                          } ?> ><?= $v->customer_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                  <h6 class="mb-0 text-uppercase font-weight-bold">Pickup And Delivery Details</h6>
                </div>

                <div class="row">
                  <div class="form-group col-md-4 required">
                    <div class="form-group">
                      <label class="control-label">Origin Pincode <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" name="origin_pincode" id="origin_pincode" maxlength="6" minlength="6"
                        class="form-control" value="<?php echo $ftl['origin_pincode']; ?>"
                        placeholder="Enter Pincode"  required="">
                    </div>
                  </div>
                  <div class="form-group col-md-4 required">
                    <div class="form-group">
                      <label class="control-label">Origin state <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <select class="form-control fillter" id="origin_state_id" name="origin_state">
                        <option value="">Select State</option>
                        <?php

                        if (count($states)) {
                          foreach ($states as $st) {
                            ?>
                            <option value="<?php echo $st['id']; ?>" <?php if($st['id']==$ftl['origin_state']){echo 'selected';}  ?>>
                              <?php echo $st['state']; ?>
                            </option>
                          <?php }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Origin City <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <select class="form-control fillter" id="origin_city_id" name="origin_city">
                        <option value="">Select City</option>
                        <?php
                        if (count($cities)) {
                          foreach ($cities as $c) { ?>
                            <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$ftl['origin_city']){echo 'selected';}  ?>>
                              <?php echo $c['city']; ?>
                            </option>
                          <?php }
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-md-4 required">
                    <div class="form-group">
                      <label class="control-label">Destination Pincode <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <input type="text" id="destination_pincode" name="destination_pincode"
                        class="form-control manifest_driver_contact" maxlength="6" minlength="6"
                        value="<?php echo $ftl['destination_pincode']; ?>" placeholder="Enter Pincode" required="">
                    </div>
                  </div>
                  <div class="form-group col-md-4 required">
                    <div class="form-group">
                      <label class="control-label">Destination state <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <select class="form-control fillter" id="destination_state_id" name="destination_state">
                        <option value="">Select State</option>
                        <?php

                        if (count($states)) {
                          foreach ($states as $st) {
                            ?>
                            <option value="<?php echo $st['id']; ?>" <?php if($st['id']==$ftl['destination_state']){echo 'selected';}  ?>>
                              <?php echo $st['state']; ?>
                            </option>
                          <?php }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Destination City <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></span></label>
                      <select class="form-control fillter" id="destination_city" name="destination_city">
                        <option value="">Select City</option>
                        <?php
                        if (count($cities)) {
                          foreach ($cities as $c) { ?>
                            <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$ftl['destination_city']){echo 'selected';}  ?>>
                              <?php echo $c['city']; ?>
                            </option>
                          <?php }
                        } ?>
                      </select>
                      <input type="hidden" name="destination_city_id" id="destination_city_id" value=""
                        class="form-control destination_city_id" required readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <hr>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label">Pickup Address <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <textarea class="form-control" name="pickup_address" placeholder="Enter Pickup Location"><?= $ftl['pickup_address'] ?></textarea>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="control-label">Delivery Address <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <textarea class="form-control" name="delivery_address"
                      placeholder="Enter Delivery Location"><?= $ftl['delivery_address'] ?></textarea>
                  </div>
                </div>


                <div class="" style="margin-bottom:20px; background-color:#1e3d5d;color:#fff;padding:10px;">
                  <h6 class="mb-0 text-uppercase font-weight-bold">Vehicle Details</h6>
                </div>


                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group ">
                      <label class="control-label">Type Of vehicle <span style="color:red;"><i class="fa fa-star"
                            aria-hidden="true"></i></label>
                      <select class="form-control get_vehical_type fillter" id="vehicle_id" name="type_of_vehicle"
                        required>
                        <?php if (!empty($vehicle_type)) { ?>
                          <option>Select Vehicle Name</option>
                          <?php foreach ($vehicle_type as $value): ?>
                            <option value="<?php echo $value->id; ?>"<?php if($ftl['type_of_vehicle']==$value->id){echo 'selected';} ?>><?php echo $value->vehicle_name; ?> </option>
                          <?php endforeach; ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Vehicle wheel Type</label>
                    <select name="vehicle_wheel_type" class="form-control fillter">
                      <option value="">Select wheeel Type</option>
                      <?php foreach (vehicle_wheel_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['vehicle_wheel_type']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Vehicle Capacity</label>
                    <input type="text" class="form-control" name="vehicle_capacity" id="vehicle_capicty"
                      placeholder="Vehicle Capacity" value="<?= $ftl['vehicle_capacity'] ?>" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Vehicle body Type</label>
                    <input type="text" class="form-control" name="vehicle_body_type" id="vehicle_body_type"
                      placeholder="Vehicle body Type" value="<?= $ftl['vehicle_body_type'] ?>" required>

                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Floor Type</label>
                    <select name="vehicle_floor_type" class="form-control fillter">
                      <option value="">Select Floor Type</option>
                      <?php foreach (vehicle_floor_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['vehicle_floor_type']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label">GPS</label>
                    <select name="vehicle_gps" class="form-control fillter">
                      <option value="">Select GPS</option>
                      <option value="1"<?php if(1==$ftl['vehicle_gps']){echo 'selected';} ?>>Yes</option>
                      <option value="0"<?php if(0==$ftl['vehicle_gps']){echo 'selected';} ?>>No</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Goods Type <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <select class="form-control fillter" name="goods_type" id="goods_type" required>
                      <option value="">Select Goods Type</option>
                      <?php if (!empty($goods_name)) { ?>
                        <?php foreach ($goods_name as $value): ?>
                          <option value="<?php echo $value->id; ?>" <?php if($value->id==$ftl['goods_type']){echo 'selected';} ?>><?php echo $value->goods_name; ?></option>
                        <?php endforeach; ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label>Type Of Parcel<span class="compulsory_fields">*</span></label>
                    <select class="form-control fillter" name="type_parcel">
                      <option value="">-Select-</option>
                      <?php foreach (parcel_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['type_parcel']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>

                    </select>
                  </div>



                  <div class="form-group col-md-3">
                    <label class="control-label">Goods Weight <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <input type="text" class="form-control billing_amount" name="goods_weight" id="goods_weight"
                      placeholder="Enter Goods Weight" value="<?= $ftl['goods_weight'];?>" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label">Weight Type <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <select class="form-control fillter" name="weight_type" id="weight_type" required>
                      <option value="">Select Weight Type</option>
                      <?php foreach (weight_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['weight_type']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label">Goods Value<span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <input type="text" class="form-control billing_amount" name="goods_value" id="goods_value"
                      placeholder="Enter Goods Value" value="<?= $ftl['goods_value'];?>" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Target price <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <input type="text" name="amount" id="target_rate" class="form-control target_rate billing_amount"
                       placeholder="Enter Amount" value="<?= $ftl['amount'];?>" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Contact No </label>
                    <input type="text" name="contact_number" value="<?= $ftl['contact_number'];?>"
                      maxlength="10" minlength="10" class="form-control manifest_driver_contact" 
                      title="please check Contact Number" placeholder="Enter Contact Number" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label"> <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span>Select Loading</label>
                    <select class="form-control fillter" name="loading_type" id="loading_type" required>
                      <option value="">Select Loading</option>
                      <?php foreach (loading_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['loading_type']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label"> <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span>Select Unloading</label>
                    <select class="form-control fillter" name="unloading_type" id="Unloading_type" required>
                      <option value="">Select Unloading</option>
                      <?php foreach (loading_type as $key => $value) { ?>
                        <option value="<?= $key; ?>" <?php if($key==$ftl['unloading_type']){echo 'selected';} ?>><?= $value; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <br><br>
                <hr>

                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="control-label">Delivery Contact No <span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <input type="text" name="delivery_contact_no" value="<?= $ftl['delivery_contact_no'];?>"
                      class="form-control manifest_driver_contact" maxlength="10" minlength="10"
                      placeholder="Enter Delivery Contact Number" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label">Delivery Contact Person Name <span style="color:red;"><i
                          class="fa fa-star" aria-hidden="true"></i></span></label>
                    <input type="text" name="delivery_contact_person_name"
                    value="<?= $ftl['delivery_contact_person_name'];?>" class="form-control"
                      placeholder="Enter delivery Contact Person Name" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label class="control-label">Insurance By<span style="color:red;"><i class="fa fa-star"
                          aria-hidden="true"></i></span></label>
                    <select class="form-control fillter" name="insurance_by" id="insurance_by" required>
                      <option value="">- Select -</option>
                      <option value="1"<?php if($ftl['insurance_by']==1){echo 'selected';} ?>>Client</option>
                      <option value="2" <?php if($ftl['insurance_by']==2){echo 'selected';} ?>>Carrier</option>
                    </select>
                  </div>
                  <?php if($ftl['insurance_by']==1){?>
                  <div class="form-group col-md-3" id="cfo_charges_data" style="display:block;">
                    <label class="control-label">CFO Charges </label>
                    <input type="text" name="cfo_charges" value="2%" class="form-control"
                      placeholder="Enter CFO Charges" readonly>
                  </div>
                 <?php } ?>
                  <div class="form-group col-md-3">
                    <label class="control-label">Special Instruction </label>
                    <textarea type="text" col="100" name="descrption" class="form-control"
                      placeholder="Special Instruction" row="10"><?= $ftl['descrption'];?></textarea>
                  </div>

                </div>
                <button type="submit" name="submit" class="btn  btn-lg btn-primary mt-2">Submit</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    </div>
    </div>

  </main>
  <!-- ******************************* loding Type vendor ************************************************** -->

  <div id="show_vendor_msg" class="modal fade" role="dialog" style="background: #000;">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Loading Charges would apply</h4>
        </div>
        <button class="btn btn-success confirmation_vendor m-2" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>


  <div id="show_vendor_confr" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Please click here for your consent</h4>
          <input type="checkbox" class="form-control">
        </div>
        <button class="btn btn-success m-2" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>


  <!-- ******************************* Unloding Type vendor ************************************************** -->


  <div id="show_Unload_vendor_msg" class="modal fade" role="dialog" style="background: #000;">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Unloading Charges would apply</h4>
        </div>
        <button class="btn btn-success confirmation_unload_vendor m-2" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>


  <div id="show_Unload_vendor_confr" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Please click here for your consent</h4>
          <input type="checkbox" class="form-control">
        </div>
        <button class="btn btn-success m-2" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>


  <!-- ******************************* Risk Type vendor ************************************************** -->

  <div id="risk" class="modal fade" role="dialog" style="background: #000;">
    <div class="modal-dialog" style="margin-top: 137px;">
      <div class="modal-content">
        <div class="modal-body">
          <h4 style="margin-top: 50px;text-align: center;">Additional Charges will apply</h4>
        </div>
        <button class="btn btn-success  m-2" id="show_cfo_charges" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>




  <style>
    input:read-only {
      background-color: #ddd;
    }

    .form-group {
      margin-bottom: 20px !important;
    }


    #map-canvas {
      /* margin-top:80%; */
      display: none;
      height: 100%;
      margin: 0;
      padding: 0
    }

    canvas[resize] {
      width: 100%;
      height: 100%;
    }

    .controls {
      margin-top: 16px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
      bacground-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 400px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    .pac-container {
      font-family: Roboto;
    }

    #type-selector {
      color: #fff;
      background-color: #4d90fe;
      padding: 5px 11px 0px 11px;
    }

    #type-selector label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }
  </style>

  </main>



  <?php include (dirname(__FILE__) . '/../admin_shared/admin_footer.php'); ?>
  <!-- START: Footer-->
</body>
<!-- END: Body-->
<script src="assets/js/domestic_shipment.js"></script>

<script>
   $('.fillter').select2();
    getConssignee();
</script>
<!-- // ******************************************** show consinee data***************************** -->


</html>