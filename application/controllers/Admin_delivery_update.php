<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_delivery_update extends CI_Controller {

	function __construct()
	{
		 parent:: __construct();
		 $this->load->model('basic_operation_m');
		 if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}
	
	public function index()
	{	 
        $data= array();
		$awb = $this->input->post('awb_no');
		$submit = $this->input->post('shipment');
	    if($submit=='Domestic'){ 
			$where = array('pod_no'=>$awb);
			$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking',$where);
		}else{
			$where = array('pod_no'=>$awb);
			$data['result'] = $this->basic_operation_m->get_all_result('tbl_international_booking',$where);
		}
		$data['all_status']= $this->basic_operation_m->get_all_result("tbl_status_delivery","");
        $this->load->view('admin/Admin_delivery_update/single_delivery_update',$data);       
	}
	
	public function single_delivery_status()
	{
	 	$all_data= $this->input->post();
		 date_default_timezone_set('Asia/Kolkata'); 
		 $track = date("Y-m-d H:i:s");
		
	  	if($all_data!=""){
            $tracking_date = date("Y-m-d H:i:s",strtotime($track));
			//print_r($tracking_date);die();
            $selected_dockets = $this->input->post('selected_dockets');
            $company_type = $this->input->post('company_type');
            $status = $this->input->post('status');
        	$comment = $this->input->post('comment');
        	$remarks = $this->input->post('remarks');
        
	        $is_delhivery_complete = 0;
		
			
			//echo "<pre>";print_r($selected_dockets);die();
			
			for($doc=0;$doc<count($selected_dockets);$doc++)
			{   
				$username=$this->session->userdata("userName");
				$whr = array('username'=>$username);
				$res=$this->basic_operation_m->getAll('tbl_users',$whr);
			    $branch_id= $res->row()->branch_id;
				$date=date('y-m-d');
				 
				$whr = array('branch_id'=>$branch_id);
				$res=$this->basic_operation_m->getAll('tbl_branch',$whr);
				$branch_name= $res->row()->branch_name;
				$pod_no=$this->input->post('pod_no');
				$status=$this->input->post('status');
				$comment = $this->input->post('comment');
				$remarks = $this->input->post('remark');
				$date=date('Y-m-d H:i:s');
				if($company_type=="Domestic")
				{
				    if($status == 'Delivered')
	    			{
	    				$is_delhivery_complete = 1;
	    				$where = array('booking_id' => $selected_dockets);
	    				$updateData = [
	    					'is_delhivery_complete' => $is_delhivery_complete,
	    				];
	    				$this->db->update('tbl_domestic_booking', $updateData, $where);

					$shipping_data = $this->db->get_where('tbl_domestic_booking', ['booking_id' => $selected_dockets])->row();
						// $arr = explode(' ', $shipping_data->reciever_name);
						// $arr_congr = explode(' ', $shipping_data[0]->sender_name);

						$fname = $shipping_data->reciever_name; $lname = "";
						$number = $shipping_data->reciever_contact;
						
						$fname_congr = $shipping_data->sender_name; $lname_congr = "";
						$number_congr = $shipping_data->sender_contactno;

						$pod_no1 = $shipping_data->pod_no;
						
						if(!empty($number)){
							$enmsg = "Hi $fname $lname, We have successfully delivered your Shipment $pod_no1 Regards, Team Box And Freight.";
							sendsms($number,$enmsg);
						}

						if(!empty($number_congr)){
							$enmsg1 = "Hi $fname_congr $lname_congr, We have successfully delivered your Shipment $pod_no1 Regards, Team Box And Freight.";
							sendsms($number_congr,$enmsg1);
						}
						
	    			}
					
					if($status == 'Picked')
	    			{
	    				$where = array('booking_id' => $selected_dockets);
	    				$updateData = ['pickup_pending' => 0];
	    				$this->db->update('tbl_domestic_booking', $updateData, $where);
	    			}
				    
				    $this->db->select('pod_no, booking_id, forworder_name, forwording_no, reciever_name, reciever_contact');
	    			$this->db->from('tbl_domestic_booking');
	    			$this->db->where('booking_id', $selected_dockets);
	    			$this->db->order_by('booking_id', 'DESC');
	    			$result = $this->db->get();
	    			$resultData = $result->row();
	               // echo $this->db->last_query();die();
					// print_r($resultData);die();
	    		    $pod_no = $resultData->pod_no;
	    			$forworder_name = $resultData->forworder_name;
	    			$forwording_no = $resultData->forwording_no;
				
				    $data = [
				        'pod_no'=>$pod_no,
				        'branch_name'=>$branch_name,
				        'booking_id'=>$selected_dockets,
				        'forworder_name'=>$forworder_name,
				        'forwording_no'=>$forwording_no,
						'tracking_date' => $tracking_date,
						'status' => $status,
						'comment' => $comment,
						'remarks' => $remarks,
						'is_delhivery_complete' => $is_delhivery_complete,
					];
					// echo "<pre>";
					// print_r($data);
					// exit;
					if($this->db->insert('tbl_domestic_tracking', $data)){
						if($this->input->post('status') == 'Undelivered'){
							
							$fname = $resultData->reciever_name; $lname = "";
							$number2 = $resultData->reciever_contact;
							$no = '9819598197';
							$enmsg = "Hi $fname $lname, it looks like we missed you. We attempted to deliver your shipment $pod_no $tracking_date but were unable to. Kindly reach us on $no to reschedule your delivery. Regards, Team Box And Freight.";
							// print_r($number2); die;
							sendsms($number2,$enmsg);
						}

						$msg = 'Status Added  Successfully';
						$class	= 'alert alert-success alert-dismissible';
	
						$this->session->set_flashdata('notify', $msg);
						$this->session->set_flashdata('class', $class);
					}

				}else if($company_type=="International")
				{
				    if($status == 'Delivered')
	    			{
	    				$is_delhivery_complete = 1;
	    				$where = array('booking_id' => $selected_dockets);
	    				$updateData = [
	    					'is_delhivery_complete' => $is_delhivery_complete,
	    				];
	    				$this->db->update('tbl_international_booking', $updateData, $where);
	    			}
				
				    $this->db->select('pod_no, booking_id, forworder_name, forwording_no');
	    			$this->db->from('tbl_international_booking');
	    			$this->db->where('booking_id', $selected_dockets);
	    			$this->db->order_by('booking_id', 'DESC');
	    			$result = $this->db->get();
	    			$resultData = $result->row();
	    
	    		    $pod_no = $resultData->pod_no;
	    			$forworder_name = $resultData->forworder_name;
	    			$forwording_no = $resultData->forwording_no;
	    			
	    			$data = [
	    			        'pod_no'=>$pod_no,
	    			        'branch_name'=>$branch_name,
	    			        'booking_id'=>$selected_dockets,
	    			        'forworder_name'=>$forworder_name,
	    			        'forwording_no'=>$forwording_no,
	    					'tracking_date' => $tracking_date,
	    					'status' => $status,
	    					'comment' => $comment,
	    					'remarks' => $remarks,
	    					'is_delhivery_complete' => $is_delhivery_complete,
	    				];
	    				
	    				
						if($this->db->insert('tbl_international_tracking', $data)){
							$msg = 'Status Added  Successfully';
							$class	= 'alert alert-success alert-dismissible';
		
							$this->session->set_flashdata('notify', $msg);
							$this->session->set_flashdata('class', $class);
						}
				}
				
				
			}
			
	  	}

	    redirect("admin/single-delivery-update");
	}
	

}
?>