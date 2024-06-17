<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Generate_pod_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function select_generate_pod($whrAct)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_tracking', 'tbl_tracking.pod_no = tbl_booking.pod_no','left');	
		if($whrAct!="")	
		{
				$this->db->where($whrAct);
		}
		$this->db->order_by("booking_date", "DESC");

		$query=$this->db->get();	
		return $query->result_array();
	}
	public function get_city_receiver($city_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_city');		
		$this->db->where('id',$city_id);
		$query=$this->db->get();			
		return $query->row();
	}
	public function get_international_tracking_data($whrAct,$limit='',$offset='')
	{
	    $data['alldata']=array();
		$this->db->select('tbl_international_booking.booking_id,tbl_international_booking.eway_no,tbl_international_booking.company_type,reciever_city,mode_dispatch,max(tbl_international_tracking.tracking_date) as tracking_date,comment,remarks,booking_date,tbl_international_booking.pod_no,sender_name,doc_nondoc,tbl_international_booking.forwording_no,tbl_international_booking.forworder_name,reciever_name,dispatch_details,chargable_weight,max(tbl_international_tracking.status) as status,tbl_international_booking.is_delhivery_complete,country_name,reciever_zipcode,reciever_address,tbl_international_booking.customer_id,no_of_pack,tbl_branch.branch_name,invoice_no,invoice_value,mode_name');
		$this->db->from('tbl_international_booking');
		$this->db->join('tbl_international_tracking', 'tbl_international_tracking.id = (select max(id) from tbl_international_tracking as e2 where e2.pod_no = tbl_international_booking.pod_no)','');		
		$this->db->join('tbl_international_weight_details', 'tbl_international_weight_details.booking_id = tbl_international_booking.booking_id','');		
		$this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_international_booking.customer_id','left');	
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_international_booking.branch_id','left');
		$this->db->join('transfer_mode', 'transfer_mode.transfer_mode_id = tbl_international_booking.mode_dispatch','left');	
		$this->db->join('zone_master', 'zone_master.z_id = tbl_international_booking.reciever_country_id','left');
		$this->db->group_by('tbl_international_booking.pod_no');
		$this->db->order_by('tbl_international_tracking.id','DESC');
		if($whrAct!="")	
		{
			$this->db->where($whrAct);
		}
		
		if($limit!="")	
		{
			$this->db->limit($limit);
		}
		
		if($offset!="")	
		{
			$this->db->offset($offset);
		}
	
		$query=$this->db->get();
		// echo $this->db->last_query();exit();
		return $query->result_array();
	}

	public function get_domestic_tracking_data($whrAct,$limit='',$offset='')
	{
		$this->db->select('tbl_domestic_booking.eway_no,tbl_domestic_booking.reciever_pincode,tbl_domestic_booking.reciever_address,tbl_domestic_booking.booking_id,tbl_domestic_booking.company_type,tbl_domestic_booking.is_delhivery_complete,city.city as reciever_city,mode_dispatch,transfer_mode.mode_name,max(tbl_domestic_tracking.tracking_date) as tracking_date,comment,remarks,booking_date,tbl_domestic_booking.pod_no,sender_name,doc_nondoc,city.city,tbl_domestic_booking.forwording_no,tbl_domestic_booking.forworder_name,reciever_name,dispatch_details,chargable_weight,max(tbl_domestic_tracking.status) as status,delivery_date,tbl_domestic_booking.customer_id,no_of_pack,tbl_branch.branch_name,invoice_no,invoice_value');
		$this->db->from('tbl_domestic_booking');
	    $this->db->join('tbl_domestic_weight_details', 'tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id','');
		$this->db->join('tbl_domestic_tracking', 'tbl_domestic_tracking.id = (select max(id) from tbl_domestic_tracking as e2 where e2.pod_no = tbl_domestic_booking.pod_no)','');	
		$this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_domestic_booking.customer_id','left');
		$this->db->join('city', 'city.id = tbl_domestic_booking.reciever_city','left');
		// $this->db->join('tbl_users', 'tbl_users.user_id = tbl_domestic_booking.user_id','left');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_domestic_booking.branch_id','left');
		$this->db->join('transfer_mode', 'transfer_mode.transfer_mode_id = tbl_domestic_booking.mode_dispatch','left');		
		// $this->db->join('service_pincode', 'service_pincode.pincode = tbl_domestic_booking.reciever_pincode','inner');		
		$this->db->group_by('tbl_domestic_booking.pod_no');
		$this->db->order_by('tbl_domestic_tracking.id','DESC');

		if($whrAct!="")	
		{
			$this->db->where($whrAct);
		}
		
		if($limit!="")	
		{
			$this->db->limit($limit);
		}
		
		if($offset!="")	
		{
			$this->db->offset($offset);
		}
	
		$query=$this->db->get();
	//echo $this->db->last_query();
	    return $query->result_array();

	}
		
	public function get_table_row_count($tablename,$where)
	{
		$this->db->select('count(booking_id) as total');
		$this->db->from($tablename);
		if(!empty($where))
		{
			$this->db->where($where);
		}
		$query	=	$this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->row()->total;
	}
	
}
?>