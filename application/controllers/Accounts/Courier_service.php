<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Courier_service extends BaseController {

	function __construct() {
        parent:: __construct();
          ini_set ('display_errors', 1);  
		ini_set ('display_startup_errors', 1);  
		error_reporting (E_ALL);  
        $this->load->model('basic_operation_m');
        $this->load->model('accounts/invoice_model','invoice_model');
        if($this->session->userdata('loggedin') == '')
        	redirect(base_url().'accountant-login');
        $this->user_id = ($this->session->userdata('user_id') != '')?$this->session->userdata('user_id'):0;      
    }

	public function ptl_courier_service(){
	   	$data = array();
		$data['title'] = "Courier Services - PTL INVOICES";
		$data['slug'] = "ptl_invoice_menu";
		$data['page'] = "accounts/invoice_master/ptl_invoices";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
  //       $this->load->library('pagination');
     
		if ($this->session->userdata("userType") == '1') {
				$data['allpoddata'] = $this->db->query("SELECT i.*,b.branch_name, u.full_name as created_by FROM tbl_domestic_invoice i 
				LEFT JOIN tbl_branch b ON(b.branch_id = i.branch_id)
				LEFT JOIN tbl_users u ON(u.user_id = i.createId) ORDER BY i.id DESC")->result_array();
		} else {
	 		$branch_id = $this->session->userdata('branch_id');
			$data['allpoddata'] = $this->db->query("SELECT i.*,b.branch_name, u.full_name as created_by FROM tbl_domestic_invoice i LEFT JOIN tbl_branch b ON(b.branch_id = i.branch_id) LEFT JOIN tbl_users u ON(u.user_id = i.createId) WHERE i.branch_id='$branch_id' ORDER BY i.id DESC")->result_array();
		}
		$this->load->view('accounts/template/layout',$data);
	}

	public function ptl_courier_service_invoice_view($id){
		$data = array();
		$data['title'] = "Courier Services - PTL INVOICES";
		$data['slug'] = "ptl_invoice_menu";
		$data['page'] = "accounts/invoice_master/ptl_invoices_view";

		$data['invoice'] = $this->db->query("SELECT d.*,b.* FROM tbl_domestic_invoice d
    		LEFT JOIN tbl_branch b ON(b.branch_id = d.branch_id) WHERE id=" . $id)->row();
    	
    	$data['allpoddata'] = $this->db->query("SELECT i.*,b.* FROM tbl_domestic_invoice_detail i LEFT JOIN tbl_domestic_booking b ON(b.pod_no = i.pod_no) WHERE i.invoice_id = " . $id)->result_array();
    	$pod = $data['allpoddata'][0]['pod_no'];
    	$data['booking'] = $this->db->get_where('tbl_domestic_booking', ['pod_no' => $pod])->row();
    	
		$data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',['id'=>1]);
		$data['user'] = $this->basic_operation_m->get_table_row('tbl_users',['user_id'=>$data['invoice']->createId]);
		$data['branch'] = $this->basic_operation_m->get_table_row('tbl_branch',['branch_id'=>$data['invoice']->branch_id]);

		// echo "<pre>"; print_r($data); die;
		$this->load->view('accounts/template/layout',$data);
	}

	public function ftl_courier_service(){
	   	$data = array();
		$data['title'] = "Courier Services - FTL INVOICES";
		$data['slug'] = "ftl_invoice_menu";
		$data['page'] = "accounts/invoice_master/ftl_invoices";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;

		$data['ftl_list'] = $this->db->query("SELECT lr_table.*,lr_product_tbl.product_name,lr_product_tbl.product_weight,rc.city as reciever_city,vehicle_type_master.vehicle_name,sc.city as sender_city FROM lr_table INNER JOIN lr_product_tbl ON lr_table.lr_id = lr_product_tbl.lr_id LEFT JOIN city as rc ON lr_table.reciever_city = rc.id LEFT JOIN vehicle_type_master ON lr_table.type_of_vehicle = vehicle_type_master.id LEFT JOIN city as sc ON lr_table.sender_city = sc.id order by lr_id DESC")->result();
    
		$this->load->view('accounts/template/layout',$data);
	}

	public function ftl_courier_service_invoice_view($id){
		$data = array();
		$data['title'] = "Courier Services - FTL INVOICES";
		$data['slug'] = "ptl_invoice_menu";
		$data['page'] = "accounts/invoice_master/ftl_invoices_view";

		$data['printlabel'] = $this->db->query("SELECT lr_table.*,rc.city as reciever_city,vehicle_type_master.vehicle_name,sc.city as sender_city FROM lr_table LEFT JOIN city as rc ON lr_table.reciever_city = rc.id LEFT JOIN vehicle_type_master ON lr_table.type_of_vehicle = vehicle_type_master.id LEFT JOIN city as sc ON lr_table.sender_city = sc.id WHERE `lr_id`=".$id)->result();
		$this->load->view('accounts/invoice_master/ftl_invoices_view',$data);
	}

}