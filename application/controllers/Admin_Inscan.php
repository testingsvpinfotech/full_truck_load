<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Inscan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('basic_operation_m');
		if ($this->session->userdata('userId') == '') {
			redirect('admin');
		}
	}

	// public function in_scan()
	// {
	// 	$data = array();
	// 	$awb = $this->input->post('awb_no');
	// 	$submit = $this->input->post('awb');
	// 	if ($awb) {
	// 		$where = array('pod_no' => $awb);
	// 		$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $where);
	// 	}
	// 	if ($submit) {
	// 		$where = array('pod_no' => $submit);
	// 		$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $where);
	// 		$all_data['pod_no'] = $this->input->post('awb');
	// 		$all_data['booking_id'] = $data['result'][0]['booking_id'];
	// 		$all_data['forwording_no'] = $data['result'][0]['forwording_no'];
	// 		$all_data['forworder_name'] = $data['result'][0]['forworder_name'];
	// 		$all_data['branch_name'] = $this->input->post('branch');
	// 		$all_data['status'] = 'In-scan';
	// 		$all_data['status'] = 'In-scan';
	// 		// print_r($all_data);die();

	// 		if ($this->basic_operation_m->insert('tbl_domestic_tracking', $all_data)) {

	// 			$msg = 'Scanning successfully';
	// 			$class	= 'alert alert-success alert-dismissible';

	// 			$this->session->set_flashdata('notify', $msg);
	// 			$this->session->set_flashdata('class', $class);
	// 		} else {
	// 			$msg = 'Something went wrong in deleting the Fule';
	// 			$class	= 'alert alert-success alert-dismissible';

	// 			$this->session->set_flashdata('notify', $msg);
	// 			$this->session->set_flashdata('class', $class);
	// 		}
	// 		redirect('admin/inscan');
	// 	}

	// 	$this->load->view('admin/inscan/inscan_add', $data);
	// }
	public function in_scan()
	{
		if ($_POST) {
			$awb =  $this->input->post('pod_no');

			$username = $this->session->userdata("userName");
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;
			$user_id = $res->row()->user_id;
			$whr = array('branch_id' => $branch_id);
			$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
			$branch_name = $res->row()->branch_name;

			$where = array('branch_id' => $branch_id);
			$ress					=	$this->basic_operation_m->getAll('tbl_branch', $where);
			$source_branch		= 	$ress->row()->branch_name;
			date_default_timezone_set('Asia/Kolkata');
			$timestamp = date("Y-m-d H:i:s");

			foreach ($awb as $value) {
				$where = array('pod_no' => $value);
				$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $where);
				$all_data['pod_no'] = $value;
				$all_data['booking_id'] = $data['result'][0]['booking_id'];
				$all_data['forwording_no'] = $data['result'][0]['forwording_no'];
				$all_data['forworder_name'] = $data['result'][0]['forworder_name'];
				$all_data['branch_name'] = $source_branch;
				$all_data['status'] = 'In-scan';
				$all_data['status'] = 'In-scan';
				$all_data['tracking_date'] = $timestamp;
				$this->basic_operation_m->insert('tbl_domestic_tracking', $all_data);

				//echo $this->db->last_query();die();
			}
			if ($data) {

				$msg = 'Branch In Scanning successfully';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			} else {
				$msg = 'Something went wrong in deleting the Fule';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			}
			redirect('admin/inscan');
		}

		$this->load->view('admin/inscan/inscan_add', $data);
	}


	


	public function branch_awb_scan()
	{
		$awb = $this->input->post('forwording_no');
		$resAct5 = $this->db->query("select * from tbl_domestic_booking where pod_no = '$awb'");
		// echo  $this->db->last_query();die;
		$booking_row = $resAct5->row_array();
		// print_r($booking_row);die();
		$pod =  $booking_row['pod_no'];
		$booking_id = $booking_row['booking_id'];

		$query_result = $this->db->query("select * from tbl_domestic_weight_details where booking_id = '$booking_id'")->row_array();

		$actual_weight = $query_result['actual_weight'];
		//$no_of_pack	   = $booking_row['a_qty'];
		$no_of_pack = $query_result['no_of_pack'];
		$podid 		   = "checkbox-" . $pod;
		$dataid 	   = 'data-val-' . $booking_id;
		$data = "";
		$pod_no = $booking_row['pod_no'];
		$data .= '<tr><td>';
		$data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked><input type='hidden' name='actual_weight[]' value='" . $actual_weight . "'/><input type='hidden' name='pcs[]' value='" . $no_of_pack . "'/></td>";

		// $data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked>";

		$data .= "<input type='checkbox' class='cb'  name='actual_weight[]' value='" . $actual_weight . "' checked>";
		$data .= "<input type='checkbox' class='cb'  name='pcs[]' value='" . $no_of_pack . "' checked>";

		$data .= "<input type='hidden' name='rec_pincode' value=" . $booking_row['reciever_pincode'] . "><td>";
		$data .= $booking_row['pod_no'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['sender_name'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['reciever_name'];
		$data .= "</td>";
		$data .= "<td><input type='hidden' readonly name='forwarder_name' id='forwarder_name'  class='form-control' value='" . $booking_row['forworder_name'] . "'/><input type='hidden' readonly name='branch_name' id='branch_name'  class='form-control' value='" . $branch_name . "'/>";
		$data .= $booking_row['forworder_name'];
		$data .= "</td>";
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['sender_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['reciever_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$data .= "<td>";
		$data .= $booking_row['dispatch_details'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $no_of_pack;
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['actual_weight'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['chargable_weight'];
		$data .= "</td>";
		$data .= "</tr>";
		if (empty($booking_row)) {
			$val = '<script type="text/javascript">
			$(document).ready(function(e) {
			alert("AWB Not Exists");
			});
			</script>';
           echo $val;
		} else {
			echo  $data;
		}
	}

	public function in_scan_awb_scan()
	{

		$awb = $this->input->post('forwording_no');
		$resAct5 = $this->db->query("select * from tbl_domestic_booking where pod_no = '$awb'");
		// echo  $this->db->last_query();die;
		$booking_row = $resAct5->row_array();
		// print_r($booking_row);die();
		$pod =  $booking_row['pod_no'];
		$booking_id = $booking_row['booking_id'];

		$query_result = $this->db->query("select * from tbl_domestic_weight_details where booking_id = '$booking_id'")->row_array();

		$actual_weight = $query_result['actual_weight'];
		//$no_of_pack	   = $booking_row['a_qty'];
		$no_of_pack = $query_result['no_of_pack'];
		$podid 		   = "checkbox-" . $pod;
		$dataid 	   = 'data-val-' . $booking_id;
		$data = "";
		$pod_no = $booking_row['pod_no'];
		$data .= '<tr><td>';
		$data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked><input type='hidden' name='actual_weight[]' value='" . $actual_weight . "'/><input type='hidden' name='pcs[]' value='" . $no_of_pack . "'/></td>";

		// $data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked>";

		$data .= "<input type='checkbox' class='cb'  name='actual_weight[]' value='" . $actual_weight . "' checked>";
		$data .= "<input type='checkbox' class='cb'  name='pcs[]' value='" . $no_of_pack . "' checked>";

		$data .= "<input type='hidden' name='rec_pincode' value=" . $booking_row['reciever_pincode'] . "><td>";
		$data .= $booking_row['pod_no'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['sender_name'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['reciever_name'];
		$data .= "</td>";
		$data .= "<td><input type='hidden' readonly name='forwarder_name' id='forwarder_name'  class='form-control' value='" . $booking_row['forworder_name'] . "'/><input type='hidden' readonly name='branch_name' id='branch_name'  class='form-control' value='" . $branch_name . "'/>";
		$data .= $booking_row['forworder_name'];
		$data .= "</td>";
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['sender_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['reciever_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$data .= "<td>";
		$data .= $booking_row['dispatch_details'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $no_of_pack;
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['actual_weight'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['chargable_weight'];
		$data .= "</td>";
		$data .= "</tr>";
		if (empty($booking_row)) {
			$val = '<script type="text/javascript">
			$(document).ready(function(e) {
			alert("AWB Not Exists");
			});
			</script>';
echo $val;
		} else {
			echo  $data;
		}
	}
	
	public function pickup_awb_scan()
	{

		$awb = $this->input->post('forwording_no');
		$resAct5 = $this->db->query("select * from tbl_domestic_booking where pod_no = '$awb'");
		// echo  $this->db->last_query();die;
		$booking_row = $resAct5->row_array();
		// print_r($booking_row);die();
		$pod =  $booking_row['pod_no'];
		$booking_id = $booking_row['booking_id'];

		$query_result = $this->db->query("select * from tbl_domestic_weight_details where booking_id = '$booking_id'")->row_array();

		$actual_weight = $query_result['actual_weight'];
		//$no_of_pack	   = $booking_row['a_qty'];
		$no_of_pack = $query_result['no_of_pack'];
		$podid 		   = "checkbox-" . $pod;
		$dataid 	   = 'data-val-' . $booking_id;
		$data = "";
		$pod_no = $booking_row['pod_no'];
		$data .= '<tr><td>';
		$data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked><input type='hidden' name='actual_weight[]' value='" . $actual_weight . "'/><input type='hidden' name='pcs[]' value='" . $no_of_pack . "'/></td>";

		// $data .= "<input type='checkbox' class='cb'  name='pod_no[]'  data-tp='{$no_of_pack}' data-tw='{$actual_weight}' value='{$pod_no}' checked>";

		$data .= "<input type='checkbox' class='cb'  name='actual_weight[]' value='" . $actual_weight . "' checked>";
		$data .= "<input type='checkbox' class='cb'  name='pcs[]' value='" . $no_of_pack . "' checked>";

		$data .= "<input type='hidden' name='rec_pincode' value=" . $booking_row['reciever_pincode'] . "><td>";
		$data .= $booking_row['pod_no'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['sender_name'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $booking_row['reciever_name'];
		$data .= "</td>";
		$data .= "<td><input type='hidden' readonly name='forwarder_name' id='forwarder_name'  class='form-control' value='" . $booking_row['forworder_name'] . "'/><input type='hidden' readonly name='branch_name' id='branch_name'  class='form-control' value='" . $branch_name . "'/>";
		$data .= $booking_row['forworder_name'];
		$data .= "</td>";
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['sender_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$resAct6 = $this->db->query("select * from city where id ='" . $booking_row['reciever_city'] . "'");
		if ($resAct6->num_rows() > 0) {
			$citydata  		 = $resAct6->row();
			$data		 	.= "<td>";
			$data		 	.= $citydata->city;
			$data	 		.= "</td>";
		}
		$data .= "<td>";
		$data .= $booking_row['dispatch_details'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $no_of_pack;
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['actual_weight'];
		$data .= "</td>";
		$data .= "<td>";
		$data .= $query_result['chargable_weight'];
		$data .= "</td>";
		$data .= "</tr>";
		if (empty($booking_row)) {
			$val = '<script type="text/javascript">
			$(document).ready(function(e) {
			alert("AWB Not Exists");
			});
			</script>';
echo $val;
		} else {
			echo  $data;
		}
	}






	public function pickup_in_scan_status_insert()
	{

		if ($_POST) {
			$awb =  $this->input->post('pod_no');

			$username = $this->session->userdata("userName");
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;
			$user_id = $res->row()->user_id;
			$whr = array('branch_id' => $branch_id);
			$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
			$branch_name = $res->row()->branch_name;

			$where = array('branch_id' => $branch_id);
			$ress					=	$this->basic_operation_m->getAll('tbl_branch', $where);
			$source_branch		= 	$ress->row()->branch_name;
			date_default_timezone_set('Asia/Kolkata');
			$timestamp = date("Y-m-d H:i:s");

			foreach ($awb as $value) {
				$where = array('pod_no' => $value);
				$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $where);
				$all_data['pod_no'] = $value;
				$all_data['booking_id'] = $data['result'][0]['booking_id'];
				$all_data['forwording_no'] = $data['result'][0]['forwording_no'];
				$all_data['forworder_name'] = $data['result'][0]['forworder_name'];
				$all_data['branch_name'] = $source_branch;
				$all_data['status'] = 'Pickup-In-scan';
				$all_data['status'] = 'Pickup-In-scan';
				$all_data['tracking_date'] = $timestamp;
				$this->basic_operation_m->insert('tbl_domestic_tracking', $all_data);

				//echo $this->db->last_query();die();
			}
			if ($data) {

				$msg = 'Pickup Scanning successfully';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			} else {
				$msg = 'Something went wrong in deleting the Fule';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			}
			redirect('admin/pickup-in-scan');
		}
		$this->load->view('admin/inscan/pickup_inscan_add', $data);
	}

	public function brnach_in_scan_insert()
	{

		if ($_POST) {
			$awb =  $this->input->post('pod_no');

			$username = $this->session->userdata("userName");
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;
			$user_id = $res->row()->user_id;
			$whr = array('branch_id' => $branch_id);
			$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
			$branch_name = $res->row()->branch_name;

			$where = array('branch_id' => $branch_id);
			$ress					=	$this->basic_operation_m->getAll('tbl_branch', $where);
			$source_branch		= 	$ress->row()->branch_name;
			date_default_timezone_set('Asia/Kolkata');
			$timestamp = date("Y-m-d H:i:s");
			foreach ($awb as $value) {
				$where = array('pod_no' => $value);
				$data['result'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $where);
				$all_data['pod_no'] = $value;
				$all_data['booking_id'] = $data['result'][0]['booking_id'];
				$all_data['forwording_no'] = $data['result'][0]['forwording_no'];
				$all_data['forworder_name'] = $data['result'][0]['forworder_name'];
				$all_data['branch_name'] = $source_branch;
				$all_data['status'] = 'In-Scan-Branch';
				$all_data['status'] = 'In-Scan-Branch';
				$all_data['tracking_date'] = $timestamp;

				$this->basic_operation_m->insert('tbl_domestic_tracking', $all_data);
				// echo $this->db->last_query();die();
			}
			if ($data) {

				$msg = 'Branch In Scanning successfully';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			} else {
				$msg = 'Something went wrong in deleting the Fule';
				$class	= 'alert alert-success alert-dismissible';

				$this->session->set_flashdata('notify', $msg);
				$this->session->set_flashdata('class', $class);
			}
			redirect('admin/branch-in-scan');
		}
		$this->load->view('admin/inscan/branch_in_scan', $data);
	}




	public function add_bank()
	{

		$data['message']				= "";
		$array['airway_no_from'] 		= array();
		$array['airway_no_to'] 			= array();
		$array['branch_code'] 			= array();

		if (isset($_POST['submit'])) {
			$all_data = $this->input->post();
			unset($all_data['submit']);
			$result = $this->basic_operation_m->insert('bank_master', $all_data);
			if ($this->db->affected_rows() > 0) {
				$data['message'] = "cnode Added Sucessfully";
			} else {
				$data['message'] = "Error in Query";
			}
			redirect('admin/view-bank');
		}
		$this->load->view('admin/Bank_Master/view_bank', $data);
	}

	public function edit_bank($vehicle_id)
	{
		$data['message'] = "";
		$resAct = $this->basic_operation_m->getAll('bank_master', "id = '$vehicle_id'");
		if ($resAct->num_rows() > 0) {
			$data['vehicle_info'] = $resAct->row();
		}

		if (isset($_POST['submit'])) {
			$all_data = $this->input->post();
			unset($all_data['submit']);
			$whr = array('id' => $vehicle_id);
			$result = $this->basic_operation_m->update('bank_master', $all_data, $whr);
			if ($this->db->affected_rows() > 0) {
				$data['message'] = "Cnode Updated Sucessfully";
			} else {
				$data['message'] = "Error in Query";
			}
			redirect('admin/view-bank');
		}
		$this->load->view('admin/Bank_Master/edit_bank', $data);
	}

	public function delete_bank()
	{
		$id = $this->input->post('getid');
		// 		$data['message']="";
		if ($id != "") {
			$whr = array('id' => $id);
			$res = $this->basic_operation_m->delete('bank_master', $whr);
			//	echo $this->db->last_qurey();die();
			$output['status'] = 'success';
			$output['message'] = 'Fule deleted successfully';
		} else {
			$output['status'] = 'error';
			$output['message'] = 'Something went wrong in deleting the Fule';
		}

		echo json_encode($output);
	}
}
