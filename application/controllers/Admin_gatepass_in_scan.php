<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_gatepass_in_scan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('basic_operation_m');
		if ($this->session->userdata('userId') == '') {
			redirect('admin');
		}
	}

	public function index()
	{
		$data = array();
		$ress					=	$this->basic_operation_m->getAll('tbl_branch', '');
		$data['all_branch']		= 	$ress->result();
		$username = $this->session->userdata("userName");
		$whr = array('username' => $username);
		$res = $this->basic_operation_m->getAll('tbl_users', $whr);
		$branch_id = $res->row()->branch_id;

		$user_id = $res->row()->user_id;
		$where = array('branch_id' => $branch_id);
		$ress					=	$this->basic_operation_m->getAll('tbl_branch', $where);
		$source_branch		= 	$ress->row()->branch_name;
		$search = $this->input->post('gatepass_no');
		$search2 = $this->input->post('bag_scan');
		$user_id = $this->session->userdata('userId');
		if ($search) {
			$whr3 = array('gatepass_no'=>$search,'destination_branch'=> $source_branch,'gatepass'=>'1','gatepass_in_scan'=>'0');
			$ress = $this->basic_operation_m->getAll('tbl_domestic_menifiest', $whr3);
			
		   //echo $this->db->last_query();die();
			$data['result']		= 	$ress->result();//print_r($data['result']);die();
		}else{
			$whr3 = array('gatepass_no'=>$search2,'source_branch'=> $source_branch,'gatepass'=>'1');
			$ress = $this->basic_operation_m->getAll('tbl_domestic_menifiest', $whr3);
			$data['result']		= 	$ress->result();
			
		} 
		$this->load->view('admin/Gatepass_in_scan/gatepass_in_scan_genrate', $data);
	}
	public function gatepass_in_scan_genrated()
	{
		$data = array();
		$ress					=	$this->basic_operation_m->getAll('tbl_branch', '');
		$data['all_branch']		= 	$ress->result();
		$username = $this->session->userdata("userName");
		$whr = array('username' => $username);
		$res = $this->basic_operation_m->getAll('tbl_users', $whr);
		$branch_id = $res->row()->branch_id;
		$user_id = $res->row()->user_id;
		$where = array('branch_id' => $branch_id);
		$where = array('branch_id' => $branch_id);
		$ress					=	$this->basic_operation_m->getAll('tbl_branch', $where);
		$source_branch		= 	$ress->row()->branch_name;
		$where1 = array('source_branch' => $source_branch, 'genrate_bag' => '0','manifiest_verifed'=>'1');
		$ress					=	$this->basic_operation_m->getAll('tbl_bagmaster', $where);
		$data['bag']		= 	$ress->result();
		$ress					=	$this->basic_operation_m->getAll('tbl_domestic_menifiest', $where1);
		$data['menifest']		= 	$ress->result();
		// $search = $this->input->post('menifest');
		$search2 = $this->input->post('gate_no');
		$user_id = $this->session->userdata('userId');
		if($user_id == '1'){
            if ($this->input->post()) {
				$where3 = array('gatepass_no'=>$search2);
				$ress					=	$this->basic_operation_m->getAll('tbl_domestic_gatepass_in_scan', $where3);
				$data['result']		= 	$ress->result();
				//print_r($data['menifest']);die();
			}else{
				
				$ress					=	$this->basic_operation_m->getAll('tbl_domestic_gatepass_in_scan', $where2);
				$data['result']		= 	$ress->result();
			}
		}else{
		if ($this->input->post()) {
			$where3 = array('destination_branch' => $source_branch, 'gatepass_no'=>$search2);
			$ress					=	$this->basic_operation_m->getAll('tbl_domestic_gatepass_in_scan', $where3);
			$data['result']		= 	$ress->result();
			//print_r($data['menifest']);die();
		}else{
			$where2 = array('destination_branch' => $source_branch);
			$ress					=	$this->basic_operation_m->getAll('tbl_domestic_gatepass_in_scan', $where2);
			$data['result']		= 	$ress->result();
		}}
		$this->load->view('admin/Gatepass_in_scan/view_gatepass_genrated', $data);
	}


	public function gatepass_genrated_in_scan()
	{
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
		//print_r($branch_name);die();
		if ($this->input->post()) {
			$pod = $this->input->post('pod');
			$manifiest_id = $this->input->post('manifiest_id');
			//print_r($manifiest_id);die();
			$where1 = array('manifiest_id' => $manifiest_id);
			$resul = $this->basic_operation_m->get_all_result('tbl_domestic_menifiest', $where1);
			$val = $resul[0]['bag_no'];
			//print_r($val);die();
            $where = array('bag_id' => $val);
			$result = $this->basic_operation_m->get_all_result('tbl_domestic_bag', $where);
			// echo $this->db->last_query();die();
			//echo '<pre>';print_r($result);die();

			foreach($result as $value){
			$all_data['pod_no'] = $value['pod_no'];
			$all_data['forwording_no'] = $value['forwording_no'];
			$all_data['forworder_name'] = $value['forwarder_name'];
			$all_data['branch_name'] = $value['source_branch'];
			$all_data['added_branch'] = $value['source_branch'];
			$all_data['status'] = 'getpass-in-scan';
			$all_data['tracking_date'] = $this->input->post('datetime');
			$track = $this->basic_operation_m->insert('tbl_domestic_tracking', $all_data);
			}
				$data = array( 
					'gatepass_in_scan' => '1'
				);

				$whr4 = array('destination_branch'=>$source_branch,'manifiest_id' =>$manifiest_id);
				$result5 = $this->basic_operation_m->update('tbl_domestic_menifiest',$data,$whr4);
                   
				$valu['gatepass_no'] = $resul[0]['gatepass_no'];
				$valu['manifiest_id'] = $resul[0]['manifiest_id'];
				$valu['bag_no'] = $resul[0]['bag_no'];
				$valu['source_branch'] = $resul[0]['source_branch'];
				$valu['destination_branch'] = $resul[0]['destination_branch'];
				$valu['lorry_no'] = $resul[0]['lorry_no'];
				$valu['driver_name'] = $resul[0]['driver_name'];
				$valu['date'] = $this->input->post('datetime');
				$valu['in_scan'] = $this->input->post('username');
				$track = $this->basic_operation_m->insert('tbl_domestic_gatepass_in_scan',$valu);
				//echo $this->db->last_query();die();
				if ($result5 && $track) {
					
					$msg = 'Something went wrong ';
					$class	= 'alert alert-success alert-dismissible';

					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
					
				} else {
					
					$msg = 'Gatepass In-Scan successfully';
					$class	= 'alert alert-success alert-dismissible';

					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
				}
				redirect('admin/gatepass-in-scan');
				
			


			$this->load->view('admin/Bagmaster/bag_genrate', $data);
		}
	}
}
