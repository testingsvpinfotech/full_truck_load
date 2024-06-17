<?php
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Admin_domestic_shipment_manager extends CI_Controller  {

	var $data = array();
    function __construct() 
	{
        parent :: __construct();
        $this->load->model('basic_operation_m'); 
        $this->load->model('Rate_model');   
        $this->load->model('booking_model');
		if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}

    }
	
	
	   	public function view_domestic_shipment($offset=0,$searching='') 
	{	
		//print_r($this->session->all_userdata());
	  	if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
		else
		{
    		$data= [];
			
			if(isset($_POST['from_date']))
			{
				$data['from_date'] = $_POST['from_date'];
				$from_date = $_POST['from_date'];
			}
			if(isset($_POST['to_date']))
			{
				$data['to_date'] = $_POST['to_date'];
				$to_date = $_POST['to_date'];
			}
			if(isset($_POST['filter']))
			{
				$filter = $_POST['filter'];
				$data['filter']  = $filter;
			}
			if(isset($_POST['courier_company']))
			{
				$courier_company = $_POST['courier_company'];
				$data['courier_companyy']  = $courier_company;
			}
			if(isset($_POST['user_id']))
			{
				$user_id = $_POST['user_id'];
				$data['user_id']  = $user_id;
			}
			if(isset($_POST['filter_value']))
			{
				$filter_value = $_POST['filter_value'];
				$data['filter_value']  = $filter_value;
			}
    
    		$user_id 	= $this->session->userdata("userId");		
    		$data['customer']=  $this->basic_operation_m->get_query_result_array('SELECT * FROM tbl_customers WHERE 1 ORDER BY customer_name ASC');
    		
    		$user_type 					= $this->session->userdata("userType");			
    		$filterCond					= '';
    		$all_data 					= $this->input->post();
    
	    	if($all_data)
			{	
				$filter_value = 	$_POST['filter_value'];
				
				foreach($all_data as $ke=> $vall)
				{
					if($ke == 'filter' && !empty($vall))
					{
						if($vall == 'pod_no')
						{
							$filterCond .= " AND tbl_domestic_booking.pod_no = '$filter_value'";
						}
						if($vall == 'forwording_no')
						{
							$filterCond .= " AND tbl_domestic_booking.forwording_no = '$filter_value'";
						}
						if($vall == 'sender')
						{
							$filterCond .= " AND tbl_domestic_booking.sender_name LIKE '%$filter_value%'";
						}
						if($vall == 'receiver')
						{
							$filterCond .= " AND tbl_domestic_booking.reciever_name LIKE '%$filter_value%'";
						}
						
						if($vall == 'origin')
						{
							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
							$filterCond 				.= " AND tbl_domestic_booking.sender_city = '$city_info->id'";
						}
						if($vall == 'destination')
						{
							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
							$filterCond 				.= " AND tbl_domestic_booking.reciever_city = '$city_info->id'";
						}
						if($vall == 'pickup')
						{
						
							$filterCond 				.= " AND tbl_domestic_booking.pickup_pending = '1'";
						}
						
					}
					elseif($ke == 'user_id' && !empty($vall))
					{
						$filterCond .= " AND tbl_domestic_booking.customer_id = '$vall'";
					}
					elseif($ke == 'from_date' && !empty($vall))
					{
						$filterCond .= " AND tbl_domestic_booking.booking_date >= '$vall'";
					}
					elseif($ke == 'to_date' && !empty($vall))
					{
						$filterCond .= " AND tbl_domestic_booking.booking_date <= '$vall'";
					}
					elseif($ke == 'courier_company' && !empty($vall) && $vall !="ALL")
					{
						$filterCond .= " AND tbl_domestic_booking.courier_company_id = '$vall'";
					}
					elseif($ke == 'mode_name' && !empty($vall) && $vall !="ALL")
					{
						$filterCond .= " AND tbl_domestic_booking.mode_dispatch = '$vall'";
					}
					
			  	}
			}
			if(!empty($searching))
			{
				$filterCond = urldecode($searching);
			}

	    
			if ($this->session->userdata("userType") == '1') 
			{
				$resActt = $this->db->query("SELECT * FROM tbl_domestic_booking  WHERE booking_type = 1 $filterCond ");
				$resAct = $this->db->query("SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id WHERE booking_type = 1 AND company_type='Domestic' AND tbl_domestic_booking.user_type !=5 $filterCond GROUP BY tbl_domestic_booking.booking_id order by tbl_domestic_booking.booking_id DESC limit ".$offset.",50");
				// echo $this->db->last_query();die();
				$download_query 		= "SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id WHERE booking_type = 1 AND company_type='Domestic' AND tbl_domestic_booking.user_type !=5 $filterCond  GROUP BY tbl_domestic_booking.booking_id order by tbl_domestic_booking.booking_id DESC";

				$this->load->library('pagination');
			
				$data['total_count']			= $resActt->num_rows();
				$config['total_rows'] 			= $resActt->num_rows();
				$config['base_url'] 			= 'admin/view-domestic-shipment';
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
				
					$data['allpoddata'] 			= $resAct->result_array();
				}
				else
				{
					$data['allpoddata'] 			= array();
				}
			}
			else
			{
				//print_r($this->session->all_userdata());
				$branch_id = $this->session->userdata("branch_id");
				$where 		= '';
				// if($this->session->userdata("userType") == '7') 
				if($this->session->userdata("branch_id") == $branch_id) 
				{ 

					$username = $this->session->userdata("userName");
					
					$whr = array('username' => $username);
					// $res = $this->basic_operation_m->getAll('tbl_users', $whr);
					// $branch_id = $res->row()->branch_id;				
					$where ="and branch_id='$branch_id' ";
				 } 
	    
				$resActt = $this->db->query("SELECT * FROM tbl_domestic_booking  WHERE booking_type = 1 and branch_id='$branch_id' $filterCond ");
				$resAct = $this->db->query("SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id  LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id  WHERE booking_type = 1 $where $filterCond GROUP BY tbl_domestic_booking.booking_id order by tbl_domestic_booking.booking_id DESC limit ".$offset.",50");
				
				$download_query 		= "SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id  LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id  WHERE booking_type = 1 $where $filterCond GROUP BY tbl_domestic_booking.booking_id order by tbl_domestic_booking.booking_id DESC ";
				
				$this->load->library('pagination');
			
				$data['total_count']			= $resActt->num_rows();
				$config['total_rows'] 			= $resActt->num_rows();
				$config['base_url'] 			= 'admin/view-domestic-shipment/';
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
				if($resAct->num_rows() > 0) 
				{
					$data['allpoddata']= $resAct->result_array();
				}
				else
				{
					$data['allpoddata']= array();
				}
			}
				
			if(isset($_POST['download_report']) && $_POST['download_report'] == 'Download Report')
			{
				$resActtt 			= $this->db->query($download_query);
				$shipment_data		= $resActtt->result_array();
				$this->domestic_shipment_report($shipment_data);
			}
			
			$data['viewVerified'] = 2;
			$whr_c =array('company_type'=>'Domestic');
			$data['courier_company']= $this->basic_operation_m->get_all_result("courier_company",$whr_c);
			$data['mode_details']= $this->basic_operation_m->get_all_result("transfer_mode",'');
			$this->load->view('admin/domestic_shipment/view_domestic_shipment', $data);
		}		
        
	}
	
//   	public function view_domestic_shipment($offset=0,$searching='') 
// 	{	
// 	  	if($this->session->userdata('userId') == '')
// 		{
// 			redirect('admin');
// 		}
// 		else
// 		{
//     		$data= [];
			
// 			if(isset($_POST['from_date']))
// 			{
// 				$data['from_date'] = $_POST['from_date'];
// 				$from_date = $_POST['from_date'];
// 			}
// 			if(isset($_POST['to_date']))
// 			{
// 				$data['to_date'] = $_POST['to_date'];
// 				$to_date = $_POST['to_date'];
// 			}
// 			if(isset($_POST['filter']))
// 			{
// 				$filter = $_POST['filter'];
// 				$data['filter']  = $filter;
// 			}
// 			if(isset($_POST['courier_company']))
// 			{
// 				$courier_company = $_POST['courier_company'];
// 				$data['courier_companyy']  = $courier_company;
// 			}
// 			if(isset($_POST['user_id']))
// 			{
// 				$user_id = $_POST['user_id'];
// 				$data['user_id']  = $user_id;
// 			}
// 			if(isset($_POST['filter_value']))
// 			{
// 				$filter_value = $_POST['filter_value'];
// 				$data['filter_value']  = $filter_value;
// 			}
    
//     		$user_id 	= $this->session->userdata("userId");		
//     		$data['customer']=  $this->basic_operation_m->get_query_result_array('SELECT * FROM tbl_customers WHERE 1 ORDER BY customer_name ASC');
    		
//     		$user_type 					= $this->session->userdata("userType");			
//     		$filterCond					= '';
//     		$all_data 					= $this->input->post();
    
// 	    	if($all_data)
// 			{	
// 				$filter_value = 	$_POST['filter_value'];
				
// 				foreach($all_data as $ke=> $vall)
// 				{
// 					if($ke == 'filter' && !empty($vall))
// 					{
// 						if($vall == 'pod_no')
// 						{
// 							$filterCond .= " AND tbl_domestic_booking.pod_no = '$filter_value'";
// 						}
// 						if($vall == 'forwording_no')
// 						{
// 							$filterCond .= " AND tbl_domestic_booking.forwording_no = '$filter_value'";
// 						}
// 						if($vall == 'sender')
// 						{
// 							$filterCond .= " AND tbl_domestic_booking.sender_name LIKE '%$filter_value%'";
// 						}
// 						if($vall == 'receiver')
// 						{
// 							$filterCond .= " AND tbl_domestic_booking.reciever_name LIKE '%$filter_value%'";
// 						}
						
// 						if($vall == 'origin')
// 						{
// 							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
// 							$filterCond 				.= " AND tbl_domestic_booking.sender_city = '$city_info->id'";
// 						}
// 						if($vall == 'destination')
// 						{
// 							$city_info					 =  $this->basic_operation_m->get_table_row('city', "city='$filter_value'");
// 							$filterCond 				.= " AND tbl_domestic_booking.reciever_city = '$city_info->id'";
// 						}
// 						if($vall == 'pickup')
// 						{
						
// 							$filterCond 				.= " AND tbl_domestic_booking.pickup_pending = '1'";
// 						}
						
// 					}
// 					elseif($ke == 'user_id' && !empty($vall))
// 					{
// 						$filterCond .= " AND tbl_domestic_booking.customer_id = '$vall'";
// 					}
// 					elseif($ke == 'from_date' && !empty($vall))
// 					{
// 						$filterCond .= " AND tbl_domestic_booking.booking_date >= '$vall'";
// 					}
// 					elseif($ke == 'to_date' && !empty($vall))
// 					{
// 						$filterCond .= " AND tbl_domestic_booking.booking_date <= '$vall'";
// 					}
// 					elseif($ke == 'courier_company' && !empty($vall) && $vall !="ALL")
// 					{
// 						$filterCond .= " AND tbl_domestic_booking.courier_company_id = '$vall'";
// 					}
// 					elseif($ke == 'mode_name' && !empty($vall) && $vall !="ALL")
// 					{
// 						$filterCond .= " AND tbl_domestic_booking.mode_dispatch = '$vall'";
// 					}
					
// 			  	}
// 			}
// 			if(!empty($searching))
// 			{
// 				$filterCond = urldecode($searching);
// 			}

	    
// 			if ($this->session->userdata("userType") == '1') 
// 			{
// 				$resActt = $this->db->query("SELECT * FROM tbl_domestic_booking  WHERE booking_type = 1 $filterCond ");
// 				$resAct = $this->db->query("SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id WHERE booking_type = 1 AND company_type='Domestic' AND tbl_domestic_booking.user_type !=5 $filterCond order by tbl_domestic_booking.booking_id DESC limit ".$offset.",50");
// 				$download_query 		= "SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id WHERE booking_type = 1 AND company_type='Domestic' AND tbl_domestic_booking.user_type !=5 $filterCond order by tbl_domestic_booking.booking_id DESC";
				
