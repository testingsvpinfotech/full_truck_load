<?php
defined('BASEPATH') or exit('No direct script access allowed');

error_reporting(E_ALL);
class Track_Loication extends CI_Controller
{

	public function __construct()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
		header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
		header("Content-Type: application/json; charset=utf-8");
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('basic_operation_m');
	}


	public function Create_trip()
	{

		$get_ftl_id = $this->input->post('get_ftl_id');
		$create_trip = $this->input->post('create_trip');
		// print_r($get_ftl_id);exit;

		$result = $this->db->query("update ftl_request_tbl set create_trip_status = '$create_trip' where id = '$get_ftl_id'");
       // echo $this->db->last_query();
		if (!empty($result)) {

			$dd = 	$this->db->query("SELECT ftl_request_tbl.*,goods_type_tbl.goods_name  FROM ftl_request_tbl left JOIN vendor_customer_tbl ON vendor_customer_tbl.customer_id = ftl_request_tbl.vc_id LEFT JOIN goods_type_tbl ON goods_type_tbl.id = ftl_request_tbl.goods_type  where ftl_request_tbl.id ='$get_ftl_id' AND ftl_request_tbl.ftl_booking_status = '1' GROUP BY ftl_request_tbl.id")->row_array();
			// echo $this->db->last_query();
			//print_r($dd);exit;
			$docNumber = $dd['ftl_request_id'];
			$customer_name = $dd['customer_name'] ? $dd['customer_name'] : $dd['consignee_name'];
			$request_date_time = $dd['ending_time'];
			$endTime = date("Y-m-d H:i:s:v", strtotime($request_date_time));
			// $endTime = date_format($request_date_time,"Y/m/d H:i:s:v");
			$origin_city12 = $dd['origin_city'];
			$get_origin_city = $this->db->query("select city from city where id ='$origin_city12'")->row_array();
			$origin_city = $get_origin_city['city'];

			$origni_state12 = $dd['origin_state'];
			$get_origin_state = $this->db->query("select state from state where id ='$origni_state12'")->row_array();
			$origni_state = $get_origin_state['state'];

			
			$origin_local_address = $dd['pickup_address'];
			$destination_city = $dd['destination_city'];
			$destination_state = $dd['destination_state'];
			$destination_local_address = $dd['delivery_address'];
			$driver_name = $dd['driver_name'];
			$driver_number = $dd['driver_contact_number'];
			$vehicle_number = $dd['vehicle_number'];
			$category = $dd['goods_name'];
			$ping_time = $dd['ping_time'];
			$p = explode(':',$ping_time);
			// $p = str_split($ping_time,2);
			//$p1 = explode(" ",$p);
			$hour = $p[0];
			$minute = $p[1];
			
			//print_r($p);exit;

			//"frequency": { "hour": 1, "minute": 15 

			// endTime tracking end to phone
			//API URL
			 $url = "https://track.cxipl.com/api//v3/trips/create";
            $frequency = array("hour"=>$hour, "minute"=>$minute);
			$origin = array("locality" => $origin_local_address, "city" => $origin_city, "state" => $origni_state);
			$destination = array("locality" => $destination_local_address, "city" => $destination_city, "state" => $destination_state);
			$drivers[] = array("name" => $driver_name, "phoneNumber" => $driver_number, "endTime" => $endTime,"frequency"=> $frequency );
			$ch = curl_init($url);
			# Setup request to send json via POST.
			$payload = json_encode(array("vehicleNo" => $vehicle_number, "origin" => $origin, "destination" => $destination,"drivers"=>$drivers, "docNumber" => $docNumber, "category" => $category, "uuid" => '', "branches" => '', "customer" => $customer_name));
        //    print_r($payload);exit;
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

			/* set the content type json */
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/json',
				'authkey: NM6TLUSJDD7QKM421WVXA142143FY1BQ',
				// 'authkey' => 'NM6TLUSJDD7QKM421WVXA142143FY1BQ',
				//'authkey' => 'NM6TLUSJDD7QKM421WVXA142143FY1BQ',
				//'content-Type' => 'application/json',
				//'Authorization' => 'Basic Og=='
			));

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			# Send request.
			$result = curl_exec($ch);
			curl_close($ch);
			# Print response.

			// print_r($result);die;


		
			$data = json_decode($result,true);
			$trip_Id = $data['data']['tripId'];
			$trackId = $data['data']['trackId'];
			$ftlId = $dd['ftl_request_id'];
			$msg = $data['success']['message'];
		    $msg = $data['error']['message'];
			//print_r($data);exit;
	
			$this->db->query("update ftl_request_tbl set create_trip_status = '2' where ftl_request_id = '$ftlId'");
			// $this->db->query("update ftl_request_tbl set trip_Id = '$trip_Id',trackId ='$trackId' where ftl_request_id = '$ftlId'");
		//	echo $this->db->last_query();exit;
            $this->session->Set_flashdata('msg',$msg);
			redirect(base_url().'admin/quation-approve-list');
			
		}
	}


	public function create_tracking_link(){

		$ftl_request_id = $this->input->post('ftl_request_id');
		$vehicle_number = $this->input->post('vehicle_number');

		//print_r($vehicle_number);exit;

		$url = "https://track.cxipl.com/api/v3/trips/share-link/public";		
		$ch = curl_init($url);
	
		$data = json_encode(array("vehicleNo" => $vehicle_number, ));
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'authkey: NM6TLUSJDD7QKM421WVXA142143FY1BQ',
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($result,true);
		//print_r($data);
	    $status = $data['success'];
	    $link = $data['data'];
		$msg = $data['success']['message'];
		$msg = $data['error']['message'];

		$r = array(
              'created_tracking_link_date'=>date('Y-m-d H:i:s'),
              'tracking_link'=>$link
		);

		//print_r($r);exit;
        $this->db->where('ftl_request_id',$ftl_request_id);
		$res = $this->db->update('ftl_request_tbl',$r);
		if(!empty($res)){
		$this->session->Set_flashdata('msg',$msg);
		redirect(base_url().'admin/quation-approve-list');	

		}
	}


	public function ftl_trip_end(){
	
		$ftlid = $this->input->post('ftl_request_id');
		$vehicleNo = $this->input->post('vehicle_number');

		

		 $url = "https://track.cxipl.com/api/v3/trips/end";		
		 $ch = curl_init($url);
		
	
		 $data = json_encode(array("vehicleNo" => $vehicleNo));
		
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 	'Content-Type:application/json',
		 	'authkey: NM6TLUSJDD7QKM421WVXA142143FY1BQ',
		 ));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $result_data = curl_exec($ch);
		//  print_r($result_data);
		 curl_close($ch);
		 $d = json_decode($result_data,true);
		 $msg = $d['data'];
		 $date = date('Y-m-d H:i:s');
		 $this->db->query("update ftl_request_tbl set trip_end = '1', trip_end_date = '$date' where ftl_request_id = '$ftlid'");
		 $this->session->set_flashdata('msg',$msg);
		 redirect(base_url().'admin/quation-approve-list');	
		
	
		
	
	}

}






