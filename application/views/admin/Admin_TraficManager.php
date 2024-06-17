<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_TraficManager extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('basic_operation_m');
		$this->load->model('Login_model');
		if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}

    public function quotation_requested_list(){ 
         $date = date('Y-m-d');
		 $branch_id = $this->session->userdata('branch_id');
		 $traffic_manager = $this->db->query("select b.state from tbl_users as u left join tbl_branch as b ON b.branch_id = u.branch_id where b.branch_id = '$branch_id' AND `user_type` = '10'")->row_array();
	     $get_traficmanager_state = $traffic_manager['state'];
		 $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
		//  $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
        //   echo $this->db->last_query();exit;
        $this->load->view('admin/trafic_manager/admin_quotation_requested_list',$data);    
    }


	public function approve_quotation_requested_list(){ 
		$date = date('Y-m-d');
		$branch_id = $this->session->userdata('branch_id');
		$traffic_manager = $this->db->query("select b.state from tbl_users as u left join tbl_branch as b ON b.branch_id = u.branch_id where b.branch_id = '$branch_id' AND `user_type` = '10'")->row_array();
		$get_traficmanager_state = $traffic_manager['state'];
		$data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
	   //  $data['get_quotation_list'] = $this->db->query("SELECT order_request_tabel.*,vendor_customer_tbl.vcode,ftl_request_tbl.ftl_request_id,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.pickup_address,ftl_request_tbl.order_date,ftl_request_tbl.delivery_address,ftl_request_tbl.type_of_vehicle,ftl_request_tbl.vehicle_capacity,ftl_request_tbl.vehicle_body_type,ftl_request_tbl.vehicle_floor_type,ftl_request_tbl.vehicle_wheel_type,ftl_request_tbl.vehicle_gps,ftl_request_tbl.request_date_time,ftl_request_tbl.goods_type,ftl_request_tbl.goods_weight,ftl_request_tbl.total_amount FROM order_request_tabel INNER JOIN vendor_customer_tbl ON order_request_tabel.vendor_customer_id = vendor_customer_tbl.customer_id INNER JOIN ftl_request_tbl ON order_request_tabel.ftl_request_id = ftl_request_tbl.id where vendor_customer_tbl.state = '$get_traficmanager_state'  ORDER BY order_request_tabel.advance_amount ASC")->result();
	   //   echo $this->db->last_query();exit;
	   $this->load->view('admin/trafic_manager/approve_quotation_list',$data);    
   }



	public function update_status(){

		$branch_id = $this->session->userdata('branch_id');
		$id = $this->input->post('id');
		$ftl_request_id = $this->input->post('ftl_request_id');
		$approved = $this->input->post('approved');
		$this->db->query("update order_request_tabel set trafic_approve_status ='$approved',branch_id ='$branch_id' where id ='$id'");
		$this->db->query("update ftl_request_tbl set trafic_approve_status ='$approved',branch_id ='$branch_id' where id ='$ftl_request_id'");
		// echo $this->db->last_query();exit;
		redirect(base_url().'admin/quation-requested-list');

	}

	public function get_ftl_data()
	{
		$order_id = $this->input->get('id');
		$dd = $this->db->query("select * from order_request_tabel where id = '$order_id' ")->row_array();
		echo json_encode($dd);
	}
}