<main>
            <div class="container-fluid site-width">
                <!-- START: Listing-->
                <div class="row">                 
                  <div class="col-12  align-self-center">
                      <div class="col-12 col-sm-12">
                      <div class="card">
                          <div class="card-header justify-content-between align-items-center">   
							 <br><br>                            
                              <h4 class="card-title"><?= $title; ?></h4>
                          </div>

						  <div class="card-header">
                          <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-bordered" data-sorting="true">
                                      <thead>
                                          <tr>
										    <th  scope="col">lr.No.</th>
										    <th  scope="col">Sender Name</th>
										    <th  scope="col">Sender city</th>
										    <th  scope="col">Pincode</th>
										    <th  scope="col">Receiver Name</th>
										    <th  scope="col">Receiver Pincode</th>
										    <th  scope="col">Receiver City</th>
										    <th  scope="col">Order Number</th>
										    <th  scope="col">Vehicle Type</th>
										    <th  scope="col">Booking date</th>
											<th  scope="col">Product Name</th>
											<th  scope="col">Product Weight</th>
											<th  scope="col">Invoice No</th>
											<th  scope="col">Invoice Amount</th>
											<th  scope="col">Bill Type</th>
											<th>Action</th>
                                          </tr>
                                      </thead>
                                   <tbody>
                                          <?php if(!empty($ftl_list)){?>
                                           <?php foreach($ftl_list as $value):?>
                                           <tr>
                                             <td><?= $value->lr_number ;?></td>
                                             <td><?= $value->sender_name ;?></td>
                                             <td><?= $value->sender_city ;?></td>
                                             <td><?= $value->sender_pincode ;?></td>
                                             <td><?= $value->reciever_name ;?></td>
                                             <td><?= $value->reciever_pincode ;?></td>
                                             <td><?= $value->reciever_city ;?></td>
                                             <td><?= $value->order_number ;?></td>
                                             <?php $dd1 = $this->db->query("select vehicle_name from vehicle_type_master where id='".$value->type_of_vehicle."'")->row_array();?>
                                             <td><?= $dd1['vehicle_name'] ;?></td>
                                             <td><?= $value->booking_date ;?></td>
                                             <td><?= $value->product_name ;?></td>
                                             <td><?= $value->product_weight ;?></td>
                                             <td><?= $value->invoice_number ;?></td>
                                             <td><?= $value->invoice_value ;?></td>
                                             <td><?= $value->dispatch_details ;?></td>
                                             <td><a href="<?= base_url('courier-service-ftl-view/'.$value->lr_id);?>"><i class="fa fa-print" style="font-size:24px;color:blue;"></i></a></td>
                                            </tr>
                                           <?php endforeach;?>  
                                         <?php }else{ ?>
                                         <tr><td class="text-red text-center" colspan="20">No Data</td></tr>
                                         <?php } ?>
                                   </tbody>
                                 </table> 
                              </div>
                               
                          </div>
                        </div> 
                     </div>
                    </div>
                </div>
                <!-- END: Listing-->
            </div>
        </main>
        