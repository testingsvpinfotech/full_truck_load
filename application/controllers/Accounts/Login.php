<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent:: __construct();
        $this->load->model('login_model');
        $this->load->model('basic_operation_m');
        
    }
	
	function index(){
		$data['title'] = "Accountant Login";
		$data['slug'] = "acc_login";
		$data['company'] = $this->db->order_by('id','desc')->limit(1)->get_where('tbl_company',['isDeleted' => 0])->row();
		$this->load->view('accounts/accountant_login',$data);
	}

	function validateLogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if(!empty($username) && !empty($password)){
			$password = $this->input->post('password');
			$key = $this->config->item('encryption_key');
            $salt1 = hash('sha512', $key . $password);
			$salt2 = hash('sha512', $password . $key);
			$hashed_password = hash('sha512', $salt1 . $password . $salt2);
			$res = $this->login_model->checkAdminLogin($this->input->post('username'),$hashed_password);

			if($res == true)
			{ 
				$getData = $this->db->get_where('tbl_users',['username'=>$username])->row();
				$sessiondata = array(
						'username' => $getData->username,
						'full_name' => $getData->full_name,
						'email' => $getData->email,
						'phoneno' => $getData->phoneno,
						'registed_date' => $getData->registed_date,
						'isactive' => $getData->isactive,
						'user_id' => $getData->user_id
					);
				$this->session->set_userdata($sessiondata);
				echo 1;
			}
			else
			{
				echo 0;
			}
		}

	}

}
?>