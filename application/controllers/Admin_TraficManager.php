<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_TraficManager extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('basic_operation_m');
		$this->load->model('Login_model');
		if ($this->session->userdata('userId') == '') {
			redirect('admin');
		}
	}

	public function quotation_requested_list($offset = '0', $searching = '')
	{

		$all_data = $this->input->post();
		$date = date('Y-m-d');
		$filterCond = '';
		$filterCond1 = '';
		if ($all_data) {
			//$filter_value = 	$_POST['filter_value'];

			foreach ($all_data as $ke => $vall) {

				if ($ke == 'ftl_No' && !empty($vall)) {
					$filterCond .= " AND ftl_request_tbl.ftl_request_id = '$vall'";
					$filterCond1 .= " AND ftl_request_tbl.ftl_request_id = '$vall'";
					//$filterCond1 .= "where ftl_request_tbl.ftl_request_id = '$vall'";
				} elseif ($ke == 'minimum_bid_amount' && !empty($vall)) {
					$filterCond .= " AND order_request_tabel.vendor_amount >= '$vall'";
					$filterCond1 .= " AND order_request_tabel.vendor_amount >= '$vall'";
					//$filterCond1 .= "where ftl_request_tbl.total_amount >= '$vall'";
				} elseif ($ke == 'max_bid_amount' && !empty($vall)) {
					$filterCond .= " AND order_request_tabel.vendor_amount <= '$vall'";
					$filterCond1 .= " AND order_request_tabel.vendor_amount <= '$vall'";
					//$filterCond1 .= "where ftl_request_tbl.total_amount <= '$vall'";
				}
			}
		}
		if (!empty($searching)) {
			$filterCond = urldecode($searching);
			$filterCond1 = urldecode($searching);
		}

	    $branch_id = $this->session->userdata('branch_id');
		// $traffic_manager = $this->db->query("select b.state,b.city from tbl_users as u left join tbl_branch as b ON b.branch_id = u.branch_id where b.branch_id = '$branch_id' AND `user_type` = '10'")->row_array();
		// $get_traficmanager_state = $traffic_manager['city'];
		
		// $getquotion = $this->db->query(
		// 		"SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.amount 
		// 		FROM order_request_tabel 
		// 		LEFT JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id 
		// 		LEFT JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id 
		// 		where order_request_tabel.date ='$date'  AND order_request_tabel.trafic_branch_id = '$branch_id' $filterCond 
		// 		ORDER BY order_request_tabel.ftl_request_id DESC limit " . $offset . "10");
				//echo $this->db->last_query();
	        //  $data['get_quotation_list'] = $getquotion->result();

		// $resActt = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where order_request_tabel.c_date ='$date' AND ftl_request_tbl.origin_city = '$get_traficmanager_state'  $filterCond ORDER BY order_request_tabel.vendor_amount DESC");
		//echo $this->db->last_query();
		// if($this->session->userdata('userType') == 1){

			$getquotion = $this->db->query(
				    "SELECT ftl_request_tbl.*,order_request_tabel.trafic_approve_status,order_request_tabel.advance_amount_percentage, order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,order_request_tabel.advance_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name FROM ftl_request_tbl
					 LEFT JOIN vendor_customer_tbl ON ftl_request_tbl.vc_id = vendor_customer_tbl.customer_id
				     LEFT JOIN order_request_tabel ON ftl_request_tbl.id = order_request_tabel.ftl_request_id
					 where ftl_request_tbl.ftl_booking_status = '0' $filterCond1 
				     ORDER BY ftl_request_tbl.ftl_request_id DESC limit " . $offset . "10");
					// echo $this->db->last_query();exit;
		        	$data['get_quotation_list'] = $getquotion->result();
		        	$resActt = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id  where order_request_tabel.c_date ='$date'   ORDER BY order_request_tabel.vendor_amount DESC");
			// $getquotion = $this->db->query(
			// 	    "SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.amount 
			// 		FROM order_request_tabel 
			// 		LEFT JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id 
			// 		LEFT JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id 
			// 		where order_request_tabel.date = '$date' $filterCond1  ORDER BY order_request_tabel.ftl_request_id DESC limit " . $offset . "10");
			// 		// echo $this->db->last_query();exit;
		    //     	$data['get_quotation_list'] = $getquotion->result();
		    //     	$resActt = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id  where order_request_tabel.c_date ='$date' AND ftl_request_tbl.origin_city = '$get_traficmanager_state'  ORDER BY order_request_tabel.vendor_amount DESC");
	        
		// }
	
		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/quation-requested-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($getquotion->num_rows() > 0) {
			$data['get_quotation_list'] 	= 	$getquotion->result();
		} else {
			$data['get_quotation_list']	= array();
		}

		$data['vendor_data'] = $this->db->get_where('vendor_customer_tbl',['status'=>1])->result_array();

		$this->load->view('admin/trafic_manager/admin_quotation_requested_list', $data);
	}



	public function cancel_quotation_requested_list($offset = '0')
	{
		$date = date('Y-m-d');
		$branch_id = $this->session->userdata('branch_id');

		// $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_number,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.id,ftl_request_tbl.trafic_approve_status,ftl_request_tbl.create_trip_status,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id WHERE ftl_request_tbl.trafic_approve_status ='1' AND order_request_tabel.trafic_approve_status ='1'  ORDER BY order_request_tabel.advance_amount ASC")->result();
		$get_cancel_quotation = $this->db->query("SELECT order_request_tabel.* ,vendor_customer_tbl.vcode FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id  WHERE  order_request_tabel.trafic_approve_status ='2' limit " . $offset . ",10");
		$resActt = $this->db->query("SELECT order_request_tabel.* ,vendor_customer_tbl.vcode FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id  WHERE  order_request_tabel.trafic_approve_status ='2'");
		//  $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
		//   echo $this->db->last_query();exit;



		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/quation-cancel-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($get_cancel_quotation->num_rows() > 0) {
			$data['get_cancel_quotation'] 	= 	$get_cancel_quotation->result();
		} else {
			$data['get_cancel_quotation']	= array();
		}


		$this->load->view('admin/trafic_manager/cancel_quotation_data', $data);
	}

	


	public function get_ftl_id()
	{
		$ftlId = $this->input->post('id');
		$data =  $this->db->query("select ftl_request_id from ftl_request_tbl where ftl_request_id ='$ftlId'")->row();
		echo json_encode($data);
	}















	public function update_quotation_data($id)
	{
		if (isset($_POST['submit'])) {

			$v = $this->input->post('rc_book');
			if (isset($_FILES) && !empty($_FILES['rc_book']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['rc_book'], 'assets/ftl_documents/vendor_rc-book/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$rc_book = $ret['image_name'];
				}
			}
			//  $hourse = $this->input->post('hourse');
			//  $minit = $this->input->post('minit');
			// $ping_time = $hourse.':'.$minit;

			$data = array(
				'driver_name' => $this->input->post('driver_name'),
				'vc_id' => $this->input->post('vendor_customer_id'),
				'driver_contact_number' => $this->input->post('driver_contact_number'),
				'vehicle_number' => $this->input->post('vehicle_number'),
				'loding_charges' => $this->input->post('loding_charges'),
				'Unloding_charges' => $this->input->post('unloding_charges'),
				'ping_time' => $this->input->post('ping_time'),
				'driver_licence' => $this->input->post('driver_licence'),
				//'rc_book' =>$rc_book,
				'ending_time' => $this->input->post('ending_time'),
			);

			// print_r($data);exit;

			$this->db->where('ftl_request_id', $id);
			 $res = $this->db->update('ftl_request_tbl', $data);
			 if($res){
				$this->session->Set_flashdata('msg', "Driver details has been successfully updated. Now You can proceed to create Trip.");
				redirect(base_url() . 'admin/quation-approve-list');
			 }else{
				$this->session->Set_flashdata('msg', "Something Went Wrong");
				redirect(base_url() . 'admin/quation-approve-list');
			 }
			// echo $this->db->last_query();exit;
			
		} else {
			
			$data['quotation_data'] = $this->db->query("SELECT ftl_request_tbl.*,order_request_tabel.vendor_amount,order_request_tabel.advance_amount_percentage,order_request_tabel.advance_amount,order_request_tabel.remaining_amount FROM  ftl_request_tbl left JOIN vendor_customer_tbl ON ftl_request_tbl.vc_id = vendor_customer_tbl.customer_id INNER JOIN order_request_tabel ON order_request_tabel.vendor_customer_id = ftl_request_tbl.vc_id where ftl_request_tbl.ftl_request_id = '$id' ")->row_array();
			// $data['quotation_data'] = $this->db->query("SELECT order_request_tabel.*,ftl_request_tbl.id as ftlId,ftl_request_tbl.ping_time,ftl_request_tbl.vehicle_number,ftl_request_tbl.driver_licence,ftl_request_tbl.rc_book,ftl_request_tbl.driver_contact_number,ftl_request_tbl.ending_time,ftl_request_tbl.driver_name,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.Unloding_charges,ftl_request_tbl.loding_charges,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount,ftl_request_tbl.unloading_type,ftl_request_tbl.loading_type FROM  order_request_tabel left JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where ftl_request_tbl.ftl_request_id = '$id' ")->row_array();
			// echo $this->db->last_query();exit;
			$this->load->view('admin/trafic_manager/update_quotation_data', $data);
		}
	}


	public function approve_quotation_requested_list($offset = '0')
	{


		$date = date('Y-m-d');
		$branch_id = $this->session->userdata('branch_id');
		// $traffic_manager = $this->db->query("select b.state from tbl_users as u left join tbl_branch as b ON b.branch_id = u.branch_id where b.branch_id = '$branch_id' AND `user_type` = '10'")->row_array();
		// $get_traficmanager_state = $traffic_manager['state'];
		// $getres = $this->db->query("SELECT order_request_tabel.*,ftl_request_tbl.ftl_request_id as ftl_id,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_number,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.id,ftl_request_tbl.trafic_approve_status,ftl_request_tbl.create_trip_status,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id WHERE ftl_request_tbl.trafic_approve_status ='1' AND order_request_tabel.trafic_approve_status ='1'  ORDER BY order_request_tabel.ftl_request_id DESC limit " . $offset . ",10");
		// $resActt = $this->db->query("SELECT order_request_tabel.*,ftl_request_tbl.ftl_request_id as ftl_id,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.driver_name,ftl_request_tbl.vehicle_number,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.id,ftl_request_tbl.trafic_approve_status,ftl_request_tbl.create_trip_status,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id WHERE ftl_request_tbl.trafic_approve_status ='1' AND order_request_tabel.trafic_approve_status ='1'  ORDER BY order_request_tabel.ftl_request_id DESC ");
		 $getres = $this->db->query("SELECT ftl_request_tbl.*,vendor_customer_tbl.vcode FROM ftl_request_tbl INNER JOIN vendor_customer_tbl ON ftl_request_tbl.vc_id = vendor_customer_tbl.customer_id  WHERE ftl_request_tbl.ftl_booking_status ='1'  ORDER BY ftl_request_tbl.ftl_request_id DESC limit " . $offset . ",10");
		 $resActt = $this->db->query("SELECT ftl_request_tbl.*,vendor_customer_tbl.vcode FROM ftl_request_tbl INNER JOIN vendor_customer_tbl ON ftl_request_tbl.vc_id = vendor_customer_tbl.customer_id  WHERE ftl_request_tbl.ftl_booking_status ='1'   ORDER BY ftl_request_tbl.ftl_request_id DESC ");
	
		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/quation-approve-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($getres->num_rows() > 0) {
			$data['get_quotation_list'] 	= $getres->result();
		} else {
			$data['get_quotation_list'] 	= array();
		}



		$this->load->view('admin/trafic_manager/approve_quotation_list', $data);
	}

	public function after_reach_vehicle_uploadPod_by_admin($id) {
   
    if(isset($_POST['submit'])){
		$vendor_id = $this->db->query("SELECT vc_id from ftl_request_tbl where  id = $id ")->row();
      $v = $this->input->post('after_reach_pod');
      if (isset($_FILES) && !empty($_FILES['after_reach_pod']['name'])) {
        $ret = $this->basic_operation_m->fileUpload($_FILES['after_reach_pod'], 'assets/ftl_documents/ftl-pod/');
        if ($ret['status'] && isset($ret['image_name'])) {
          $after_reach_pod = $ret['image_name'];
        }
      }

    $data = array(
     'vendor_id' => $vendor_id->vc_id,
    'ftl_request_id'=>$this->input->post('ftl_request_id'),
    'exit_date'=>$this->input->post('exit_date'),
    'exit_time'=>$this->input->post('exit_time'),
    'after_reach_pod'=>$after_reach_pod,
    'payment_confirm'=>$this->input->post('payment_confirm'),
    );
//  print_r($data);die;
    $this->db->insert('Ftl_upload_pod',$data);
    $this->session->Set_flashdata('msg','Data Inserted Successfully!!');
    redirect(base_url().'admin/quation-approve-list');

   }else{
    $data['id'] = $id;
    $this->load->view('admin/trafic_manager/ftl_pod_upload',$data);
   }
 }


	public function update_status()
	{

		$branch_id = $this->session->userdata('branch_id');
		$user_id = $this->session->userdata('userId');
		$date_time = date('d-m-y H:i:s');
		$id = $this->input->post('id');
		$vendor_customer_id = $this->input->post('vendor_customer_id');
		$ftl_request_id = $this->input->post('ftl_request_id');
		$approved = $this->input->post('approved');

		// print_r($_POST);die;
		if($id){
		  $this->db->query("update order_request_tabel set trafic_approve_status ='$approved' ,branch_id ='$branch_id' where id ='$id'");
		}
		$res = $this->db->query("update ftl_request_tbl set ftl_booking_status ='$approved', vc_id='$vendor_customer_id' ,branch_id ='$branch_id',tm_user_id = '$user_id',ftl_approve_date = '$date_time' where ftl_request_id ='".$ftl_request_id."' OR id ='".$ftl_request_id."'");
// echo $this->db->last_query();exit;
		$this->db->query("update order_request_tabel set trafic_approve_status ='2' where trafic_approve_status!= '1' AND ftl_request_id ='$ftl_request_id'");
		
        if($res){
		$this->session->set_flashdata('msg', 'Quation Approved,Now  !');
		}else{
		$this->session->set_flashdata('msg', 'Something went wrong!');
		}
		redirect(base_url() . 'admin/quation-requested-list');
	}

	public function get_ftl_data()
	{
		$order_id = $this->input->get('id');
		$dd = $this->db->query("select * from order_request_tabel where id = '$order_id' ")->row_array();
		echo json_encode($dd);
	}


	public function view_ewaybill_list($offset = '0')
	{
		$resActt   = $this->db->query("select * from ftl_document_image_tbl");
		$resAct   = $this->db->query("select * from ftl_document_image_tbl  limit " . $offset . ",10");
		//	echo $this->db->last_query();exit;
		// $data['get_ftl_document']	   = $this->db->query("select * from ftl_document_image_tbl DESC limit ".$offset.",2")->result_array();
		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/ftl-documents-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			= 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($resAct->num_rows() > 0) {
			$data['get_ftl_document']	= $resAct->result_array();
		} else {
			$data['get_ftl_document']	= array();
		}

		$this->load->view('admin/trafic_manager/admin_eway_bill_list', $data);
	}


	public function pickup_request_list($offset = '0', $searching = '')
	{

		$all_data 					= $this->input->post();
		$filterCond = '';
		if ($all_data) {
			$filter_value = 	$_POST['filter_value'];

			foreach ($all_data as $ke => $vall) {

				if ($ke == 'user_id' && !empty($vall)) {
					$filterCond .= " AND tbl_domestic_booking.customer_id = '$vall'";
				} elseif ($ke == 'from_date' && !empty($vall)) {
					$filterCond .= " AND tbl_domestic_booking.booking_date >= '$vall'";
				} elseif ($ke == 'to_date' && !empty($vall)) {
					$filterCond .= " AND tbl_domestic_booking.booking_date <= '$vall'";
				} elseif ($ke == 'courier_company' && !empty($vall) && $vall != "ALL") {
					$filterCond .= " AND tbl_domestic_booking.courier_company_id = '$vall'";
				} elseif ($ke == 'mode_name' && !empty($vall) && $vall != "ALL") {
					$filterCond .= " AND tbl_domestic_booking.mode_dispatch = '$vall'";
				}
			}
		}
		if (!empty($searching)) {
			$filterCond = urldecode($searching);
		}
		$branch_id = $this->session->userdata('branch_id');
		$traffic_manager = $this->db->query("select b.state,b.city from tbl_users as u left join tbl_branch as b ON b.branch_id = u.branch_id where b.branch_id = '$branch_id' AND `user_type` = '10'")->row_array();
		$get_traficmanager_state = $traffic_manager['city'];
		$pickup_request_list = $this->db->query("SELECT ftl_request_tbl.*,vendor_customer_tbl.vendor_name,tbl_customers.customer_name  from  ftl_request_tbl left JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN  tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id where ftl_request_tbl.origin_city = '$get_traficmanager_state' AND  ftl_request_tbl.trafic_approve_status ='1' limit " . $offset . ",10");
		$resActt = $this->db->query("SELECT ftl_request_tbl.*,vendor_customer_tbl.vendor_name,tbl_customers.customer_name from  ftl_request_tbl left JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN  tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id where ftl_request_tbl.origin_city = '$get_traficmanager_state' AND  ftl_request_tbl.trafic_approve_status ='1' ");
		//echo $this->db->last_query();exit;
		//  $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
		//   echo $this->db->last_query();exit;


		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/pickup-request-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($pickup_request_list->num_rows() > 0) {
			$data['get_pickup_request_list'] 	= 	$pickup_request_list->result();
		} else {
			$data['get_pickup_request_list']	= array();
		}


		$this->load->view('admin/trafic_manager/ftl_pickup_request_list', $data);
	}

	public function upload_trip_documents()
	{
		if (isset($_POST['submit'])) {

			$v = $this->input->post('loding_slip_upload');
			if (isset($_FILES) && !empty($_FILES['loding_slip_upload']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['loding_slip_upload'], 'assets/ftl_documents/Loading-Slip/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$loding_slip_upload = $ret['image_name'];
				}
			}
			// ********************************* before_seal_photo upload ****************     
			$v = $this->input->post('before_seal_photo');
			if (isset($_FILES) && !empty($_FILES['before_seal_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['before_seal_photo'], 'assets/ftl_documents/Before-Seal/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$before_seal_photo = $ret['image_name'];
				}
			}

			// ********************************* after_seal_photo upload ****************     
			$v = $this->input->post('after_seal_photo');
			if (isset($_FILES) && !empty($_FILES['after_seal_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['after_seal_photo'], 'assets/ftl_documents/After-Seal/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$after_seal_photo = $ret['image_name'];
				}
			}

			// ********************************* empty_lorry_photo upload ****************     
			$v = $this->input->post('empty_lorry_photo');
			if (isset($_FILES) && !empty($_FILES['empty_lorry_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['empty_lorry_photo'], 'assets/ftl_documents/Empty-Lorry/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$empty_lorry_photo = $ret['image_name'];
				}
			}

			// ********************************* empty_lorry_photo upload ****************     
			$v = $this->input->post('loaded_lorry_photo');
			if (isset($_FILES) && !empty($_FILES['loaded_lorry_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['loaded_lorry_photo'], 'assets/ftl_documents/Loaded-Lorry/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$loaded_lorry_photo = $ret['image_name'];
				}
			}

			$data = array(
				'ftl_id' => $this->input->post('ftl_id'),
				'loading_slip' => $loding_slip_upload,
				'before_seal' => $before_seal_photo,
				'after_seal' => $after_seal_photo,
				'empty_lorry' => $empty_lorry_photo,
				'loaded_lorry' => $loaded_lorry_photo,
			);
			//print_r($data);exit;
			$this->db->insert('ftl_trip_document_tbl', $data);
			$this->db->update('ftl_request_tbl',['create_trip_status'=>'1'],['ftl_request_id'=>$this->input->post('ftl_id')]);
			// echo $this->db->last_query();exit;
			$this->session->Set_flashdata('msg', 'Images Uploaded Successfully!!');
			redirect(base_url() . 'admin/upload-trip-documents-list');
		} else {
			$data['ftl_id'] = $this->db->query("select * from ftl_request_tbl  where ftl_request_id ='$id'")->row_array();
		//	print_r($data['ftl_id'] );exit;
			$this->load->view('admin/trafic_manager/add_pickup_documentation',$data);
		}
	}

	public function upload_trip_documents_list($offset = '0')
	{

		$resActt   = $this->db->query("SELECT ftl_request_tbl.*,ftl_trip_document_tbl.loading_slip,ftl_trip_document_tbl.before_seal,ftl_trip_document_tbl.after_seal,ftl_trip_document_tbl.empty_lorry,ftl_trip_document_tbl.ftl_id,ftl_trip_document_tbl.loaded_lorry,ftl_trip_document_tbl.status FROM ftl_request_tbl  LEFT JOIN ftl_trip_document_tbl ON ftl_trip_document_tbl.ftl_id =  ftl_request_tbl.ftl_request_id
WHERE create_trip_status = '1'");
		$resAct   = $this->db->query("select * from ftl_request_tbl where create_trip_status = '1'  limit " . $offset . ",10");
		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/upload-trip-documents-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			= 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($resAct->num_rows() > 0) {
			$data['pickup_document_data']	= $resActt->result_array();
		} else {
			$data['pickup_document_data']	= array();
		}
		$this->load->view('admin/trafic_manager/pickup_document_list', $data);
	}

	public function update_upload_trip_documents($ftl_id)
	{

		if (isset($_POST['submit'])) {

			$v = $this->input->post('loding_slip_upload');
			if (isset($_FILES) && !empty($_FILES['loding_slip_upload']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['loding_slip_upload'], 'assets/ftl_documents/Loading-Slip/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$loding_slip_upload = $ret['image_name'];
				}
			}
			// ********************************* before_seal_photo upload ****************     
			$v = $this->input->post('before_seal_photo');
			if (isset($_FILES) && !empty($_FILES['before_seal_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['before_seal_photo'], 'assets/ftl_documents/Before-Seal/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$before_seal_photo = $ret['image_name'];
				}
			}

			// ********************************* after_seal_photo upload ****************     
			$v = $this->input->post('after_seal_photo');
			if (isset($_FILES) && !empty($_FILES['after_seal_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['after_seal_photo'], 'assets/ftl_documents/After-Seal/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$after_seal_photo = $ret['image_name'];
				}
			}

			// ********************************* empty_lorry_photo upload ****************     
			$v = $this->input->post('empty_lorry_photo');
			if (isset($_FILES) && !empty($_FILES['empty_lorry_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['empty_lorry_photo'], 'assets/ftl_documents/Empty-Lorry/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$empty_lorry_photo = $ret['image_name'];
				}
			}

			// ********************************* empty_lorry_photo upload ****************     
			$v = $this->input->post('loaded_lorry_photo');
			if (isset($_FILES) && !empty($_FILES['loaded_lorry_photo']['name'])) {
				$ret = $this->basic_operation_m->fileUpload($_FILES['loaded_lorry_photo'], 'assets/ftl_documents/Loaded-Lorry/');
				//file is uploaded successfully then do on thing add entry to table
				if ($ret['status'] && isset($ret['image_name'])) {
					$loaded_lorry_photo = $ret['image_name'];
				}
			}

			$data = array(

				'loading_slip' => $loding_slip_upload,
				'before_seal' => $before_seal_photo,
				'after_seal' => $after_seal_photo,
				'empty_lorry' => $empty_lorry_photo,
				'loaded_lorry' => $loaded_lorry_photo,
			);
			//print_r($data);exit;
			$this->db->where('id', $ftl_id);
			$this->db->update('ftl_trip_document_tbl', $data);

			$this->session->Set_flashdata('msg', 'Images Updated Successfully!!');
			redirect(base_url() . 'admin/pickup-request-list');
		} else {
			$data['update_document'] = $this->db->query("select * from ftl_trip_document_tbl where ftl_id ='$ftl_id'")->row_array();
			// echo $this->db->last_query();
			// exit;
			$this->load->view("admin/trafic_manager/update_pickup_documentation", $data);
		}
	}


	// ***************************************** FTL Account ********************************


	public function pending_payment_approve($offset = '0')
	{

		$pending_payment_approve_list = $this->db->query("SELECT ftl_request_tbl.*,ftl_account_tbl.status as payment_approve_status ,ftl_account_tbl.payment_approved_date, order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch 
				from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id 
				LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id 
				LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id 
				LEFT JOIN ftl_account_tbl ON ftl_account_tbl.ftl_request_id = ftl_request_tbl.ftl_request_id  where ftl_request_tbl.trafic_approve_status ='1'GROUP BY ftl_request_tbl.ftl_request_id limit " . $offset . ",10");
		$resActt = $this->db->query("SELECT ftl_request_tbl.*,order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where ftl_request_tbl.trafic_approve_status ='1'GROUP BY ftl_request_tbl.ftl_request_id ");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/pending-payment-approval/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($pending_payment_approve_list->num_rows() > 0) {
			$data['pending_payment_approve'] 	= 	$pending_payment_approve_list->result();
		} else {
			$data['pending_payment_approve']	= array();
		}

		$this->load->view('admin/trafic_manager/pending_payment_approve', $data);
	}

	public function store_payment_status()
	{

		$change_status =	$this->input->post('change_status');
		$ftl_request_id	= $this->input->post('ftl_request_id');
		$utr_no	= $this->input->post('utr_no');
		$payment_status	= $this->input->post('payment_status');
		$approved	= $this->input->post('status');
		$payment_approved_by = $this->session->userdata('userId');	

		$data = array(
			'payment_status' => $payment_status,
			'status' => $approved,
			'utr_no'=>$utr_no,
			'ftl_request_id' => $ftl_request_id,
			'payment_approved_by' => $payment_approved_by,
		);

		//print_r($data);exit;
		$resdata =	$this->db->insert('ftl_account_tbl', $data);
	
		//echo $this->db->last_query();exit;
		if (!empty($resdata)) {
			$this->session->Set_userdata('msg', 'Payment Status Updated Successfully!!');
			redirect(base_url() . 'admin/pending-payment-approval');
		}
	
	}


	public function pending_transfer_payment($offset  = '0')
	{

		$pending_transfer_payment = $this->db->query("SELECT ftl_request_tbl.*,ftl_account_tbl.status as payment_approve_status ,ftl_account_tbl.payment_approved_by,ftl_account_tbl.payment_approved_date,ftl_account_tbl.utr_no, order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch 
		from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id 
		LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id 
		LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id 
		LEFT JOIN ftl_account_tbl ON ftl_account_tbl.ftl_request_id = ftl_request_tbl.ftl_request_id  where ftl_request_tbl.trafic_approve_status ='1' AND ftl_account_tbl.status ='1' GROUP BY ftl_request_tbl.ftl_request_id limit " . $offset . ",10");
		$resActt = $this->db->query("SELECT ftl_request_tbl.*,ftl_account_tbl.payment_approved_by,ftl_account_tbl.payment_approved_date,order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id LEFT JOIN ftl_account_tbl ON ftl_account_tbl.ftl_request_id = ftl_request_tbl.ftl_request_id where ftl_request_tbl.trafic_approve_status ='1' AND ftl_account_tbl.status='1' GROUP BY ftl_request_tbl.ftl_request_id ");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/pending-transfer-payment/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($pending_transfer_payment->num_rows() > 0) {
			$data['pending_transfer_payment'] 	= 	$pending_transfer_payment->result();
		} else {
			$data['pending_transfer_payment']	= array();
		}

		$this->load->view('admin/trafic_manager/pending_transfer_payment_list', $data);
	}





	public function ftl_payment($offset = '0')
	{
		$ftl_payment = $this->db->query("SELECT ftl_request_tbl.*,ftl_account_tbl.utr_no ,ftl_account_tbl.status as payment_approve_status ,ftl_account_tbl.payment_approved_by,ftl_account_tbl.payment_approved_date,ftl_account_tbl.final_utr_no,ftl_account_tbl.final_payment_approved_date, order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch 
		from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id 
		LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id 
		LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id 
		LEFT JOIN ftl_account_tbl ON ftl_account_tbl.ftl_request_id = ftl_request_tbl.ftl_request_id  where ftl_request_tbl.trafic_approve_status ='1' AND ftl_account_tbl.status ='1' GROUP BY ftl_request_tbl.ftl_request_id limit " . $offset . ",10");
		$resActt = $this->db->query("SELECT ftl_request_tbl.*,ftl_account_tbl.utr_no,ftl_account_tbl.payment_approved_by,ftl_account_tbl.payment_approved_date,order_request_tabel.vendor_amount,order_request_tabel.advance_amount,order_request_tabel.remaining_amount,vendor_customer_tbl.vcode,vendor_customer_tbl.vendor_name,tbl_customers.customer_name,su.full_name as sales_name,su.branch_id as sales_branch_id,tu.full_name as traffic_manager_name,tbl_branch.branch_name as trafic_manager_branch from ftl_request_tbl LEFT JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN tbl_customers ON tbl_customers.customer_id = ftl_request_tbl.customer_id LEFT JOIN tbl_users as su ON su.user_id = ftl_request_tbl.sales_user_id LEFT JOIN tbl_users as tu ON tu.user_id = ftl_request_tbl.tm_user_id LEFT JOIN tbl_branch ON tbl_branch.branch_id = ftl_request_tbl.branch_id LEFT JOIN order_request_tabel ON order_request_tabel.ftl_request_id = ftl_request_tbl.id LEFT JOIN ftl_account_tbl ON ftl_account_tbl.ftl_request_id = ftl_request_tbl.ftl_request_id where ftl_request_tbl.trafic_approve_status ='1' AND ftl_account_tbl.status='1' GROUP BY ftl_request_tbl.ftl_request_id ");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/ftl-payment/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($ftl_payment->num_rows() > 0) {
			$data['ftl_payment'] 	= 	$ftl_payment->result();
		} else {
			$data['ftl_payment']	= array();
		}

		$this->load->view('admin/trafic_manager/ftl_payment_list', $data);
	}

	public function update_ftl_payment_data()
	{


		$payment_date =	$this->input->post('payment_date');
		$utr_no =	$this->input->post('utr_no');
		$ftl_request_id	= $this->input->post('ftl_request_id');


		$data = array(
			'final_payment_approved_date' => $payment_date,
			'final_utr_no' => $utr_no,
			'approve_status' => 2,
		);

		$this->db->where('ftl_request_id', $ftl_request_id);
		$res =	$this->db->update('ftl_account_tbl', $data);
		if (!empty($res)) {
			$this->session->set_userdata('msg', 'Payment Status Updated Successfully!!');
			redirect(base_url() . 'admin/ftl-payment');
		}
	}


	############################################ Vendor List ##############################################################

	public function getCityList()
	{
	   $pincode = $this->input->post('pincode');
	   $whr1 = array('pin_code' => $pincode);
	   $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
 
	   $city_id = $res1->row()->city_id;
 
	   $whr2 = array('id' => $city_id);
	   $data = $this->db->query("select * from city where id = '$city_id'")->row();
 
	   echo json_encode($data);
	}
	public function getState()
	{
	   $pincode = $this->input->post('pincode');
	   $whr1 = array('pin_code' => $pincode);
	   $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
	   $state_id = $res1->row()->state_id;
	   $data = $this->db->query("select * from state where id = '$state_id'")->row();
	  // echo $this->db->last_query();
	   echo json_encode($data);
	}



	public function ftl_vendor_list($offset = '0')
	{
		$vendor_list = $this->db->query("select * from vendor_customer_tbl  ORDER BY customer_id  DESC limit " . $offset . ",10");

		$resActt = $this->db->query("select * from vendor_customer_tbl");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/ftl-vendor-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($vendor_list->num_rows() > 0) {
			$data['ftl_customer_vendor'] 	= 	$vendor_list->result();
		} else {
			$data['ftl_customer_vendor']	= array();
		}

		$this->load->view('admin/trafic_manager/ftl_customer_vendor', $data);
	}

public function add_ftl_vendor(){

		$user_id = $this->session->userdata('userId');

	 if (isset($_POST['submit'])) {
		$v = $this->input->post('cancel_cheque');
		if (isset($_FILES) && !empty($_FILES['cancel_cheque']['name'])) {
		  $ret = $this->basic_operation_m->fileUpload($_FILES['cancel_cheque'], 'assets/ftl_documents/vendor_register_doc/');
		  if ($ret['status'] && isset($ret['image_name'])) {
		   $cancel_cheque = $ret['image_name'];
		  }
		}
		$v1 = $this->input->post('gst_proof');
		if (isset($_FILES) && !empty($_FILES['cancel_cheque']['name'])) {
		  $ret = $this->basic_operation_m->fileUpload($_FILES['gst_proof'], 'assets/ftl_documents/vendor_register_doc/');
		  if ($ret['status'] && isset($ret['image_name'])) {
		   $gst_proof = $ret['image_name'];
		  }
		}
		$v2 = $this->input->post('address_proof');
		if (isset($_FILES) && !empty($_FILES['address_proof']['name'])) {
		  $ret = $this->basic_operation_m->fileUpload($_FILES['address_proof'], 'assets/ftl_documents/vendor_register_doc/');
		  if ($ret['status'] && isset($ret['image_name'])) {
		   $address_proof = $ret['image_name'];
		  }
		}
		$v3 = $this->input->post('pan_card_proof');
		if (isset($_FILES) && !empty($_FILES['pan_card_proof']['name'])) {
		  $ret = $this->basic_operation_m->fileUpload($_FILES['pan_card_proof'], 'assets/ftl_documents/vendor_register_doc/');
		  if ($ret['status'] && isset($ret['image_name'])) {
		   $pan_card_proof = $ret['image_name'];
		  }
		}
		$v4 = $this->input->post('profile_image');
		if (isset($_FILES) && !empty($_FILES['profile_image']['name'])) {
		  $ret = $this->basic_operation_m->fileUpload($_FILES['profile_image'], 'assets/ftl_documents/vendor_profile_image/');
		  if ($ret['status'] && isset($ret['image_name'])) {
		   $profile_image = $ret['image_name'];
		  }
		}

		$date = date('y-m-d H:i:s');
		$data = array(
		   'vcode' => $this->input->post('vci'),
		   'vendor_name' => $this->input->post('vendor_name'),
		   'reference_person_name' => $this->input->post('reference_person_name'),
		   'mobile_no' => $this->input->post('phone'),
		   'alternate_phone_number' => $this->input->post('alternate_number'),
		   'email' => $this->input->post('email'),
		   'alternate_email' => $this->input->post('alternate_email'),
		   'username' => $this->input->post('username'),
		   'pincode' => $this->input->post('pincode'),
		   'state' => $this->input->post('state'),
		   'city' => $this->input->post('city'),
		   'pan_number' => $this->input->post('pan_number'),
		   'gst_number' => $this->input->post('gst_number'),
		   'cancel_cheque' => $cancel_cheque,
		   'gst_proof' => $gst_proof,
		   'address_proof' => $address_proof,
		   'pan_card_proof' => $pan_card_proof,
		   'profile_image' => $profile_image,
		   'register_type' => $this->input->post('register_type'),
		   'service_provider' => $this->input->post('service_provider'),
		   'credit_days' => $this->input->post('credit_days'),
		   'address' => $this->input->post('address'),
		   'password' => md5($this->input->post('password')),
		   'register_date' => $date,
		   'bank_name' => $this->input->post('bank_name'),
		   'acc_number' => $this->input->post('acc_number'),
		   'ifsc_code' => $this->input->post('ifsc_code'),
		   'status' => 1,
		   'created_by'=>$user_id
		);

	   // print_r($data);exit;

	   $this->db->insert('vendor_customer_tbl', $data);
	   //echo $this->db->last_query();exit;

		$last_id = $this->db->insert_id();
	   // print_r($last_id);exit;

		$origin = $this->input->post('origin[]');
		$destination = $this->input->post('destination[]');
		$vehicle_type = $this->input->post('vehicle_type[]');
		$count = count($this->input->post('destination[]'));
		for($i=0; $i<$count; $i++){
		 
		   $data = array(
			  'vendor_id'=>$last_id,
			  'origin'=>$origin[$i],
			  'destination'=>$destination[$i],
			  'vehicle_type'=>$vehicle_type[$i],
		   );
		   //print_r($data);exit;

		   $res = $this->db->insert('vendor_customer_service_area_tbl', $data); 
		}
	  if(!empty($res)){
		$this->session->set_flashdata('msg', 'Registration Successfully!! Now Proceed For Login ');
		redirect(base_url() . 'admin/add-ftl-vendor');
	  }else{
		$this->session->set_flashdata('msg', 'Something went Wrong');
		redirect(base_url() . 'admin/add-ftl-vendor');
	  }
	 } else {

		$result = $this->db->query("select max(customer_id) AS id from  vendor_customer_tbl")->row();
		// echo $this->db->last_query();exit;
		$id = $result->id + 1;

		if (strlen($id) == 1) {
		   $customer_id = 'VI0000' . $id;
		} else if (strlen($id) == 2) {
		   $customer_id = 'VI000' . $id;
		} else if (strlen($id) == 3) {
		   $customer_id = 'VI00' . $id;
		} else if (strlen($id) == 4) {
		   $customer_id = 'VI' . $id;
		}
		$data['VCI'] = $customer_id;
		//  print_r($data['VCI']);exit;
		$this->load->view('admin/trafic_manager/vendor_registration',$data);
	}
	
	 
  }






	public function get_id_vendor_customer()
	{
		$id = $this->input->get('id');
		$data = $this->db->query("select * from  vendor_customer_tbl where customer_id = '$id'")->result_array();
		echo json_encode($data);
	}
	public function update_vendor_customer_stats(){
		//print_r($_POST);

		    $approve = $this->input->post('approve'); 
		    $reject = $this->input->post('reject'); 
			if($approve == 'Approve'){
				$p = 1;
			}
			if($reject == 'Reject'){
				$p = 2;
			}

			$id = $this->input->post('customer_id');
			$this->db->query("update vendor_customer_tbl set status ='$p' where customer_id = '$id'");
			//echo $this->db->last_query();exit;
			redirect(base_url() . 'admin/dashboard');
		
	}
	public function vendor_inactive()
	{
		$inactive = $this->input->post('inactive'); 
		$id = $this->input->post('customer_id');
		$this->db->query("update vendor_customer_tbl set status ='$inactive' where customer_id = '$id'");
		$this->session->flashdata('msg', 'Vendor Inactive');
		redirect(base_url() . 'admin/ftl-vendor-list');
	}


//  ****************************** ftl customer Rate ********************************

public function ftl_customer_rate_master(){
    if(isset($_POST['submit'])){

		$data = array(
			'ftl_customer_id' => $this->input->post('ftl_customer_id'),
			'vehicle_type' => $this->input->post('vehicle_type'),
			'from_date' => $this->input->post('from_date'),
			'to_date' => $this->input->post('to_date'),
			'rate' => $this->input->post('rate'),
			'origin' => $this->input->post('origin'),
			'destination' => $this->input->post('destination'),
		);
      $result = $this->db->insert('ftl_customer_rate_tbl', $data);
	  if((!empty($result))){
		$this->session->Set_flashdata('msg','Customer Rate add Successfully');
		redirect(base_url().'admin/ftl-customer-rate-master');
	  }else{
		$this->session->Set_flashdata('msg','Some Thing Went Wrong');
		redirect(base_url().'admin/ftl-customer-rate-master');
	  }
	

	}else{
      $data['get_ftl_customer'] = $this->db->query("select * from tbl_customers where ftl_customer = '1'")->result_array();
      $data['get_vehicle_type'] = $this->db->query("select * from vehicle_type_master")->result_array();
	  $data['cities']	= $this->basic_operation_m->get_all_result('city', '');
	  $this->load->view('admin/ftl_customer_rate/add_ftl_customer_rate',$data);
	}  
	
}

public function ftl_customer_rate_list($offset = '0')
	{
		$vendor_list = $this->db->query("select * from ftl_customer_rate_tbl limit " . $offset . "10");

		$resActt = $this->db->query("select * from ftl_customer_rate_tbl");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/ftl-customer-rate-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}


		$this->pagination->initialize($config);
		if ($vendor_list->num_rows() > 0) {
			$data['ftl_customer_rate'] 	= 	$vendor_list->result();
		} else {
			$data['ftl_customer_rate']	= array();
		}

		$this->load->view('admin/ftl_customer_rate/ftl_customer_rate_list', $data);
	}

	public function ftl_pod_list($offset='')
	{
		$ftl_pod_data = $this->db->query("select * from Ftl_upload_pod limit " . $offset . "10");
		//echo $this->db->last_query();exit;

		$resActt = $this->db->query("select * from Ftl_upload_pod");

		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/ftl-pod-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);

		$config['per_page'] 			    = 10;
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

		if ($offset == '') {
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		} else {
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}

		$this->pagination->initialize($config);
		if ($ftl_pod_data->num_rows() > 0) {
			$data['ftl_pod'] 	= 	$ftl_pod_data->result();
		} else {
			$data['ftl_pod']	= array();
		}
		//print_r($data['ftl_pod']);exit;
		$this->load->view('admin/trafic_manager/ftl_pod_list',$data);
	}



}
