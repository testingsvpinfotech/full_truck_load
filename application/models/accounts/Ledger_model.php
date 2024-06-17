<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ledger_model extends CI_Model
{
	// public function get_max_id(){
    
	public function get_max_id($table, $field)
	{
  		$append_code = "GL";
    	$code = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(ledger_code),3) AS UNSIGNED)) AS ledger_code FROM acctbl_ledger WHERE ledger_code RLIKE '$append_code'")->result_array();
    	// $append_code = $record['prod'][0]['pm_short_name'];
    	
    	if(empty($code[0]['ledger_code']))
    	{
      		$retstr = $append_code.'GN101';
      		return $retstr;
    	}
    	else
    	{
      		$str = $code[0]['ledger_code'] + 1;
      		$code = $append_code.$str;
      		return $code;
    	}
	}

	public function get_max_id_for_saleledger($table, $field)
	{
  		$append_code = "SL";
    	$code = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(ledger_code),3) AS UNSIGNED)) AS ledger_code FROM acctbl_ledger WHERE ledger_code RLIKE '$append_code'")->result_array();
    	// $append_code = $record['prod'][0]['pm_short_name'];
    	
    	if(empty($code[0]['ledger_code']))
    	{
      		$retstr = $append_code.'SL101';
      		return $retstr;
    	}
    	else
    	{
      		$str = $code[0]['ledger_code'] + 1;
      		$code = $append_code.$str;
      		return $code;
    	}
	}

	public function get_max_id_for_purchaseledger($table, $field)
	{
  		$append_code = "PL";
    	$code = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(ledger_code),3) AS UNSIGNED)) AS ledger_code FROM acctbl_ledger WHERE ledger_code RLIKE '$append_code'")->result_array();
    	// $append_code = $record['prod'][0]['pm_short_name'];
    	
    	if(empty($code[0]['ledger_code']))
    	{
      		$retstr = $append_code.'PL101';
      		return $retstr;
    	}
    	else
    	{
      		$str = $code[0]['ledger_code'] + 1;
      		$code = $append_code.$str;
      		return $code;
    	}
	}
  public function get_max_id_for_vendorledger($table, $field)
  {
      $append_code = "VL";
      $code = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(ledger_code),3) AS UNSIGNED)) AS ledger_code FROM acctbl_ledger WHERE ledger_code RLIKE '$append_code'")->result_array();
      // $append_code = $record['prod'][0]['pm_short_name'];
      
      if(empty($code[0]['ledger_code']))
      {
          $retstr = $append_code.'VL101';
          return $retstr;
      }
      else
      {
          $str = $code[0]['ledger_code'] + 1;
          $code = $append_code.$str;
          return $code;
      }
  }

	// ALL LEDGER LISTING
	public function ledgerListingCount($searchText = ''){
		$this->db->select('BaseTbl.*, Branch.branch_name');
        $this->db->from('acctbl_ledger as BaseTbl');
        $this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.alias  LIKE '%".$searchText."%'
                            OR  BaseTbl.under_group  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $query = $this->db->get();
        
        return count($query->result());
	}

	public function ledgerListing($searchText = '', $page='', $segment=''){
		  $this->db->select('BaseTbl.*, Branch.branch_name');
        $this->db->from('acctbl_ledger as BaseTbl');
        $this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
                OR  BaseTbl.alias  LIKE '%".$searchText."%'
                OR  BaseTbl.under_group  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.branch_id', $this->session->userdata('branch_id'));
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
	}

  public function get_allvoucher_asper_ledger($id){
    $this->db->select('BaseTbl.*,Branch.branch_name, Party.name, State.state');
    $this->db->from('acctbl_voucher as BaseTbl');
    $this->db->join('tbl_branch as Branch', 'Branch.branch_id = BaseTbl.branch_id','left');
    $this->db->join('acctbl_ledger as Party', 'Party.id = BaseTbl.party_id','left');
    $this->db->join('state as State', 'State.id = Branch.state','left');
    $this->db->where('party_id', $id);
    $result = $this->db->get()->result();
    return $result;
  }
}