// 				$this->load->library('pagination');
			
// 				$data['total_count']			= $resActt->num_rows();
// 				$config['total_rows'] 			= $resActt->num_rows();
// 				$config['base_url'] 			= 'admin/view-domestic-shipment';
// 				//	$config['suffix'] 				= '/'.urlencode($filterCond);
				
// 				$config['per_page'] 			= 50;
// 				$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
// 				$config['full_tag_close'] 		= '</ul></nav>';
// 				$config['first_link'] 			= '&laquo; First';
// 				$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
// 				$config['first_tag_close'] 		= '</li>';
// 				$config['last_link'] 			= 'Last &raquo;';
// 				$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
// 				$config['last_tag_close'] 		= '</li>';
// 				$config['next_link'] 			= 'Next';
// 				$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
// 				$config['next_tag_close'] 		= '</li>';
// 				$config['prev_link'] 			= 'Previous';
// 				$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
// 				$config['prev_tag_close'] 		= '</li>';
// 				$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
// 				$config['cur_tag_close'] 		= '</a></li>';
// 				$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
// 				$config['reuse_query_string'] 	= TRUE;
// 				$config['num_tag_close'] 		= '</li>';
// 				$config['attributes'] = array('class' => 'page-link');
				
// 				if($offset == '')
// 				{
// 					$config['uri_segment'] 			= 3;
// 					$data['serial_no']				= 1;
// 				}
// 				else
// 				{
// 					$config['uri_segment'] 			= 3;
// 					$data['serial_no']		= $offset + 1;
// 				}
				
				
// 				$this->pagination->initialize($config);
// 				if ($resAct->num_rows() > 0) 
// 				{
				
// 					$data['allpoddata'] 			= $resAct->result_array();
// 				}
// 				else
// 				{
// 					$data['allpoddata'] 			= array();
// 				}
// 			}
// 			else
// 			{
// 				$where 		= '';
// 				if($this->session->userdata("userType") == '7') 
// 				{ 
// 					$username = $this->session->userdata("userName");
// 					$whr = array('username' => $username);
// 					$res = $this->basic_operation_m->getAll('tbl_users', $whr);
// 					$branch_id = $res->row()->branch_id;				
// 					$where ="and branch_id='$branch_id' ";
// 				 } 
	    
// 				$resActt = $this->db->query("SELECT * FROM tbl_domestic_booking  WHERE booking_type = 1 $where $filterCond ");
// 				$resAct = $this->db->query("SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id  LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id  WHERE booking_type = 1 $where $filterCond order by tbl_domestic_booking.booking_id DESC limit ".$offset.",50");
				
// 				$download_query 		= "SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.chargable_weight,tbl_domestic_weight_details.no_of_pack,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id  LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id  WHERE booking_type = 1 $where $filterCond order by tbl_domestic_booking.booking_id DESC ";
				
// 				$this->load->library('pagination');
			
// 				$data['total_count']			= $resActt->num_rows();
// 				$config['total_rows'] 			= $resActt->num_rows();
// 				$config['base_url'] 			= 'admin/view-domestic-shipment/';
// 				//	$config['suffix'] 				= '/'.urlencode($filterCond);
				
// 				$config['per_page'] 			= 50;
// 				$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
// 				$config['full_tag_close'] 		= '</ul></nav>';
// 				$config['first_link'] 			= '&laquo; First';
// 				$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
// 				$config['first_tag_close'] 		= '</li>';
// 				$config['last_link'] 			= 'Last &raquo;';
// 				$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
// 				$config['last_tag_close'] 		= '</li>';
// 				$config['next_link'] 			= 'Next';
// 				$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
// 				$config['next_tag_close'] 		= '</li>';
// 				$config['prev_link'] 			= 'Previous';
// 				$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
// 				$config['prev_tag_close'] 		= '</li>';
// 				$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
// 				$config['cur_tag_close'] 		= '</a></li>';
// 				$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
// 				$config['reuse_query_string'] 	= TRUE;
// 				$config['num_tag_close'] 		= '</li>';
// 				$config['attributes'] = array('class' => 'page-link');
				
// 				if($offset == '')
// 				{
// 					$config['uri_segment'] 			= 3;
// 					$data['serial_no']				= 1;
// 				}
// 				else
// 				{
// 					$config['uri_segment'] 			= 3;
// 					$data['serial_no']		= $offset + 1;
// 				}
				
				
// 				$this->pagination->initialize($config);
// 				if($resAct->num_rows() > 0) 
// 				{
// 					$data['allpoddata']= $resAct->result_array();
// 				}
// 				else
// 				{
// 					$data['allpoddata']= array();
// 				}
// 			}
				
// 			if(isset($_POST['download_report']) && $_POST['download_report'] == 'Download Report')
// 			{
// 				$resActtt 			= $this->db->query($download_query);
// 				$shipment_data		= $resActtt->result_array();
// 				$this->domestic_shipment_report($shipment_data);
// 			}
			
// 			$data['viewVerified'] = 2;
// 			$whr_c =array('company_type'=>'Domestic');
// 			$data['courier_company']= $this->basic_operation_m->get_all_result("courier_company",$whr_c);
// 			$data['mode_details']= $this->basic_operation_m->get_all_result("transfer_mode",'');
// 			$this->load->view('admin/domestic_shipment/view_domestic_shipment', $data);
// 		}		
        
