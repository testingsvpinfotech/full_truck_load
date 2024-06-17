<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterFranchiseController extends CI_Controller
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

    public function index()
    {

        $data['allfranchise'] = $this->Franchise_model->get_master_franchise_details();
        $this->load->view('admin/franchise_master/view_Master_franchise', $data);
    }


   
public function add_master_franchise()
{

    $query = "SELECT MAX(customer_id) as id FROM tbl_customers ";
    $result1 = $this->basic_operation_m->get_query_row($query);
    $id = $result1->id + 1;
    //print_r($id); exit;

    if (strlen($id) == 1) {
        $franchise_id = 'FI0000' . $id;
    } elseif (strlen($id) == 2) {
        $franchise_id = 'FI000' . $id;
    } elseif (strlen($id) == 3) {
        $franchise_id = 'FI00' . $id;
    } elseif (strlen($id) == 4) {
        $franchise_id = 'FI0' . $id;
    } elseif (strlen($id) == 5) {
        $franchise_id = 'FI' . $id;
    }

    $data['cities'] = $this->basic_operation_m->get_all_result('city', '');
    $data['states'] =  $this->basic_operation_m->get_all_result('state', '');
    $data['fid']    =   $franchise_id;

    $data['company_list'] = $this->basic_operation_m->get_query_result_array('SELECT * FROM tbl_company WHERE 1 ORDER BY company_name ASC');

    $this->load->view('admin/franchise_master/add_master_franchise', $data);
}



    public function store_master_franchise_data()
    {


        if (isset($_POST['submit'])) {



            $this->load->library('form_validation');

            $this->form_validation->set_rules('franchise_name', 'Name', 'trim|required');
            $this->form_validation->set_rules('pan_number', 'Pan Number', 'trim|required|is_unique[tbl_franchise.pan_number]');
            $this->form_validation->set_rules('aadhar_number', 'Aadhar Number', 'trim|required|is_unique[tbl_franchise.aadhar_number]');
            $this->form_validation->set_rules('cmp_gstno', 'GST Number', 'trim|required|is_unique[tbl_franchise.cmp_gstno]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_customers.email]');

            if ($this->form_validation->run() == FALSE) {

                $this->add_franchise();
            } else {
                // *********************************  pancard upload ****************



                $v = $this->input->post('pancard_photo');
                if (isset($_FILES) && !empty($_FILES['pancard_photo']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['pancard_photo'], 'assets/franchise-documents/pancard_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $pancard_photo = $ret['image_name'];
                    }
                }


                // ********************************* AadharCard upload ****************     




                $v = $this->input->post('aadharcard_photo');
                if (isset($_FILES) && !empty($_FILES['aadharcard_photo']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['aadharcard_photo'], 'assets/franchise-documents/aadharcard_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $aadharcard_photo = $ret['image_name'];
                    }
                }
                // ********************************* Cancel Check upload ****************     


                $v = $this->input->post('cancel_check');
                if (isset($_FILES) && !empty($_FILES['cancel_check']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['cancel_check'], 'assets/franchise-documents/bank_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $cancel_check = $ret['image_name'];
                    }
                }



                $date = date('Y-m-d');
                

                $data = array(
                    'cid' => $this->input->post('fid'),
                    'password' => $this->input->post('password'),
                    'customer_name' => $this->input->post('franchise_name'), //****Personal Info
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'pincode' => $this->input->post('pincode'),
                    'state' => $this->input->post('franchaise_state_id'),
                    'city' => $this->input->post('franchaise_city_id'),
                    'phone' => $this->input->post('contact_number'),
                    'contact_person' => $this->input->post('alt_contact'),
                    'company_id' => $this->input->post('companytype'),
                    'customer_type' => 1,
                    'register_date' => $date,
                );

                // print($data);exit;

                $result = $this->db->insert('tbl_customers', $data);


                $customer_last_id = $this->db->insert_id();

                if ($customer_last_id != '') {

                    $data1 = array(

                        'fid' => $customer_last_id,
                        'franchise_relation' => $this->input->post('franchise_relation'),
                        'age' => $this->input->post('age'),
                        'pan_name' => $this->input->post('pan_name'),
                        'pan_number' => $this->input->post('pan_number'),
                        'pancard_photo' => $pancard_photo,
                        'aadhar_number' => $this->input->post('aadhar_number'),
                        'aadharin_name' => $this->input->post('aadharin_name'),
                        'dob' => $this->input->post('dob'),
                        'gender' => $this->input->post('gender'),
                        'aadhar_address' => $this->input->post('aadhar_address'),
                        'aadharcard_photo' => $aadharcard_photo,
                        'company_name' => $this->input->post('company_name'), // ****company information
                        'cmp_pan_number' => $this->input->post('cmp_pan_number'),
                        'cmp_gstno' => $this->input->post('cmp_gstno'),
                        'legal_name' => $this->input->post('legal_name'),
                        'constitution_of_business' => $this->input->post('constitution_of_business'),
                        'taxpayer_type' => $this->input->post('taxpayer_type'),
                        'gstin_status' => $this->input->post('gstin_status'),
                        'cmp_address' => $this->input->post('cmp_address'),
                        'cmp_pincode' => $this->input->post('cmp_pincode'),
                        'cmp_state' => $this->input->post('cmp_state'),
                        'cmp_city' => $this->input->post('cmp_city'),
                        'cmp_office_phone' => $this->input->post('cmp_office_phone'),
                        'cmp_account_name' => $this->input->post('cmp_account_name'), //*****Bank Details
                        'cmp_account_number' => $this->input->post('cmp_account_number'),
                        'cancel_check' => $cancel_check,
                        'cmp_bank_name' => $this->input->post('cmp_bank_name'),
                        'cmp_bank_branch' => $this->input->post('cmp_bank_branch'),
                        'cmp_acc_type' => $this->input->post('cmp_acc_type'),
                        'cmp_ifsc_code' => $this->input->post('cmp_ifsc_code'),

                    );

                    $result = $this->db->insert('tbl_franchise', $data1);
                } else {
                    $msg            = 'Franchise not added successfully';
                    $class            = 'alert alert-danger alert-dismissible';
                }

                if (!empty($result)) {
                    $msg            = 'Franchise added successfully';
                    $class            = 'alert alert-success alert-dismissible';
                } else {
                    $msg            = 'Franchise not added successfully';
                    $class            = 'alert alert-danger alert-dismissible';
                }
                $this->session->set_flashdata('notify', $msg);
                $this->session->set_flashdata('class', $class);

                redirect('admin/view-franchise-master');
            }
        }
    }


    public function getCityList()
    {
        $pincode = $this->input->post('pincode');
        $whr1 = array('pin_code' => $pincode);
        $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

        $city_id = $res1->row()->city_id;

        $whr2 = array('id' => $city_id);
        $res2 = $this->basic_operation_m->selectRecord('city', $whr2);
        $result2 = $res2->row();

        echo json_encode($result2);
    }

    public function getState()
    {
        $pincode = $this->input->post('pincode');
        $whr1 = array('pin_code' => $pincode);
        $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

        $state_id = $res1->row()->state_id;
        $whr3 = array('id' => $state_id);
        $res3 = $this->basic_operation_m->selectRecord('state', $whr3);
        $result3 = $res3->row();

        echo json_encode($result3);
    }
    public function getCityList1()
    {
        $pincode = $this->input->post('cmppincode');
        $whr1 = array('pin_code' => $pincode);
        $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

        $city_id = $res1->row()->city_id;

        $whr2 = array('id' => $city_id);
        $res2 = $this->basic_operation_m->selectRecord('city', $whr2);
        $result2 = $res2->row();

        echo json_encode($result2);
    }

    public function getState1()
    {
        $pincode = $this->input->post('cmppincode');
        $whr1 = array('pin_code' => $pincode);
        $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

        $state_id = $res1->row()->state_id;
        $whr3 = array('id' => $state_id);
        $res3 = $this->basic_operation_m->selectRecord('state', $whr3);
        $result3 = $res3->row();

        echo json_encode($result3);
    }




    function update_master_franchise_data($id, $fid)
    {
        $date = date('Y-m-d');
        $data['message'] = "";
        if ($id != "") {
            $whr = array('franchise_id' => $id);
            $data['franchise_data'] = $this->basic_operation_m->get_table_row('tbl_franchise', $whr);
        }
        if ($fid != "") {
            $whr1 = array('customer_id' => $fid);
            $data['customer'] = $this->basic_operation_m->get_table_row('tbl_customers', $whr1);
        }


                if (isset($_POST['submit'])) {

                   


                    $last = $this->uri->total_segments();
                    $id = $this->uri->segment($last);
                    $whr2 = array('customer_id' => $fid);

                    $data = array(
                        'customer_name' => $this->input->post('franchise_name'), //****Personal Info
                        'email' => $this->input->post('email'),
                        'address' => $this->input->post('address'),
                        'pincode' => $this->input->post('pincode'),
                        'state' => $this->input->post('franchaise_state_id'),
                        'city' => $this->input->post('franchaise_city_id'),
                        'phone' => $this->input->post('contact_number'),
                        'contact_person' => $this->input->post('alt_contact'),
                        'company_id' => $this->input->post('companytype'),
                        'customer_type' => 1,
                        'register_date' => $date,
                    );
                    //   print_r($data);
                    $result = $this->basic_operation_m->update('tbl_customers', $data, $whr2);


                    // *********************************  pancard upload ****************



                $v = $this->input->post('pancard_photo');
                if (isset($_FILES) && !empty($_FILES['pancard_photo']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['pancard_photo'], 'assets/franchise-documents/pancard_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $pancard_photo = $ret['image_name'];
                    }
                }


                // ********************************* AadharCard upload ****************     




                $v = $this->input->post('aadharcard_photo');
                if (isset($_FILES) && !empty($_FILES['aadharcard_photo']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['aadharcard_photo'], 'assets/franchise-documents/aadharcard_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $aadharcard_photo = $ret['image_name'];
                    }
                }
                // ********************************* Cancel Check upload ****************     


                $v = $this->input->post('cancel_check');
                if (isset($_FILES) && !empty($_FILES['cancel_check']['name'])) {
                    $ret = $this->basic_operation_m->fileUpload($_FILES['cancel_check'], 'assets/franchise-documents/bank_document/');
                    //file is uploaded successfully then do on thing add entry to table
                    if ($ret['status'] && isset($ret['image_name'])) {
                        $cancel_check = $ret['image_name'];
                    }
                }


                    $whr3 = array('fid' => $id);
                    $r = array(

                        //'fid' => $id,
                        //'username' => $this->input->post('username'),
                        'franchise_relation' => $this->input->post('franchise_relation'),
                        'age' => $this->input->post('age'),
                        // 'alt_contact' => $this->input->post('alt_contact'),
                        'pan_name' => $this->input->post('pan_name'),
                        'pan_number' => $this->input->post('pan_number'),
                        'pancard_photo' => $pancard_photo,
                        'aadhar_number' => $this->input->post('aadhar_number'),
                        'aadharin_name' => $this->input->post('aadharin_name'),
                        'dob' => $this->input->post('dob'),
                        'gender' => $this->input->post('gender'),
                        'aadhar_address' => $this->input->post('aadhar_address'),
                        'aadharcard_photo' => $aadharcard_photo,
                        'company_name' => $this->input->post('company_name'), // ****company information
                        'cmp_pan_number' => $this->input->post('cmp_pan_number'),
                        'cmp_gstno' => $this->input->post('cmp_gstno'),
                        'legal_name' => $this->input->post('legal_name'),
                        'constitution_of_business' => $this->input->post('constitution_of_business'),
                        'taxpayer_type' => $this->input->post('taxpayer_type'),
                        'gstin_status' => $this->input->post('gstin_status'),
                        'cmp_address' => $this->input->post('cmp_address'),
                        'cmp_pincode' => $this->input->post('cmp_pincode'),
                        'cmp_state' => $this->input->post('cmp_state'),
                        'cmp_city' => $this->input->post('cmp_city'),
                        'cmp_office_phone' => $this->input->post('cmp_office_phone'),
                        'cmp_account_name' => $this->input->post('cmp_account_name'), //*****Bank Details
                        'cmp_account_number' => $this->input->post('cmp_account_number'),
                        'cmp_bank_name' => $this->input->post('cmp_bank_name'),
                        'cmp_bank_branch' => $this->input->post('cmp_bank_branch'),
                        'cmp_acc_type' => $this->input->post('cmp_acc_type'),
                        'cmp_ifsc_code' => $this->input->post('cmp_ifsc_code'),
                        'cancel_check' => $cancel_check,

                    );

                    $franchise = $this->basic_operation_m->update('tbl_franchise', $r, $whr3);

                    if ($franchise && $result) {
                        //   print_r($result);die();
                        if ($this->db->affected_rows() > 0) {
                            $data['message'] = "data Updated Sucessfully";
                        } else {
                            $data['message'] = "Error in Query";
                        }
                        if (!empty($data)) {
                            $msg            = 'Customer updated successfully';
                            $class            = 'alert alert-success alert-dismissible';
                        } else {
                            $msg            = 'Customer not updated successfully';
                            $class            = 'alert alert-danger alert-dismissible';
                        }
                        $this->session->set_flashdata('notify', $msg);
                        $this->session->set_flashdata('class', $class);

                        redirect('admin/view-franchise-master');
                    }
                    redirect('admin/view-franchise-master');
                }

        $data['cities'] = $this->basic_operation_m->get_all_result('city', '');
        $data['states'] = $this->basic_operation_m->get_all_result('state', '');

        $this->load->view('admin/franchise_master/update_franchise_master_data', $data);
    }


    public function delete_master_FranchiseData()
    {
        $getId = $this->input->post('getid');
        $data =  $this->db->delete('tbl_franchise', array('franchise_id' => $getId));
        // echo $this->db->last_query();
        if ($data) {
            $output['status'] = 'success';
            $output['message'] = 'Member deleted successfully';
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the member';
        }

        echo json_encode($output);
    }

}
