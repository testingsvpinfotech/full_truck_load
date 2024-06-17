<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_franchise_fuel extends CI_Controller {

	var $data 			= array();
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
        if (isset($_POST['submit'])) {
            $all_data = $this->input->post();
            unset($all_data['submit']);
            $result = $this->basic_operation_m->insert('tbl_rate_group_master', $all_data);
            if ($this->db->affected_rows() > 0) {
                $data['message'] = "Fule Group Name Added Sucessfully";
            } else {
                $data['message'] = "Error in Query";
            }
            redirect('admin/fule-group-master');
        }
        $data = array();
        $resAct    = $this->db->query("select * from tbl_rate_group_master where groups_id ='2' ");
        if ($resAct->num_rows() > 0) {
            $data['allvehicletype'] = $resAct->result_array();
        }

        $this->load->view('admin/franchise_fuel_master/add_fuel_group_name', $data);
    }
	
	
	###################### View All Airlines Start ########################
	public function all_fuel()
	{  
	   
		$data 							= $this->data;
		$user_id						= $this->session->userdata("userId");
		$data['fule_company']			= $this->basic_operation_m->get_query_result("select franchise_fule_tbl.*, tbl_rate_group_master.group_name as group_name from franchise_fule_tbl left join tbl_rate_group_master on tbl_rate_group_master.id = franchise_fule_tbl.group_id Group By franchise_fule_tbl.fuel_id");
	
        $this->load->view('admin/franchise_fuel_master/view_fuel',$data);
      
	}
	
	public function addfuel()
	{  		
		$data['all_customer']		= $this->db->query("select * from tbl_rate_group_master where groups_id = 2 ")->result_array();
        $this->load->view('admin/franchise_fuel_master/view_add_fuel',$data);
      
	}
	
	public function insertfuel()
	{  
		// if(isset($_POST['save'])){
			//print_r($_POST);exit;
		$data = array(
			'fov_rate'=>$this->input->post('fov_rate'),
			'awb_rate'=>$this->input->post('awb_rate'),
			'cod_rate'=>$this->input->post('cod_rate'),
			'cod_percentage'=>$this->input->post('cod_percentage'),
			'fule_percentage'=>$this->input->post('fule_percentage'),
			'cod_min'=>$this->input->post('cod_min'),
			'group_id'=>$this->input->post('cf_id'),
			'from_date'=>$this->input->post('from_date'),
			'to_date'=>$this->input->post('to_date')
		);

		//print_r($data);exit;
		$res = $this->db->insert('franchise_fule_tbl',$data);

		if($res){
			$msg					= 'Franchise Fuel Add successfully';
			$class					= 'alert alert-success alert-dismissible';	
			
		}
		else
		{
			$msg			= 'Fuel not Add successfully';
			$class			= 'alert alert-danger alert-dismissible';	
			
		}
		
		$this->session->set_flashdata('notify',$msg);
		$this->session->set_flashdata('class',$class);
		
		redirect('admin/all-franchise-fuel');
	// }
 }
	
	public function deletefuel()
	{  
	     $id = $this->input->post('getid');
		if(!empty($id))
		{
			$airlines_company		= $this->basic_operation_m->delete("franchise_fule_tbl","fuel_id = '$id'");
			//$airlines_company		= $this->basic_operation_m->delete("franchise_fuel_detail","cf_id = '$id'");

			$output['status'] = 'success';
			$output['message'] = 'Fule deleted successfully';
		}
		else{
			$output['status'] = 'error';
			$output['message'] = 'Something went wrong in deleting the Fule';
		}
 
		echo json_encode($output);	
	}
	
	// public function editfuel($id)
	// {  
	// 	$data				 				= $this->data;
	// 	if(!empty($id))
	// 	{
	// 		$data['courier_company']	= $this->basic_operation_m->get_all_result("courier_company","");
	// 		$data['fuel_list']		= $this->basic_operation_m->get_query_row("select * from franchise_fuel  where franchise_fuel.cf_id = '$id'");
	// 		$data['fuel_detail']		= $this->basic_operation_m->get_query_result("select * from courier_fuel_detail  where cf_id = '$id'");
	// 		$data['all_customer']		= $this->basic_operation_m->get_all_result("tbl_rate_group_master","");
			
	// 	}
	// 	$this->load->view('admin/franchise_fuel_master/view_edit_fuel',$data);
	// }
	
	// public function updatefuel($id)
	// {  
	// 	$alldata 							= $this->input->post();
	// 	$n_data 							= $alldata;
	// 	unset($n_data['cod_range_from']);
	// 	unset($n_data['cod_range_to']);
	// 	unset($n_data['cod_range_rate']);
	// 	unset($n_data['topay_range_from']);
	// 	unset($n_data['topay_range_to']);
	// 	unset($n_data['topay_range_rate']);
		
	// 	if(!empty($alldata))
	// 	{
	// 		$status							= $this->basic_operation_m->update("franchise_fuel",$n_data,"cf_id = '$id'");
		
	// 		$airlines_company				= $this->basic_operation_m->delete("franchise_fuel_detail","cf_id = '$id'");
	// 		if(!empty($alldata['cod_range_from']) )
	// 		{
	// 			foreach($alldata['cod_range_from'] as $key => $values)
	// 			{
	// 				$this->basic_operation_m->insert("franchise_fuel_detail",array('cf_id'=>$id,'cod_range_from'=>$alldata['cod_range_from'][$key],'cod_range_to'=>$alldata['cod_range_to'][$key],'cod_range_rate'=>$alldata['cod_range_rate'][$key]));
	// 			}
	// 		}
			
	// 		if(!empty($alldata['topay_range_from']))
	// 		{
	// 			foreach($alldata['topay_range_from'] as $key => $values)
	// 			{
	// 				$this->basic_operation_m->insert("franchise_fuel_detail",array('cf_id'=>$id,'topay_range_from'=>$alldata['topay_range_from'][$key],'topay_range_to'=>$alldata['topay_range_to'][$key],'topay_range_rate'=>$alldata['topay_range_rate'][$key]));
	// 			}
	// 		}
			
	// 		$msg							= 'Franchise Fuel updated successfully';
	// 		$class							= 'alert alert-success alert-dismissible';	
			
	// 	}
	// 	else
	// 	{
	// 		$msg			= 'Fuel not updated successfully';
	// 		$class			= 'alert alert-danger alert-dismissible';	
			
	// 	}
	// 	$this->session->set_flashdata('notify',$msg);
	// 	$this->session->set_flashdata('class',$class);
		
	// 	redirect('admin/all-franchise-fuel');
	
	// }
	
	
	
	###################### View All Airlines End ########################	
	
	
   
}
?>
