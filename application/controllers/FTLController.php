<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class FTLController extends CI_Controller
{

	var $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('basic_operation_m');
		$this->load->model('Franchise_model');
		if ($this->session->userdata('userId') == '') {
			redirect('admin');
		}
	}

	public function index()
	{
		$data['cities']	= $this->basic_operation_m->get_all_result('city', '');
		$data['states'] = $this->basic_operation_m->get_all_result('state', '');
		$user_type 	= $this->session->userdata("userType");
		if ($user_type == 1) {
			$data['customers'] = $this->basic_operation_m->get_all_result('tbl_customers', "");
		} else {
			$username = $this->session->userdata("userName");
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;
			$where = "branch_id='$branch_id' ";
			$customer_type = 0;
			$data['customers'] = $this->basic_operation_m->get_all_result('tbl_customers', "branch_id = '$branch_id',customer_type = $customer_type");
		}

		$data['vehicle_type'] = $this->db->query("SELECT * FROM `vehicle_type_master`")->result();
		$data['ftl_data'] = $this->db->query("SELECT ftl_request_tbl.* FROM `ftl_request_tbl`  where ftl_booking_status = 1  AND lr_genrated = 0 AND  vc_id != 0")->result();
		$data['insurance_company'] = $this->db->query("SELECT * FROM `insurance_company_tbl`")->result();
		$data['product_unit_name'] = $this->db->query("SELECT * FROM `product_unit_tbl`")->result();
		$this->load->view('admin/ftl_master/add_lr', $data);
	}

	/// ######################### Ftl request ######################################################################

