<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_domestic_zone_manager extends CI_Controller {

	var $data = array();
	function __construct()
	{
		 parent:: __construct();
		 $this->load->model('basic_operation_m');
		 $this->load->model('Zone_model');

		 if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}
	
	
	###################### View All Airlines Start ########################
	public function all_zone()
	{  
	   
		$data 		= $this->data;
		$user_id	= $this->session->userdata("userId");
		$data['zone']	= $this->basic_operation_m->get_all_result("domestic_zone_master","");			
        $this->load->view('admin/domestic_zone_master/view_zone',$data);
      
	}	
	public function add_zone()
	{  	   
		$data 		= $this->data;
		$user_id	= $this->session->userdata("userId");
		$data['courier_company']	= $this->basic_operation_m->get_all_result("courier_company","");
		$data['country_list']	 = $this->basic_operation_m->get_all_result("domestic_zone_master","");
        $this->load->view('admin/domestic_zone_master/view_add_zone',$data);      
	}
	
	public function insert_zone()
	{  	   
		$alldata 	= $this->input->post();		
		
		if(!empty($alldata))
		{
			$c_company		        = $this->basic_operation_m->insert("domestic_zone_master",$alldata);
			$msg					= 'Courier company uploaded successfully';
			$class					= 'alert alert-success alert-dismissible';				
		}
		else
		{
			$msg			= 'Airlines not uploaded successfully';
			$class			= 'alert alert-danger alert-dismissible';	
			
		}
		
		$this->session->set_flashdata('notify',$msg);
		$this->session->set_flashdata('class',$class);
		
		redirect('admin/view-domestic-zone');
	}
	
	public function delete_zone($id)
	{  
		if(!empty($id))
		{
			$airlines_company	= $this->basic_operation_m->delete("domestic_zone_master","z_id = '$id'");
			$msg				= 'Zone deleted successfully';
			$class				= 'alert alert-success alert-dismissible';	
			
		}
		else
		{
			$msg	= 'Zone not deleted successfully';
			$class	= 'alert alert-danger alert-dismissible';	
			
		}
		
		$this->session->set_flashdata('notify',$msg);
		$this->session->set_flashdata('class',$class);
		
		redirect('admin/view-domestic-zone');
	}
	
	public function edit_zone($id)
	{  
		$data = $this->data;
		$data['allcountry']=$this->basic_operation_m->get_all_result('tbl_country');		
		if(!empty($id))
		{
			$data['courier_company']	= $this->basic_operation_m->get_all_result("courier_company","");
			$data['country_list']	 = $this->basic_operation_m->get_all_result("tbl_country","");
			$data['zone']	= $this->basic_operation_m->get_table_row("domestic_zone_master","");		
			
		}
		
		$this->load->view('admin/domestic_zone_master/view_edit_zone',$data);
	}
	
	public function update_zone($id)
	{  
		$alldata 	= $this->input->post();	

		if(!empty($alldata))
		{
			$status	= $this->basic_operation_m->update("domestic_zone_master",$alldata,"z_id = '$id'");
			
			$msg	= 'Airlines updated successfully';
			$class	= 'alert alert-success alert-dismissible';	
			
		}
		else
		{
			$msg	= 'Airlines not updated successfully';
			$class	= 'alert alert-danger alert-dismissible';	
			
		}
		$this->session->set_flashdata('notify',$msg);
		$this->session->set_flashdata('class',$class);
		
		redirect('admin/view-domestic-zone');
	
	}	
	###################### View All Airlines Flight End ########################	
   
}
?>
