<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Master extends BaseController {

	function __construct() {
        parent:: __construct();
        $this->config->load('custom');
        $this->load->model('basic_operation_m');
        $this->load->model('accounts/master_model','master_model');
        if($this->session->userdata('loggedin') == '')
        	redirect(base_url().'accountant-login');
        $this->user_id = ($this->session->userdata('user_id') != '')?$this->session->userdata('user_id'):0;
         ini_set ('display_errors', 1);  
		ini_set ('display_startup_errors', 1);  
		error_reporting (E_ALL);  
    }

	function vendors(){
		$data['title'] = "Vendors List";
		$data['slug'] = "vendor_menu";
		$data['page'] = "accounts/vendors_list";
		
		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->vendorListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 15);        
        $data['vlist'] = $this->master_model->vendorListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}
	function view_unbilled_shipments(){
		$data['title'] = "Unbill Shipments List";
		$data['slug'] = "shipments_menu";
		$data['page'] = "accounts/unbill_shipments/view_unbill_shipments";
		
		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->ShipmentCount($searchText);
		$returns = $this->paginationCompress ( "unbill-shipments/", $count, 50);        
        $data['vlist'] = $this->master_model->ShipmentResult($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	function getVendorRecords($id){
		$data = $this->db->get_where('vendor_customer_tbl',['customer_id' => $id])->row();
		echo json_encode($data);
	}

	function vendor_details($id){
		$data['title'] = "Vendors Details";
		$data['slug'] = "vendor_menu";
		$data['page'] = "accounts/single_vendor_details";
        $data['vrecord'] = $this->db->get_where('vendor_customer_tbl',['customer_id' => $id])->row();
        $data['vbranch'] = $this->db->get_where('acctbl_vendor_branch',['vendor_id' => $id])->result();
        $data['vaddr'] = $this->master_model->get_vendor_address_details($id);

        $data['branch'] = $this->db->get_where('tbl_branch',['isdeleted' => 0])->result();
        $data['state'] = $this->db->select('state_id, state_name')->get('tbl_state')->result();
		$this->load->view('accounts/template/layout',$data);
	}

	function getCities_statewise(){
		$state = $this->input->post('state');
		$data = $this->db->get_where('tbl_city',['state_id' => $state])->result();
		echo json_encode($data);
	}

	function update_vendor_records($id){
		$data = $this->input->post();
		if(!empty($data['branch_id'])){
			$branch_cnt = count($data['branch_id']);
			for ($j=0; $j < $branch_cnt; $j++) { 
				$result = $this->db->insert('acctbl_vendor_branch',['vendor_id' => $id, 'branch_id' => $data['branch_id'][$j]]);
			}
		}else{
			$reslut = true;
		}
		if(!empty($data['id'])){
			$adr_cnt = count($data['id']);
				for ($i=0; $i < $adr_cnt; $i++) { 
					$address_data = array( 'vendor_id' => $id,
					'vaddress' => $data['sub_address1'][$i],
					'vstate' => $data['sub_state_id1'][$i],
					'vcity' => $data['sub_city_id1'][$i],
					'vpincode' => $data['sub_pincode1'][$i],
					'vdefault' => $data['dcheck1_val'][$i],
				);
				$result1 = $this->db->insert('acctbl_vendor_address',$address_data);
			}
		}else{
			$result1 = true;
		}
		if($result == true && $result1 == true){
			echo 1;
		}else{ echo 0; }
	}

	function customers(){
		$data['title'] = "Customers List";
		$data['slug'] = "customer_menu";
		$data['page'] = "accounts/customers_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->customerListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-customer/", $count, 15);        
        $data['custlist'] = $this->master_model->customerListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function tds_sections(){
		$data['title'] = "TDS Sections";
		$data['slug'] = "tds_sections";
		$data['page'] = "accounts/tds_sections_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->sectionListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 10);
        $data['secData'] = $this->master_model->sectionListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function submitSection($id=null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_tdssection',['section_name' =>$data['section_name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_tdssection', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_tdssection',['sec_id !=' => $id,'section_name' =>$data['section_name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_tdssection', $data,['sec_id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}

	public function getSectionRowData($id){
		$data = $this->db->get_where('acctbl_tdssection',['sec_id' => $id, 'isDeleted'=>0])->row();
		echo json_encode($data);
	}

	public function getSectionRecords(){
		$data = $this->db->get_where('acctbl_tdssection',['isDeleted'=>0])->result();
		echo json_encode($data);
	}

	public function tds_percent(){
		$data['title'] = "TDS % List";
		$data['slug'] = "tds_percent";
		$data['page'] = "accounts/tds_percent_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->tdsListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 10);
        $data['tdsData'] = $this->master_model->tdsListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function getTdsRowData($id){
		$data = $this->db->get_where('acctbl_tdspercent',['id' => $id, 'isDeleted'=>0])->row();
		echo json_encode($data);
	}

	public function submitTds($id = null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_tdspercent',[ 'section_id' =>$data['section_id'],'tds_perc' => $data['tds_perc']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_tdspercent', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_tdspercent',['id !=' => $id,'section_id' =>$data['section_id'],'tds_perc' => $data['tds_perc']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_tdspercent', $data,['id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}

	// GST MASTER START
	public function gst_master()
	{
		$data['title'] = "GST";
		$data['slug'] = "gst_menu";
		$data['page'] = "accounts/gst_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->gstListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 10);
        $data['gstData'] = $this->master_model->gstListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function getStateRecords(){
		$data = $this->db->get('state')->result();
		echo json_encode($data);
	}

	public function getGstRowData($id){
		$data = $this->db->get_where('acctbl_gst',['gst_id' => $id, 'isDeleted'=>0])->row();
		echo json_encode($data);
	}

	public function submitGst($id = null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_gst',['gst_group' =>$data['gst_group'],'gst_state' => $data['gst_state'],'gst_perc' => $data['gst_perc']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_gst', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_gst',['gst_id !=' => $id,'gst_group' =>$data['gst_group'],'gst_state' => $data['gst_state'],'gst_perc' => $data['gst_perc']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_gst', $data,['gst_id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}
	// GST MASTER END

	// Expense MASTER Start
	public function group_master(){
		$data['title'] = "Group Master";
		$data['slug'] = "exp_grp_menu";
		$data['page'] = "accounts/expense_group_list";
		$data['nature'] = $this->config->item('grp_nature');
        $data['expGrpData'] = $this->db->get_where('acctbl_group_master',['isDeleted' => 0])->result();
		$this->load->view('accounts/template/layout',$data);
	}

	public function getExpGroupRowData($id){
		$data = $this->db->get_where('acctbl_group_master',['id' => $id, 'isDeleted'=>0])->row();
		echo json_encode($data);
	}
	public function getGroupNature(){
		$data = $this->config->item('grp_nature');
		echo json_encode($data);
	}
	public function submitExpGroup($id = null){
		$data = $this->input->post();
		$data['group_type'] = 1;
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_group_master',[ 'name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_group_master', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_group_master',['id !=' => $id,'name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_group_master', $data,['id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}

	// SubGroup
	public function expense_subgrp_master(){
		$data['title'] = "Sub-Group Master";
		$data['slug'] = "exp_subgrp_menu";
		$data['page'] = "accounts/expense_subgroup_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->master_model->expSubGrpListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 10);
		$data['expSubGrpData'] = $this->master_model->expSubGrpListing($searchText, $returns["page"], $returns["segment"]);
        // $data['expGrpData'] = $this->db->get_where('acctbl_subgroup_master',['isDeleted' => 0])->result();
		$this->load->view('accounts/template/layout',$data);
	}

	public function getExpSubGroupRowData($id){
		$data = $this->db->get_where('acctbl_subgroup_master',['id' => $id, 'isDeleted'=>0])->row();
		echo json_encode($data);
	}
	public function getExpGroupData(){
		$data['nature'] = $this->config->item('grp_nature');
		$a1 = $this->db->select('id,name')->get_where('acctbl_group_master',['isDeleted'=>0])->result();
		$a2 = $this->db->select('id, sub_name as name')->get_where('acctbl_subgroup_master',['isDeleted'=>0])->result();
		$data['grp'] = array_merge($a1,$a2);
		echo json_encode($data);
	}
	public function submitExpSubGroup($id = null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_subgroup_master',['sub_name' =>$data['sub_name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_subgroup_master', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_subgroup_master',['id !=' => $id,'sub_name' =>$data['sub_name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_subgroup_master', $data,['id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}
	// Expense MASTER End

	// Nature of transaction master start
	public function transaction_nature_master(){
		$data['title'] = "Nature of Transaction Master";
		$data['slug'] = "trans_nature_menu";
		$data['page'] = "accounts/transaction_nature_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');
        $count = $this->master_model->natureTransListingCount($searchText);
		$returns = $this->paginationCompress ( "transaction_nature_master/", $count, 10);
		$data['natureData'] = $this->master_model->natureTransListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function getNatureTransRowData($id){
		$data = $this->db->get_where('acctbl_nature_trans',['id' => $id])->row();
		echo json_encode($data);
	}

	public function submitNatureTrans($id=null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_nature_trans',['name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_nature_trans', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_nature_trans',['id !=' => $id,'name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_nature_trans', $data,['id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}
	// Nature of transaction master end

	// Payment of transaction master start
	public function payment_trans_master(){
		$data['title'] = "Payment Transaction Master";
		$data['slug'] = "pay_trans_menu";
		$data['page'] = "accounts/payement_transaction_list";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');
        $count = $this->master_model->paymentTransListingCount($searchText);
		$returns = $this->paginationCompress ( "payment_trans_master/", $count, 10);
		$data['payData'] = $this->master_model->paymentTransListing($searchText, $returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
	}

	public function getPaymentTransRowData($id){
		$data = $this->db->get_where('acctbl_payment_trans',['id' => $id])->row();
		echo json_encode($data);
	}

	public function submitPaymentTrans($id=null){
		$data = $this->input->post();
		
		if($id==null){
			$rowCnt = $this->db->get_where('acctbl_payment_trans',['name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['createId'] = $this->user_id;
				$data['createDtm'] = date('Y-m-d H:i:s');	
				$result = $this->db->insert('acctbl_payment_trans', $data);
				echo !empty($result)?1:0;
			}
		}else{
			$rowCnt = $this->db->get_where('acctbl_payment_trans',['id !=' => $id,'name' =>$data['name']])->num_rows();
			if($rowCnt > 0){
				echo 2;
			}else{
				$data['updateId'] = $this->user_id;
				$data['updateDtm'] = date('Y-m-d H:i:s');
				$result = $this->db->update('acctbl_payment_trans', $data,['id' => $id]);
				echo !empty($result)?1:0;
			}
		}
	}
	// Payment of transaction master end
}
?>