// 	}
	
  	public function domestic_shipment_report($shipment_data)
   	{    
		$date=date('d-m-Y');
		$filename = "SipmentDetails_".$date.".csv";
		$fp = fopen('php://output', 'w');
			
		$header =array("AWB No.","Sender","Receiver","Receiver City","Forwording No","Forworder Name","Booking date","Mode","Pay Mode","Amount","Weight","NOP","Invoice No","Invoice Amount","Branch Name","User","Eway No","Eway Expiry date");

			
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);

		fputcsv($fp, $header);
		$i =0;
		foreach($shipment_data as $row) 
		{
			$i++;

			$whr=array('transfer_mode_id'=>$row['mode_dispatch']);
            $mode_details = $this->basic_operation_m->get_table_row('transfer_mode',$whr);

            $whr_u =array('branch_id'=>$row['branch_id']);
            $branch_details = $this->basic_operation_m->get_table_row('tbl_branch', $whr_u);


            $whr_u =array('user_id'=>$row['user_id']);
            $user_details = $this->basic_operation_m->get_table_row('tbl_users', $whr_u);
            $user_details->username = substr($user_details->username,0,20);


			
			$whr=array('id'=>$row['sender_city']);
			$sender_city_details = $this->basic_operation_m->get_table_row("city",$whr);
			$sender_city = $sender_city_details->city;
			
			$whr_s=array('id'=>$row['reciever_state']);
			$reciever_state_details = $this->basic_operation_m->get_table_row("state",$whr_s);
			$reciever_state = $reciever_state_details->state;
			
			$whr_p=array('id'=>$row['payment_method']);
			$payment_method_details = $this->basic_operation_m->get_table_row("payment_method",$whr_p);
			$payment_method = $payment_method_details->method;


			$branch_details->branch_name = substr($branch_details->branch_name,0,20);
			$row=array(
				$row['pod_no'],
				$row['sender_name'],
				$row['reciever_name'],
				$row['city'],
				$row['forwording_no'],
				$row['forworder_name'],
				date('d-m-Y',strtotime($row['booking_date'])),
				$mode_details->mode_name,
				$row['dispatch_details'],
				$row['grand_total'],
				$row['chargable_weight'],
				$row['no_of_pack'],
				$row['invoice_no'],
				$row['invoice_value'],
				$branch_details->branch_name,
				$user_details->username
			);
			
			
			fputcsv($fp, $row);
		}
		exit;
   	}
   
	public function view_pending_domestic_forworder()
    {
    	$whr =array("forwording_no"=>"");
    	$data['all_pending_forworder'] = $this->basic_operation_m->get_all_result("tbl_domestic_booking",$whr);	
		$this->load->view('admin/domestic_shipment/view_domestic_pending_forworder', $data);
    }
     public function view_domestic_unbill_shipment()
    {
        $whr =array("invoice_generated_status"=>"0");
        $data['all_unbill_shippment'] = $this->basic_operation_m->get_all_result("tbl_domestic_booking",$whr);    
        $this->load->view('admin/domestic_shipment/view_domestic_unbill_shipment', $data);
    }
    public function add_new_rate_domestic()
    {
        $sub_total 	 = 0;		
		$customer_id = $this->input->post('customer_id');
		$c_courier_id= $this->input->post('c_courier_id');
		$mode_id  = $this->input->post('mode_id');
		$reciver_city	= $this->input->post('city');
		$reciver_state 	= $this->input->post('state');		
		$sender_state 	= $this->input->post('sender_state');		
		$sender_city 	= $this->input->post('sender_city');		
		$is_appointment = $this->input->post('is_appointment');		
		// $invoice_value = $this->input->post('invoice_value');		
		
		$whr1 			= array('state' => $sender_state,'city' => $sender_city);
		$res1			= $this->basic_operation_m->selectRecord('region_master_details', $whr1);	
		
		$sender_zone_id 		= $res1->row()->regionid;
		$reciver_zone_id  		= $this->input->post('receiver_zone_id');
		
		$doc_type 		= $this->input->post('doc_type'); 
		$chargable_weight  = $this->input->post('chargable_weight');
		$receiver_gstno =$this->input->post('receiver_gstno');
		$booking_date       = $this->input->post('booking_date');
		$invoice_value       = $this->input->post('invoice_value');
		$dispatch_details       = $this->input->post('dispatch_details');
		$current_date = date("Y-m-d",strtotime($booking_date));
		$chargable_weight	= $chargable_weight * 1000;
		$fixed_perkg		= 0;
		$addtional_250		= 0;
		$addtional_500		= 0;
		$addtional_1000		= 0;
		$fixed_per_kg_1000		= 0;
		$tat					= 0;
		
		
		$where					= "from_zone_id='".$sender_zone_id."' AND to_zone_id='".$reciver_zone_id."'";
		
		// checking city and state rate 
		$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND city_id='".$reciver_city."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$this->input->post('chargable_weight')." BETWEEN weight_range_from AND weight_range_to) and fixed_perkg = '0' ORDER BY applicable_from DESC LIMIT 1");
		if ($fixed_perkg_result->num_rows() > 0) 
		{
			$where					= "city_id='".$reciver_city."'";
		}
		else
		{
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND city_id='".$reciver_city."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg = '0' ORDER BY applicable_from DESC,weight_range_to desc LIMIT 1");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
				$where					= "city_id='".$reciver_city."'";
			}
		}
		
		
		// checking city and state rate 
		$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND state_id='".$reciver_state."' and city_id='' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$this->input->post('chargable_weight')." BETWEEN weight_range_from AND weight_range_to) and fixed_perkg = '0' ORDER BY applicable_from DESC LIMIT 1");
		if ($fixed_perkg_result->num_rows() > 0) 
		{
			$where					= "state_id='".$reciver_state."'";
		}
		else
		{
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND state_id='".$reciver_state."' and city_id='' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg = '0' ORDER BY applicable_from DESC,weight_range_to desc LIMIT 1");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
				$where					= "state_id='".$reciver_state."'";
			}
		}
			
		// calculationg fixed per kg price 	
		$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."'  AND $where  AND (c_courier_id='".$c_courier_id."' OR c_courier_id=0) AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$this->input->post('chargable_weight')." BETWEEN weight_range_from AND weight_range_to) and fixed_perkg = '0' ORDER BY applicable_from,c_courier_id DESC LIMIT 1");
		$frieht=0;
		if ($fixed_perkg_result->num_rows() > 0) 
		{
			$data['rate_master'] = $fixed_perkg_result->row();
			$rate	= $data['rate_master']->rate;
			$tat	= $data['rate_master']->tat;
			$fixed_perkg = $rate;
		}
		else
		{
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND $where  AND (c_courier_id='".$c_courier_id."' OR c_courier_id=0) AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg = '0' ORDER BY applicable_from DESC,weight_range_to,c_courier_id desc LIMIT 1");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
				$data['rate_master']    = $fixed_perkg_result->row();
				$rate               	= $data['rate_master']->rate;
				$tat          	     	= $data['rate_master']->tat;
				$weight_range_to	    = round($data['rate_master']->weight_range_to * 1000);
				$fixed_perkg            = $rate;
			}
			
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."'  AND $where  AND (c_courier_id='".$c_courier_id."' OR c_courier_id=0) AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg <> '0' ");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
			    if($weight_range_to > 1000)
			    {
			        $weight_range_to = $weight_range_to;
			    }
			    else
			    {
			        $weight_range_to = 1000;
			    }
				$left_weight  = ($chargable_weight - $weight_range_to);
			
				$rate_master  = $fixed_perkg_result->result();
				
				foreach($rate_master as $key => $values)
				{
					$tat	= $values->tat;
					if($values->fixed_perkg == 1) // 250 gm slab
					{
						
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
						$total_slab = $slab_weight/250;
						$addtional_250 = $addtional_250 + $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
					
					if($values->fixed_perkg == 2)// 500 gm slab
					{
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
					
						if($slab_weight < 1000)
						{
						    if($slab_weight <= 500)
						    {
						        $slab_weight = 500;
						    }
						    else
						    {
						        $slab_weight = 1000;
						    }
						    
						}
						else
						{
						    $diff_ceil = $slab_weight%1000;
						    $slab_weight = $slab_weight - $diff_ceil;
						
						    if($diff_ceil <= 500 && $diff_ceil != 0)
						    {
						       
						        $slab_weight = $slab_weight + 500;
						    }
						    elseif($diff_ceil <= 1000 && $diff_ceil != 0)
						    {
						       
						        $slab_weight = $slab_weight + 1000;
						    }
						    
						  
						}
				
						$total_slab = $slab_weight/500;
						$addtional_500 = $addtional_500 +$total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					
					}
					
					if($values->fixed_perkg == 3) // 1000 gm slab
					{
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$total_slab = ceil($slab_weight/1000);
						
						$addtional_1000 = $addtional_1000+ $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
					
					if($values->fixed_perkg == 4 && ($this->input->post('chargable_weight') >=  $values->weight_range_from && $this->input->post('chargable_weight') <=  $values->weight_range_to)) // 1000 gm slab
					{
						//$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$total_slab = ceil($chargable_weight/1000);
						$fixed_perkg = 0;
						$addtional_250 = 0;
						$addtional_500 = 0;
						$addtional_1000 = 0;
						$rateeee= $values->rate;
						$fixed_per_kg_1000 = $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
				}
				
			}
		}
		
		
		$frieht = $fixed_perkg + $addtional_250 + $addtional_500 + $addtional_1000 + $fixed_per_kg_1000;
		$amount = $frieht;
		

	//	$whr1 = array('courier_id' => $c_courier_id);
		$whr1 = array('courier_id' => $c_courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => $customer_id);
		$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
		
		if(empty($res1))
		{
			// echo "hi";
			$whr1 = array('courier_id' => $c_courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => '0');
			$res1 = $this->basic_operation_m->get_query_row("select * from courier_fuel where (courier_id = '$c_courier_id' or courier_id='0') and fuel_from <= '$current_date' and fuel_to >='$current_date' and (customer_id = '0' or customer_id = '$customer_id') ORDER BY courier_id,customer_id  DESC limit 1");

			// echo $this->db->last_query();

			// print_r($res1);exit();
		}
		
		if($res1)
		{
			$fuel_per 		= $res1->fuel_price;
			$fov 			= $res1->fov_min;
			$docket_charge 	= $res1->docket_charge;
			$fov_base 	= $res1->fov_base;
			$fov_min 	= $res1->fov_min;

			// echo "<pre>";
			// print_r($res1);exit();
			
			if($dispatch_details != 'Cash' && $dispatch_details != 'COD')
			{
				$res1->cod	= 0;
			}
			
			if($is_appointment == 1)
			{
				$appt_charges =  ($res1->appointment_perkg * $this->input->post('chargable_weight'));
				if($res1->appointment_min > $appt_charges)
				{
					$appt_charges = $res1->appointment_min;
				}
			}
			
			if($dispatch_details != 'ToPay')
			{
				$res1->to_pay_charges	= 0;
			}

			// if ($fov_base) {
			// 	# code...
			// }
			
			if($invoice_value >= $fov_base )
			{
				$fov = (($invoice_value/100)* $res1->fov_above);
			}
			elseif($invoice_value < $res1->fov_base)
			{
				$fov = (($invoice_value/100)*$res1->fov_below);
			}

			if ($fov < $fov_min) {
				$fov = $fov_min;
			}
			
			if($dispatch_details == 'COD')
			{
				if($res1->cod	!= 0)
				{
					$cod_detail_Range  	= $this->basic_operation_m->get_query_row("select * from courier_fuel_detail  where cf_id = '$res1->cf_id' and ('$invoice_value' BETWEEN cod_range_from and cod_range_to)");
					if(!empty($cod_detail_Range))
					{
						$res1->cod 				=($invoice_value * $cod_detail_Range->cod_range_rate/100);
					}
				}
				
			}
			else
			{
				$res1->cod				= 0;
			}
		
			if($dispatch_details == 'ToPay')
			{
				
				$to_pay_charges_Range  	= $this->basic_operation_m->get_query_row("select * from courier_fuel_detail  where cf_id = '$res1->cf_id' and ('$invoice_value' BETWEEN topay_range_from and topay_range_to)");
				if(!empty($to_pay_charges_Range))
				{
					$res1->to_pay_charges 				=($invoice_value * $to_pay_charges_Range->topay_range_rate/100);
				}
				
			}
			else
			{
				$res1->to_pay_charges				= 0;
			}
			
			if($res1->fc_type == 'freight')
			{
				$final_fuel_charges =($amount * $fuel_per/100);
				$amount	= $amount + $fov + $docket_charge + $res1->cod + $res1->to_pay_charges + $appt_charges;
			}
			else
			{
				$amount	= $amount + $fov + $docket_charge + $res1->cod + $res1->to_pay_charges + $appt_charges;
				$final_fuel_charges =($amount * $fuel_per/100);
			}
			$cft 			= $res1->cft;
			$cod			= $res1->cod;
			$to_pay_charges = $res1->to_pay_charges;
			
		}
		else
		{
			$cft = '0';
			$cod = '0';
			$fov = '0';
			$to_pay_charges ='0';
			$appt_charges ='0';
			$fuel_per ='0';
			$docket_charge ='0';
			$amount	= $amount + $fov + $docket_charge + $cod + $to_pay_charges + $appt_charges;
			$final_fuel_charges =($amount * $fuel_per/100);
		}
		
		//Cash
		
    
		$sub_total =($amount + $final_fuel_charges);

		$first_two_char = substr($receiver_gstno,0,2);
		
		if($receiver_gstno=="")
		{
		    $first_two_char=27;
		}
		
			$tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
			if($tbl_customers_info->gst_charges == 1)
			{
				if($first_two_char==27)
				{
					$cgst = ($sub_total*9/100);
					$sgst = ($sub_total*9/100);
					$igst = 0;
					$grand_total = $sub_total + $cgst + $sgst + $igst;
				}else{
					$cgst = 0;
					$sgst = 0;
					$igst = ($sub_total*18/100);
					$grand_total = $sub_total + $igst;
				}		
			}
			else
			{
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}
			
			if($dispatch_details == 'Cash')
			{	
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}
			
			
		$query ="select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND $where  AND ( c_courier_id='".$c_courier_id."' OR c_courier_id=0) AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$chargable_weight." BETWEEN weight_range_from AND weight_range_to)  ORDER BY applicable_from DESC LIMIT 1";
		
		if($tat > 0)
		{
			$tat_date 		=  date('Y-m-d', strtotime($booking_date. " + $tat days"));
		}
		else
		{
			$tat_date 		=  date('Y-m-d', strtotime($booking_date. " + 5 days"));
		}
		

		$data = array(
			'query'=>$query,
			'sender_zone_id'=>$sender_zone_id,			
			'tat_date'=>$tat_date,			
			'reciver_zone_id'=>$reciver_zone_id,			
			'chargable_weight'=>ceil($chargable_weight),			 	
			'frieht' => round($frieht,2),
			'fov'=>round($fov,2),
			'appt_charges'=>round($appt_charges,2),
			'docket_charge'=>round($docket_charge,2),
			'amount' => round($amount,2),
			'cod' => round($cod,2),
			'cft' => round($cft,2),
			'to_pay_charges' => round($to_pay_charges,2),
			'final_fuel_charges'=>round($final_fuel_charges,2),
			'sub_total'=>number_format($sub_total, 2, '.', ''),
			'cgst'=>number_format($cgst, 2, '.', ''),
			'sgst'=>number_format($sgst, 2, '.', ''),
			'igst'=>number_format($igst, 2, '.', ''),
			'grand_total'=>number_format($grand_total, 2, '.', ''),
		);
		echo json_encode($data);
		exit;
		}
    
    public function add_domestic_shipment() 
	{
		$data			= $this->data;
        $result 		= $this->db->query('select max(booking_id) AS id from tbl_domestic_booking')->row();
        $id 			= $result->id + 1;
        
		if (strlen($id) == 2) 
		{
            $id = 'B4L1000'.$id;
        }
		elseif (strlen($id) == 3) 
		{
            $id = 'B4L100'.$id;
        }
		elseif (strlen($id) == 1) 
		{
            $id = 'B4L10000'.$id;
        }
		elseif (strlen($id) == 4) 
		{
            $id = 'B4L10'.$id;
        }
		elseif (strlen($id) == 5) 
		{
            $id = 'B4L1'.$id;
        }
        
		
        $data['transfer_mode']		 	= $this->basic_operation_m->get_query_result('select * from `transfer_mode`');
       
        $user_id 	= $this->session->userdata("userId");
		$data['cities']	= $this->basic_operation_m->get_all_result('city', '');
      	$data['states'] =$this->basic_operation_m->get_all_result('state', '');
        $user_type 	= $this->session->userdata("userType");
		if($user_type == 1)
		{    $where =" customer_type != '1' AND customer_type != '2' ";
			$data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', $where);
		}else{
			$username = $this->session->userdata("userName");
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;				
			//$where ="branch_id='$branch_id' ";
                        // $where ="branch_id='$branch_id' AND customer_type != '1' AND customer_type != '2' ";
                        $where =" customer_type != '1' AND customer_type != '2' ";
			// $data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', "branch_id = '$branch_id'");
			$data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', $where );
		}
        $data['payment_method']  = $this->basic_operation_m->get_all_result('payment_method', '');
        $data['region_master'] = $this->basic_operation_m->get_all_result('region_master', '');
		$data['bid'] = $id;
		$whr_d= array("company_type"=>"Domestic");
		$data['courier_company'] = $this->basic_operation_m->get_all_result("courier_company",$whr_d);	
		
		$this->load->view('admin/domestic_shipment/view_add_domestic_shipment', $data);
	}


	public function insert_domestic_shipment()
	{
		$all_Data 	= $this->input->post();	


		if(!empty($all_Data)) 
		{
			
			$customer_account_id		 = $this->input->post('customer_account_id');
			$block_status				 = $this->basic_operation_m->get_query_row("select * from access_control where customer_id = '$customer_account_id' and block_status = 'Booking' and current_status ='0'"); 
			if(!empty($block_status))
			{
				$msg	='Booking is Blocked for this customer';
				$class	= 'alert alert-danger alert-dismissible';	
				$this->session->set_flashdata('notify',$msg);
				$this->session->set_flashdata('class',$class);
				redirect('admin/view-add-domestic-shipment');
			}
			foreach ($all_Data as $key => $value) {
				if (is_array($value)) {
					# code...
				}else{
					$_POST[$key] = strtoupper($value);
				}
				
			}
			// echo "<hr>";
			// print_r($this->input->post());exit();
			$username = $this->session->userdata("userName");
			$user_id = $this->session->userdata("userId");
			$user_type = $this->session->userdata("userType");
		
		    
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;
			
			$customer_info =$this->basic_operation_m->get_table_row('tbl_customers',array('customer_id'=>$this->input->post('customer_account_id')));
			$company_info =$this->basic_operation_m->get_table_row('tbl_company',array('id'=>$customer_info->company_id));
			$branch_info =$this->basic_operation_m->get_table_row('tbl_branch',array('branch_id'=>$branch_id));

			$date = date('Y-m-d',strtotime($this->input->post('booking_date')));
			$this->session->unset_userdata("booking_date");
			$this->session->set_userdata("booking_date",$this->input->post('booking_date'));

			$reciever_pincode= $this->input->post('reciever_pincode');
			$reciever_city= $this->input->post('reciever_city');
			$reciever_state= $this->input->post('reciever_state');

			$whr_pincode = array('pin_code'=>$reciever_pincode,'city_id'=>$reciever_city,'state_id'=>$reciever_state); 
			$check_city =$this->basic_operation_m->get_table_row('pincode',$whr_pincode);
			//echo "++++".$this->db->last_query();
			if(empty($check_city))
			{	$whr_C =array('id'=>$reciever_city);
				$city_details = $this->basic_operation_m->get_table_row('city',$whr_C);
				$whr_S =array('id'=>$reciever_state);
				$state_details = $this->basic_operation_m->get_table_row('state',$whr_S);

				$pincode_data = array(
					'pin_code'=>$reciever_pincode,
					'city'=>$city_details->city,
					'city_id'=>$reciever_city,
					'state'=>$state_details->state,
					'state_id'=>$reciever_state);
				
				$whr_p = array('pin_code'=>$reciever_pincode);
				$qry = $this->basic_operation_m->update('pincode', $pincode_data, $whr_p);				
			}

			if($all_Data['doc_type'] == 0)
			{
				$doc_nondoc			= 'Document';
			}
			else
			{
				$doc_nondoc			= 'Non Document';
			}	
			$result 		= $this->db->query('select max(booking_id) AS id from tbl_domestic_booking')->row();
	        $id 			= $result->id + 1;
	        $idnew 			= $result->id + 1;
	     
			$bracnh_prefix 		=   substr($branch_info->branch_code, -2);
			
			// if (strlen($id) == 2) 
			// {
	  //           $id = $company_info->company_code.$bracnh_prefix.'1000'.$id;
	  //       }
			// elseif (strlen($id) == 3) 
			// {
	  //           $id = $company_info->company_code.$bracnh_prefix.'100'.$id;
	  //       }
			// elseif (strlen($id) == 1) 
			// {
	  //           $id = $company_info->company_code.$bracnh_prefix.'10000'.$id;
	  //       }
			// elseif (strlen($id) == 4) 
			// {
	  //           $id = $company_info->company_code.$bracnh_prefix.'10'.$id;
	  //       }
			// elseif (strlen($id) == 5) 
			// {
	  //           $id = $company_info->company_code.$bracnh_prefix.'1'.$id;
	  //       }	
			

			$id = 50100001 + $idnew;
	        $pod_no =trim($this->input->post('awn'));
	        if($pod_no!="")
	        {
	        	$awb_no = $pod_no;
	        }
			else
			{
	        	$awb_no =$id;
	        }
			
			$is_appointment = ($this->input->post('is_appointment') == 'ON')?1:0;
			//booking details//
			$data = array(
				'doc_type'=>$this->input->post('doc_type'),
				'doc_nondoc'=>$doc_nondoc,
				'courier_company_id'=>$this->input->post('courier_company'),
				'company_type'=>'Domestic',
				'mode_dispatch' => $this->input->post('mode_dispatch'),
				'pod_no' => $awb_no,
				'forwording_no' => $this->input->post('forwording_no'),
				'forworder_name' => $this->input->post('forworder_name'),
				'risk_type' => $this->input->post('risk_type'),
				'customer_id' => $this->input->post('customer_account_id'),
				'sender_name' => $this->input->post('sender_name'),
				'sender_address' => $this->input->post('sender_address'),
				'sender_city' => $this->input->post('sender_city'),
				'sender_state'=> $this->input->post('sender_state'),
				'sender_pincode' => $this->input->post('sender_pincode'),
				'sender_contactno' => $this->input->post('sender_contactno'),
				'sender_gstno' => $this->input->post('sender_gstno'),
				'reciever_name' => $this->input->post('reciever_name'),
				'contactperson_name' => $this->input->post('contactperson_name'),				
				'reciever_address' => $this->input->post('reciever_address'),
				'reciever_contact' => $this->input->post('reciever_contact'),
				'reciever_pincode' => $this->input->post('reciever_pincode'),
				'reciever_city' => $this->input->post('reciever_city'),
				'reciever_state' => $this->input->post('reciever_state'),
				'receiver_zone' => $this->input->post('receiver_zone'),
				'receiver_zone_id' => $this->input->post('receiver_zone_id'),
				'receiver_gstno'=>$this->input->post('receiver_gstno'),
				'is_appointment'=>$is_appointment,
				'ref_no'=>$this->input->post('ref_no'),
				'invoice_no'=>$this->input->post('invoice_no'),
				'invoice_value' => $this->input->post('invoice_value'),
				'eway_no' => $this->input->post('eway_no'),
				'eway_expiry_date' => $this->input->post('eway_expiry_date'),
				'special_instruction' => $this->input->post('special_instruction'),
				//'type_of_pack' => $this->input->post('type_of_pack'),
				'booking_date' =>$date,				
				'booking_time' =>date('H:i:s',strtotime($this->input->post('booking_date'))),				
				'dispatch_details' => $this->input->post('dispatch_details'),
				'delivery_date' => $this->input->post('delivery_date'),
				'payment_method' => $this->input->post('payment_method'),
				'frieht' => $this->input->post('frieht'),
				'transportation_charges' => $this->input->post('transportation_charges'),
				'insurance_charges' => $this->input->post('insurance_charges'),
				'pickup_charges' => $this->input->post('pickup_charges'),
				'delivery_charges' => $this->input->post('delivery_charges'),
				'courier_charges' => $this->input->post('courier_charges'),
				'awb_charges' => $this->input->post('awb_charges'),
				'other_charges' => $this->input->post('other_charges'),
				'total_amount' => $this->input->post('amount'),
				'fuel_subcharges' => $this->input->post('fuel_subcharges'),
				'e_invoice' => $this->input->post('e_invoice'),
				'type_shipment' => $this->input->post('type_shipment'),
				'sub_total' => $this->input->post('sub_total'),		
				'cgst' => $this->input->post('cgst'),			
				'sgst' => $this->input->post('sgst'),			
				'igst' => $this->input->post('igst'),			
				'green_tax' => $this->input->post('green_tax'),			
				'appt_charges' => $this->input->post('appt_charges'),			
				'grand_total' => $this->input->post('grand_total'),		
				'user_id' =>$user_id,
				'user_type' =>$user_type,				
				'branch_id' => $branch_id,
				'booking_type'=>1,
				
				);
		
		
				$query = $this->basic_operation_m->insert('tbl_domestic_booking', $data);

				$all_Data = $this->input->post();
			
		
				$lastid = $this->db->insert_id();
				if(empty($lastid))
				{
					
					$data['error'][] = "Already Exist ". $this->input->post('awn').'<br>';	
				}
				else
				{	
					//$lastid = $this->db->insert_id();


					// echo "<pre>";

					$weight_data = array(
						'per_box_weight_detail' => $all_Data['per_box_weight_detail'],
						'length_detail' => $all_Data['length_detail'],
						'breath_detail' => $all_Data['breath_detail'],
						'height_detail' => $all_Data['height_detail'],
						'valumetric_weight_detail' => $all_Data['valumetric_weight_detail'],
						'valumetric_actual_detail' => $all_Data['valumetric_actual_detail'],
						'valumetric_chageable_detail' => $all_Data['valumetric_chageable_detail'],
						'per_box_weight' => $all_Data['per_box_weight'],
						'length' => $all_Data['length'],
						'breath' => $all_Data['breath'],
						'height' => $all_Data['height'],
						'valumetric_weight' => $all_Data['valumetric_weight'],
						'valumetric_actual' => $all_Data['valumetric_actual'],
						'valumetric_chageable' => $all_Data['valumetric_chageable'],
					);

					$weight_details = json_encode($weight_data);

						
					$data2 = array(						
						'booking_id' => $lastid,
						'actual_weight' => $this->input->post('actual_weight'),
						'valumetric_weight' => $this->input->post('valumetric_weight'),
						'length' => $this->input->post('length'),
						'breath' => $this->input->post('breath'),
						'height' => $this->input->post('height'),					
						'chargable_weight' => $this->input->post('chargable_weight'),
						'per_box_weight' => $this->input->post('per_box_weight'),
						'no_of_pack' => $this->input->post('no_of_pack'),						
						'actual_weight_detail' => json_encode($this->input->post('actual_weight')),
						'valumetric_weight_detail' => json_encode($this->input->post('valumetric_weight_detail[]')),
						'chargable_weight_detail' => json_encode($this->input->post('chargable_weight')),
						'length_detail' => json_encode($this->input->post('length_detail[]')),
						'breath_detail' => json_encode($this->input->post('breath_detail[]')),
						'height_detail' => json_encode($this->input->post('height_detail[]')),						
						'no_pack_detail' => json_encode($this->input->post('no_of_pack')),
						'per_box_weight_detail' =>json_encode($this->input->post('per_box_weight_detail[]')),
						'weight_details' =>$weight_details,
					);
						
					// 	echo "<pre>";print_r($data2);
					// 	exit();

					$query2 = $this->basic_operation_m->insert('tbl_domestic_weight_details', $data2);
								
					$username = $this->session->userdata("userName");
					$whr = array('username' => $username);
					$res = $this->basic_operation_m->getAll('tbl_users', $whr);
					$branch_id = $res->row()->branch_id;
					
					$whr = array('branch_id' => $branch_id);
					$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
					$branch_name = $res->row()->branch_name;
								
					$whr = array('booking_id' => $lastid);
					$res = $this->basic_operation_m->getAll('tbl_domestic_booking', $whr);
					$podno = $res->row()->pod_no;
					$customerid= $res->row()->customer_id;
					$data3 = array('id' => '',
						'pod_no' => $podno,
						'status' => 'Booked',
						'branch_name' => $branch_name,
						'tracking_date' => $this->input->post('booking_date'),
						'booking_id' => $lastid,
						'forworder_name' => $data['forworder_name'],
						'forwording_no' => $data['forwording_no'],
						'is_spoton' => ($data['forworder_name'] == 'spoton_service') ? 1 : 0,
						'is_delhivery_b2b' => ($data['forworder_name'] == 'delhivery_b2b') ? 1 : 0,
						'is_delhivery_c2c' => ($data['forworder_name'] == 'delhivery_c2c') ? 1 : 0
					);
					
					$result3 = $this->basic_operation_m->insert('tbl_domestic_tracking', $data3);
					if($this->input->post('customer_account_id')!="")
					{
						$whr = array('customer_id'=>$customerid);
						$res=$this->basic_operation_m->getAll('tbl_customers',$whr);
						$email= $res->row()->email;
					}
					$msg='Your Shipment '.$podno.' status:Boked  At Location: '.$branch_name;
					
					
					$class	= 'alert alert-success alert-dismissible';	
				
					$this->session->set_flashdata('notify',$msg);
					$this->session->set_flashdata('class',$class);
			}
			
			redirect('admin/view-add-domestic-shipment');
		}
	}
	public function edit_domestic_shipment($id) 
	{
		$data['message'] = "";
		$data['transfer_mode']= $this->basic_operation_m->get_query_result('SELECT * FROM transfer_mode');
		
		$data['cities'] = $this->basic_operation_m->get_all_result('city','');
		$data['states'] = $this->basic_operation_m->get_all_result('state','');		
		$user_id 	= $this->session->userdata("userId");
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") 
		{
			$data['booking'] = $this->basic_operation_m->get_table_row('tbl_domestic_booking', $whr);
			
			$data['weight'] = $this->basic_operation_m->get_table_row('tbl_domestic_weight_details', $whr);
			
			$user_type 	= $this->session->userdata("userType");
			if($user_type == 1)
			{
				$data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', "");
			}
			else
			{
				$username = $this->session->userdata("userName");
			 $whr = array('username' => $username);
			 $res = $this->basic_operation_m->getAll('tbl_users', $whr);
			 $branch_id = $res->row()->branch_id;				
			$where ="branch_id='$branch_id' ";
			
				$data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', "branch_id = '$branch_id'");
			}
		
		}	
		$data['payment_method']  = $this->basic_operation_m->get_all_result('payment_method', '');
		$whr_d= array("company_type"=>"Domestic");
		$data['courier_company'] = $this->basic_operation_m->get_all_result("courier_company",$whr_d);	
		$data['country_list'] = $this->basic_operation_m->get_all_result('zone_master');		   
		$data['booking_id']=$id;
	   	$this->load->view('admin/domestic_shipment/view_edit_domestic_shipment', $data);
	}
    public function update_domestic_shipment($id)
	{
		$all_data 		= $this->input->post();
		$all_data2 		= $this->input->post();


		if (!empty($all_data)) 
		{
			$whr = array('booking_id' => $id);
			$date = date('Y-m-d',strtotime($this->input->post('booking_date')));
				//booking details//
				
				if($this->input->post('doc_type') == 0)
				{
					$doc_nondoc			= 'Document';
				}
				else
				{
					$doc_nondoc			= 'Non Document';
				}
				
			$username = $this->session->userdata("userName");
			$user_id = $this->session->userdata("userId");
			$user_type = $this->session->userdata("userType");
			$whr_u = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr_u);
			$branch_id = $res->row()->branch_id;

			$date = date('Y-m-d',strtotime( $this->input->post('booking_date')));

			$reciever_pincode= $this->input->post('reciever_pincode');
			$reciever_city= $this->input->post('reciever_city');
			$reciever_state= $this->input->post('reciever_state');

			$whr_pincode = array('pin_code'=>$reciever_pincode,'city_id'=>$reciever_city,'state_id'=>$reciever_state); 
			$check_city =$this->basic_operation_m->get_table_row('pincode',$whr_pincode);
			//echo "++++".$this->db->last_query();
			if(empty($check_city))
			{	$whr_C =array('id'=>$reciever_city);
				$city_details = $this->basic_operation_m->get_table_row('city',$whr_C);
				$whr_S =array('id'=>$reciever_state);
				$state_details = $this->basic_operation_m->get_table_row('state',$whr_S);

				$pincode_data = array(
					'pin_code'=>$reciever_pincode,
					'city'=>$city_details->city,
					'city_id'=>$reciever_city,
					'state'=>$state_details->state,
					'state_id'=>$reciever_state);
				
				$whr_p = array('pin_code'=>$reciever_pincode);
				$qry = $this->basic_operation_m->update('pincode', $pincode_data, $whr_p);				
			}
			$is_appointment = ($this->input->post('is_appointment') == 'ON')?1:0;
			//booking details//
			$data = array(
				'doc_type'=>$this->input->post('doc_type'),
				'doc_nondoc'=>$doc_nondoc,
				'courier_company_id'=>$this->input->post('courier_company'),
				'company_type'=>'Domestic',
				'mode_dispatch' => $this->input->post('mode_dispatch'),
				'pod_no' => $this->input->post('awn'),
				'forwording_no' => $this->input->post('forwording_no'),
				'forworder_name' => $this->input->post('forworder_name'),
				'risk_type' => $this->input->post('risk_type'),
				'customer_id' => $this->input->post('customer_account_id'),
				'sender_name' => $this->input->post('sender_name'),
				'sender_address' => $this->input->post('sender_address'),
				'sender_city' => $this->input->post('sender_city'),
				'sender_state'=> $this->input->post('sender_state'),
				'sender_pincode' => $this->input->post('sender_pincode'),
				'sender_contactno' => $this->input->post('sender_contactno'),
				'sender_gstno' => $this->input->post('sender_gstno'),
				'edited_date' => $this->input->post('edited_date'),
				'edited_by' => $this->input->post('edited_by'),
				'edited_branch' => $this->input->post('edited_branch'),

				'reciever_name' => $this->input->post('reciever_name'),
				'contactperson_name' => $this->input->post('contactperson_name'),				
				'reciever_address' => $this->input->post('reciever_address'),
				'reciever_contact' => $this->input->post('reciever_contact'),
				'reciever_pincode' => $this->input->post('reciever_pincode'),
				'reciever_city' => $this->input->post('reciever_city'),
				'reciever_state' => $this->input->post('reciever_state'),
				'receiver_zone' => $this->input->post('receiver_zone'),
				'receiver_zone_id' => $this->input->post('receiver_zone_id'),
				'receiver_gstno'=>$this->input->post('receiver_gstno'),	
				'is_appointment'=>$is_appointment,	
				'ref_no'=>$this->input->post('ref_no'),
				'invoice_no'=>$this->input->post('invoice_no'),
				'invoice_value' => $this->input->post('invoice_value'),
				'eway_no' => $this->input->post('eway_no'),
				'eway_expiry_date' => date('Y-m-d H:i:s',strtotime($this->input->post('eway_expiry_date'))),
				'delivery_date' => $this->input->post('delivery_date'),
				'special_instruction' => $this->input->post('special_instruction'),
				//'type_of_pack' => $this->input->post('type_of_pack'),
				'booking_date' =>$date,				
				'booking_time' =>date('H:i:s',strtotime($this->input->post('booking_date'))),								
				'dispatch_details' => $this->input->post('dispatch_details'),
				'payment_method' => $this->input->post('payment_method'),

				'frieht' => $this->input->post('frieht'),
				'transportation_charges' => $this->input->post('transportation_charges'),
				'insurance_charges' => $this->input->post('insurance_charges'),
				'pickup_charges' => $this->input->post('pickup_charges'),
				'delivery_charges' => $this->input->post('delivery_charges'),
				'courier_charges' => $this->input->post('courier_charges'),
				'awb_charges' => $this->input->post('awb_charges'),
				'other_charges' => $this->input->post('other_charges'),
				'fov_charges' => $this->input->post('fov_charges'),
				'green_tax' => $this->input->post('green_tax'),
				'appt_charges' => $this->input->post('appt_charges'),
				'e_invoice' => $this->input->post('e_invoice'),
				'type_shipment' => $this->input->post('type_shipment'),
				'total_amount' => $this->input->post('amount'),
				'fuel_subcharges' => $this->input->post('fuel_subcharges'),
				'sub_total' => $this->input->post('sub_total'),		
				'cgst' => $this->input->post('cgst'),			
				'sgst' => $this->input->post('sgst'),			
				'igst' => $this->input->post('igst'),			
				'grand_total' => $this->input->post('grand_total'),		

				'user_id' =>$user_id,
				'user_type' =>$user_type,				
				'branch_id' => $branch_id,
				'booking_type'=>1,
				
				);
				// echo '<pre>';print_r($_POST);die;
				$query = $this->basic_operation_m->update('tbl_domestic_booking', $data, $whr);
			

			$check_invoice_pod = $this->basic_operation_m->get_table_row('tbl_domestic_invoice_detail', $whr);
           // echo $this->db->last_query();
             if(!empty($check_invoice_pod) ){
                    $data_invoice_details = array( 
                    	'no_of_pack'=> $this->input->post('no_of_pack'),
                    	'chargable_weight' => $this->input->post('chargable_weight'),             
                        'frieht' => $this->input->post('frieht'),
                        'transportation_charges' => $this->input->post('transportation_charges'),
                        'pickup_charges' => $this->input->post('pickup_charges'),
                        'delivery_charges' => $this->input->post('delivery_charges'),
                        'courier_charges' => $this->input->post('courier_charges'),
                        'awb_charges'=>$this->input->post('awb_charges'),
                        'other_charges' => $this->input->post('other_charges'),
                        'amount' => $this->input->post('amount'),
                        'fuel_subcharges' => $this->input->post('fuel_subcharges'), 
                        'sub_total' => $this->input->post('sub_total'),                
                        );
                    $query = $this->basic_operation_m->update('tbl_domestic_invoice_detail', $data_invoice_details, $whr);
           }
				

           		$weight_data = array(
					'per_box_weight_detail' => $all_data2['per_box_weight_detail'],
					'length_detail' => $all_data2['length_detail'],
					'breath_detail' => $all_data2['breath_detail'],
					'height_detail' => $all_data2['height_detail'],
					'valumetric_weight_detail' => $all_data2['valumetric_weight_detail'],
					'valumetric_actual_detail' => $all_data2['valumetric_actual_detail'],
					'valumetric_chageable_detail' => $all_data2['valumetric_chageable_detail'],
					'per_box_weight' => $all_data2['per_box_weight'],
					'length' => $all_data2['length'],
					'breath' => $all_data2['breath'],
					'height' => $all_data2['height'],
					'valumetric_weight' => $all_data2['valumetric_weight'],
					'valumetric_actual' => $all_data2['valumetric_actual'],
					'valumetric_chageable' => $all_data2['valumetric_chageable'],
				);

				$weight_details = json_encode($weight_data);

				// echo "<pre>";
				// print_r($weight_details);
				// exit();

				$data2 = array(						
						'actual_weight' => $this->input->post('actual_weight'),
						'valumetric_weight' => $this->input->post('valumetric_weight'),
						'length' => $this->input->post('length'),
						'breath' => $this->input->post('breath'),
						'height' => $this->input->post('height'),					
						'chargable_weight' => $this->input->post('chargable_weight'),
						'per_box_weight' => $this->input->post('per_box_weight'),
						'no_of_pack' => $this->input->post('no_of_pack'),						
						'actual_weight_detail' => json_encode($this->input->post('actual_weight')),
						'valumetric_weight_detail' => json_encode($this->input->post('valumetric_weight_detail[]')),
						'chargable_weight_detail' => json_encode($this->input->post('chargable_weight')),
						'length_detail' => json_encode($this->input->post('length_detail[]')),
						'breath_detail' => json_encode($this->input->post('breath_detail[]')),
						'height_detail' => json_encode($this->input->post('height_detail[]')),						
						'no_pack_detail' => json_encode($this->input->post('no_of_pack')),
						'per_box_weight_detail' =>json_encode($this->input->post('per_box_weight_detail[]')),
						'weight_details' =>$weight_details,
					);
						
				


				$query2 = $this->basic_operation_m->update('tbl_domestic_weight_details', $data2, $whr);


			
				$username = $this->session->userdata("userName");
				$whr = array('username' => $username);
				$res = $this->basic_operation_m->getAll('tbl_users', $whr);
				$branch_id = $res->row()->branch_id;
				
				$whr = array('branch_id' => $branch_id);
				$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
				$branch_name = $res->row()->branch_name;
							
				$whr = array('booking_id' => $id);
				$res = $this->basic_operation_m->getAll('tbl_domestic_booking', $whr);
				$podno = $res->row()->pod_no;
				$customerid= $res->row()->customer_id;
				// $data3 = array('id' => '',
				// 	'pod_no' => $podno,
				// 	'status' => 'booked',
				// 	'branch_name' => $branch_name,
				// 	'tracking_date' => $date,
				// 	'booking_id' => $id,
				// 	'forworder_name' => $data['forworder_name'],
				// 	'forwording_no' => $data['forwording_no'],
				// 	'is_spoton' => ($data['forworder_name'] == 'spoton_service') ? 1 : 0,
				// 	'is_delhivery_b2b' => ($data['forworder_name'] == 'delhivery_b2b') ? 1 : 0,
				// 	'is_delhivery_c2c' => ($data['forworder_name'] == 'delhivery_c2c') ? 1 : 0
				// );
				
				// $result3 = $this->basic_operation_m->insert('tbl_domestic_tracking', $data3);
			
			//$query2 = $this->basic_operation_m->update('tbl_weight_details', $data2, $whr);
		
			if ($this->db->affected_rows() > 0) 
			{
				$data['message'] = "Data added successfull";
			}
			else 
			{
				$data['message'] = "Failed to Submit";
			}
	
		redirect('admin/view-domestic-shipment');
		}
	}
		public function getFuelcharges() 
		{
		$customer_id = $this->input->post('customer_id');
		$dispatch_details = $this->input->post('dispatch_details');
		$courier_id = $this->input->post('courier_id');
		$sub_amount = $this->input->post('sub_amount');
		$booking_date = $this->input->post('booking_date');
       

	    $current_date = date("Y-m-d",strtotime($booking_date));
		
		$whr1 = array('courier_id' => $courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => $customer_id);
		$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
		if(empty($res1))
		{
			$whr1 = array('courier_id' => $courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => '0');
			$res1 = $this->basic_operation_m->get_query_row("select * from courier_fuel where (courier_id = '$courier_id' or courier_id='0') and fuel_from <= '$current_date' and fuel_to >='$current_date' and (customer_id = '0' or customer_id = '$customer_id')");
		}
		
		//$whr1 = array('courier_id' => $courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date);
		//$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
		if($res1){$fuel_per = $res1->fuel_price; }else{$fuel_per ='0';}

		$final_fuel_charges =($sub_amount * $fuel_per/100);
			
		$sub_total =($sub_amount + $final_fuel_charges);
		 
        
		$gst_details =$this->basic_operation_m->get_query_row('select * from tbl_gst_setting order by id desc limit 1');

            //echo $this->db->last_query();

		if($gst_details){
			$cgst_per = $gst_details->cgst; 
			$sgst_per = $gst_details->sgst; 
			$igst_per = $gst_details->igst; 
		}else{
			$cgst_per = '0'; 
			$sgst_per = '0'; 
			$igst_per = '0'; 
		}    
		
	  
	   
	   $tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
		if($tbl_customers_info->gst_charges == 1)
		{
			$cgst = ($sub_total*$cgst_per/100);
			$sgst = ($sub_total*$sgst_per/100);
			$igst = 0;	
		}
		else
		{
			$cgst = 0;
			$sgst = 0;
			$igst = 0;
		}
		
		if($dispatch_details == 'Cash')
		{	
			$cgst = ($sub_total*$cgst_per/100);
			$sgst = ($sub_total*$sgst_per/100);
			$igst = 0;
		}
	   
	   
	   $grand_total1 = $sub_total + $cgst + $sgst + $igst;
		
       $grand_total = round($grand_total1);
		$result2= array('final_fuel_charges'=>$final_fuel_charges,
						'sub_total'=>number_format($sub_total, 2, '.', ''),
                        'cgst'=>number_format($cgst, 2, '.', ''),
                        'sgst'=>number_format($sgst, 2, '.', ''),
						'igst'=>number_format($igst, 2, '.', ''),
						'grand_total'=>number_format($grand_total, 2, '.', ''),
					);
		echo json_encode($result2);
		
		
	}


	public function getsenderdetails() {
		$data = [];  
		$customer_name = $this->input->post('customer_name');
		$whr1 = array('customer_id' => $customer_name);
		//$res1 = $this->basic_operation_m->selectRecord('tbl_customers', $whr1);

		$res1 = $this->basic_operation_m->get_customer_details($whr1);
		//$result1 = $res1->row();
		$data['user'] = $res1;
		echo json_encode($data);
		exit;
	}
	 public function check_duplicate_forwording_no() {
        $data = [];  
        $forwording_no = $this->input->post('forwording_no');
        $whr = array('forwording_no' => $forwording_no);
        $result = $this->basic_operation_m->get_table_row('tbl_domestic_booking', $whr);

        $forwording_no = $result->forwording_no;
        if($forwording_no!="")
        {
            $data['msg'] = "Forwording number is duplicate ";
        }else{
            $data['msg'] = "";
        }

        echo json_encode($data);
        exit;
    }
	// public function ajax_country_search()
	// {
	// 	$val = $this->input->post('val');
	// 	$auto_search_result = $this->Rate_model->select_ajax_country($val);
	// 	// echo "<pre>";
	// 	// print_r($auto_search_result);exit;
	// }
	// public function getcity() {
	// 	// $pincode = $this->input->post('pincode');
	// 	// $whr1 = array('pin_code' => $pincode);
	// 	// $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);	
		
	// 	// $city_id = $res1->row()->city_id;
		
	// 	// $whr2 = array('id' => $city_id);
	// 	// $res2 = $this->basic_operation_m->selectRecord('city', $whr2);
	// 	// $result2 = $res2->row();

	// 	//echo json_encode($result2);

	// 	$html 	 = '';
	// 	$alldata = $this->input->post();
	// 	if(!empty($alldata))
	// 	{

	// 		$all_airport= $this->basic_operation_m->get_query_result("SELECT * FROM city WHERE (city like '%" . $alldata["keyword"] . "%') LIMIT 5");
	// 		if(!empty($all_airport)) 
	// 		{	
	// 			$html		.='<ul id="city-list" >';
				
	// 				foreach($all_airport as $airport_list) 
	// 				{
				
	// 					$city		= "'".$airport_list->city."'";
	// 					if($alldata['box'] == 1)
	// 					{
	// 						$html		.='<li onClick="selectCountry('.$city.');">'.$airport_list->city.'</li>';
	// 					}
	// 					else
	// 					{
	// 						$html		.='<li onClick="selectCountry('.$city.');">'.$airport_list->city.'</li>';
	// 					}
	// 				}
				
	// 			$html		.='</ul>';
	// 		}

	// 	}
	// 	echo $html;
		
	//}
	public function getCityList() {
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);	
		
		$city_id = $res1->row()->city_id;
		
		$whr2 = array('id' => $city_id);
		$res2 = $this->basic_operation_m->get_table_row('city', $whr2);
		$pincode_city = $res2->id;

		$city_list= $this->basic_operation_m->get_all_result('city', '');

		$resAct = $this->db->query("select service_pincode.*,courier_company.c_id,courier_company.c_company_name from service_pincode JOIN courier_company on courier_company.c_id=service_pincode.forweder_id where pincode='".$pincode."' order by serv_pin_id DESC ");

		$data = array();
		$data['forwarder'] = array();
		if ($resAct->num_rows() > 0) 
        {
            $data['forwarder'] = $resAct->result_array();
        }

		$option="";
		$forwarder="";
		foreach ($city_list as $value) { 
			if($value["id"]==$pincode_city){$selected ="selected";}else{ $selected="";}
			$option.='<option value="'. $value["id"].'" '. $selected.' >'.$value["city"].'</option>';
		}

		if (!empty($data['forwarder'])) {
			foreach ($data['forwarder'] as $key => $value) {
				$servicable = '';
				// if ($value['servicable']==0) {
				// 	//$servicable = 'no service';
				// }else{
				// 	$servicable = 'service';
				// }

				if ($value['oda']==1) {
					
					$servicable = ' - ODA Available';
					
				}else{
					// $servicable = ' ODA Available';
				}
				$forwarder.= "<option value='".$value["c_company_name"]."'>".$value["c_company_name"]."".$servicable."</option>";
			}
		}

		$forwarder.= "<option value='SELF'>SELF</option>";
		unset($data['forwarder']);
		$data['option'] = $option;
		$data['forwarder2'] = $forwarder;

		echo json_encode($data);
	}
	public function getState() {
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);	
		
		$state_id = $res1->row()->state_id;
		if(!empty($state_id))
		{
			$whr3 = array('id' => $state_id);
			$res3 = $this->basic_operation_m->get_table_row('state', $whr3);
			$pincode_state = $res3->id;
			

			$state_list= $this->basic_operation_m->get_all_result('state', '');
			$option="";
			foreach ($state_list as $value) { 
				if($value["id"]==$pincode_state){$selected ="selected";}else{ $selected="";}
				$option.='<option value="'. $value["id"].'" '. $selected.' >'.$value["state"].'</option>';
				}
		}
		else
		{
			$option	= array();
		}


		echo json_encode($option);
		
	}
	public function delete_domestic_shipment() 
	{
			$id = $this->input->post('getid');
		if ($id != "") {
			$whr = array('booking_id' => $id);
			$res = $this->basic_operation_m->delete('tbl_domestic_booking', $whr);
			$res1= $this->basic_operation_m->delete('tbl_domestic_weight_details', $whr);
			$res2= $this->basic_operation_m->delete('tbl_domestic_tracking', $whr);

			 	$output['status'] = 'success';
			$output['message'] = 'Shipment deleted successfully';
		}
		else{
			$output['status'] = 'error';
			$output['message'] = 'Something went wrong in deleting the Shipment';
		}
 
		echo json_encode($output);	
	}
		

	
