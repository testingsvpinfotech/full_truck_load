<?php
// ini_set('display_errors', '1');
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('basic_operation_m');
      $this->load->library('session');
   }

   public function index()
   {
      $this->load->view('vendor/include/header');
      $this->load->view('vendor/home');
      $this->load->view('vendor/include/footer');
   }

   public function register()
   {
         //print_r($_POST);exit;
      if (!empty($this->input->post())) {

         $v = $this->input->post('cancel_cheque');
         if (isset($_FILES) && !empty($_FILES['cancel_cheque']['name'])) {
           $ret = $this->basic_operation_m->fileUpload($_FILES['cancel_cheque'], 'assets/ftl_documents/vendor_register_doc/');
           if ($ret['status'] && isset($ret['image_name'])) {
            $cancel_cheque = $ret['image_name'];
           }
         }
         $v1 = $this->input->post('gst_proof');
         if (isset($_FILES) && !empty($_FILES['cancel_cheque']['name'])) {
           $ret = $this->basic_operation_m->fileUpload($_FILES['gst_proof'], 'assets/ftl_documents/vendor_register_doc/');
           if ($ret['status'] && isset($ret['image_name'])) {
            $gst_proof = $ret['image_name'];
           }
         }
         $v2 = $this->input->post('address_proof');
         if (isset($_FILES) && !empty($_FILES['address_proof']['name'])) {
           $ret = $this->basic_operation_m->fileUpload($_FILES['address_proof'], 'assets/ftl_documents/vendor_register_doc/');
           if ($ret['status'] && isset($ret['image_name'])) {
            $address_proof = $ret['image_name'];
           }
         }
         $v3 = $this->input->post('pan_card_proof');
         if (isset($_FILES) && !empty($_FILES['pan_card_proof']['name'])) {
           $ret = $this->basic_operation_m->fileUpload($_FILES['pan_card_proof'], 'assets/ftl_documents/vendor_register_doc/');
           if ($ret['status'] && isset($ret['image_name'])) {
            $pan_card_proof = $ret['image_name'];
           }
         }
         $v4 = $this->input->post('profile_image');
         if (isset($_FILES) && !empty($_FILES['profile_image']['name'])) {
           $ret = $this->basic_operation_m->fileUpload($_FILES['profile_image'], 'assets/ftl_documents/vendor_profile_image/');
           if ($ret['status'] && isset($ret['image_name'])) {
            $profile_image = $ret['image_name'];
           }
         }

         $date = date('y-m-d');
         $data = array(
            'vcode' => $this->input->post('vci'),
            'vendor_name' => $this->input->post('vendor_name'),
            'reference_person_name' => $this->input->post('reference_person_name'),
            'mobile_no' => $this->input->post('phone'),
            'alternate_phone_number' => $this->input->post('alternate_number'),
            'email' => $this->input->post('email'),
            'alternate_email' => $this->input->post('alternate_email'),
            'username' => $this->input->post('username'),
            'pincode' => $this->input->post('pincode'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'pan_number' => $this->input->post('pan_number'),
            'gst_number' => $this->input->post('gst_number'),
            'cancel_cheque' => $cancel_cheque,
            'gst_proof' => $gst_proof,
            'address_proof' => $address_proof,
            'pan_card_proof' => $pan_card_proof,
            'profile_image' => $profile_image,
            'register_type' => $this->input->post('register_type'),
            'service_provider' => $this->input->post('service_provider'),
            'credit_days' => $this->input->post('credit_days'),
            'address' => $this->input->post('address'),
            'password' => md5($this->input->post('password')),
            'register_date' => $date,
            'bank_name' => $this->input->post('bank_name'),
            'acc_number' => $this->input->post('acc_number'),
            'ifsc_code' => $this->input->post('ifsc_code'),
            'status' => 0
         );

        // print_r($data);exit;

        $this->db->insert('vendor_customer_tbl', $data);
        //echo $this->db->last_query();exit;

         $last_id = $this->db->insert_id();
        // print_r($last_id);exit;

         $origin = $this->input->post('origin[]');
         $destination = $this->input->post('destination[]');
         $vehicle_type = $this->input->post('vehicle_type[]');
         $count = count($this->input->post('destination[]'));
         for($i=0; $i<$count; $i++){
          
            $data = array(
               'vendor_id'=>$last_id,
               'origin'=>$origin[$i],
               'destination'=>$destination[$i],
               'vehicle_type'=>$vehicle_type[$i],
            );
            //print_r($data);exit;

            $res = $this->db->insert('vendor_customer_service_area_tbl', $data); 
         }
       if(!empty($res)){
         $this->session->set_flashdata('msg', 'Registration Successfully!! Now Proceed For Login ');
         redirect(base_url() . 'add-vendor');
       }else{
         $this->session->set_flashdata('msg', 'Something went Wrong');
         redirect(base_url() . 'add-vendor');
       }
      } else {

         $result = $this->db->query("select max(customer_id) AS id from  vendor_customer_tbl")->row();
         // echo $this->db->last_query();exit;
         $id = $result->id + 1;

         if (strlen($id) == 1) {
            $customer_id = 'VI0000' . $id;
         } else if (strlen($id) == 2) {
            $customer_id = 'VI000' . $id;
         } else if (strlen($id) == 3) {
            $customer_id = 'VI00' . $id;
         } else if (strlen($id) == 4) {
            $customer_id = 'VI' . $id;
         }
         $data['VCI'] = $customer_id;
         //  print_r($data['VCI']);exit;
         $this->load->view('vendor/include/header');
         $this->load->view('vendor/registration', $data);
         $this->load->view('vendor/include/footer');
      }
   }





   public function vendor_user_profile()
   {
      $id = $this->session->userdata('customer_id');
      if (!empty($this->input->post())) {

         $date = date('y-m-d');
         $data = array(
            // 'vcode'=>$this->input->post('vci'),
            'vendor_name' => $this->input->post('vendor_name'),
            'reference_person_name' => $this->input->post('reference_person_name'),
            'mobile_no' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'pincode' => $this->input->post('pincode'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'pan_number' => $this->input->post('pan_number'),
            'gst_number' => $this->input->post('gst_number'),
            'service_provider' => $this->input->post('service_provider'),
            'credit_days' => $this->input->post('credit_days'),
            'branch_name' => $this->input->post('branch_name'),
            'address' => $this->input->post('address'),
            'password' => md5($this->input->post('password')),
            'register_date' => $date,
            'status' =>1
         );
         $this->db->where('customer_id', $id);
         $this->db->update('vendor_customer_tbl', $data);
         $this->session->flashdata('msg', 'Update Successfully!!');
         redirect(base_url() . 'add-vendor');
      } else {
         $data['customer'] = $this->db->query("select * from vendor_customer_tbl  where customer_id = '$id'")->result_array();
         //   print_r($this->session->all_userdata());
         // echo $this->db->last_query();exit;
         $this->load->view('vendor/include/header');
         $this->load->view('vendor/vendor_user_profiel', $data);
         $this->load->view('vendor/include/footer');
      }
   }










   public function getCityList()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

      $city_id = $res1->row()->city_id;

      $whr2 = array('id' => $city_id);
      $data = $this->db->query("select * from city where id = '$city_id'")->row();

      echo json_encode($data);
   }
   public function getState()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
      $state_id = $res1->row()->state_id;
      $data = $this->db->query("select * from state where id = '$state_id'")->row();
     // echo $this->db->last_query();
      echo json_encode($data);
   }


   public function login()
   {
      if (isset($_POST['submit'])) {
         
         //print_r($_POST);exit;

         $username = $this->input->post('username');
         $password =  md5($this->input->post('password'));

         $result =  $this->basic_operation_m->logindata($username, $password);

         // print_r($result);exit;
         if (!empty($result)) {

          //  print_r($result[0]['status']); exit;
            if($result[0]['status'] == '3'){
               $this->session->Set_flashdata('msg', 'Your Account Has been Inactive ');
               redirect(base_url() .'vendor-login');

            }elseif( $result[0]['status'] == '0'){
            $this->session->Set_flashdata('msg', 'Your Login proccessing');
            redirect(base_url() .'vendor-login');

         }elseif( $result[0]['status'] == '2'){
            $this->session->Set_flashdata('msg', 'Your Account Has been rejected');
            redirect(base_url() .'vendor-login');

         }elseif( $result[0]['status'] == '1'){
            $Session_data  = array(
               'customer_id' => $result[0]['customer_id'],
               'username' => $result[0]['username'],
               'password' => $result[0]['password'],
               'vcode' => $result[0]['vcode'],

            );

            $this->session->set_userdata($Session_data);
            $this->session->Set_flashdata('msg', 'Login Successfully!!');
            redirect(base_url() .'dashboard');
         }
      }else{
       $this->session->Set_flashdata('msg', 'Somthing went wrong');
       redirect(base_url() .'vendor-login');
      }
    } else {
         $this->load->view('vendor/include/header');
         $this->load->view('vendor/login');
         $this->load->view('vendor/include/footer');
      }
   }
}
