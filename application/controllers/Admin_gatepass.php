<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_gatepass extends CI_Controller
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
		$search = $this->input->post('menifest');
		$search2 = $this->input->post('bag_scan');
		$user_id = $this->session->userdata('userId');
		if ($search) {
			$whr3 = array('manifiest_id'=>$search,'gatepass' => '0','source_branch'=> $source_branch);
			$ress = $this->basic_operation_m->getAll('tbl_domestic_menifiest', $whr3);
			$data['result']		= 	$ress->result();
			
		}else{
			$whr3 = array('bag_no'=>$search2,'gatepass' => '0','source_branch'=> $source_branch);
			$ress = $this->basic_operation_m->getAll('tbl_domestic_menifiest', $whr3);
			$data['result']		= 	$ress->result();
			
		}
		$this->load->view('admin/Gatepass/gatepass_genrate', $data);
	}
	public function gatepass_genrated()
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
				$ress					=	$this->basic_operation_m->getAll('tbl_gatepass', $where3);
				$data['result']		= 	$ress->result();
				//print_r($data['menifest']);die();
			}else{
				
				$ress					=	$this->basic_operation_m->getAll('tbl_gatepass', '');
				$data['result']		= 	$ress->result();
			}
		}else{
		if ($this->input->post()) {
			$where3 = array('gatepass_no'=>$search2,'origin' => $source_branch);
			$ress					=	$this->basic_operation_m->getAll('tbl_gatepass', $where3);
			$data['result']		= 	$ress->result();
			//echo $this->db->last_query();die();
			//print_r($data['result']);die();
		}else{
			$where2 = array('origin' => $source_branch);
			$ress					=	$this->basic_operation_m->getAll('tbl_gatepass', $where2);
			$data['result']		= 	$ress->result();
		}}
		$this->load->view('admin/Gatepass/view_gatepass_genrated', $data);
	}


	public function genrate_gatepass()
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
			$bag = $this->input->post('bag');
			$manifiest_id = $this->input->post('manifiest_id');
			
			$where = array('bag_id' => $bag,'source_branch'=>$source_branch);
			$result = $this->basic_operation_m->get_all_result('tbl_domestic_bag', $where);
			//echo '<pre>';print_r($result);die();

			foreach($result as $value){
			$all_data['pod_no'] = $value['pod_no'];
			$all_data['forwording_no'] = $value['forwording_no'];
			$all_data['forworder_name'] = $value['forwarder_name'];
			$all_data['branch_name'] = $value['source_branch'];
			$all_data['added_branch'] = $value['source_branch'];
			$all_data['status'] = 'getpass-genrated';
			$all_data['tracking_date'] = $this->input->post('datetime');
			$track = $this->basic_operation_m->insert('tbl_domestic_tracking', $all_data);
			}
			
			//echo $this->db->last_query();die();
				//$pod = $this->input->post('pod'); 
				
				$menifestid = $this->db->query('select max(id) AS id from tbl_gatepass')->row();
				$inc_id = $menifestid->id + 1;
				$id = $menifestid->id + 1;
				$bag = $menifestid->id + 1;
				
				if (strlen($bag) == 2) {
					$gatpass = 'GTP00' . $bag;
				} else if (strlen($bag) == 3) {
					$gatpass = 'GTP0' . $bag;
				} else if (strlen($bag) == 1) {
					$gatpass = 'GTP000' . $bag;
				} else if (strlen($bag) == 4) {
					$gatpass = 'GTP' . $bag;
				}


				$data = array( 
					'gatepass_no'=> $gatpass,
					'manifiest_id'=> $manifiest_id,
					'bag_no'=> $result[0]['bag_id'],
					'total_no_bag'=> count($result),
					'lock_no' => $this->input->post('lock_no'),
					'driver_name' => $this->input->post('driver_name'),
					'origin' => $result[0]['source_branch'],
					'destination' => $this->input->post('destination'),
					'datetime' => $this->input->post('datetime'),
					'genrated_by' => $this->input->post('username'),
					'vehicle_no' => $this->input->post('vehicle_no')
				);
				
				$result5 = $this->basic_operation_m->insert('tbl_gatepass', $data);
				$whr = array('manifiest_id' => $manifiest_id,'source_branch'=>$source_branch);
				$data1['gatepass'] = 1;
				$data1['gatepass_no'] =$gatpass;
			    $value = $this->basic_operation_m->update('tbl_domestic_menifiest', $data1, $whr);
				// echo  $this->db->last_query();die();
				//print_r($this->input->post('manifiest_id')); die();
               // var_dump($result5);die();
				if ($result5) {
                    $msg = 'Gatepass Genrated successfully';
					$class	= 'alert alert-success alert-dismissible';

					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
					
					
				} else {
					
					$msg = 'Something went wrong ';
					$class	= 'alert alert-success alert-dismissible';

					$this->session->set_flashdata('notify', $msg);
					$this->session->set_flashdata('class', $class);
				}
				redirect('admin/gatepass');
				
			


			$this->load->view('admin/Bagmaster/bag_genrate', $data);
		}
	}
}