// 	public function delete_domestic_shipment($id) 
// 	{
		
// 		if ($id != "") {
// 			$whr = array('booking_id' => $id);
// 			$res = $this->basic_operation_m->delete('tbl_domestic_booking', $whr);
// 			$res1= $this->basic_operation_m->delete('tbl_domestic_weight_details', $whr);
// 			$res2= $this->basic_operation_m->delete('tbl_domestic_tracking', $whr);

// 			$msg= 'Entry deleted successfully';
// 			$class= 'alert alert-danger alert-dismissible';	
// 			$this->session->set_flashdata('notify',$msg);
// 		    $this->session->set_flashdata('class',$class);

// 			redirect('admin/view-domestic-shipment');
// 		}
// 	}

	public function print_label($id) 
	{
	    // Load library
	    $this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") {	
			$data['booking'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $whr);
			$where =array('id'=>1);
		    $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);
			// echo '<pre>'; print_r($data['booking']); die;
			$this->load->view('admin/domestic_shipment/print_shipment', $data);
		}
	}

    public function all_printpod($booking_id='') 
    {  
        // Load library
        $this->load->library('zend');

        $data['multi']= '1'; 
        // Load in folder Zend
        $this->zend->load('Zend/Barcode');
        $post_Data= $this->input->post();
        if(!empty($post_Data))
        {
            $data= array();
            $where = "customer_id = '".$post_Data['user_id']."' AND (tbl_domestic_booking.booking_date >= '".$post_Data['from_date']."' AND tbl_domestic_booking.booking_date <= '".$post_Data['to_date']."')";
            
            $user_id = $this->session->userdata("userId");
            $user_type = $this->session->userdata("userType");
            
           $resAct = $this->db->query("select * from tbl_domestic_booking where $whr GROUP BY booking_id order by booking_date DESC ");

            if ($resAct->num_rows() > 0) 
            {
                $data['booking'] = $resAct->result_array();
            }   
            
            $where =array('id'=>1);
            $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);   
        
            $this->load->view('admin/domestic_shipment/print_shipment', $data);
        }
        elseif($booking_id)
        {
            $data['selected_lists'] = explode('-',$booking_id);
            $booking_ids            = array_unique(array_filter($data['selected_lists']));
            
            $booking_idsa           = implode("','",$booking_ids);
            $whr                    = "tbl_domestic_booking.booking_id IN ('$booking_idsa')";
            
            $user_id = $this->session->userdata("userId");
            $user_type = $this->session->userdata("userType");         
                
            $resAct = $this->db->query("select * from tbl_domestic_booking where $whr GROUP BY booking_id order by booking_date DESC ");

            if ($resAct->num_rows() > 0) 
            {
                $data['booking'] = $resAct->result_array();
            }  
            $where =array('id'=>1);
            $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);   
        
            $this->load->view('admin/domestic_shipment/print_shipment', $data);
        }
    }
	public function getZone() {
		$reciever_state = $this->input->post('reciever_state');
		$reciever_city =  $this->input->post('reciever_city');

		$whr1 = array('state' => $reciever_state,'city' => $reciever_city);
		$res1 = $this->basic_operation_m->selectRecord('region_master_details', $whr1);	
		
		$regionid = $res1->row()->regionid;

		$whr3 = array('region_id' => $regionid);
		$res3 = $this->basic_operation_m->selectRecord('region_master', $whr3);
		$result3 = $res3->row();

		echo json_encode($result3);
		
	}
	public function view_upload_domestic_shipment()
	{
		$this->load->view('admin/domestic_shipment/view_upload_domestic_shipment');
	}
	public function upload_domestic_shipment()
	{
		$data = [];			
		$username = $this->session->userdata("userName");
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		
		$extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
		if($extension!="csv")
		{	
			$msg			= 'Please uploade csv file.';
			$class			= 'alert alert-danger alert-dismissible';	
			$this->session->set_flashdata('notify',$msg);
			$this->session->set_flashdata('class',$class);
			
			
		}else{
			$file = fopen($_FILES['uploadFile']['tmp_name'],"r");
			$heading_array = array();
			$cnt = 0;
				
			while(!feof($file))
			{
				$data	= fgetcsv($file);
				if(!empty($data))
				{	 
				 	if($cnt>0)
				  	{
					 	$username = $this->session->userdata("userName");
					 	$user_id = $this->session->userdata("userId");
					 	$user_type = $this->session->userdata("userType");
					
						$whr = array('username' => $username);
						$res = $this->basic_operation_m->getAll('tbl_users', $whr);
						$branch_id = $res->row()->branch_id;
						
						$customer_info =$this->basic_operation_m->get_table_row('tbl_customers',array('cid' => $data[0]));
						$company_info =$this->basic_operation_m->get_table_row('tbl_company',array('id'=>$customer_info->company_id));
						$branch_info =$this->basic_operation_m->get_table_row('tbl_branch',array('branch_id'=>$branch_id));
						$bracnh_prefix 		=   substr($branch_info->branch_code, -2);
						$booking_date = date('Y-m-d',strtotime($data[1]) );
						if($data[5] == 0)
						{
							$doc_nondoc			= 'Document';
						}
						else
						{
							$doc_nondoc			= 'Non Document';
						}	
						$result 		= $this->basic_operation_m->get_query_row('select max(booking_id) AS id from tbl_domestic_booking');
						$id 			= $result->id + 1;
						$idnew 			= $result->id + 1;
						
						// if (strlen($id) == 2) 
						// {
						// 	$id = $company_info->company_code.$bracnh_prefix.'1000'.$id;
						// }
						// elseif (strlen($id) == 3) 
						// {
						// 	$id = $company_info->company_code.$bracnh_prefix.'100'.$id;
						// }
						// elseif (strlen($id) == 1) 
						// {
						// 	$id = $company_info->company_code.$bracnh_prefix.'10000'.$id;
						// }
						// elseif (strlen($id) == 4) 
						// {
						// 	$id = $company_info->company_code.$bracnh_prefix.'10'.$id;
						// }
						// elseif (strlen($id) == 5) 
						// {
						// 	$id = $company_info->company_code.$bracnh_prefix.'1'.$id;
						// }
						
						$id = 50100001 + $idnew;	
						
						$pod_no =trim($this->input->post('awn'));
						if($pod_no!="")
						{
							$awb_no = $pod_no;
						}else{
							$awb_no =$id;
						}
						
						
						//============Get Customer details//
						$whr = array('cid' => $data[0]);
						$customerRes = $this->basic_operation_m->get_table_row('tbl_customers', $whr);
						
						$customer_id = $customerRes->customer_id;
						$sender_name = $customerRes->customer_name;
						$sender_address = $customerRes->address;
						$sender_pincode = $customerRes->pincode;
						$sender_city = $customerRes->city;
						$sender_state = $customerRes->state;
						$sender_contactno = $customerRes->phone;
						$sender_gstno = $customerRes->gstno;	
						// courier id, mode id
						$modeDispatch = $data[4];
						$whr = array("mode_name"=>$modeDispatch);
						$mode_dispatch_detail = $this->basic_operation_m->get_table_row("transfer_mode",$whr);
						$mode_id = $mode_dispatch_detail->transfer_mode_id;
						 
						 
						$forworder = $data[2];
						$whr_c = array("c_company_name"=>$forworder);
						$courier_company_details = $this->basic_operation_m->get_table_row("courier_company",$whr_c);
						$c_courier_id = $courier_company_details->c_id;
						//============Fuel Gst	
						
						$city	= $this->input->post('city');
						$state 	= $this->input->post('state');		
						$doc_type 	= $this->input->post('doc_type'); 
						
						$reciever_pincode =$data[12];
						$sender_pincode 	=$data[20];
						
						$receiverCityDetails = $this->basic_operation_m->get_table_row('pincode', array('pin_code'=>$reciever_pincode));
						$senderCityDetails = $this->basic_operation_m->get_table_row('pincode', array('pin_code'=>$reciever_pincode));
						
						$reciever_state = $receiverCityDetails->state_id;
						$reciever_city =  $receiverCityDetails->city_id;

						$whr1 = array('state' => $reciever_state,'city' => $reciever_city);
						$res1 = $this->basic_operation_m->selectRecord('region_master_details', $whr1);	
						
						$regionid = $res1->row()->regionid;
						
						$whr3 = array('region_id' => $regionid);
						$res3 = $this->basic_operation_m->selectRecord('region_master', $whr3);
						$result3 = $res3->row();
						
						$zone_id = $result3->region_id;
						$region_name = $result3->region_name;
						
						$whr1 			= array('state' => $senderCityDetails->state_id,'city' => $senderCityDetails->city_id);
						$res1			= $this->basic_operation_m->selectRecord('region_master_details', $whr1);	
						
						$sender_zone_id 		= $res1->row()->regionid;
												
						$chargable_weight  = $data[18];
						//$receiver_gstno =$this->input->post('receiver_gstno');
						
						$current_date = date("Y-m-d",strtotime($booking_date));
						$chargable_weight	= $chargable_weight * 1000;
						$fixed_perkg		= 0;
						$addtional_250		= 0;
						$addtional_500		= 0;
						$addtional_1000		= 0;
							
						// calculationg fixed per kg price 	
						$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND from_zone_id='".$sender_zone_id."' AND to_zone_id='".$zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$data[18]." BETWEEN weight_range_from AND weight_range_to) and fixed_perkg = '0' ORDER BY applicable_from DESC LIMIT 1");
					
						
						
						$frieht=0;
						if ($fixed_perkg_result->num_rows() > 0) 
						{
							$data['rate_master'] = $fixed_perkg_result->row();
							$rate	= $data['rate_master']->rate;
							$fixed_perkg = $rate;
						}
						else
						{
							$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND from_zone_id='".$sender_zone_id."' AND to_zone_id='".$zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg = '0' ORDER BY applicable_from DESC,weight_range_to desc LIMIT 1");
							
							if ($fixed_perkg_result->num_rows() > 0) 
							{
								$data['rate_master']    = $fixed_perkg_result->row();
								$rate               	= $data['rate_master']->rate;
								$weight_range_to	    = round($data['rate_master']->weight_range_to * 1000);
								$fixed_perkg            = $rate;
							}
							
							$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND from_zone_id='".$sender_zone_id."' AND to_zone_id='".$zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg <> '0' ");
							
							if ($fixed_perkg_result->num_rows() > 0) 
							{
								if($weight_range_to > 1000)
								{
									$weight_range_to = $weight_range_to;
								}
								else
								{
									$weight_range_to = 1000;
								}
								$left_weight  = ($chargable_weight - $weight_range_to);
							
								$rate_master  = $fixed_perkg_result->result();
								
								foreach($rate_master as $key => $values)
								{
									
									if($values->fixed_perkg == 1) // 250 gm slab
									{
										
										$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
										$total_slab = $slab_weight/250;
										$addtional_250 = $addtional_250 + $total_slab * $values->rate;
										$left_weight = $left_weight - $slab_weight;
									}
									
									if($values->fixed_perkg == 2)// 500 gm slab
									{
										$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
									
										if($slab_weight < 1000)
										{
											if($slab_weight <= 500)
											{
												$slab_weight = 500;
											}
											else
											{
												$slab_weight = 1000;
											}
											
										}
										else
										{
											$diff_ceil = $slab_weight%1000;
											$slab_weight = $slab_weight - $diff_ceil;
										
											if($diff_ceil <= 500 && $diff_ceil != 0)
											{
											   
												$slab_weight = $slab_weight + 500;
											}
											elseif($diff_ceil <= 1000 && $diff_ceil != 0)
											{
											   
												$slab_weight = $slab_weight + 1000;
											}
										}
								
										$total_slab = $slab_weight/500;
										$addtional_500 = $addtional_500 +$total_slab * $values->rate;
										$left_weight = $left_weight - $slab_weight;
									
									}
									
									if($values->fixed_perkg == 3) // 1000 gm slab
									{
										$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
										$total_slab = ceil($slab_weight/1000);
										
										$addtional_1000 = $addtional_1000+ $total_slab * $values->rate;
										$left_weight = $left_weight - $slab_weight;
									}
								}
								
							}
							
						}	
		
						//echo $fixed_perkg ."-". $addtional_250 ."-". $addtional_500 ."-". $addtional_1000;exit;		
					
						$frieht = $fixed_perkg + $addtional_250 + $addtional_500 + $addtional_1000;
						$amount = $frieht;

						//	$whr1 = array('courier_id' => $c_courier_id);
						$whr1 = array('courier_id' => $c_courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date);
						$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
					
						if($res1){$fuel_per = $res1->fuel_price; }else{$fuel_per ='0';}
						$fuel_subcharges =($amount * $fuel_per/100);
				
						$sub_total =($amount + $fuel_subcharges);

						$first_two_char = substr($sender_gstno,0,2);
					
						if($sender_gstno=="")
						{
							$first_two_char=27;
						}

						if($first_two_char==27)
						{
							$cgst = ($sub_total*9/100);
							$sgst = ($sub_total*9/100);
							$igst = 0;
							$grand_total = $sub_total + $cgst + $sgst + $igst;
						}else{
							$cgst = 0;
							$sgst = 0;
							$igst = ($sub_total*18/100);
							$grand_total = $sub_total + $igst;
						}					
						
						//==============
						
						//booking details//
						$data_booking = array(
							'doc_type'=>$data[5],
							'doc_nondoc'=>$doc_nondoc,
							'courier_company_id'=>$c_courier_id,
							'company_type'=>'Domestic',
							'mode_dispatch' => $mode_id,
							'pod_no' => $awb_no,
							'forwording_no' => $data[3],
							'forworder_name' => $data[2],
							'customer_id' => $customer_id,
							'sender_name' => $sender_name,
							'sender_address' => $sender_address,
							'sender_city' => $sender_city,
							'sender_state'=> $sender_state,
							'sender_pincode' => $sender_pincode,
							'sender_contactno' => $sender_contactno,
							'sender_gstno' => $sender_gstno,
							'reciever_name' => $data[9],
							'contactperson_name' => $data[10],				
							'reciever_address' => $data[11],							
							'reciever_pincode' => $reciever_pincode,
							'reciever_city' => $reciever_city,
							'reciever_state' => $reciever_state,
							'receiver_zone'=>$region_name,
							'receiver_zone_id'=>$zone_id,
							'invoice_no'=>$data[7],
							'invoice_value' => $data[8],							
							'special_instruction' => $data[6],							
							'booking_date' =>$booking_date,				
							'dispatch_details' => 'Credit',										
							'frieht' => $frieht,
							'transportation_charges' => '0',
							'pickup_charges' => '0',
							'delivery_charges' => '0',
							'courier_charges' => '0',
							'awb_charges' => '0',
							'other_charges' => '0',							
							'total_amount' => $amount,
							'fuel_subcharges' => $fuel_subcharges,
							'sub_total' => $sub_total,		
							'cgst' => $cgst,			
							'sgst' => $sgst,			
							'igst' => $igst,			
							'grand_total' => $grand_total,
							'user_id' =>$user_id,
							'user_type' =>$user_type,				
							'branch_id' => $branch_id,
							'booking_type'=>1,							
						);
							
						//echo "<pre>"; print_r($data);
						$query = $this->basic_operation_m->insert('tbl_domestic_booking', $data_booking);	
						$lastid = $this->db->insert_id();
						//======================
						$valumetric_weight = (($data[15] * $data[16] * $data[17]) / 5000) * $data[13];	
							
						$data2 = array(						
							'booking_id' => $lastid,
							'actual_weight' => $data[14],
							'valumetric_weight' => $valumetric_weight,
							'length' => $data[15],
							'breath' => $data[16],
							'height' => $data[17],			
							'chargable_weight' => $chargable_weight,
							'per_box_weight' => $data[14],
							'no_of_pack' => $data[13],					
							'actual_weight_detail' => json_encode([$data[14]]),
							'valumetric_weight_detail' => json_encode([$valumetric_weight]),
							'chargable_weight_detail' => json_encode([$chargable_weight]),
							'length_detail' => json_encode([$data[15]]),
							'breath_detail' => json_encode([$data[16]]),
							'height_detail' => json_encode([$data[17]]),				
							'no_pack_detail' => json_encode([$data[13]]),
							'per_box_weight_detail' =>json_encode([$data[14]]),
						);

						$query2 = $this->basic_operation_m->insert('tbl_domestic_weight_details', $data2);
						
						$username = $this->session->userdata("userName");
						$whr = array('username' => $username);
						$res = $this->basic_operation_m->getAll('tbl_users', $whr);
						$branch_id = $res->row()->branch_id;
					
						$whr = array('branch_id' => $branch_id);
						$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
						$branch_name = $res->row()->branch_name;
									
						$whr = array('booking_id' => $lastid);
						$res = $this->basic_operation_m->getAll('tbl_domestic_booking', $whr);
						$podno = $res->row()->pod_no;
						$customerid= $res->row()->customer_id;
						$data3 = array('id' => '',
							'pod_no' => $podno,
							'status' => 'Booked',
							'branch_name' => $branch_name,
							'tracking_date' => $booking_date,
							'booking_id' => $lastid,
							'forworder_name' => $data[2],
							'forwording_no' => $data[3],
							'is_spoton' => ($data[2] == 'spoton_service') ? 1 : 0,
							'is_delhivery_b2b' => ($data[2] == 'delhivery_b2b') ? 1 : 0,
							'is_delhivery_c2c' => ($data[2] == 'delhivery_c2c') ? 1 : 0
						);
					
						$result3 = $this->basic_operation_m->insert('tbl_domestic_tracking', $data3);
									
					} //==end already exist condition
					$cnt++;			
				}
				$msg   = 'File uploaded successfully..';
				$class = 'alert alert-success alert-dismissible';	
				$this->session->set_flashdata('notify',$msg);
				$this->session->set_flashdata('class',$class);
			}		
			redirect('admin/view-upload-domestic-shipment');
		}
  	}
	
	public function check_duplicate_awb_no() {
        $data = [];  
        $pod_no = $this->input->post('pod_no');
        $whr = array('pod_no' => $pod_no);
        $result = $this->basic_operation_m->get_table_row('tbl_domestic_booking', $whr);

        $pod_no = $result->pod_no;
        if($pod_no!="")
        {
            $data['msg'] = "Forwording number is duplicate ";
        }else{
            $data['msg'] = "";
        }

        echo json_encode($data);
        exit;
    }


    public function track_shipment()
	{
		$data= array();
		$resAct	= $this->basic_operation_m->getAll('tbl_testimonial','');

		if($resAct->num_rows()>0)
		{
			$data['testimonial']=$resAct->result_array();	            
		}else{
			 $data['testimonial']=array();
		}
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
	 	{
		 	$data['homenews']=$resAct1->result_array();	            
	    }else{
	     	$data['homenews']=array();
	    }
		
		$data['delivery_pod']		= array();
		if (isset($_GET['pod_no']))
	    {
			$pod_no=$this->input->get('pod_no');
			$check_pod_international=$this->db->query("select pod_no from tbl_international_booking where pod_no like '%$pod_no%'");
			$check_result=$check_pod_international->row();
			
			if(isset($check_result)){
				   
		    	$reAct=$this->db->query("select tbl_international_booking.*,tbl_international_weight_details.no_of_pack, sendercity.city AS sender_city_name, recievercity.country_name as reciever_country_name from tbl_international_booking left join tbl_international_weight_details on tbl_international_booking.booking_id=tbl_international_weight_details.booking_id INNER JOIN city sendercity ON sendercity.id = tbl_international_booking.sender_city INNER JOIN zone_master recievercity ON recievercity.z_id = tbl_international_booking.reciever_country_id where pod_no like '%$pod_no%'");
				$data['info']=$reAct->row();
				
				$courier_company_id = $data['info']->courier_company_id;
				
				$tracking_href_details=$this->db->query("select * from courier_company where c_id=".$courier_company_id);
				$data['forwording_track']	=	$tracking_href_details->row();
			
				
				$reAct=$this->db->query("select * from tbl_international_tracking where pod_no like '%$pod_no%' ORDER BY id DESC");
				$data['pod']	=	$reAct->result();  
				$data['del_status']	=	$reAct->row();
	        			
	        			
	        		
			}else{
				  
		    	$reAct=$this->db->query("select tbl_domestic_booking.*,tbl_domestic_weight_details.no_of_pack, sendercity.city AS sender_city_name, recievercity.city as reciever_country_name from tbl_domestic_booking left join tbl_domestic_weight_details on tbl_domestic_booking.booking_id=tbl_domestic_weight_details.booking_id INNER JOIN city sendercity ON sendercity.id = tbl_domestic_booking.sender_city INNER JOIN city recievercity ON recievercity.id = tbl_domestic_booking.reciever_city where pod_no like '%$pod_no%'");
				$data['info']=$reAct->row();
				
				$courier_company_id = $data['info']->courier_company_id;
				$tracking_href_details=$this->db->query("select * from courier_company where c_id=".$courier_company_id);
				$data['forwording_track']	=	$tracking_href_details->row();
				
				$reAct=$this->db->query("select * from tbl_domestic_tracking,tbl_branch,tbl_city where tbl_branch.`branch_name`=tbl_domestic_tracking.branch_name AND tbl_city.city_id=tbl_branch.city AND pod_no like '%$pod_no%' ORDER BY id DESC;");
				$data['pod']	=	$reAct->result();
				$data['del_status']	=	$reAct->row();
			}
		
			if(!empty($data['pod']))
			{
				foreach($data['pod'] as $k => $values)
				{
					if($values->status == 'DELIVERED' || $values->status == 'Delivered')
					{
						$data['delivery_date'] = $values->tracking_date;
					}
				}
			}
				
			//$lrNum 					= $data['pod'][0]->forwording_no;
			//$podData 				= $this->deliverypod($lrNum);
			//$data['delivery_pod'] 	= json_decode($podData, true);
			
			$reAct=$this->db->query("select * from tbl_upload_pod where pod_no='$pod_no'");
			$data['podimg']=$reAct->row();
			//echo $this->db->last_query($data);
	   	}
		// echo "<pre>";

		// print_r($data);

		// exit();
	  	$this->load->view('admin/track_shipment/track_shipment',$data);
	}


	public function download_pod($id) 
	{
	    // Load library
	    $this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") {	
			$data['booking'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $whr);
			$where =array('id'=>1);
		    $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);
			// echo '<pre>'; print_r($data['booking']); die;
			$html = $this->load->view('admin/download_shipment', $data, true);
		}

		// $html = $this->load->view('admin/booking_domestic_master/booking_print', $data, true);	
		// echo $html; die;
		
		$this->load->library('M_pdf');
        
        $this->m_pdf->pdf->setAutoTopMargin = 'stretch';
        $this->m_pdf->pdf->autoMarginPadding = 'pad';
        $this->m_pdf->pdf->setAutoBottomMargin = 'stretch';

		// $this->m_pdf->pdf->SetHTMLFooter('<div style="text-align: right">Page {PAGENO} out of {nbpg}</div>');
	    $this->m_pdf->pdf->WriteHTML($html);
	    
	    $this->m_pdf->pdf->defaultheaderfontsize=14;
        $this->m_pdf->pdf->defaultheaderfontstyle='B';
        $this->m_pdf->pdf->defaultheaderline=1;
	 
        $this->mpdf->showImageErrors = true;
        $this->mpdf->debug = true;
        
		$type           = 'I';
        $filename = $invoice_series.'_'.$inc_num.'.pdf';
		$savefolderpath = 'assets/invoice/domestic/';
		
        $this->m_pdf->pdf->Output($savefolderpath.$filename, $type);
	}

	public function cashGstCalc(){

		$customer_id = $_REQUEST['customer_id'];
		$type_of_doc = $_REQUEST['type_of_doc'];
		$sender_gstno = $_REQUEST['sender_gstno'];
		$tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gstno,gst_charges from tbl_customers where customer_id = '$customer_id'");
		$tbl_branch_info 		= $this->basic_operation_m->get_query_row("select * from tbl_branch where branch_id = ".$_SESSION['branch_id']);

		$cgst =0;
		$sgst =0;
		$igst =0;
		$grand_total = $_REQUEST['totalAmount'];

		if ($type_of_doc=='GSTIN') {
			$gstno = $sender_gstno;
		}else{
			$gstno = trim($tbl_customers_info->gstno);
		}
		
		$gst_number = trim($tbl_branch_info->gst_number);

		if (!empty($gstno) && !empty($gst_number)) {
			$arr1 = str_split($gst_number);
			$arr2 = str_split($gstno);

			if ($arr2[0]==$arr1[0] && @$arr2[1]==@$arr1[1]) {
				$cgst = ($sub_total*9/100);
				$sgst = ($sub_total*9/100);
				$igst = 0;
				$grand_total = $grand_total + $cgst + $sgst + $igst;
			}else{
				$cgst = 0;
				$sgst = 0;
				$igst = ($grand_total*18/100);
				$grand_total = $grand_total + $igst;
			}
		}else{
			$cgst = 0;
			$sgst = 0;
			$igst = ($grand_total*18/100);
			$grand_total = $grand_total + $igst;
		}
			
		

		echo json_encode(
			array(
				'cgst'=>$cgst,
				'sgst'=>$sgst,
				'igst'=>$igst,
				'grand_total'=>$grand_total
			)
		);
	}

}

?>
