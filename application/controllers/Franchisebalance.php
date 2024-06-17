<?php 
ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1); 
defined('BASEPATH') or exit('No direct script access allowed');

class Franchisebalance extends CI_Controller
{

    var $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('basic_operation_m');
        $this->load->model('Franchise_model');
        if ($this->session->userdata('userId') == '') {
            redirect('admin');
        }
    }

    public function credit_list(){
        $data['allfranchise'] = $this->Franchise_model->get_franchise_details();
        // print_r($allfranchise);exit;
        $this->load->view('admin/franchise_balance/franchise_credit_list');
    }

    public function debit_list(){
        $data['allfranchise'] = $this->Franchise_model->get_franchise_details();
        // print_r($allfranchise);exit;
        $this->load->view('admin/franchise_balance/franchise_debit_list');
    }
    public function balance_list(){
        $data['franchise_balance_list'] = $this->db->query("select tbl_customers.* from tbl_customers INNER JOIN franchise_topup_balance_tbl  ON franchise_topup_balance_tbl.customer_id = tbl_customers.customer_id GROUP by tbl_customers.customer_id")->result_array();
       
        $this->load->view('admin/franchise_balance/franchise_balance_list',$data);
    }


  
}
