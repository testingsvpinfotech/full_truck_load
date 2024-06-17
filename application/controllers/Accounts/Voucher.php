<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Voucher extends BaseController {

	function __construct() {
        parent:: __construct();
        $this->load->model('basic_operation_m');
        $this->load->model('accounts/voucher_model','voucher_model');
        if($this->session->userdata('loggedin') == '')
        	redirect(base_url().'accountant-login');
        $this->user_id = ($this->session->userdata('user_id') != '')?$this->session->userdata('user_id'):0;
    }

    function voucher_list(){
    	$data['title'] = "Voucher List";
		$data['slug'] = "voucherlist_menu";
		$data['page'] = "accounts/voucher/voucher_list";

		$fieldname = $this->input->post('fieldname');
		$searchResult = $this->input->post('searchResult');
        $data['fieldname'] = $fieldname;
        $data['searchResult'] = $searchResult;
        $this->load->library('pagination');        
        $count = $this->voucher_model->voucherListingCount($fieldname,$searchResult);
		$returns = $this->paginationCompress ( "voucher-list/", $count, 15);

		$data['vlist'] = $this->voucher_model->voucherListing($fieldname,$searchResult,$returns["page"], $returns["segment"]);
		$this->load->view('accounts/template/layout',$data);
    }

    function createnew_voucher(){
    	$data['title'] = "New Voucher";
		$data['slug'] = "voucher_menu";
		$data['page'] = "accounts/voucher/createnew_voucher";
		$data['ledger'] = $this->db->get_where('acctbl_ledger',['isDeleted' => 0])->result();
		$data['particular'] = $this->db->get_where('acctbl_ledger',['isDeleted' => 0])->result();
		$data['branch'] = $this->db->get_where('tbl_branch',['isdeleted' => 0])->result();
		$data['vno'] = $this->voucher_model->get_voucher_max_id('acctbl_voucher','voucher_no');
		$this->load->view('accounts/template/layout',$data);
    }

    // Insert voucher
    function insert_voucher(){
    	$data = $this->input->post();
    	// print_r($data);
    	// die;
    	$vno = $this->voucher_model->get_voucher_max_id('acctbl_voucher','voucher_no');
    	$insert_data = array(
    		'voucher_no' => $vno,
    		'voucher_date' => $data['voucher_date'],
    		'voucher_type' => $data['voucher_type'],
    		'inv_no' => $data['inv_no'],
    		'party_id' => $data['party_id'],
    		'center' => $data['center'],
    		'remark' => $data['remark'],
    		'total_amount' => $data['total_amount']
    	);
    	$this->db->trans_begin();
    	$this->db->insert('acctbl_voucher',$insert_data);
    	$result = $this->db->insert_id();
    	if(!empty($result)){
    		$result1 = $this->voucher_trans($result, $data);
    		if(!empty($result1)){
    			if ($this->db->trans_status() === FALSE)
				{
				   echo $this->db->trans_rollback();
				}
				else
				{
				   echo $this->db->trans_commit();
				}
    		}else{
    			echo $this->db->trans_rollback();
    		}
    	}else{
    		echo $this->db->trans_rollback();
    	}
    }

    // Voucher Transaction
    function voucher_trans($id, $data){
    	$cnt = count($data['vtrans_id']);

    	for ($i=0; $i < $cnt ; $i++) {
    		$trans_data = array(
    		'voucher_id' => $id,
    		'particular_id' => $data['par_id'][$i],
    		'particular_name' => $data['par_name'][$i],
    		'rate' => $data['rate'][$i],
    		'amount' => $data['amount'][$i]
    			
    		);
    		$result1 = $this->db->insert('acctbl_voucher_trans', $trans_data);
    	}
    	if(!empty($result1)){
    		return true;
    	}
    }

    // All Voucher Records
    function voucher_details($id){
    	$data['title'] = "Voucher Details";
		$data['slug'] = "vdetail_menu";
		$data['page'] = "accounts/voucher/voucher_details";
		$data['ledger'] = $this->db->get_where('acctbl_ledger',['isDeleted' => 0])->result();
		$data['particular'] = $this->db->get_where('acctbl_ledger',['isDeleted' => 0])->result();
		$data['branch'] = $this->db->get_where('tbl_branch',['isdeleted' => 0])->result();
		$data['vno'] = $this->voucher_model->get_voucher_max_id('acctbl_voucher','voucher_no');

		$data['data'] = $this->voucher_model->single_voucher_details($id);
		// echo "<pre>";  print_r($data['data']); die;
		$this->load->view('accounts/template/layout',$data);
    }

    function voucher_print($id){
    	$date=date('d-m-Y');
		$filename = "VoucherDetails_".$date.".csv";
		$fp = fopen('php://output', 'w');
			
		$header =array("Voucher No.","Voucher Date","Voucher Type","Invoice No","Party A/C Name","Branch Name","Total Amount");

			
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
    	$vdata = $this->voucher_model->single_voucher_details($id);
    	$row = $vdata['master'];
		$row1=array(
			$row->voucher_no,
			$row->voucher_date,
			$row->voucher_type,
			$row->inv_no,
			$row->name,
			$row->branch_name,
			$row->total_amount
		);
		fputcsv($fp, $row1);
		
		exit;
    }
}
