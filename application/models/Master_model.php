<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_model extends CI_Model
{
	function vendorListingCount($searchText = ''){
		$this->db->select('BaseTbl.customer_id, BaseTbl.vcode, BaseTbl.vendor_name, BaseTbl.mobile_no,BaseTbl.address,BaseTbl.email,BaseTbl.register_date, BaseTbl.status');
        $this->db->from('vendor_customer_tbl as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vendor_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
	}

	
	function vendorListing($searchText = '', $page='', $segment='')
    {
        $this->db->select('BaseTbl.customer_id, BaseTbl.vcode, BaseTbl.vendor_name, BaseTbl.mobile_no,BaseTbl.address,BaseTbl.email,BaseTbl.register_date, BaseTbl.status');
        $this->db->from('vendor_customer_tbl as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vendor_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    // Customers List
    function customerListingCount($searchText = ''){
    	$this->db->select('BaseTbl.customer_id, BaseTbl.cid, BaseTbl.customer_name, BaseTbl.contact_person,BaseTbl.address,BaseTbl.email,BaseTbl.phone,BaseTbl.address,BaseTbl.gstno');
        $this->db->from('tbl_customers as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.cid  LIKE '%".$searchText."%'
                            OR  BaseTbl.customer_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_person  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%'
                            OR  BaseTbl.gstno  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isdeleted', 0);
        $query = $this->db->get();
        return count($query->result());
    }
    function customerListing($searchText = '', $page='', $segment=''){
    	$this->db->select('BaseTbl.customer_id, BaseTbl.cid, BaseTbl.customer_name, BaseTbl.contact_person,BaseTbl.address,BaseTbl.email,BaseTbl.phone,BaseTbl.address,BaseTbl.gstno');
        $this->db->from('tbl_customers as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.cid  LIKE '%".$searchText."%'
                            OR  BaseTbl.customer_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_person  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%'
                            OR  BaseTbl.gstno  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isdeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    // TDS SECTION Start
    function sectionListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.sec_id, BaseTbl.section_name');
        $this->db->from('acctbl_tdssection as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.section_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        return count($query->result());
    } 
    function sectionListing($searchText = '', $page='', $segment='')
    {
        $this->db->select('BaseTbl.sec_id, BaseTbl.section_name');
        $this->db->from('acctbl_tdssection as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.section_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function tdsListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id,BaseTbl.section_id, BaseTbl.description, BaseTbl.tds_perc,BaseTbl.thresehold_mix,BaseTbl.thresehold_yearly,Tds.section_name');
        $this->db->from('acctbl_tdspercent as BaseTbl');
        $this->db->join('acctbl_tdssection as Tds', 'Tds.sec_id = BaseTbl.section_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        return count($query->result());
    } 

    function tdsListing($searchText = '', $page='', $segment='')
    {
        $this->db->select('BaseTbl.id,BaseTbl.section_id, BaseTbl.description, BaseTbl.tds_perc,BaseTbl.thresehold_mix,BaseTbl.thresehold_yearly,Tds.section_name');
        $this->db->from('acctbl_tdspercent as BaseTbl');
        $this->db->join('acctbl_tdssection as Tds', 'Tds.sec_id = BaseTbl.section_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
    // TDS SECTION End

    // GST SECTION Start
    function gstListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.gst_id,BaseTbl.gst_group, BaseTbl.gst_description, BaseTbl.gst_perc,BaseTbl.gst_state,State.state');
        $this->db->from('acctbl_gst as BaseTbl');
        $this->db->join('state as State', 'State.id = BaseTbl.gst_state','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.gst_group  LIKE '%".$searchText."%'
				OR BaseTbl.gst_description  LIKE '%".$searchText."%'
				OR BaseTbl.gst_perc  LIKE '%".$searchText."%'
				OR State.state  LIKE '%".$searchText."%'
        	)";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();        
        return count($query->result());
    }

    function gstListing($searchText = '', $page='', $segment='')
    {
        $this->db->select('BaseTbl.gst_id,BaseTbl.gst_group, BaseTbl.gst_description, BaseTbl.gst_perc,BaseTbl.gst_state,State.state');
        $this->db->from('acctbl_gst as BaseTbl');
        $this->db->join('state as State', 'State.id = BaseTbl.gst_state','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.gst_group  LIKE '%".$searchText."%'
				OR BaseTbl.gst_description  LIKE '%".$searchText."%'
				OR BaseTbl.gst_perc  LIKE '%".$searchText."%'
				OR State.state  LIKE '%".$searchText."%'
        	)";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
    // TDS SECTION End
    // Expense Sub group Start
    function expSubGrpListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id,BaseTbl.sub_name, Group.name');
        $this->db->from('acctbl_subgroup_master as BaseTbl');
        $this->db->join('acctbl_group_master as Group', 'Group.id = BaseTbl.exp_group_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sub_name  LIKE '%".$searchText."%'
				OR Group.name  LIKE '%".$searchText."%'
        	)";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();        
        return count($query->result());
    }
    function expSubGrpListing($searchText = '', $page='', $segment='')
    {
        $this->db->select('BaseTbl.id,BaseTbl.sub_name, Group.name');
        $this->db->from('acctbl_subgroup_master as BaseTbl');
        $this->db->join('acctbl_group_master as Group', 'Group.id = BaseTbl.exp_group_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sub_name  LIKE '%".$searchText."%'
				OR Group.name  LIKE '%".$searchText."%'
        	)";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
    // TDS SECTION End
}