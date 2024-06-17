<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model
{
	public function get_voucher_max_id($table, $field)
	{
  		$append_code = "V-";
    	$code = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(voucher_no),3) AS UNSIGNED)) AS voucher_no FROM acctbl_voucher WHERE voucher_no RLIKE '$append_code'")->result_array();
    	// $append_code = $record['prod'][0]['pm_short_name'];
    	
    	if(empty($code[0]['voucher_no']))
    	{
      		$retstr = $append_code.'101';
      		return $retstr;
    	}
    	else
    	{
      		$str = $code[0]['voucher_no'] + 1;
      		$code = $append_code.$str;
      		return $code;
    	}
	}

	// Voucher Listing
	public function voucherListingCount($fieldname = '',$searchResult = ''){
		$this->db->select('BaseTbl.*, Branch.branch_name, Party.name');
		$this->db->from('acctbl_voucher as BaseTbl');
		$this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
		$this->db->join('acctbl_ledger as Party', 'Party.id = BaseTbl.party_id','left');
		if(!empty($fieldname) && !empty($searchResult)) {
			$likeCriteria = '';
			if($fieldname == 'voucher_no'){
				$likeCriteria = "BaseTbl.voucher_no  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'voucher_type'){
				$likeCriteria = "BaseTbl.voucher_type  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'inv_no'){
				$likeCriteria = "BaseTbl.inv_no  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'name'){
				$likeCriteria = "Party.name  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'branch_name'){
				$likeCriteria = "Branch.branch_name  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'total_amount'){
				$likeCriteria = "BaseTbl.total_amount  LIKE '%".$searchResult."%'";
			}
            $this->db->where($likeCriteria);
        }
		$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $query = $this->db->get();        
        return count($query->result());
	}

	public function voucherListing($fieldname='',$searchResult='', $page='', $segment=''){
		$this->db->select('BaseTbl.*, Branch.branch_name, Party.name');
		$this->db->from('acctbl_voucher as BaseTbl');
		$this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
		$this->db->join('acctbl_ledger as Party', 'Party.id = BaseTbl.party_id','left');
		if(!empty($fieldname) && !empty($searchResult)) {
			$likeCriteria = '';
			if($fieldname == 'voucher_no'){
				$likeCriteria = "BaseTbl.voucher_no  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'voucher_type'){
				$likeCriteria = "BaseTbl.voucher_type  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'inv_no'){
				$likeCriteria = "BaseTbl.inv_no  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'name'){
				$likeCriteria = "Party.name  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'branch_name'){
				$likeCriteria = "Branch.branch_name  LIKE '%".$searchResult."%'";
			}elseif($fieldname == 'total_amount'){
				$likeCriteria = "BaseTbl.total_amount  LIKE '%".$searchResult."%'";
			}
            $this->db->where($likeCriteria);
        }

		$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();
        return $result;
	}

	public function single_voucher_details($id){
		$this->db->select('BaseTbl.*, Branch.branch_name, Party.name');
		$this->db->from('acctbl_voucher as BaseTbl');
		$this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
		$this->db->join('acctbl_ledger as Party', 'Party.id = BaseTbl.party_id','left');
		$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();        
        $result['master'] = $query->row();

        $result['trans'] = $this->db->select('vt.*')->from('acctbl_voucher_trans vt')->where('voucher_id',$id)->get()->result();
        return $result;
	}
}