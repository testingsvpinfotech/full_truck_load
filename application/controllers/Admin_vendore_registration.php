<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_vendore_registration extends CI_Controller {

	function __construct()
	{
		 parent:: __construct();
		 $this->load->model('basic_operation_m');
		 if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}


	public function index($offset = '0')
	{
		$vendor_list = $this->db->query("select * from tbl_vendor_customer JOIN city ON city.id = tbl_vendor_customer.city JOIN state ON state.id = tbl_vendor_customer.state ORDER BY customer_id  DESC limit " . $offset . ",10");

		$resActt = $this->db->query("select * from tbl_vendor_customer");

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

		$this->load->view('admin/vendor_customer_master/ftl_customer_vendor', $data);
	}

	public function add_ftl_vendor(){

		$user_id = $this->session->userdata('userId');

	 if (isset($_POST['submit'])) {
		// basic validation
		if(!empty($this->input->post('state')) && !empty($this->input->post('city'))){
			$pincode = $this->input->post('pincode');
			$state = $this->input->post('state');
			$city_id = $this->input->post('city');
			$city = $this->db->query("SELECT * FROM pincode WHERE pin_code ='$pincode' AND city_id = '$city_id' AND state_id ='$state'")->row();
			if(empty($city)){
				$msg			= 'State or City Not valid ';
				$class			= 'alert alert-danger alert-dismissible';
				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
				redirect('admin/add-ftl-vendor');
			}				
		}
		 NumValidation($this->input->post('phone'),'Contact No Not Valid','admin/add-ftl-vendor');
		 NumValidation($this->input->post('alternate_number'),'Alternate Contact No Not Valid','admin/add-ftl-vendor');
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
		   'vid' => $this->input->post('vci'),
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

	   $this->db->insert('tbl_vendor_customer', $data);
		$last_id = $this->db->insert_id();
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

		   $res = $this->db->insert('tbl_vendor_customer_service_area', $data); 
		}
	  if(!empty($res)){
		$this->session->set_flashdata('msg', 'Registration Successfully!! Now Proceed For Login ');
		redirect(base_url() . 'admin/add-ftl-vendor');
	  }else{
		$this->session->set_flashdata('msg', 'Something went Wrong');
		redirect(base_url() . 'admin/add-ftl-vendor');
	  }
	 } else {

		$result = $this->db->query("select max(customer_id) AS id from tbl_vendor_customer")->row();
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
		$data['cities'] = $this->basic_operation_m->get_all_result('city', '');
		$data['states'] = $this->basic_operation_m->get_all_result('state', '');
		$data['vehicle_type'] = $this->db->query('SELECT * FROM tbl_vehicle_type')->result();
		//  print_r($data['VCI']);exit;
		$this->load->view('admin/vendor_customer_master/vendor_registration',$data);
	}
	
	 
  }

}
?>