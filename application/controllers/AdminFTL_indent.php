<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminFTL_indent extends CI_Controller {

	function __construct()
	{
		 parent:: __construct();
		 $this->load->model('basic_operation_m');
		 if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}


	public function index($offset=0,$searching='') 
	{	
		error_reporting(E_ALL);
ini_set('display_errors', 1);
		//print_r($this->session->all_userdata());
	  	if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
		else
		{
    		$data= [];
			
			if(isset($_GET['from_date']))
			{
				$data['from_date'] = $_GET['from_date'];
				$from_date = $_GET['from_date'];
			}
			if(isset($_GET['to_date']))
			{
				$data['to_date'] = $_GET['to_date'];
				$to_date = $_GET['to_date'];
			}
			if(isset($_GET['filter']))
			{
				$filter = $_GET['filter'];
				$data['filter']  = $filter;
			}			
			if(isset($_GET['filter_value']))
			{
				$filter_value = $_GET['filter_value'];
				$data['filter_value']  = $filter_value;
			}
    
    		$user_id 	= $this->session->userdata("userId");		
    		$data['customer']=  $this->basic_operation_m->get_query_result_array('SELECT * FROM tbl_customers WHERE 1 ORDER BY customer_name ASC');
    		
    		$user_type 					= $this->session->userdata("userType");			
    		$filterCond					= " tbl_indent_tripsheet.customer_id =702";
    		$all_data 					= $this->input->get();
			$customer_id ='';
			$from_date ='';
	    	if($all_data)
			{	
				$filter_value = 	$_GET['filter_value'];
				
				foreach($all_data as $ke=> $vall)
				{
					if($ke == 'filter' && !empty($vall))
					{
						if($vall == 'indent_no')
						{
							if(!empty($filter_value)){
								$indent_no   = $filter_value;
							}
							
						}							
						if($vall == 'origin_city')
						{
							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
							$origin_city 	= $city_info->id;
						}
						if($vall == 'destination_city')
						{
							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
							$destination_city 				= $city_info->id;
						}						
					}	
			  	}
                 if(!empty($_GET['from_date']) && !empty($_GET['to_date'])){
					 $from_date = $_GET['from_date'];
					 $to_date = $_GET['to_date'];
					$filterCond .= " DATE(tbl_indent_tripsheet.request_date_time) BETWEEN '$from_date' AND '$to_date'";
				 }
                 if(!empty($_GET['user_id'])){
					 $customer_id = $_GET['user_id'];
					$filterCond .= " tbl_indent_tripsheet.customer_id ='$customer_id'";
				 }

			}
			if(!empty($searching))
			{
				$filterCond = urldecode($searching);
			}
				
				$resActt = $this->db->query("CALL View_indent(?,?,?,?,?,?)", [$indent_no,$origin_city,$destination_city,$from_date,$to_date,$customer_id]);
				$resAct = $this->db->query("CALL View_indent(?,?,?,?,?,?)", [$indent_no,$origin_city,$destination_city,$from_date,$to_date,$customer_id]);
			
				echo $this->db->last_query();die();
			//	$download_query 		= "SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id WHERE booking_type = 1 AND company_type='Domestic' AND tbl_domestic_booking.user_type !=5 $filterCond  GROUP BY tbl_domestic_booking.booking_id order by tbl_domestic_booking.booking_id DESC";

				$this->load->library('pagination');
			
				$data['total_count']			= $resActt->num_rows();
				$config['total_rows'] 			= $resActt->num_rows();
				$config['base_url'] 			= 'admin/view-ftl-request';
				//	$config['suffix'] 				= '/'.urlencode($filterCond);
				
				$config['per_page'] 			= 50;
				$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
				$config['full_tag_close'] 		= '</ul></nav>';
				$config['first_link'] 			= '&laquo; First';
				$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
				$config['first_tag_close'] 		= '</li>';
				$config['last_link'] 			= 'Last &raquo;';
				$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
				$config['last_tag_close'] 		= '</li>';
				$config['next_link'] 			= 'Next';
				$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
				$config['next_tag_close'] 		= '</li>';
				$config['prev_link'] 			= 'Previous';
				$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
				$config['prev_tag_close'] 		= '</li>';
				$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
				$config['cur_tag_close'] 		= '</a></li>';
				$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
				$config['reuse_query_string'] 	= TRUE;
				$config['num_tag_close'] 		= '</li>';
				$config['attributes'] = array('class' => 'page-link');
				
				if($offset == '')
				{
					$config['uri_segment'] 			= 3;
					$data['serial_no']				= 1;
				}
				else
				{
					$config['uri_segment'] 			= 3;
					$data['serial_no']		= $offset + 1;
				}			
				
				$this->pagination->initialize($config);
				if ($resAct->num_rows() > 0) 
				{
				
					$data['ftl_request_data'] 			= $resAct->result_array();
				}
				else
				{
					$data['ftl_request_data'] 			= array();
				}			
			$data['viewVerified'] = 2;
			$this->load->view('admin/FTL_indent/ftl_request_list', $data);
		}		
        
	}



    // public function index()
	// {
	// 	$data['ftl_request_data'] = $this->db->query("SELECT tbl_indent_tripsheet.* ,tbl_vehicle_type.vehicle_name  FROM tbl_indent_tripsheet left join tbl_vehicle_type ON tbl_vehicle_type.id = tbl_indent_tripsheet.type_of_vehicle ")->result_array();
	// 	$this->load->view('admin/FTL_indent/ftl_request_list', $data);
	// }

    //  Calculating targert Price rate 
	public function gat_rfq_customer_data()
	{
		$current_date = date("Y-m-d");
		$customer_id = $this->input->post('customer_id');
		$vehicle_id = $this->input->post('vehicle_id');
		$origin_city = $this->input->post('origin_city_id');
		$destination_city = $this->input->post('destination_city_id');
		$data1 =  $this->db->query("select * from  ftl_customer_rate_tbl where ftl_customer_id = '$customer_id' AND vehicle_type ='$vehicle_id' AND origin = '$origin_city' AND destination ='$destination_city' AND to_date>= '$current_date'")->row_array();
		//echo $this->db->last_query();
		if(!empty($data1)){$data = $data1;}else{$data = '';}
		echo json_encode($data);
	}



    public function add_ftl_request()
	{
		$customer_id = $this->input->post('customer_id');
		if ($this->input->post('customer_type')=='1') {
			$customer_name = $this->db->get_where('tbl_customers', ['customer_id' => $customer_id])->row('customer_name');
		}else{
			$customer_name = '';
		}

		$user_id = $this->session->userdata('userId');
		$date = $this->input->post('date');
		$time1 = $this->input->post('time');
		$time = date('H:i:sA', strtotime($time1));
		$request_date_time = $date . " " . $time;
		//print_r($request_date_time);exit;

		if (isset($_POST['submit'])) {
            
			 // validation state city start
			if(!empty($this->input->post('consignee_state')) && !empty($this->input->post('consignee_city'))){
                $pincode = $this->input->post('consignee_pincode');
                $state = $this->input->post('consignee_state');
				$city_id = $this->input->post('consignee_city');
				$city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                if(empty($city)){
					$msg			= 'Conssignee State City Not valid';
					$class			= 'alert alert-danger alert-dismissible';
					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
					redirect('admin/view-ftl-request');
				}				
			}
			if(!empty($this->input->post('origin_state')) && !empty($this->input->post('origin_city'))){
                $pincode = $this->input->post('origin_pincode');
                $state = $this->input->post('origin_state');
				$city_id = $this->input->post('origin_city');
				$city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                if(empty($city)){
					$msg			= 'Origin State or City Not valid ';
					$class			= 'alert alert-danger alert-dismissible';
					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
					redirect('admin/view-ftl-request');
				}				
			}
			if(!empty($this->input->post('destination_state')) && !empty($this->input->post('destination_city'))){
				$pincode = $this->input->post('destination_pincode');
                $state = $this->input->post('destination_state');
				$city_id = $this->input->post('destination_city');
				$city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                if(empty($city)){
					$msg			= 'Destination State or City Not valid ';
					$class			= 'alert alert-danger alert-dismissible';
					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
					redirect('admin/view-ftl-request');
				}				
			}
			  //  contact no or pincode 
			  if(!empty($this->input->post('consignee_contact_no'))){
				NumValidation($this->input->post('consignee_contact_no'),'Consignee Contact No Not Valid','admin/view-ftl-request');
				}
				NumValidation($this->input->post('contact_number'),'VEHICLE DETAILS Contact No Not Valid','admin/view-ftl-request');
				NumValidation($this->input->post('delivery_contact_no'),'Delivery Contact No Not Valid','admin/view-ftl-request');

       // validation end 
			$data = array(

				'order_date' => $this->input->post('order_date'),
				'customer_id' => $customer_id,
				'customer_name' => $customer_name,
				'ftl_request_id' => $this->input->post('ftl_request_id'),
				'descrption' => $this->input->post('descrption'),
				'request_date_time' => $request_date_time,
				'origin_city' => $this->input->post('origin_city'),
				'origin_pincode' => $this->input->post('origin_pincode'),
				'origin_state' => $this->input->post('origin_state'),
                'destination_city' => $this->input->post('destination_city'),
                'destination_state' => $this->input->post('destination_state'),
				'destination_pincode' => $this->input->post('destination_pincode'),
				'type_of_vehicle' => $this->input->post('type_of_vehicle'),
				'vehicle_capacity' => $this->input->post('vehicle_capacity'),
				'vehicle_body_type' => $this->input->post('vehicle_body_type'),
				'vehicle_gps' => $this->input->post('vehicle_gps'),
				'vehicle_floor_type' => $this->input->post('vehicle_floor_type'),
				'vehicle_wheel_type' => $this->input->post('vehicle_wheel_type'),
				'goods_type' => $this->input->post('goods_type'),
				'goods_weight' => $this->input->post('goods_weight'),
				'goods_weight' => $this->input->post('goods_weight'),
				'weight_type' => $this->input->post('weight_type'),
				'amount' => $this->input->post('amount'),
				'goods_value' => $this->input->post('goods_value'),
				'customer_type' => $this->input->post('customer_type'),
				'pickup_address' => $this->input->post('pickup_address'),
				'loading_type' => $this->input->post('loading_type'),
				'unloading_type' => $this->input->post('unloading_type'),
				'contact_number' => $this->input->post('contact_number'),
				'delivery_address' => $this->input->post('delivery_address'),
				'delivery_contact_no' => $this->input->post('delivery_contact_no'),
				'type_parcel' => $this->input->post('type_parcel'),
				'insurance_by' => $this->input->post('insurance_by'),
				'cfo_charges' => $this->input->post('cfo_charges'),
				'delivery_contact_person_name' => $this->input->post('delivery_contact_person_name'),
				'order_created_by' => $user_id,
				'user_type' => '1'

			);

			if($this->input->post('customer_type')=='2'){
				$data['consignee_name'] = $this->input->post('consignee_name');
				$data['consignee_address'] = $this->input->post('consignee_address');
				$data['consignee_pincode'] = $this->input->post('consignee_pincode');
				$data['consignee_state'] = $this->input->post('consignee_state');
				$data['consignee_city'] = $this->input->post('consignee_city');
				$data['consignee_contact_no'] = $this->input->post('consignee_contact_no');
			 }

			//   echo '<pre>'; print_r($data);
			$result = $this->db->insert('tbl_indent_tripsheet', $data);
			// echo $this->db->last_query();die;
			

			if (!empty($result)) {
				$msg			= 'Indent genrated successfully';
				$class			= 'alert alert-success alert-dismissible';
			} else {
				$msg			= 'FTL Request not added';
				$class			= 'alert alert-danger alert-dismissible';
			}
			$this->session->set_flashdata('notify', $msg);
			$this->session->set_flashdata('class', $class);

			redirect('admin/view-ftl-request');
		} else {
			$result 		= $this->db->query('select max(id) AS id from tbl_indent_tripsheet')->row();
			$id = $result->id + 1;

			if (strlen($id) == 2) {
				$id = 'FTLR1000' . $id;
			} elseif (strlen($id) == 3) {
				$id = 'FTLR100' . $id;
			} elseif (strlen($id) == 1) {
				$id = 'FTLR10000' . $id;
			} elseif (strlen($id) == 4) {
				$id = 'FTLR10' . $id;
			} elseif (strlen($id) == 5) {
				$id = 'FTLR1' . $id;
			}
			$data['FTTLR_id'] = $id;
			$data['customer'] = $this->db->query('SELECT * FROM tbl_customers where ftl_customer = 1')->result();
			$data['vehicle_type'] = $this->db->query('SELECT * FROM tbl_vehicle_type')->result();
			$data['cities'] = $this->basic_operation_m->get_all_result('city', '');
			$data['states'] = $this->basic_operation_m->get_all_result('state', '');
			$data['goods_name'] = $this->db->query('SELECT * FROM tbl_goods_type')->result();
			$this->load->view('admin/FTL_indent/add_ftl_request', $data);
		}
	}


    public function update_ftl_request($id)
	{
			$customer_id = $this->input->post('customer_id');
			if ($customer_id) {
				$customer_name = $this->db->get_where('tbl_customers', ['customer_id' => $customer_id])->row('customer_name');
			}
	
			$user_id = $this->session->userdata('userId');
			$date = $this->input->post('date');
			$time1 = $this->input->post('time');
			$time = date('H:i:sA', strtotime($time1));
			$request_date_time = $date . " " . $time;
			//print_r($request_date_time);exit;
			$whr = array('id'=>$id);
	
			if (isset($_POST['submit'])) {
                // validation state city start
                if(!empty($this->input->post('consignee_state')) && !empty($this->input->post('consignee_city'))){
                    $pincode = $this->input->post('consignee_pincode');
                    $state = $this->input->post('consignee_state');
                    $city_id = $this->input->post('consignee_city');
                    $city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                    if(empty($city)){
                        $msg			= 'Conssignee State City Not valid';
                        $class			= 'alert alert-danger alert-dismissible';
                        $this->session->set_flashdata('notify', $msg);
                        $this->session->set_flashdata('class', $class);
                        redirect('admin/view-ftl-request');
                    }				
                }
                if(!empty($this->input->post('origin_state')) && !empty($this->input->post('origin_city'))){
                    $pincode = $this->input->post('origin_pincode');
                    $state = $this->input->post('origin_state');
                    $city_id = $this->input->post('origin_city');
                    $city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                    if(empty($city)){
                        $msg			= 'Origin State or City Not valid ';
                        $class			= 'alert alert-danger alert-dismissible';
                        $this->session->set_flashdata('notify', $msg);
                        $this->session->set_flashdata('class', $class);
                        redirect('admin/view-ftl-request');
                    }				
                }
                if(!empty($this->input->post('destination_state')) && !empty($this->input->post('destination_city'))){
                    $pincode = $this->input->post('destination_pincode');
                    $state = $this->input->post('destination_state');
                    $city_id = $this->input->post('destination_city');
                    $city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
                    if(empty($city)){
                        $msg			= 'Destination State or City Not valid ';
                        $class			= 'alert alert-danger alert-dismissible';
                        $this->session->set_flashdata('notify', $msg);
                        $this->session->set_flashdata('class', $class);
                        redirect('admin/view-ftl-request');
                    }				
                }
                //  contact no or pincode 
				     if(!empty($this->input->post('consignee_contact_no'))){
				         NumValidation($this->input->post('consignee_contact_no'),'Consignee Contact No Not Valid','admin/view-ftl-request');
					 }
					 NumValidation($this->input->post('contact_number'),'VEHICLE DETAILS Contact No Not Valid','admin/view-ftl-request');
					 NumValidation($this->input->post('delivery_contact_no'),'Delivery Contact No Not Valid','admin/view-ftl-request');
               // validation end 
				$data = array(
                    'order_date' => $this->input->post('order_date'),
                    'customer_id' => $customer_id,
                    'customer_name' => $customer_name,
                    'descrption' => $this->input->post('descrption'),
                    'request_date_time' => $request_date_time,
                    'origin_city' => $this->input->post('origin_city'),
                    'origin_pincode' => $this->input->post('origin_pincode'),
                    'origin_state' => $this->input->post('origin_state'),
                    'destination_city' => $this->input->post('destination_city'),
                    'destination_state' => $this->input->post('destination_state'),
                    'destination_pincode' => $this->input->post('destination_pincode'),
                    'type_of_vehicle' => $this->input->post('type_of_vehicle'),
                    'vehicle_capacity' => $this->input->post('vehicle_capacity'),
                    'vehicle_body_type' => $this->input->post('vehicle_body_type'),
                    'vehicle_gps' => $this->input->post('vehicle_gps'),
                    'vehicle_floor_type' => $this->input->post('vehicle_floor_type'),
                    'vehicle_wheel_type' => $this->input->post('vehicle_wheel_type'),
                    'goods_type' => $this->input->post('goods_type'),
                    'goods_weight' => $this->input->post('goods_weight'),
                    'goods_weight' => $this->input->post('goods_weight'),
                    'weight_type' => $this->input->post('weight_type'),
                    'amount' => $this->input->post('amount'),
                    'goods_value' => $this->input->post('goods_value'),
                    'customer_type' => $this->input->post('customer_type'),
                    'pickup_address' => $this->input->post('pickup_address'),
                    'loading_type' => $this->input->post('loading_type'),
                    'unloading_type' => $this->input->post('unloading_type'),
                    'contact_number' => $this->input->post('contact_number'),
                    'delivery_address' => $this->input->post('delivery_address'),
                    'delivery_contact_no' => $this->input->post('delivery_contact_no'),
                    'type_parcel' => $this->input->post('type_parcel'),
                    'insurance_by' => $this->input->post('insurance_by'),
                    'cfo_charges' => $this->input->post('cfo_charges'),
                    'delivery_contact_person_name' => $this->input->post('delivery_contact_person_name'),
                    'order_created_by' => $user_id,
                    'user_type' => '1'    
                );
                if($this->input->post('customer_type')=='2'){
                    $data['consignee_name'] = $this->input->post('consignee_name');
                    $data['consignee_address'] = $this->input->post('consignee_address');
                    $data['consignee_pincode'] = $this->input->post('consignee_pincode');
                    $data['consignee_state'] = $this->input->post('consignee_state');
                    $data['consignee_city'] = $this->input->post('consignee_city');
                    $data['consignee_contact_no'] = $this->input->post('consignee_contact_no');
                 }else{
					$data['consignee_name'] = '';
                    $data['consignee_address'] = '';
                    $data['consignee_pincode'] = '';
                    $data['consignee_state'] = '';
                    $data['consignee_city'] = '';
                    $data['consignee_contact_no'] = '';
				 }		
				$result = $this->db->update('tbl_indent_tripsheet', $data,$whr);
			    // echo $this->db->last_query();die;
	
				if (!empty($result)) {
					$msg			= 'FTL Indent Update successfully';
					$class			= 'alert alert-success alert-dismissible';
				} else {
					$msg			= 'FTL Request not added';
					$class			= 'alert alert-danger alert-dismissible';
				}
				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
	
				redirect('admin/view-ftl-request');
			} else {
                $data['customer'] = $this->db->query('SELECT * FROM tbl_customers where ftl_customer = 1')->result();
                $data['vehicle_type'] = $this->db->query('SELECT * FROM tbl_vehicle_type')->result();
                $data['cities'] = $this->basic_operation_m->get_all_result('city', '');
                $data['states'] = $this->basic_operation_m->get_all_result('state', '');
                $data['goods_name'] = $this->db->query('SELECT * FROM tbl_goods_type')->result();
                $data['ftl'] = $this->db->query("SELECT * FROM tbl_indent_tripsheet  where id = $id")->row_array();
				$this->load->view('admin/FTL_indent/Update_ftl_request', $data);
			}
		}




}


?>