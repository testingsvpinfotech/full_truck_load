<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Ledger extends BaseController {

	function __construct() {
        parent:: __construct();
        $this->load->model('basic_operation_m');
        $this->load->model('accounts/ledger_model','ledger_model');
        if($this->session->userdata('loggedin') == '')
        	redirect(base_url().'accountant-login');
        $this->user_id = ($this->session->userdata('user_id') != '')?$this->session->userdata('user_id'):0;
    }

    // ======== START SALE REGISTER =======
    public function all_ledger_details(){
    	$data['title'] = "Ledger List";
		$data['slug'] = "ledger_menu";
		$data['page'] = "accounts/ledger/all_ledger_details";

		$searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;            
        $this->load->library('pagination');        
        $count = $this->ledger_model->ledgerListingCount($searchText);
		$returns = $this->paginationCompress ( "accounts-vendor/", $count, 15);        
        $data['ledger_list'] = $this->ledger_model->ledgerListing($searchText, $returns["page"], $returns["segment"]);

		$this->load->view('accounts/template/layout',$data);
    }

    // Create New Sale Ledger
    public function create_sale_ledger(){
    	$data['title'] = "Create Sale Ledger";
		$data['slug'] = "saleledger_menu";
		$data['page'] = "accounts/ledger/create_sale_ledger";

        $a1 = $this->db->select('id,name,alias_name')->get_where('acctbl_group_master',['isDeleted'=>0])->result();
        $a2 = $this->db->select('id, sub_name as name,alias_name')->get_where('acctbl_subgroup_master',['isDeleted'=>0])->result();
        $data['grp'] = array_merge($a1,$a2);
        $data['max_no'] = $this->ledger_model->get_max_id_for_saleledger('acctbl_ledger','ledger_code');

		$this->load->view('accounts/template/layout',$data);
    }

    // Create New Sale Ledger
    public function create_purchase_ledger(){
        $data['title'] = "Create Purchase Ledger";
        $data['slug'] = "purchaseledger_menu";
        $data['page'] = "accounts/ledger/create_purchase_ledger";

         $a1 = $this->db->select('id,name,alias_name')->get_where('acctbl_group_master',['isDeleted'=>0])->result();
        $a2 = $this->db->select('id, sub_name as name,alias_name')->get_where('acctbl_subgroup_master',['isDeleted'=>0])->result();
        $data['grp'] = array_merge($a1,$a2);
        $data['max_no'] = $this->ledger_model->get_max_id_for_purchaseledger('acctbl_ledger','ledger_code');

        $this->load->view('accounts/template/layout',$data);
    }
  
    // Create New ledger
    public function create_ledger(){
        $data['title'] = "Create New Ledger";
        $data['slug'] = "create_ledger";
        $data['page'] = "accounts/ledger/new_general_ledger";
        $a1 = $this->db->select('id,name,alias_name')->get_where('acctbl_group_master',['isDeleted'=>0])->result();
        $a2 = $this->db->select('id, sub_name as name,alias_name')->get_where('acctbl_subgroup_master',['isDeleted'=>0])->result();
        $data['grp'] = array_merge($a1,$a2);
        $data['max_no'] = $this->ledger_model->get_max_id('acctbl_ledger','ledger_code');
        $data['payment'] = $this->db->get_where('acctbl_payment_trans',['isDeleted' => 0])->result();
        $this->load->view('accounts/template/layout',$data);
    }

      // Create New vendor ledger
    public function create_vendorledger(){
        $data['title'] = "Create New Vendor Ledger";
        $data['slug'] = "vledger_list";
        $data['page'] = "accounts/ledger/new_vendor_ledger";

        $a1 = $this->db->select('id,name,alias_name')->get_where('acctbl_group_master',['isDeleted'=>0])->result();
        $a2 = $this->db->select('id, sub_name as name,alias_name')->get_where('acctbl_subgroup_master',['isDeleted'=>0])->result();
        $data['grp'] = array_merge($a1,$a2);
        $data['max_no'] = $this->ledger_model->get_max_id_for_vendorledger('acctbl_ledger','ledger_code');
        
        $this->load->view('accounts/template/layout',$data);
    }

    public function submitLedger(){
        $data = $this->input->post();

        $rowCnt = $this->db->get_where('acctbl_ledger',['name' =>$data['name']])->num_rows();
        if($rowCnt > 0){
            echo 2;
        }else{
            $date = $this->input->post('date');
           
            if(date('m', strtotime($date)) <= 3){
                $year = (date('Y')-1).'-'.(date('Y'));
            }else{
                $year = (date('Y')).'-'.(date('Y')+1);   
            }
            $data['fin_year'] = $year;
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['date'] = $date;
            $data['createId'] = $this->user_id;
            $data['createDtm'] = date('Y-m-d H:i:s');   
            $result = $this->db->insert('acctbl_ledger', $data);
            echo !empty($result)?1:0;
        }
    }

    public function getTransNature($name){
        $name = str_replace("%20"," ",$name);
        $data['nature'] = $this->db->get_where('acctbl_nature_trans',['isDeleted' => 0])->result();
        $data['gst'] = $this->db->get_where('acctbl_ledgergst',['ledger_name' => $name])->row();
        echo json_encode($data);
    }

    public function submitLedgerGst(){
        $data = $this->input->post();
        $rowCnt = $this->db->get_where('acctbl_ledgergst',['ledger_name' =>$data['ledger_name']])->num_rows();
        if($rowCnt > 0){
            echo 2;
        }else{

            $data['createId'] = $this->user_id;
            $data['createDtm'] = date('Y-m-d H:i:s');   
            $result = $this->db->insert('acctbl_ledgergst', $data);
            echo !empty($result)?1:0;
        }
    }
    // ======== END SALE REGISTER =======
    // ======== START VOUCHER RECORDS =======
    public function view_ledger_voucher($id){
        $name = $this->db->get_where('acctbl_ledger',['id' => $id])->row();
        $data['title']= ($name->name)?"Ledger: ".$name->name:"";
        $data['slug'] = "create_ledger";
        $data['page'] = "accounts/ledger/ledger_voucher_details";
        $data['voucher'] = $this->ledger_model->get_allvoucher_asper_ledger($id);

        // echo '<pre>'; print_r($data['voucher']); die;
        $this->load->view('accounts/template/layout',$data);
    }
    // ======== END VOUCHER RECORDS =======
}
?>

