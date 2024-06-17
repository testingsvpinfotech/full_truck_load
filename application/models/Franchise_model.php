<?php
class Franchise_model extends CI_Model
{
	public function get_franchise_details()
	{
		$this->db->select('tbl_customers.*,franchise_delivery_tbl.delivery_franchise_id,tbl_franchise.fid');
		$this->db->from('tbl_customers');
		$this->db->join('state', 'state.id = tbl_customers.state','left');	
		$this->db->join('city', 'city.id = tbl_customers.city','left');	
		$this->db->join('tbl_franchise','tbl_customers.customer_id = tbl_franchise.fid','inner');
		$this->db->join('franchise_delivery_tbl','tbl_customers.customer_id = franchise_delivery_tbl.delivery_franchise_id','left');
		$this->db->join('franchise_assign_pincode','tbl_customers.customer_id = franchise_assign_pincode.customer_id','left');
		$this->db->where('customer_type','2');
		$query	=	$this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

	public function get_master_franchise_details()
	{
		$this->db->select('*');
		$this->db->from('tbl_customers');
		$this->db->join('state', 'state.id = tbl_customers.state','left');	
		$this->db->join('city', 'city.id = tbl_customers.city','left');	
		$this->db->join('tbl_franchise','tbl_customers.customer_id = tbl_franchise.fid','inner');
		$this->db->where('customer_type','1');
		$query	=	$this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

}