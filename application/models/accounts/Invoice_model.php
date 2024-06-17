<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
	public function get_ptl_invoiceListing($searchText = '', $page='', $segment=''){
		$this->db->select('BaseTbl.*, Branch.branch_name, User.full_name');
		$this->db->from('tbl_domestic_invoice BaseTbl');
		$this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
		$this->db->join('tbl_users as User', 'User.user_id = BaseTbl.createId','left');
		// if(!empty($searchText)) {
  //           $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
  //               OR  BaseTbl.alias  LIKE '%".$searchText."%'
  //               OR  BaseTbl.under_group  LIKE '%".$searchText."%')";
  //           $this->db->where($likeCriteria);
  //       }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
	}
	public function get_ptl_invoiceListingCount($searchText = ''){
		$this->db->select('BaseTbl.*, Branch.branch_name, User.full_name');
		$this->db->from('tbl_domestic_invoice BaseTbl');
		$this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
		$this->db->join('tbl_users as User', 'User.user_id = BaseTbl.createId','left');
		// if(!empty($searchText)) {
  //           $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
  //               OR  BaseTbl.alias  LIKE '%".$searchText."%'
  //               OR  BaseTbl.under_group  LIKE '%".$searchText."%')";
  //           $this->db->where($likeCriteria);
  //       }
  //       $this->db->where('BaseTbl.isDeleted', 0);
  //       $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
	}
}