public function get_ftl_details(){
	$ftl_number = $this->input->post('ftl_number');
	$data = $this->db->query("SELECT ftl_request_tbl.*,vehicle_type_master.vehicle_name  FROM ftl_request_tbl 
	left join vehicle_type_master ON vehicle_type_master.id = ftl_request_tbl.type_of_vehicle 
	WHERE ftl_request_tbl.id = $ftl_number GROUP BY ftl_request_tbl.id ")->row();
    // echo $this->db->last_query();die; 
	echo json_encode($data);
}



	public function insert_lr_details()
	{

		$date = date('Y-m-d', strtotime($this->input->post('booking_date')));
		$this->session->unset_userdata("booking_date");
		$this->session->set_userdata("booking_date", $this->input->post('booking_date'));
		$lrno =	$this->input->post('lr_number');
		$dd = $this->db->query("SELECT lr_number FROM `lr_table` WHERE `lr_number` = '$lrno'")->row();

		$insurance_details = $this->input->post('insurance_details');

		if ($insurance_details == 1) {
			$insurance_number = $this->input->post('insurance_number');
			$insurance_company_name = $this->input->post('insurance_company_name');
			$insurance_charges = $this->input->post('insurance_charges');
			$insurance_date = date('y-m-d', strtotime($this->input->post('insurance_date')));
		}

		$ftlcustomer_id = $this->input->post('customer_account_id234');
		
		if($ftlcustomer_id){
			$customer_id = $ftlcustomer_id;
		}else{
			$customer_id = $this->input->post('customer_account_id');
		}


		if (!empty($dd->lr_number)) {
			$msg = "Already Exist " . $this->input->post('lr_number');
			$class	= 'alert alert-danger alert-dismissible';
			$this->session->set_flashdata('notify', $msg);
			$this->session->set_flashdata('class', $class);
			redirect(base_url() . 'admin/add-lr');
		} else {

			$ftl_request_id = $this->input->post('ftl_number');
			

			$data = array(

				'booking_date' => $date,
				'lr_number' => $lrno,
				'lr_number' => $lrno,
				'order_number' => $this->input->post('order_number'),
				'ftl_number' => $this->input->post('ftl_number'),
				'lorry_number' => $this->input->post('lorry_number'),
				'type_of_vehicle' => $this->input->post('type_of_vehicle'),
				'dispatch_details' => $this->input->post('dispatch_details'),
				'invoice_value' => $this->input->post('invoice_value'),
				'invoice_number' => $this->input->post('invoice_number'),
				'lr_sender_address' => $this->input->post('lr_sender_address'),
				'lr_receiver_address' => $this->input->post('lr_receiver_address'),
				'customer_id' =>$customer_id,
				'sender_name' => $this->input->post('sender_name'),
				'sender_address' => $this->input->post('sender_address'),
				'sender_city' => $this->input->post('sender_city'),
				'sender_state' => $this->input->post('sender_state'),
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
				'receiver_gstno' => $this->input->post('receiver_gstno'),
				'gst_pay' => $this->input->post('gst_pay'),
				'insurance_details' => $insurance_details,
				'insurance_number' => $insurance_number,
				'insurance_company_name' => $insurance_company_name,
				'insurance_charges' => $insurance_charges,
				'insurance_date' => $insurance_date,

			);
			$this->db->trans_start();
			$this->db->query("UPDATE ftl_request_tbl set lr_genrated = '1' WHERE  id = $ftl_request_id ");
			// echo '<pre>';  print_r($data);
			$this->db->insert('lr_table', $data);
			// echo $this->db->last_query();exit;


			$lastid = $this->db->insert_id();

			$data2 = array(
				'lr_id' => $lastid,
				'product_name' => $this->input->post('product_name'),
				'product_weight' => $this->input->post('product_weight'),
				'declare_weight' => $this->input->post('declare_weight'),
				'chargable_weight' => $this->input->post('chargable_weight'),
				'product_unit' => $this->input->post('product_unit'),
				'product_qty' => $this->input->post('product_qty'),

				'frieht_charge' => $this->input->post('frieht_charge'),
				'aso_charge' => $this->input->post('aso_charge'),
				'labour_charge' => $this->input->post('labour_charge'),
				'st_charge' => $this->input->post('st_charge'),
				'lc_charge' => $this->input->post('lc_charge'),
				'misc_charge' => $this->input->post('misc_charge'),
				'ch_post_charge' => $this->input->post('ch_post_charge'),
				'total_charge' => $this->input->post('total_charge'),
				'gst_charge' => $this->input->post('gst_charge'),
				'grand_total' => $this->input->post('grand_total'),
				'total_inv_val' => $this->input->post('total_inv_val'),

			);
             $this->db->insert('lr_product_tbl', $data2);


			 for($i=0; $i<count((array)$this->input->post('inv_no'));$i++){
				$multi_data = array(
					'lr_id'=>$lastid,
					'multi_inv_no' => $this->input->post('inv_no')[$i],
					'multi_inv_value' => $this->input->post('inv_val')[$i],
					'multi_eway_no' => $this->input->post('eway_number')[$i],
				);
			   $this->db->insert('lr_eway_tbl',$multi_data);
			//    echo $this->db->last_query();exit;

			 }
			 $this->db->trans_complete();
			 
			


			$msg   =  'Data Inserted Successfully!!';
			$class	= 'alert alert-success alert-dismissible';

			$this->session->set_flashdata('notify', $msg);
			$this->session->set_flashdata('class', $class);
			redirect(base_url() . 'admin/add-lr');
		}
	}


	public function add_unit()
	{

		$this->load->view('admin/ftl_master/add_unit');
	}

	public function view_ftl_list()
	{

		$data['ftl_list'] = $this->db->query("SELECT lr_table.*,lr_product_tbl.product_name,lr_product_tbl.product_weight,rc.city as reciever_city,sc.city as sender_city FROM lr_table LEFT JOIN lr_product_tbl ON lr_table.lr_id = lr_product_tbl.lr_id LEFT JOIN city as rc ON lr_table.reciever_city = rc.id  LEFT JOIN city as sc ON lr_table.sender_city = sc.id order by lr_id DESC")->result();

		// echo '<pre>'; print_r($data['ftl_list']);die;
		$this->load->view('admin/ftl_master/ftl_list', $data);
	}

	public function view_lr_printlabel($id)
	{
		$data['printlabel'] = $this->db->query("SELECT lr_table.*,rc.city as reciever_city,vehicle_type_master.vehicle_name,sc.city as sender_city FROM lr_table LEFT JOIN city as rc ON lr_table.reciever_city = rc.id LEFT JOIN vehicle_type_master ON lr_table.type_of_vehicle = vehicle_type_master.id LEFT JOIN city as sc ON lr_table.sender_city = sc.id WHERE `lr_id`=" . $id)->result();
		$this->load->view('admin/ftl_master/lr_printlabel', $data);
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
	
	
				$data = array(
	
					'order_date' => $this->input->post('order_date'),
					'vehicle_temperature_log' => $this->input->post('temperature_log'),
					'maintain_temperature_time' => $this->input->post('maintain_temperature_time'),
					'customer_id' => $customer_id,
					'customer_name' => $customer_name,
					'ftl_request_id' => $this->input->post('ftl_request_id'),
					// 'risk_type' => $this->input->post('risk_type'),
					'descrption' => $this->input->post('descrption'),
					'request_date_time' => $request_date_time,
					'origin_city' => $this->input->post('origin_city'),
					'origin_pincode' => $this->input->post('origin_pincode'),
					'origin_state' => $this->input->post('origin_state'),
					'destination_state' => $this->input->post('destination_city'),
					'destination_city' => $this->input->post('destination_state'),
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

				

				//   echo '<pre>'; print_r($data);
				$result = $this->db->update('ftl_request_tbl',$whr, $data);
				//   echo $this->db->last_query();exit;
	
				// $last_id = $this->db->insert_id();
				// $data2 = array(
				// 	'ftl_id' => $last_id,
				// 	'consignee_name' => $this->input->post('consignee_name'),
				// 	'consignee_address' => $this->input->post('consignee_address'),
				// 	'consignee_pincode' => $this->input->post('consignee_pincode'),
				// 	'consignee_state' => $this->input->post('consignee_state'),
				// 	'consignee_city' => $this->input->post('consignee_city'),
				// 	'consignee_contact_no' => $this->input->post('consignee_contact_no'),
	
				// );
				// $result = $this->db->insert('ftl_consignee_tbl', $data2);
	
				if (!empty($result)) {
					$msg			= 'FTL Request inserted successfully';
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
				$data['ftl'] = $this->db->query("SELECT * FROM ftl_request_tbl  where id = $id")->row_array();
				$data['vehicle_type'] = $this->db->query('SELECT * FROM vehicle_type_master')->result();
				$data['goods_name'] = $this->db->query('SELECT * FROM goods_type_tbl')->result();
				$data['goods_name'] = $this->db->query('SELECT * FROM goods_type_tbl')->result();
				$this->load->view('admin/ftl_master/Update_ftl_request', $data);
			}
		}

	public function gat_rfq_customer_data()
	{

		// $current_date12 = date('Y-m-d H:i:s');
		$current_date = date("Y-m-d");
		$customer_id = $this->input->post('customer_id');
		$vehicle_id = $this->input->post('vehicle_id');
		$origin_city = $this->input->post('origin_city_id');
		$destination_city = $this->input->post('destination_city_id');
		//  print_r($destination_city);exit;
		$data =  $this->db->query("select * from  ftl_customer_rate_tbl where ftl_customer_id = '$customer_id' AND vehicle_type ='$vehicle_id' AND origin = '$origin_city' AND destination ='$destination_city' AND to_date>= '" . $current_date . "' ")->row_array();
		//echo $this->db->last_query();
		echo json_encode($data);
	}


	public function getOriginCityList()
	{
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

		$city_id = $res1->row()->city_id;

		$whr2 = array('id' => $city_id);
		$data = $this->db->query("select * from city where id = '$city_id'")->row();

		echo json_encode($data);
	}
	public function getOriginState()
	{
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
		$state_id = $res1->row()->state_id;
		$data = $this->db->query("select * from state where id = '$state_id'")->row();
		// echo $this->db->last_query();
		echo json_encode($data);
	}

	public function getDestinationCityList()
	{
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

		$city_id = $res1->row()->city_id;

		$whr2 = array('id' => $city_id);
		$data = $this->db->query("select * from city where id = '$city_id'")->row();

		echo json_encode($data);
	}
	public function getDestinationState()
	{
		$pincode = $this->input->post('pincode');
		$whr1 = array('pin_code' => $pincode);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
		$state_id = $res1->row()->state_id;
		$data = $this->db->query("select * from state where id = '$state_id'")->row();
		// echo $this->db->last_query();
		echo json_encode($data);
	}

	public function getVehicleCapicty()
	{
		$vehicle_id = $this->input->post('vehicle_id');
		$data = $this->db->query("SELECT * FROM vehicle_type_master where id = '$vehicle_id'")->result_array();
		// echo $this->db->last_query();
		echo json_encode($data);
	}


	public function getCityList()
	{
		$data = array();

		$pincode = $this->input->post('pincode');
		$booking_date = $this->input->post('booking_date');
		$mode_dispatch = $this->input->post('mode_dispatch');
		$sender_city = $this->input->post('sender_city');
		$sender_state = $this->input->post('sender_state');

		$whr1 = array('pin_code' => $pincode,'isdeleted'=>0);
		$res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);


		$pin_code = @$res1->row()->pin_code;
		$city_id = @$res1->row()->city_id;
		$state_id = @$res1->row()->state_id;
		$isODA = @$res1->row()->isODA;

		if ($state_id) {
			$whr2 = array('id' => $state_id);
			$res2 = $this->basic_operation_m->get_table_row('state', $whr2);
			$statecode = $res2->statecode;

		}

		if (!$pin_code) {
			$data['status'] = "failed";
			$data['message'] = "The pin code <b> ".$pincode." </b> is NSS (No Service Station).<br>To add this pin code in system, please contact your Admin/Manager.";
			echo json_encode($data);
			exit();
		}
		$data['status'] = "success";
		$whr2 = array('id' => $city_id);
		$res2 = $this->basic_operation_m->get_table_row('city', $whr2);
		$pincode_city = $res2->id;

		$city_list = $this->basic_operation_m->get_all_result('city', '');

		$resAct = $this->db->query("select service_pincode.*,courier_company.c_id,courier_company.c_company_name from service_pincode JOIN courier_company on courier_company.c_id=service_pincode.forweder_id where pincode='" . $pincode . "' order by serv_pin_id DESC ");


		$data['forwarder'] = array();
		if ($resAct->num_rows() > 0) {
			$data['forwarder'] = $resAct->result_array();
		}

		$option = "";
		$forwarder = "";
		foreach ($city_list as $value) {
			if ($value["id"] == $pincode_city) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			$option .= '<option value="' . $value["id"] . '" ' . $selected . ' >' . $value["city"] . '</option>';
		}

		if (!empty($data['forwarder'])) {
			foreach ($data['forwarder'] as $key => $value) {
				$servicable = '';
				

				if ($value['oda'] == 1) {

					$servicable = ' - ODA Available';

				} else {
					// $servicable = ' ODA Available';
				}
				$forwarder .= "<option value='" . $value["c_company_name"] . "'>" . $value["c_company_name"] . "" . $servicable . "</option>";
			}
		}
		$pincode = $this->input->post('pincode');
		$final_branch = $this->db->query("select branch_id from tbl_branch_service where pincode = '$pincode'")->row();
		$branch_id = $final_branch->branch_id;
		$final_branch_name = $this->db->query("select branch_name from tbl_branch where branch_id = '$branch_id'")->row();
		$forwarder .= "<option value='SELF' selected>SELF</option>";
		unset($data['forwarder']);
		$data['message'] = "";
		$data['option'] = $option;
	
		$data['final_branch_id'] = $final_branch->branch_id;
		$data['final_branch_name'] = $final_branch_name->branch_name;
		$data['forwarder2'] = $forwarder;
		$data['city_id'] = $city_id;
		$data['state_id'] = $state_id;
		$data['statecode'] = $statecode;
		$data['edd_date'] = isset($edd_date) ? date('d-m-Y', strtotime($edd_date)) : " ";
		// $data['edd_date'] = isset($edd_date) ? date('d-m-Y', strtotime($edd_date)) : date('d-m-Y');
		$data['edd_days'] = !empty($EDD) ? $EDD : '';

		echo json_encode($data);
	}
}
