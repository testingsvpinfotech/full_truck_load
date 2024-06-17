<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_bag_incoming extends CI_Controller{
	
	function __construct()
	{	
		parent:: __construct();
		$this->load->model('basic_operation_m');
		if($this->session->userdata('userId') == '')
		{
			redirect('admin');
		}
	}
	
	public function incomingbag()
	{  
     

        $data= array();
		$username=$this->session->userdata("userName");
		     $whr = array('username'=>$username);
			 $res=$this->basic_operation_m->getAll('tbl_users',$whr);
			 $branch_id= $res->row()->branch_id;
			 
			 $whr = array('branch_id'=>$branch_id);
			 $res=$this->basic_operation_m->getAll('tbl_branch',$whr);
			 $branch_name= $res->row()->branch_name;
		
		$resAct=$this->db->query("SELECT *, SUM(CASE WHEN tbl_domestic_bag.bag_recived=1 THEN 1 ELSE 0 END) AS total_coming, COUNT(tbl_domestic_bag.id) AS total,
 COUNT(tbl_domestic_bag.total_pcs) AS total_pcs, COUNT(tbl_domestic_bag.total_weight) AS total_weight
FROM tbl_domestic_menifiest
LEFT JOIN tbl_domestic_bag ON tbl_domestic_bag.bag_id = tbl_domestic_menifiest.bag_no
WHERE tbl_domestic_menifiest.destination_branch='$branch_name' AND reciving_status ='1'
GROUP BY tbl_domestic_bag.bag_id
ORDER BY tbl_domestic_bag.date_added DESC");
		//$resAct=$this->basic_operation_m->getAll('tbl_inword','');
		 if($resAct->num_rows()>0)
		 {
		 	$data['allinword']=$resAct->result_array();	            
			
         }
		 
         $this->load->view('admin/bag_incoming/view_incoming',$data);
     
		
	}
	
	public function addincomingbag($mid='')
	{
		$data['message']="";//for branch code
		$data['menifiest_data']="";//for branch code
		$data['manifiest_id']="";//for branch code
		
		$username=$this->session->userdata("userName");
		 $whr = array('username'=>$username);
		 $res=$this->basic_operation_m->getAll('tbl_users',$whr);
		 $branch_id= $res->row()->branch_id;
		 
		 $whr = array('branch_id'=>$branch_id);
		 $res=$this->basic_operation_m->getAll('tbl_branch',$whr);
		 $branch_name= $res->row()->branch_name;
	
		 $resAct=$this->db->query("select distinct tbl_domestic_bag.bag_id AS bag_no,tbl_domestic_bag.date_added,tbl_domestic_bag.bag_recived from tbl_domestic_menifiest
LEFT JOIN tbl_domestic_bag ON tbl_domestic_bag.bag_id = tbl_domestic_menifiest.bag_no
 where destination_branch='$branch_name' AND bag_recived = '0' GROUP BY tbl_domestic_bag.bag_id" );
		
        if($resAct->num_rows()>0)
        {
			$data['menifiest']=$resAct->result();
        }
		
       	$data['branch_name']=$branch_name;
      // echo $this->db->last_query();
	  
	  if(!empty($mid))
	  {
		   $date=date('y-m-d');
			 
			
			 $data['manifiest_id']=$mid;
			 $res=$this->db->query("select * from tbl_domestic_bag where   bag_id='$mid' ");
			$data['menifiest_data']=$res->result();
	  }
		
		if (isset($_POST['submit'])) 
		{
			
			
			 $date=date('y-m-d');
			 
			$mid=$this->input->post('manifiest_id');
			 $data['manifiest_id']=$mid;
			 $res=$this->db->query("select * from tbl_domestic_bag where   bag_id='$mid' ");
			$data['menifiest_data']=$res->result();
			
		}
	//echo $_POST['receving'];exit;
		if(isset($_POST['receving'])) 
		{
			$all_data 		= $this->input->post();
			$date			= $this->input->post('datetime');
		
			$username	=	$this->session->userdata("userName");
			$whr 		= 	array('username'=>$username);
			$res		=	$this->basic_operation_m->getAll('tbl_users',$whr);
			$branch_id	= 	$res->row()->branch_id;
			


			$whr		= 	array('branch_id'=>$branch_id);
			$res		=	$this->basic_operation_m->getAll('tbl_branch',$whr);
			$branch_name= 	$res->row()->branch_name;
	
			if(!empty($all_data))
			{
			
				$manifiest_id			= $all_data['manifiest_id'];
				foreach($all_data as $key => $values)
				{
					if($key !== 'manifiest_id' && $key !== 'receving'	 && $key !== 'datetime'	)
					{
						
						if(!empty($values))
						{
						
							$key_data	= 	explode('_',$key);
							$pod_no		= 	$key_data[1];
							//$date		=	date('y-m-d');

							$mid			=	$manifiest_id;
							$booking_id		=	$this->basic_operation_m->get_table_row('tbl_domestic_booking',"pod_no = '$pod_no'");
				
							$r				= array('id'=>'',
										'branch_code' =>$branch_name,
										'pod_no'=>$pod_no,
										'status' => 'In-Scan',
										'manifiest_id'=>$mid,
										'date_added'=>$date,
							);
							
							$data1=array('id'=>'',
										 'booking_id'=>$booking_id->booking_id,
										 'pod_no'=>$pod_no,
										 'status'=>'In-Scan',
										 'branch_name'=>$branch_name,
										 'tracking_date'=>$date,
											  );
							$result		=	$this->basic_operation_m->insert('tbl_inword',$r);
							
							$result1	=	$this->basic_operation_m->insert('tbl_domestic_tracking',$data1);
							$resAct		=	$this->db->query("update tbl_domestic_bag set bag_recived = '1' where pod_no='$pod_no'");
							$resAct		=	$this->db->query("update tbl_domestic_booking set menifiest_recived = '0' where pod_no='$pod_no'");
							
						}
					}	
				}
			}
			redirect('admin/list-incoming-bag');
			
		}
		
		
		$this->load->view('admin/bag_incoming/addincoming', $data);
	}
	
	public function sendemail($to,$message)
	{
	    $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
	    $this->load->library('email');
	    $this->email->initialize($config);
        
        $this->email->from('info@shreelogistics.net', 'shreelogistics Admin');
        $this->email->to($to); 
        
        
        $this->email->subject('Shipment Update');
        $this->email->message($message);	
        
        $this->email->send();


	}
	
	
}




?>