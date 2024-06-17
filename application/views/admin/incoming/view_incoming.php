     <?php $this->load->view('admin/admin_shared/admin_header'); ?>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        
        <!-- END: Main Menu-->
    <?php $this->load->view('admin/admin_shared/admin_sidebar');
   // include('admin_shared/admin_sidebar.php'); ?>
        <!-- END: Main Menu-->
    
        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Listing-->
                <div class="row">                 
                  <div class="col-12  align-self-center">
                      <div class="col-12 col-sm-12 mt-3">
                      <div class="card">
                          <div class="card-header justify-content-between align-items-center">
                              <h4 class="card-title">Incoming</h4>  
 <span style="float: right;"><a href="admin/add-incoming" class="fa fa-plus btn btn-primary">Add Incoming</a></span>							  
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table layout-primary bordered">
                                      <thead>
                                          <tr>      
												 <th>ID</th>
										   <th>Menifiest Id</th>
										   <th>Source Branch</th>
										   <th>NOP</th>
										   <th>Recived</th>
										   <th>Missed</th>
										   <th>Total Weight</th>
										   <th>Date</th>
										   <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>  

                                         <?php 
				  if (!empty ($allinword))
				  {
					  $cnt = 1;
				  foreach ($allinword as  $value) {
				      
				       $podno=$value['pod_no'];
						      $res=$this->db->query("select count(pod_no) as total from tbl_domestic_tracking where pod_no='$podno' and status='delivered'");
							  $total=$res->row()->total;
							 // echo $total;
							  if($total==0)
							  {		
                  ?>  
				  <td><?php echo $cnt;?></td>
                  <td><?php echo $value['manifiest_id'];?></td>
                  <td><?php echo $value['source_branch'];?></td>
                  <td><?php echo $value['total_pcs'];?></td>
                  <td><?php echo $value['total_coming'];?></td>
                  <td><?php echo $value['total'] - $value['total_coming'];?></td>
                  <td><?php echo $value['total_weight'];?></td>
                   <td><?php echo $value['date_added'];?></td>
                   <td><a href="admin/add-incoming/<?php echo $value['manifiest_id'];?>"><i class="ion-edit" style="color:var(--primarycolor)"></i></a></td>
				</tr>
					<?php 
					$cnt++;
							  }
						}
                     }
                      else{
                        	echo "<p>No Data Found</p>";
                         }
						?>
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
    <!-- END: Content-->
    <!-- START: Footer-->
    <?php $this->load->view('admin/admin_shared/admin_footer');
     //include('admin_shared/admin_footer.php'); ?>
    <!-- START: Footer-->
</body>
<!-- END: Body-->

