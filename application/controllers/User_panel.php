<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class User_panel extends CI_Controller {

	function __construct()
	{
		
		 parent:: __construct();
		 $this->load->model('basic_operation_m');
		 if($this->session->userdata('customer_id') == '')
		{
			redirect('home');
		}
	}
	
	public function dashboard()
	{ 
	    $customer_id	=	$this->session->userdata("customer_id");
    	$data= array();
	 

		$data['latest_international_shippment']		=	$this->basic_operation_m->get_all_pod_data_dashboard(array('tbl_international_booking.customer_id'=>$customer_id)); 
		$data['latest_domestic_shippment']			=	$this->basic_operation_m->get_all_pod_data_domestic_dashboard(array('tbl_domestic_booking.customer_id'=>$customer_id));  

		$data['count_international_pod']			=	$this->basic_operation_m->get_count_international_pod(array('customer_id'=>$customer_id)); 
		$data['count_delivered_international_pod']	=	$this->basic_operation_m->get_count_international_pod(array('customer_id'=>$customer_id,'is_delhivery_complete'=>1)); 

		$data['count_domestic_pod']					=	$this->basic_operation_m->get_count_domestic_pod(array('customer_id'=>$customer_id));  
		$data['count_delivered_domestic_pod']		=	$this->basic_operation_m->get_count_domestic_pod(array('customer_id'=>$customer_id,'is_delhivery_complete'=>1));  

	
         
		$this->load->view('user/view_dashboard',$data);
	}  

	public function report()
	{
		$data= array('from_date'=>'','to_date'=>'','status'=>'','company_type'=>'');
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
          $resAct	= $this->basic_operation_m->getAll('tbl_testimonial','');

		if($resAct->num_rows()>0)
		 {
			$data['testimonial']=$resAct->result_array();	            
		 }else{
			 $data['testimonial']=array();
		 }

         $cities=$this->basic_operation_m->getAll('tbl_city','');
       	if($cities->num_rows()>0)
       {
       	$data['cities']=$cities->result_array();
       } 

       if(isset($_POST['submit']))
       {
            $data['alldata']=array();
            $data['alldata_d']=array();
            $customer_id=$this->session->userdata("customer_id");
           
       		$from_date = $this->input->post('fromdate');
       		$to_date = $this->input->post('todate');
       		$status = $this->input->post('status');
       		
       		if($status=='1')
       		{
       		 $display_status = "Delivered";   
       		}else{
       		    $display_status = "Pending";
       		}
       		$city = $this->input->post('city');
       		
       		$company_type = $this->input->post('company_type');
       		
       		if($company_type!="ALL")
       		{
				
       		    if($company_type=="International")
				{
        			$status_fileter = '1=1';
        			if($status !="ALL"){
        				$status_fileter = "tbl_international_booking.is_delhivery_complete='$status'";
        			}
        			$resAct1 = $this->db->query("select * from tbl_international_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_international_booking`.`customer_id` LEFT JOIN `zone_master` ON `zone_master`.`z_id` = `tbl_international_booking`.`reciever_country_id` WHERE tbl_international_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date' AND $status_fileter ORDER BY booking_date DESC");
               	
               		if($resAct1->num_rows()>0)
               		{
               			$temp= $resAct1->result();
               			
               			foreach($temp as $t)
               			{
               			    $resAct2 = $this->db->query("select * from tbl_international_tracking where tbl_international_tracking.pod_no='$t->pod_no' order by tracking_date DESC ");
        					if($resAct2->num_rows()>0){
        						$status=@$resAct2->row()->status;
        						//$row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'reciever_name'=>$t->reciever_name,'status'=>$status);
        					    $row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'doc_nondoc'=>$t->doc_nondoc,'country_name'=>$t->country_name,'forwording_no'=>$t->forwording_no,'forworder_name'=>$t->forworder_name,'reciever_name'=>$t->reciever_name,'invoice_no'=>$t->invoice_no,'invoice_value'=>$t->invoice_value,'status'=>$status);
        						array_push( $data['alldata'],$row);
        					}
               			}
               		}
               		 $data['from_date'] =$from_date;
               		$data['to_date']=$to_date;
               		$data['status']=$this->input->post('status');
               		
       		    }
				else if($company_type=="Domestic")
			    {	
               		//==domestic
               		$d_status_fileter = '1=1';
               		if($status !="ALL"){
        				$d_status_fileter = "tbl_domestic_booking.is_delhivery_complete='$status'";
        			}
               		$resAct2 = $this->db->query("select * from tbl_domestic_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_domestic_booking`.`customer_id` LEFT JOIN `city` ON `city`.`id` = `tbl_domestic_booking`.`reciever_city` WHERE tbl_domestic_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date' AND $d_status_fileter ORDER BY booking_date DESC");
               
               		if($resAct2->num_rows()>0)
               		{
               			$temp2= $resAct2->result();
               			
               			foreach($temp2 as $t2)
               			{
               			    $resAct2 = $this->db->query("select * from tbl_domestic_tracking where tbl_domestic_tracking.pod_no='$t2->pod_no' order by tracking_date DESC ");
        					if($resAct2->num_rows()>0){
        						$status=@$resAct2->row()->status;
        					    $row_d=array('booking_date'=>$t2->booking_date,'pod_no'=>$t2->pod_no,'sender_name'=>$t2->sender_name,'doc_nondoc'=>$t2->doc_nondoc,'city'=>$t2->city,'forwording_no'=>$t2->forwording_no,'forworder_name'=>$t2->forworder_name,'reciever_name'=>$t2->reciever_name,'invoice_no'=>$t2->invoice_no,'invoice_value'=>$t2->invoice_value,'status'=>$status);
        						array_push($data['alldata_d'],$row_d);
        					}
               			}
               		}
               		 $data['from_date'] =$from_date;
               		$data['to_date']=$to_date;
               		$data['status']=$this->input->post('status');
			    }
			
       		}
			else
			{
				
       		        $status_fileter = '1=1';
        			if($status !="ALL")
					{
        				$status_fileter = "tbl_international_booking.is_delhivery_complete='$status'";
        			}
        			$resAct1 = $this->db->query("select * from tbl_international_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_international_booking`.`customer_id` LEFT JOIN `zone_master` ON `zone_master`.`z_id` = `tbl_international_booking`.`reciever_country_id` WHERE tbl_international_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date' AND $status_fileter ORDER BY booking_date DESC");
               	
               		if($resAct1->num_rows()>0)
               		{
               			$temp= $resAct1->result();
               			
               			foreach($temp as $t)
               			{
               			    $resAct2 = $this->db->query("select * from tbl_international_tracking where tbl_international_tracking.pod_no='$t->pod_no' AND $status_fileter order by tracking_date DESC ");
        					if($resAct2->num_rows()>0){
        						$status=@$resAct2->row()->status;
        						//$row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'reciever_name'=>$t->reciever_name,'status'=>$status);
        					    $row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'doc_nondoc'=>$t->doc_nondoc,'country_name'=>$t->country_name,'forwording_no'=>$t->forwording_no,'forworder_name'=>$t->forworder_name,'reciever_name'=>$t->reciever_name,'invoice_no'=>$t->invoice_no,'invoice_value'=>$t->invoice_value,'status'=>$status);
        						array_push($data['alldata'],$row);
        					}
               			}
               		}
               		//echo "<pre>";print_r($data['alldata']);
               		//==domestic
               		
               		$d_status_fileter = '1=1';
               		if($status !="ALL")
					{
        				$d_status_fileter = "tbl_domestic_booking.is_delhivery_complete='$status'";
        			}
               	
               		$resAct_d = $this->db->query("select * from tbl_domestic_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_domestic_booking`.`customer_id` LEFT JOIN `city` ON `city`.`id` = `tbl_domestic_booking`.`reciever_city` WHERE tbl_domestic_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date' AND $d_status_fileter ORDER BY booking_date DESC");
             
                
               		if($resAct_d->num_rows()>0)
               		{
               			$temp2= $resAct_d->result();
               			
               			foreach($temp2 as $t2)
               			{
               			    $resAct_d = $this->db->query("select * from tbl_domestic_tracking where tbl_domestic_tracking.pod_no='$t2->pod_no'  order by tracking_date DESC ");
        					if($resAct_d->num_rows()>0){
        						$status=@$resAct_d->row()->status;
        					    $row_d=array('booking_date'=>$t2->booking_date,'pod_no'=>$t2->pod_no,'sender_name'=>$t2->sender_name,'doc_nondoc'=>$t2->doc_nondoc,'city'=>$t2->city,'forwording_no'=>$t2->forwording_no,'forworder_name'=>$t2->forworder_name,'reciever_name'=>$t2->reciever_name,'invoice_no'=>$t2->invoice_no,'invoice_value'=>$t2->invoice_value,'status'=>$status);
        						array_push($data['alldata_d'],$row_d);
        					}
               			}
               		}
               		//echo "<pre>";print_r($data['alldata_d']);
       		}
       		 $data['from_date'] =$from_date;
       		$data['to_date']=$to_date;
       		$data['status']=$this->input->post('status');
       		$data['company_type']=$company_type;
           
       }
        
    // echo "<pre>";print_r($data['alldata_d']);exit;
		$this->load->view('user/report_master/view_mis_report',$data);
	}
	
	
	public function mis_report_excel($from_date,$to_date,$status,$company_type)
	{       
	
		//echo $from_date.$to_date.$status.$company_type;
	        $data['alldata']=array();
            $data['alldata_d']=array();
            $customer_id=$this->session->userdata("customer_id");
	        $status_fileter = '1=1';
			if($status !="ALL")
			{
				$status_fileter = "tbl_international_booking.is_delhivery_complete='$status'";
			}
			$resAct1 = $this->db->query("select * from tbl_international_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_international_booking`.`customer_id` LEFT JOIN `zone_master` ON `zone_master`.`z_id` = `tbl_international_booking`.`reciever_country_id` WHERE tbl_international_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date' AND $status_fileter ORDER BY booking_date DESC");
       	
       	
       		if($resAct1->num_rows()>0)
       		{
       			$temp= $resAct1->result();
       			
       			foreach($temp as $t)
       			{
       			    $resAct2 = $this->db->query("select * from tbl_international_tracking where tbl_international_tracking.pod_no='$t->pod_no'  order by tracking_date DESC ");
					if($resAct2->num_rows()>0){
						$status=@$resAct2->row()->status;
						//$row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'reciever_name'=>$t->reciever_name,'status'=>$status);
					    $row=array('booking_date'=>$t->booking_date,'pod_no'=>$t->pod_no,'sender_name'=>$t->sender_name,'doc_nondoc'=>$t->doc_nondoc,'country_name'=>$t->country_name,'forwording_no'=>$t->forwording_no,'forworder_name'=>$t->forworder_name,'reciever_name'=>$t->reciever_name,'invoice_no'=>$t->invoice_no,'invoice_value'=>$t->invoice_value,'status'=>$status);
						array_push( $data['alldata'],$row);
					}
       			}
       		}
       		//==domestic
       		$d_status_fileter = '1=1';
       		if($status!="ALL"){
				$d_status_fileter = "tbl_domestic_booking.is_delhivery_complete='$status'";
			}
       		$resAct2 = $this->db->query("select * from tbl_domestic_booking LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_domestic_booking`.`customer_id` LEFT JOIN `city` ON `city`.`id` = `tbl_domestic_booking`.`reciever_city` WHERE tbl_domestic_booking.customer_id='$customer_id' and booking_date between '$from_date' and '$to_date'  AND $d_status_fileter ORDER BY booking_date DESC ");
 
       		if($resAct2->num_rows()>0)
       		{
       			$temp2= $resAct2->result();
       			
       			foreach($temp2 as $t2)
       			{
       			    $resAct2 = $this->db->query("select * from tbl_domestic_tracking where tbl_domestic_tracking.pod_no='$t2->pod_no'order by tracking_date DESC ");
					if($resAct2->num_rows()>0){
						$status=@$resAct2->row()->status;
					    $row=array('booking_date'=>$t2->booking_date,'pod_no'=>$t2->pod_no,'sender_name'=>$t2->sender_name,'doc_nondoc'=>$t2->doc_nondoc,'city'=>$t2->city,'forwording_no'=>$t2->forwording_no,'forworder_name'=>$t2->forworder_name,'reciever_name'=>$t2->reciever_name,'invoice_no'=>$t2->invoice_no,'invoice_value'=>$t2->invoice_value,'status'=>$status);
						array_push($data['alldata_d'],$row);
					}
       			}
       		}
       	
       		
       		$filename = "omcs_".$customer_id.".csv";
			$fp = fopen('php://output', 'w');
			$header =array("SrNo.","Date","AWB.","Destination","Receiver","Doc/Non-doc","Invoice No","Invoice Value","Status");
		
				
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			
			fputcsv($fp, $header);
			$i =0;
			foreach($data['alldata'] as $value) {
			
				$i++;
				$booking_date =  date("d-m-Y",strtotime($value['booking_date']));
				$row=array($i,$booking_date,$value['pod_no'],$value['country_name'],$value['reciever_name'],$value['doc_nondoc'],$value['invoice_no'],$value['invoice_value'],$value['status']);
				fputcsv($fp, $row);
			}
				foreach($data['alldata_d'] as $value_d) {
			
				$i++;
				$booking_date =  date("d-m-Y",strtotime($value_d['booking_date']));
				$row=array($i,$booking_date,$value_d['pod_no'],$value_d['city'],$value_d['reciever_name'],$value_d['doc_nondoc'],$value_d['invoice_no'],$value_d['invoice_value'],$value_d['status']);
				fputcsv($fp, $row);
			}
       		
       		
       		
	}
	
	
	public function search_shipment()
	{
		$data= array();
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
		if(isset($_POST['submit']))
        {
			$pod_no = $this->input->post('pod_no');
			$reAct = $this->db->query("select * from tbl_booking where pod_no='$pod_no'");
			$data['pod'] = $reAct->result();
		}
		$this->load->view('search_shipment',$data);
	}
	
	public function list_domestic_shipment($offset=0,$searching='')
	{
		$customer_id=$this->session->userdata("customer_id");
		$data= array();
		
		
		$where 	= ' AND tbl_domestic_booking.customer_id = '.$customer_id;


		$resActt = $this->db->query("SELECT * FROM tbl_domestic_booking  WHERE booking_type = 1 $where ");
		$resAct = $this->db->query("SELECT tbl_domestic_booking.*,city.city,tbl_domestic_weight_details.actual_weight,payment_method  FROM tbl_domestic_booking LEFT JOIN city ON tbl_domestic_booking.reciever_city = city.id  LEFT JOIN tbl_domestic_weight_details ON tbl_domestic_weight_details.booking_id = tbl_domestic_booking.booking_id  WHERE booking_type = 1 $where  order by tbl_domestic_booking.booking_id DESC limit ".$offset.",50");
		
		
		$this->load->library('pagination');
	
		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/view-domestic-shipment/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);
		
		$config['per_page'] 			= 50;
		$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
		$config['full_tag_close'] 		= '</ul></nav>';
		$config['first_link'] 			= '&laquo; First';
		$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['first_tag_close'] 		= '</li>';
		$config['last_link'] 			= 'Last &raquo;';
		$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['last_tag_close'] 		= '</li>';
		$config['next_link'] 			= 'Next';
		$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['next_tag_close'] 		= '</li>';
		$config['prev_link'] 			= 'Previous';
		$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['prev_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
		$config['cur_tag_close'] 		= '</a></li>';
		$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
		$config['reuse_query_string'] 	= TRUE;
		$config['num_tag_close'] 		= '</li>';
		$config['attributes'] = array('class' => 'page-link');
		
		if($offset == '')
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		}
		else
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}
		
		
		$this->pagination->initialize($config);
		if($resAct->num_rows() > 0) 
		{
			$data['allpoddata']= $resAct->result_array();
		}
		else
		{
			$data['allpoddata']= array();
		}
			
		$this->load->view('user/domestic_shipment/view_domestic_shipment',$data);
		
	}
	
	public function list_international_shipment($offset=0,$searching='')
	{
		$customer_id=$this->session->userdata("customer_id");
		$data= array();
		$where 	= ' AND tbl_international_booking.customer_id = '.$customer_id;

		$resActt = $this->db->query("SELECT * FROM tbl_international_booking  WHERE booking_type = 1 $where  ");
		$resAct = $this->db->query("SELECT tbl_international_booking.*,zone_master.country_name,tbl_international_weight_details.chargable_weight  FROM tbl_international_booking LEFT JOIN zone_master ON tbl_international_booking.reciever_country_id = zone_master.z_id LEFT JOIN tbl_international_weight_details ON tbl_international_weight_details.booking_id = tbl_international_booking.booking_id   WHERE booking_type = 1 $where  order by tbl_international_booking.booking_id DESC limit ".$offset.",50");
		
		
		$this->load->library('pagination');

		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'admin/view-international-shipment/';
	//	$config['suffix'] 				= '/'.urlencode($filterCond);
		
		$config['per_page'] 			= 50;
		$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
		$config['full_tag_close'] 		= '</ul></nav>';
		$config['first_link'] 			= '&laquo; First';
		$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['first_tag_close'] 		= '</li>';
		$config['last_link'] 			= 'Last &raquo;';
		$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['last_tag_close'] 		= '</li>';
		$config['next_link'] 			= 'Next';
		$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['next_tag_close'] 		= '</li>';
		$config['prev_link'] 			= 'Previous';
		$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['prev_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
		$config['cur_tag_close'] 		= '</a></li>';
		$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
		$config['reuse_query_string'] 	= TRUE;
		$config['num_tag_close'] 		= '</li>';
		$config['attributes'] = array('class' => 'page-link');
		
		if($offset == '')
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		}
		else
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}
		
		$this->pagination->initialize($config);
		if($resAct->num_rows() > 0) 
		{
			$data['allpoddata']= $resAct->result_array();
		}
		else
		{
			$data['allpoddata']= array();
		}
		$this->load->view('user/international_shipment/view_international_shipment',$data);
        
		
	}
	public function pickup_request()
	{
		$data= array();
		$data['message']="";
		if (isset($_POST['submit'])) 
		{
			$customer_id	=	$this->session->userdata("customer_id");
			$date=date('y-m-d');
			$r= array('id'=>'',
					  'customer_id'=>$customer_id,
					  'consigner_name'=>$this->input->post('consigner_name'),
					  'consigner_address'=>$this->input->post('consigner_address'),
					  'consigner_city' => $this->input->post('consigner_city'),
					  'consigner_gstno' => $this->input->post('consigner_gstno'),
					  'consigner_pincode' => $this->input->post('consigner_pincode'),
					  'consigner_contact' => $this->input->post('consigner_contact'),
					  'consigner_email' => $this->input->post('consigner_email'),
					  'consignee_name' => $this->input->post('consignee_name'),
					  'consignee_address' => $this->input->post('consignee_address'),
					  'consignee_city' => $this->input->post('consignee_city'),
					  'consignee_gstno' => $this->input->post('consignee_gstno'),
					  'consignee_pincode' => $this->input->post('consignee_pincode'),
					   'consignee_contact' => $this->input->post('consignee_contact'),
					  'consignee_email' => $this->input->post('consignee_email'),
					  'weight' => $this->input->post('weight'),
					  'qty' => $this->input->post('qty'),
					  'pickup_date'=>$date,
					  //'isdeleted' =>'0',
				 );
			$result=$this->basic_operation_m->insert('tbl_pickup_request',$r);
		
			if ($this->db->affected_rows()>0) {
				$data['message']="Pickup Request Added Sucessfully";
			}else{
				$data['message']="Error in Query";
			}
			redirect('User_panel/view_pickup_request');
		}
	
		$this->load->view('user/pickup_request',$data);
	
	}

	public function view_pickup_request()
	{
		$data= array();
		$data['message']="";
		$customer_id					=	$this->session->userdata("customer_id");
        $data['all_request']			= $this->basic_operation_m->get_table_result('tbl_pickup_request',array('customer_id'=>$customer_id));
		$this->load->view('user/view_pickup_request',$data);
	
	}
	
	public function company_profile()
	{
		$data= array();
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
		 if (isset($_POST['submit'])) {
			$user_id= $this->session->userdata("customer_id");
			$r= array('id'=>'',
					  'user_id'=>$user_id,
				      'name'=>$this->input->post('name'),
		              'address' => $this->input->post('address'),
					  'gst_no' => $this->input->post('gst_no'),
					  'contact_person' => $this->input->post('contact_person'),
					  'contact_no' => $this->input->post('contact_no'),
                      //'isdeleted' =>'0',
                 );
			$result=$this->basic_operation_m->insert('tbl_company_profile',$r);
			 
			if ($this->db->affected_rows()>0) {
				$data['message']="Company Profile Added Sucessfully";
			}else{
                $data['message']="Error in Query";
			}
             redirect(base_url().'home');
		 }
		$this->load->view('company_profile',$data);
	}
	 public function track_shipment_fromlist()
	{
	    $last = $this->uri->total_segments();
	    $id= $this->uri->segment($last);
	   
		$data= array();
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
         
         
	        
		if ($id!="")
           {
			$pod_no=$id;
			$reAct=$this->db->query("select * from tbl_booking where pod_no='$pod_no'");
			
			$data['info']=$reAct->row();
			
			$reAct=$this->db->query("select * from tbl_tracking where pod_no='$pod_no'");
			
			$data['pod']=$reAct->result();
			
			$reAct=$this->db->query("select * from tbl_upload_pod where pod_no='$pod_no'");
			
			$data['podimg']=$reAct->row();
			//echo $this->db->last_query($data);
		   }
		
		$this->load->view('track_shipment_new',$data);
	}
	public function track_shipment()
	{
		$data= array();
		$resAct	= $this->basic_operation_m->getAll('tbl_testimonial','');

		if($resAct->num_rows()>0)
		 {
			$data['testimonial']=$resAct->result_array();	            
		 }else{
			 $data['testimonial']=array();
		 }
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
		 $data['delivery_pod']		= array();
		if (isset($_GET['submit']))
        {
			$pod_no=$this->input->get('pod_no');
			$check_pod_international=$this->db->query("select pod_no from tbl_international_booking where pod_no like '%$pod_no%'");
			$check_result=$check_pod_international->row();
		
			if(isset($check_result)){
			   
			    	$reAct=$this->db->query("select tbl_international_booking.*,tbl_international_weight_details.no_of_pack, sendercity.city AS sender_city_name, recievercity.country_name as reciever_country_name from tbl_international_booking left join tbl_international_weight_details on tbl_international_booking.booking_id=tbl_international_weight_details.booking_id INNER JOIN city sendercity ON sendercity.id = tbl_international_booking.sender_city INNER JOIN zone_master recievercity ON recievercity.z_id = tbl_international_booking.reciever_country_id where pod_no like '%$pod_no%'");
        			$data['info']=$reAct->row();
        			
        			$courier_company_id = $data['info']->courier_company_id;
        			
        			$tracking_href_details=$this->db->query("select * from courier_company where c_id=".$courier_company_id);
        			$data['forwording_track']	=	$tracking_href_details->row();
        		
        			
        			$reAct=$this->db->query("select * from tbl_international_tracking where pod_no = '$pod_no' ORDER BY id asc");
        			$data['pod']	=	$reAct->result();  
        			$data['del_status']	=	$reAct->row();
        			
        			
        		
			}else{
			  
			    	$reAct=$this->db->query("select tbl_domestic_booking.*,tbl_domestic_weight_details.no_of_pack, sendercity.city AS sender_city_name, recievercity.city as reciever_country_name from tbl_domestic_booking left join tbl_domestic_weight_details on tbl_domestic_booking.booking_id=tbl_domestic_weight_details.booking_id INNER JOIN city sendercity ON sendercity.id = tbl_domestic_booking.sender_city INNER JOIN city recievercity ON recievercity.id = tbl_domestic_booking.reciever_city where pod_no like '%$pod_no%'");
        			$data['info']=$reAct->row();
        			
        			$courier_company_id = $data['info']->courier_company_id;
        			$tracking_href_details=$this->db->query("select * from courier_company where c_id=".$courier_company_id);
        			$data['forwording_track']	=	$tracking_href_details->row();
        			
        			$reAct=$this->db->query("select * from tbl_domestic_tracking,tbl_branch,tbl_city where tbl_branch.`branch_name`=tbl_domestic_tracking.branch_name AND tbl_city.city_id=tbl_branch.city AND pod_no like '%$pod_no%' ORDER BY id DESC;");
        			$data['pod']	=	$reAct->result();
        			$data['del_status']	=	$reAct->row();
			}
	
			if(!empty($data['pod']))
			{
				foreach($data['pod'] as $k => $values)
				{
					if($values->status == 'DELIVERED' || $values->status == 'Delivered')
					{
						$data['delivery_date'] = $values->tracking_date;
					}
				}
			}
			
			//$lrNum 					= $data['pod'][0]->forwording_no;
			//$podData 				= $this->deliverypod($lrNum);
			//$data['delivery_pod'] 	= json_decode($podData, true);
			
			$reAct=$this->db->query("select * from tbl_upload_pod where pod_no='$pod_no'");
			$data['podimg']=$reAct->row();
			//echo $this->db->last_query($data);
		   }
		 
	$this->load->view('track_shipment',$data);
	}
	
	public function deliverypod($lrNum){
		
		$curl = curl_init();
		
		$apiUrl = base_url()."admin/generatepod/get_delebrypod/".$lrNum;

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiUrl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"Cookie: ci_session=hjmb3p0tgrvn9plsr3a6ji3qpdkpd15d"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}
	
	public function pod()
	{
		$data= array();
		$resAct1 = $this->db->query("select * from tbl_news limit 9 ");

		if($resAct1->num_rows()>0)
		 {
		 	$data['homenews']=$resAct1->result_array();	            
         }else{
         	 $data['homenews']=array();
         }
          $resAct	= $this->basic_operation_m->getAll('tbl_testimonial','');

		if($resAct->num_rows()>0)
		 {
			$data['testimonial']=$resAct->result_array();	            
		 }else{
			 $data['testimonial']=array();
		 }
		if (isset($_POST['submit']))
           {
			$pod_no=$this->input->post('pod_no');
		
			$reAct=$this->db->query("select * from tbl_international_booking where pod_no='$pod_no'");
			
			$data['info']=$reAct->row();
			
			if(!empty($data['info']))
			{
			
				$reAct=$this->db->query("select * from tbl_upload_pod where pod_no='$pod_no'");
			
				$data['pod']=$reAct->result_array();
			}
			else
			{
				
				$reAct=$this->db->query("select * from tbl_domestic_booking where pod_no='$pod_no'");
			
				$data['info']=$reAct->row();
				
				$reAct=$this->db->query("select * from tbl_upload_pod where pod_no='$pod_no'");
			
				$data['pod']=$reAct->result_array();
			}
		
			
		   }
		 //print_r($data['pod']);exit;
		$this->load->view('user/pod',$data);
	}
	public function updatepassword()
    {
    	$data['message']="";
     
           if (isset($_POST['submit']))
           {
           $id=$this->session->userdata("customer_id");
           	$whr=array('customer_id'=>$id);
            $r= array('password'=> $this->input->post('new_pass'),);
			
           	$result=$this->basic_operation_m->update('tbl_customers',$r,$whr);
           /*	echo $this->db->last_query();exit;  ----------code is to check the code is working or not and show the input content*/
           	if($this->db->affected_rows() > 0)
           	 {
           		$data['message']="Password Change Successfully";
           	 }
           	 else
             {
           		$data['message']="Error is Query";
             }
           	 redirect(base_url().'login');
           }
              $this->load->view('company_profile',$data);

    }
	
	
	public function domestic_printpod($id) 
	{
	    // Load library
	    $this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") {	
			$data['booking'] = $this->basic_operation_m->get_all_result('tbl_domestic_booking', $whr);
			$where =array('id'=>1);
		    $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);
			// echo '<pre>'; print_r($data['booking']); die;
			$this->load->view('admin/domestic_shipment/print_shipment', $data);
		}
	}
	
	public function international_printpod($id) 
	{
	    // Load library
	    $this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") {			
			$data['booking'] = $this->basic_operation_m->get_all_result('tbl_international_booking', $whr);
			$where =array('id'=>1);
		    $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);
			$this->load->view('admin/international_shipment/print_shipment', $data);
		}
	}
	
	// this funciton is use for complain managment 
	public function complain_view()
	{
		$data = array();
		$data['all_ticket']				= $this->basic_operation_m->get_all_ticket();	
		$this->load->view('user/complain/view_complain', $data);
		
	}
	
	
	// this function is use for getting all tickets 
	public function open_ticket()
	{
		
		$user_id 							= $this->session->userdata('customer_id');
		
		$data['user_id']					= $this->session->userdata('customer_id');
		$data['admin_info']					= $this->basic_operation_m->get_admin_info_by_id(1);	
		$data['domstic_pod']				= $this->basic_operation_m->get_domestic_pod($user_id);	
		
		$data['international_pod']			= $this->basic_operation_m->get_international_pod($user_id);	
		$data['total_open_ticket']			= $this->basic_operation_m->get_all_ticket_by_status(1);
		$data['total_replied_ticket']		= $this->basic_operation_m->get_all_ticket_by_status(3);
		$data['total_creplied_ticket']		= $this->basic_operation_m->get_all_ticket_by_status(2);
		$data['total_closed_ticket']		= $this->basic_operation_m->get_all_ticket_by_status(5);
		$data['all_ticket']					= $this->basic_operation_m->get_all_ticket();
	
		$this->load->view('user/complain/open_ticket',$data);
		
	}
	
	// this function is use for getting all tickets 
	public function insert_ticket()
	{
		$data								= array();
		$user_id							= $this->session->userdata('customer_id');
		
		$data['user_info']					= $this->basic_operation_m->get_admin_info_by_id($user_id);
		$data['admin_info']					= $this->basic_operation_m->get_admin_info_by_id(1);
		
		$all_data 							= $this->input->post();
		$file								= '';
		if($all_data['subject'] != '' && $all_data['message'] != ''  && $all_data['pod_no'] != '' && $all_data['priorty'] != '')
		{
			if(isset($_FILES['file']['name']))
			{
				$config 					= array(
									'encrypt_name' => TRUE,
									'allowed_types' => '*',
									'upload_path'   => 'assets/upload');
				 $this->load->library('upload'); 
                $this->upload->initialize($config);
				if(!$this->upload->do_upload('file'))
				{
					$error = $this->upload->display_errors();
				
				}
				else 
				{
					$upload_info	 		= $this->upload->data();
					$file					= $upload_info['file_name'];
				}
			}
		
			

			$all_data['user_id']				= $user_id;
			$message							= $all_data['message'];
			unset($all_data['email']);
			unset($all_data['message']);	
			
			
			$ticket_id							= $this->basic_operation_m->insert('ticket',$all_data);	
			$all_dataa							= array('ticket_id'=>$ticket_id,'user_type'=>$user_id,'to_email'=>$data['admin_info']->email,'message'=>$message,'attechment'=>$file);
			//$otp_status 						= $this->send_aws_mail($data['admin_info']->email,'[Ticket '.$data['page_info']->name.' #'.$ticket_id.'] '.$all_data['subject'],$admin_message,$file);
			//$otp_status 						= $this->send_aws_mail($data['user_info']->email,'[Ticket '.$data['page_info']->name.' #'.$ticket_id.'] '.$all_data['subject'],$user_message,$file);
			
			$ticket_id							= $this->basic_operation_m->insert('ticket_msg',$all_dataa);	
			
		}
		redirect('User_panel/complain_view');
	}
	
	// this function is use for getting all tickets 
	public function insert_replay($ticket_id)
	{
		$data								= array();
		
		$user_id							= $this->session->userdata('customer_id');
		
		$ticket_info						= $this->basic_operation_m->get_ticket_info($ticket_id);
	
		$data['user_info']					= $this->basic_operation_m->get_user_info_by_id($ticket_info->user_id);
		
		$data['admin_info']					= $this->basic_operation_m->get_admin_info_by_id(1);
		
		$all_data 							= $this->input->post();
		$file								= '';
		if($all_data['message'] != '' && !empty($ticket_info))
		{
			$url = base_url().'assets/upload/';

			if(isset($_FILES['file']['name']))
			{
				$config 					= array(
									'encrypt_name' => TRUE,
									'allowed_types' => '*',
									'overwrite'     => FALSE,
									'upload_path'   => 'assets/upload');
				 $this->load->library('upload'); 
                $this->upload->initialize($config);
				if(!$this->upload->do_upload('file'))
				{
					$error = $this->upload->display_errors();
				
				}
				else 
				{
					$upload_info	 		= $this->upload->data();
					$file					= $upload_info['file_name'];
				}
			}
		
			
			$message				= $all_data['message'];
			if($user_id == 1)
			{
				//$otp_status 			= $this->send_aws_mail($data['user_info']->email,'[Ticket '.$data['page_info']->name.' #'.$ticket_id.'] '.$ticket_info->subject,$user_message,$file);
				$all_dataa				= array('ticket_id'=>$ticket_id,'user_type'=>$user_id,'to_email'=>$data['user_info']->email,'message'=>$message,'attechment'=>$file);
				$query_status			= $this->basic_operation_m->update("ticket",array("ticket_status"=> 3),array("ticket_id" => $ticket_id));
			}
			else
			{
				//$otp_status 			= $this->send_aws_mail($data['admin_info']->email,'[Ticket '.$data['page_info']->name.' #'.$ticket_id.'] '.$ticket_info->subject,$admin_message,$file);
				$all_dataa				= array('ticket_id'=>$ticket_id,'user_type'=>$user_id,'to_email'=>$data['user_info']->email,'message'=>$message,'attechment'=>$file);
				$query_status			= $this->basic_operation_m->update("ticket",array("ticket_status"=> 2),array("ticket_id" => $ticket_id));
			}
			$query_status				= $this->basic_operation_m->insert('ticket_msg',$all_dataa);
		}
		redirect('User_panel/ticket_detail/'.$ticket_id);
	}
	
	// this function is use for closing ticket
	public function ticket_close($ticket_id)
	{
		$data								= $this->data;
		$user_id							= $this->session->userdata('customer_id');
		
		$ticket_info						= $this->basic_operation_m->get_ticket_info($ticket_id);
		$data['user_info']					= $this->basic_operation_m->get_admin_info_by_id($ticket_info->user_id);
		if(!empty($ticket_info))
		{	
			
			//$otp_status 			= $this->send_aws_mail($data['user_info']->email,'[Ticket '.$data['page_info']->name.' #'.$ticket_id.'] '.$ticket_info->subject,$user_message,'');
			$query_status			= $this->basic_operation_m->update("ticket",array("ticket_status"=> 5),array("ticket_id" => $ticket_id));
		}
		redirect('User_panel/complain_view');
	}
	
	// this function is use for getting all tickets 
	public function ticket_detail($ticket_id)
	{
		
		$data								= array();
		$user_id 							= $this->session->userdata('customer_id');
		$uesr_info 							= $this->basic_operation_m->get_user_info_by_id($user_id);
	
		$data['user_id']					= $user_id;
		$data['ticket_info']				= $this->basic_operation_m->get_ticket_info($ticket_id);	
		$data['ticket_user_info']			= $this->basic_operation_m->get_user_info_by_id($data['ticket_info']->user_id);
		$data['ticket_chat']				= $this->basic_operation_m->get_ticket_chat($ticket_id);	
		$this->load->view('user/complain/ticket_detail',$data);
		
	}
	
	// this function is use for getting all tickets 
	public function delete_ticket($ticket_id)
	{
		$query_status			= $this->basic_operation_m->run_query("update ticket set ticket_status = 5 where ticket_id = $ticket_id");
		/* $user_id						= $this->session->userdata('user_id');
		$update_payed					= "delete from ticket where ticket_id = '$ticket_id'";
		$query_status					=  $this->basic_operation_m->run_query($update_payed);
		
		$update_payed					= "delete from ticket_msg where ticket_id = '$ticket_id'";
		$query_status					=  $this->basic_operation_m->run_query($update_payed);
		redirect('ticket'); */
		redirect('ticket');
		
	}
	
	
	// add shipment 
	  public function add_new_rate_domestic()
    {
        $sub_total 	 = 0;		
		$customer_id = $this->input->post('customer_id');
		$c_courier_id= $this->input->post('c_courier_id');
		$mode_id  = $this->input->post('mode_id');
		$reciver_city	= $this->input->post('city');
		$reciver_state 	= $this->input->post('state');		
		$sender_state 	= $this->input->post('sender_state');		
		$sender_city 	= $this->input->post('sender_city');		
		
		$whr1 			= array('state' => $sender_state,'city' => $sender_city);
		$res1			= $this->basic_operation_m->selectRecord('region_master_details', $whr1);	
		
		$sender_zone_id 		= $res1->row()->regionid;
		$reciver_zone_id  		= $this->input->post('receiver_zone_id');
		
		$doc_type 		= $this->input->post('doc_type'); 
		$chargable_weight  = $this->input->post('chargable_weight');
		$receiver_gstno =$this->input->post('receiver_gstno');
		$booking_date       = $this->input->post('booking_date');
		$invoice_value       = $this->input->post('invoice_value');
		$dispatch_details       = $this->input->post('dispatch_details');
		$current_date = date("Y-m-d",strtotime($booking_date));
		$chargable_weight	= $chargable_weight * 1000;
		$fixed_perkg		= 0;
		$addtional_250		= 0;
		$addtional_500		= 0;
		$addtional_1000		= 0;
		$fixed_per_kg_1000		= 0;
			
		// calculationg fixed per kg price 	
		$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND from_zone_id='".$sender_zone_id."' AND to_zone_id='".$reciver_zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$this->input->post('chargable_weight')." BETWEEN weight_range_from AND weight_range_to) and fixed_perkg = '0' ORDER BY applicable_from DESC LIMIT 1");
		$frieht=0;
		if ($fixed_perkg_result->num_rows() > 0) 
		{
			$data['rate_master'] = $fixed_perkg_result->row();
			$rate	= $data['rate_master']->rate;
			$fixed_perkg = $rate;
		}
		else
		{
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND  from_zone_id='".$sender_zone_id."' AND to_zone_id='".$reciver_zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg = '0' ORDER BY applicable_from DESC,weight_range_to desc LIMIT 1");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
				$data['rate_master']    = $fixed_perkg_result->row();
				$rate               	= $data['rate_master']->rate;
				$weight_range_to	    = round($data['rate_master']->weight_range_to * 1000);
				$fixed_perkg            = $rate;
			}
			
			$fixed_perkg_result = $this->db->query("select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND  from_zone_id='".$sender_zone_id."' AND to_zone_id='".$reciver_zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND fixed_perkg <> '0' ");
			if ($fixed_perkg_result->num_rows() > 0) 
			{
			    if($weight_range_to > 1000)
			    {
			        $weight_range_to = $weight_range_to;
			    }
			    else
			    {
			        $weight_range_to = 1000;
			    }
				$left_weight  = ($chargable_weight - $weight_range_to);
			
				$rate_master  = $fixed_perkg_result->result();
				
				foreach($rate_master as $key => $values)
				{
					
					if($values->fixed_perkg == 1) // 250 gm slab
					{
						
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
						$total_slab = $slab_weight/250;
						$addtional_250 = $addtional_250 + $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
					
					if($values->fixed_perkg == 2)// 500 gm slab
					{
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;
					
						if($slab_weight < 1000)
						{
						    if($slab_weight <= 500)
						    {
						        $slab_weight = 500;
						    }
						    else
						    {
						        $slab_weight = 1000;
						    }
						    
						}
						else
						{
						    $diff_ceil = $slab_weight%1000;
						    $slab_weight = $slab_weight - $diff_ceil;
						
						    if($diff_ceil <= 500 && $diff_ceil != 0)
						    {
						       
						        $slab_weight = $slab_weight + 500;
						    }
						    elseif($diff_ceil <= 1000 && $diff_ceil != 0)
						    {
						       
						        $slab_weight = $slab_weight + 1000;
						    }
						    
						  
						}
				
						$total_slab = $slab_weight/500;
						$addtional_500 = $addtional_500 +$total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					
					}
					
					if($values->fixed_perkg == 3) // 1000 gm slab
					{
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$total_slab = ceil($slab_weight/1000);
						
						$addtional_1000 = $addtional_1000+ $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
					
					if($values->fixed_perkg == 4 && ($this->input->post('chargable_weight') >=  $values->weight_range_from && $this->input->post('chargable_weight') <=  $values->weight_range_to)) // 1000 gm slab
					{
						//$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$slab_weight = ($values->weight_slab < $left_weight)?$values->weight_slab:$left_weight;	
						$total_slab = ceil($chargable_weight/1000);
						$fixed_perkg = 0;
						$addtional_250 = 0;
						$addtional_500 = 0;
						$addtional_1000 = 0;
						$rateeee= $values->rate;
						$fixed_per_kg_1000 = $total_slab * $values->rate;
						$left_weight = $left_weight - $slab_weight;
					}
				}
				
			}
		}
		
		
		$frieht = $fixed_perkg + $addtional_250 + $addtional_500 + $addtional_1000 + $fixed_per_kg_1000;
		$amount = $frieht;
		

	//	$whr1 = array('courier_id' => $c_courier_id);
		$whr1 = array('courier_id' => $c_courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => $customer_id);
		$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
		
		if(empty($res1))
		{
			$whr1 = array('courier_id' => $c_courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date,'customer_id =' => '0');
			$res1 = $this->basic_operation_m->get_query_row("select * from courier_fuel where (courier_id = '$c_courier_id' or courier_id='0') and fuel_from <= '$current_date' and fuel_to >='$current_date' and (customer_id = '0' or customer_id = '$customer_id')");
		}
		
		if($res1)
		{
			$fuel_per = $res1->fuel_price;
			$fov = '0';
			$docket_charge =$res1->docket_charge;
			
			if($dispatch_details != 'Cash')
			{
				$res1->cod	= 0;
			}
			
			if($dispatch_details != 'ToPay')
			{
				$res1->to_pay_charges	= 0;
			}
			
			if($invoice_value >= $res1->fov_base )
			{
				$fov = (($invoice_value/100)* $res1->fov_above);
			}
			elseif($invoice_value < $res1->fov_base)
			{
				$fov = (($invoice_value/100)*$res1->fov_below);
			}
			
			if($dispatch_details == 'COD')
			{
			
				$cod_detail_Range  	= $this->basic_operation_m->get_query_row("select * from courier_fuel_detail  where cf_id = '$res1->cf_id' and ('$invoice_value' BETWEEN cod_range_from and cod_range_to)");
				if(!empty($cod_detail_Range))
				{
					$res1->cod 				=($invoice_value * $cod_detail_Range->cod_range_rate/100);
				}
				
			}
			else
			{
				$res1->cod				= 0;
			}
		
			if($dispatch_details == 'ToPay')
			{
				
				$to_pay_charges_Range  	= $this->basic_operation_m->get_query_row("select * from courier_fuel_detail  where cf_id = '$res1->cf_id' and ('$invoice_value' BETWEEN topay_range_from and topay_range_to)");
				if(!empty($to_pay_charges_Range))
				{
					$res1->to_pay_charges 				=($invoice_value * $to_pay_charges_Range->topay_range_rate/100);
				}
				
			}
			else
			{
				$res1->to_pay_charges				= 0;
			}
			
			if($res1->fc_type == 'freight')
			{
				$final_fuel_charges =($amount * $fuel_per/100);
				$amount	= $amount + $fov + $docket_charge + $res1->cod + $res1->to_pay_charges;
			}
			else
			{
				$amount	= $amount + $fov + $docket_charge + $res1->cod + $res1->to_pay_charges;
				$final_fuel_charges =($amount * $fuel_per/100);
			}
			$cft 			= $res1->cft;
			$cod			= $res1->cod;
			$to_pay_charges = $res1->to_pay_charges;
			
		}
		else
		{
			$cft = '5000';
			$cod = '0';
			$fov = '0';
			$to_pay_charges ='0';
			$fuel_per ='0';
			$docket_charge ='0';
			$amount	= $amount + $fov + $docket_charge + $cod + $to_pay_charges;
			$final_fuel_charges =($amount * $fuel_per/100);
		}
		
		//Cash
		
    
		$sub_total =($amount + $final_fuel_charges);

		$first_two_char = substr($receiver_gstno,0,2);
		
		if($receiver_gstno=="")
		{
		    $first_two_char=27;
		}
		
			$tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
			if($tbl_customers_info->gst_charges == 1)
			{
				if($first_two_char==27)
				{
					$cgst = ($sub_total*9/100);
					$sgst = ($sub_total*9/100);
					$igst = 0;
					$grand_total = $sub_total + $cgst + $sgst + $igst;
				}else{
					$cgst = 0;
					$sgst = 0;
					$igst = ($sub_total*18/100);
					$grand_total = $sub_total + $igst;
				}		
			}
			else
			{
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}
			
			if($dispatch_details == 'Cash')
			{	
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}
			
			
		$query ="select * from tbl_domestic_rate_master where customer_id='".$customer_id."' AND from_zone_id='".$sender_zone_id."' AND to_zone_id='".$reciver_zone_id."' AND c_courier_id='".$c_courier_id."' AND mode_id='".$mode_id."' AND DATE(`applicable_from`)<='".$current_date."' AND (".$chargable_weight." BETWEEN weight_range_from AND weight_range_to)  ORDER BY applicable_from DESC LIMIT 1";

		$data = array(
			'query'=>$query,
			'sender_zone_id'=>$sender_zone_id,			
			'reciver_zone_id'=>$reciver_zone_id,			
			'chargable_weight'=>ceil($chargable_weight),			 	
			'frieht' => $frieht,
			'fov'=>$fov,
			'docket_charge'=>$docket_charge,
			'amount' => $amount,
			'cod' => $cod,
			'cft' => $cft,
			'to_pay_charges' => $to_pay_charges,
			'final_fuel_charges'=>$final_fuel_charges,
			'sub_total'=>number_format($sub_total, 2, '.', ''),
			'cgst'=>number_format($cgst, 2, '.', ''),
			'sgst'=>number_format($sgst, 2, '.', ''),
			'igst'=>number_format($igst, 2, '.', ''),
			'grand_total'=>number_format($grand_total, 2, '.', ''),
		);
		echo json_encode($data);
		exit;
		}
    
    public function add_domestic_shipment() 
	{
		$data			= array();
        $result 		= $this->db->query('select max(booking_id) AS id from tbl_domestic_booking')->row();
        $id 			= $result->id + 1;
        
		if (strlen($id) == 2) 
		{
            $id = 'SD1000'.$id;
        }
		elseif (strlen($id) == 3) 
		{
            $id = 'SD100'.$id;
        }
		elseif (strlen($id) == 1) 
		{
            $id = 'SD10000'.$id;
        }
		elseif (strlen($id) == 4) 
		{
            $id = 'SD10'.$id;
        }
		elseif (strlen($id) == 5) 
		{
            $id = 'SD1'.$id;
        }
        
     
		
        $data['transfer_mode']		 	= $this->basic_operation_m->get_query_result('select * from `transfer_mode`');
       
        $customer_id 	= $this->session->userdata("customer_id");
		$data['cities']	= $this->basic_operation_m->get_all_result('city', '');
      	$data['states'] =$this->basic_operation_m->get_all_result('state', '');
       
		$data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', "customer_id = '$customer_id'");
	
        $data['payment_method']  = $this->basic_operation_m->get_all_result('payment_method', '');
        $data['region_master'] = $this->basic_operation_m->get_all_result('region_master', '');
		$data['bid'] = $id;
		$whr_d= array("company_type"=>"Domestic");
		$data['courier_company'] = $this->basic_operation_m->get_all_result("courier_company",$whr_d);	
		
		$this->load->view('user/domestic_shipment/view_add_domestic_shipment', $data);
	}


	public function insert_domestic_shipment()
	{
		$all_Data 	= $this->input->post();	
		
		
		if(!empty($all_Data)) 
		{
			
			$customer_account_id		 = $this->input->post('customer_account_id');
			$block_status				 = $this->basic_operation_m->get_query_row("select * from access_control where customer_id = '$customer_account_id' and block_status = 'Booking' and current_status ='0'"); 
			if(!empty($block_status))
			{
				$msg	='Booking is Blocked for this customer';
				$class	= 'alert alert-danger alert-dismissible';	
				$this->session->set_flashdata('notify',$msg);
				$this->session->set_flashdata('class',$class);
				redirect('User_panel/add_domestic_shipment');
			}
			foreach ($all_Data as $key => $value) {
				if (is_array($value)) {
					# code...
				}else{
					$_POST[$key] = strtoupper($value);
				}
				
			}
			// echo "<hr>";
			// print_r($this->input->post());exit();
			$username = $this->session->userdata("userName");
			$user_id = $this->session->userdata("customer_id");
			$user_type = $this->session->userdata("userType");
		
		    
			$whr = array('customer_id' => $user_id);
			$res = $this->basic_operation_m->getAll('tbl_customers', $whr);
			$branch_id = $res->row()->branch_id;
			
			$customer_info =$this->basic_operation_m->get_table_row('tbl_customers',array('customer_id'=>$this->input->post('customer_account_id')));
			$company_info =$this->basic_operation_m->get_table_row('tbl_company',array('id'=>$customer_info->company_id));
			$branch_info =$this->basic_operation_m->get_table_row('tbl_branch',array('branch_id'=>$branch_id));

			$date = date('Y-m-d',strtotime($this->input->post('booking_date')));
			$this->session->unset_userdata("booking_date");
			$this->session->set_userdata("booking_date",$this->input->post('booking_date'));

			$reciever_pincode= $this->input->post('reciever_pincode');
			$reciever_city= $this->input->post('reciever_city');
			$reciever_state= $this->input->post('reciever_state');

			$whr_pincode = array('pin_code'=>$reciever_pincode,'city_id'=>$reciever_city,'state_id'=>$reciever_state); 
			$check_city =$this->basic_operation_m->get_table_row('pincode',$whr_pincode);
			//echo "++++".$this->db->last_query();
			if(empty($check_city))
			{	$whr_C =array('id'=>$reciever_city);
				$city_details = $this->basic_operation_m->get_table_row('city',$whr_C);
				$whr_S =array('id'=>$reciever_state);
				$state_details = $this->basic_operation_m->get_table_row('state',$whr_S);

				$pincode_data = array(
					'pin_code'=>$reciever_pincode,
					'city'=>$city_details->city,
					'city_id'=>$reciever_city,
					'state'=>$state_details->state,
					'state_id'=>$reciever_state);
				
				$whr_p = array('pin_code'=>$reciever_pincode);
				$qry = $this->basic_operation_m->update('pincode', $pincode_data, $whr_p);				
			}

			if($all_Data['doc_type'] == 0)
			{
				$doc_nondoc			= 'Document';
			}
			else
			{
				$doc_nondoc			= 'Non Document';
			}	
			$result 		= $this->db->query('select max(booking_id) AS id from tbl_domestic_booking')->row();
	        $id 			= $result->id + 1;
	     
			$bracnh_prefix 		=   substr($branch_info->branch_code, -2);
			
			if (strlen($id) == 2) 
			{
	            $id = $company_info->company_code.$bracnh_prefix.'1000'.$id;
	        }
			elseif (strlen($id) == 3) 
			{
	            $id = $company_info->company_code.$bracnh_prefix.'100'.$id;
	        }
			elseif (strlen($id) == 1) 
			{
	            $id = $company_info->company_code.$bracnh_prefix.'10000'.$id;
	        }
			elseif (strlen($id) == 4) 
			{
	            $id = $company_info->company_code.$bracnh_prefix.'10'.$id;
	        }
			elseif (strlen($id) == 5) 
			{
	            $id = $company_info->company_code.$bracnh_prefix.'1'.$id;
	        }	
			
	        $pod_no =trim($this->input->post('awn'));
	        if($pod_no!="")
	        {
	        	$awb_no = $pod_no;
	        }
			else
			{
	        	$awb_no =$id;
	        }
			
			//booking details//
			$data = array(
				'doc_type'=>$this->input->post('doc_type'),
				'doc_nondoc'=>$doc_nondoc,
				'courier_company_id'=>$this->input->post('courier_company'),
				'company_type'=>'Domestic',
				'mode_dispatch' => $this->input->post('mode_dispatch'),
				'pod_no' => $awb_no,
				'forwording_no' => $this->input->post('forwording_no'),
				'forworder_name' => $this->input->post('forworder_name'),
				'customer_id' => $this->input->post('customer_account_id'),
				'sender_name' => $this->input->post('sender_name'),
				'sender_address' => $this->input->post('sender_address'),
				'sender_city' => $this->input->post('sender_city'),
				'sender_state'=> $this->input->post('sender_state'),
				'sender_pincode' => $this->input->post('sender_pincode'),
				'sender_contactno' => $this->input->post('sender_contactno'),
				'sender_gstno' => $this->input->post('sender_gstno'),
				'reciever_name' => $this->input->post('reciever_name'),
				'contactperson_name' => $this->input->post('contactperson_name'),				
				'reciever_address' => $this->input->post('reciever_address'),
				'reciever_contact' => $this->input->post('reciever_contact'),
				'reciever_pincode' => $this->input->post('reciever_pincode'),
				'reciever_city' => $this->input->post('reciever_city'),
				'reciever_state' => $this->input->post('reciever_state'),
				'receiver_zone' => $this->input->post('receiver_zone'),
				'receiver_zone_id' => $this->input->post('receiver_zone_id'),
				'receiver_gstno'=>$this->input->post('receiver_gstno'),
				'ref_no'=>$this->input->post('ref_no'),
				'invoice_no'=>$this->input->post('invoice_no'),
				'invoice_value' => $this->input->post('invoice_value'),
				'eway_no' => $this->input->post('eway_no'),
				'eway_expiry_date' => $this->input->post('eway_expiry_date'),
				'special_instruction' => $this->input->post('special_instruction'),
				//'type_of_pack' => $this->input->post('type_of_pack'),
				'booking_date' =>$date,				
				'booking_time' =>date('H:i:s',strtotime($this->input->post('booking_date'))),				
				'dispatch_details' => $this->input->post('dispatch_details'),
				'payment_method' => $this->input->post('payment_method'),
				'frieht' => $this->input->post('frieht'),
				'transportation_charges' => $this->input->post('transportation_charges'),
				'pickup_charges' => $this->input->post('pickup_charges'),
				'delivery_charges' => $this->input->post('delivery_charges'),
				'courier_charges' => $this->input->post('courier_charges'),
				'awb_charges' => $this->input->post('awb_charges'),
				'other_charges' => $this->input->post('other_charges'),
				'total_amount' => $this->input->post('amount'),
				'fuel_subcharges' => $this->input->post('fuel_subcharges'),
				'sub_total' => $this->input->post('sub_total'),		
				'cgst' => $this->input->post('cgst'),			
				'sgst' => $this->input->post('sgst'),			
				'igst' => $this->input->post('igst'),			
				'grand_total' => $this->input->post('grand_total'),		
				'user_id' =>'1',
				'user_type' =>'1',				
				'branch_id' => $branch_id,
				'booking_type'=>1,
				'pickup_pending'=>1,
				
				);
		
			 //print_r($data);exit;
				$query = $this->basic_operation_m->insert('tbl_domestic_booking', $data);

				$all_Data = $this->input->post();
			
		
				$lastid = $this->db->insert_id();
				if(empty($lastid))
				{
					
					$data['error'][] = "Already Exist ". $this->input->post('awn').'<br>';	
				}
				else
				{	
					$lastid = $this->db->insert_id();
						
						$data2 = array(						
						'booking_id' => $lastid,
						'actual_weight' => $this->input->post('actual_weight'),
						'valumetric_weight' => $this->input->post('valumetric_weight'),
						'length' => $this->input->post('length'),
						'breath' => $this->input->post('breath'),
						'height' => $this->input->post('height'),					
						'chargable_weight' => $this->input->post('chargable_weight'),
						'per_box_weight' => $this->input->post('per_box_weight'),
						'no_of_pack' => $this->input->post('no_of_pack'),						
						'actual_weight_detail' => json_encode($this->input->post('actual_weight')),
						'valumetric_weight_detail' => json_encode($this->input->post('valumetric_weight_detail[]')),
						'chargable_weight_detail' => json_encode($this->input->post('chargable_weight')),
						'length_detail' => json_encode($this->input->post('length_detail[]')),
						'breath_detail' => json_encode($this->input->post('breath_detail[]')),
						'height_detail' => json_encode($this->input->post('height_detail[]')),						
						'no_pack_detail' => json_encode($this->input->post('no_of_pack')),
						'per_box_weight_detail' =>json_encode($this->input->post('per_box_weight_detail[]')),
						);
						
				// 	echo "<pre>";print_r($data2);
				// 	exit();

				$query2 = $this->basic_operation_m->insert('tbl_domestic_weight_details', $data2);
			
				
				$whr = array('branch_id' => $branch_id);
				$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
				$branch_name = $res->row()->branch_name;
							
				$whr = array('booking_id' => $lastid);
				$res = $this->basic_operation_m->getAll('tbl_domestic_booking', $whr);
				$podno = $res->row()->pod_no;
				$customerid= $res->row()->customer_id;
				$data3 = array('id' => '',
					'pod_no' => $podno,
					'status' => 'Booked',
					'branch_name' => $branch_name,
					'tracking_date' => $this->input->post('booking_date'),
					'booking_id' => $lastid,
					'forworder_name' => $data['forworder_name'],
					'forwording_no' => $data['forwording_no'],
					'is_spoton' => ($data['forworder_name'] == 'spoton_service') ? 1 : 0,
					'is_delhivery_b2b' => ($data['forworder_name'] == 'delhivery_b2b') ? 1 : 0,
					'is_delhivery_c2c' => ($data['forworder_name'] == 'delhivery_c2c') ? 1 : 0
				);
				
				$result3 = $this->basic_operation_m->insert('tbl_domestic_tracking', $data3);
				if($this->input->post('customer_account_id')!="")
				{
					$whr = array('customer_id'=>$customerid);
					$res=$this->basic_operation_m->getAll('tbl_customers',$whr);
					$email= $res->row()->email;
				}
				$msg='Your Shipment '.$podno.' status:Boked  At Location: '.$branch_name;
				
				
				$class	= 'alert alert-success alert-dismissible';	
			
				$this->session->set_flashdata('notify',$msg);
				$this->session->set_flashdata('class',$class);
			}
			
			redirect('User_panel/add_domestic_shipment');
		}
	}
	
	 public function add_new_rate_international()
    {
        $sub_total 				= 0;        	
        $fixed_perkg 			= 0;        	
        $rate 					= 0;        	
		$courier_company_id	 = $this->input->post('courier_company_id');
		$reciever_country_id = $this->input->post('reciever_country_id');
		$reciever_zone_id 	 = $this->input->post('reciever_zone_id');
		$customer_id 		 = $this->input->post('customer_id');
		$weight		 		 = $this->input->post('weight');
		$qty		 		 = $this->input->post('qty');
		$doc 				 = $this->input->post('doc'); // non-doc =1 , doc =0
		$type_export_import  = $this->input->post('type_export_import');
		$dispatch_details       = $this->input->post('dispatch_details');
		$actual_weight 		= $this->input->post('actual_weight');
		$valumetric_weight	= $this->input->post('valumetric_weight');
		$chargable_weight   = $this->input->post('chargable_weight');
		$booking_date       = $this->input->post('booking_date');
		$current_date = date("Y-m-d",strtotime($booking_date));

		$data['rate_master'] = new \stdClass();

			$a 		= $chargable_weight; // input value 
			$int 	= (int)$a;
			$result = ($a - $int);
			
			if( ($result <= 0.50) && !empty($result))
			{
				$fin_chargable_weight = $int + 0.50;

			}
			else if( ($result >= 0.50) && !empty($result) )
			{
				$fin_chargable_weight = $int + 1;
			}
			else
			{
				$fin_chargable_weight = round($a);
			}
			//$fin_chargable_weight1 =number_format($fin_chargable_weight,2);
			
			$fin_chargable_weight1 =$fin_chargable_weight;
			
			
			//echo $result;

			//$res = $this->db->query("select * from tbl_international_rate_master where courier_company_id='".$courier_company_id."' AND zone_id='".$reciever_zone_id."' AND customer_id='".$customer_id."' AND type_export_import='".$type_export_import."'  AND doc_type='".$doc."' AND ('".$fin_chargable_weight1."' BETWEEN `weight_from` AND `weight_to`) LIMIT 1 ");
            $res = $this->db->query("select * from tbl_international_rate_master where courier_company_id='".$courier_company_id."' AND zone_id='".$reciever_zone_id."' AND customer_id='".$customer_id."' AND DATE(`from_date`)<='".$current_date."' AND type_export_import='".$type_export_import."'  AND doc_type='".$doc."' AND ('".$fin_chargable_weight1."' BETWEEN `weight_from` AND `weight_to`) ORDER BY from_date DESC LIMIT 1 ");
            
			if ($res->num_rows() > 0) 
			{
				$data['rate_master'] = $res->row();
				
				$fixed_perkg = $data['rate_master']->fixed_perkg;
				$rate		 = $data['rate_master']->rate;
			}
			
			if($fixed_perkg=="0")
			{
				$frieht = $rate ;
			}else if($fixed_perkg=="1")
			{
				$frieht = $fin_chargable_weight1 * $rate;
			}

			$amount =$frieht;
			
	    	$whr1 = array('courier_id' => $courier_company_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date);
			$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
			if($res1){$fuel_per = $res1->fuel_price; }else{$fuel_per ='0';}
			$final_fuel_charges =($amount * $fuel_per/100);

			$sub_total =($amount + $final_fuel_charges);


            $whr2 = array('from <=' => $current_date,'to >=' => $current_date);
            $gst_details = $this->basic_operation_m->get_table_row('tbl_gst_setting', $whr2);
            if($gst_details){
                $cgst_per = $gst_details->cgst; 
                $sgst_per = $gst_details->sgst; 
                $igst_per = $gst_details->igst; 
            }else{
                $cgst_per = '0'; 
                $sgst_per = '0'; 
                $igst_per = '0'; 
            }            

            if($type_export_import=="Export")
            {
                $cgst = 0;
                $sgst = 0;
                $igst = ($sub_total*$igst_per/100);
                $grand_total = $sub_total + $igst;

            }else if($type_export_import=="Import")
            {
                $cgst = ($sub_total*$cgst_per/100);
                $sgst = ($sub_total*$sgst_per/100);
                $igst = 0;
                $grand_total = $sub_total + $cgst + $sgst + $igst;
            }
			
			$tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
			if($tbl_customers_info->gst_charges == 1)
			{
				if($first_two_char==27)
				{
					$cgst = ($sub_total*9/100);
					$sgst = ($sub_total*9/100);
					$igst = 0;
					$grand_total = $sub_total + $cgst + $sgst + $igst;
				}else{
					$cgst = 0;
					$sgst = 0;
					$igst = ($sub_total*18/100);
					$grand_total = $sub_total + $igst;
				}		
			}
			else
			{
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}
			
			if($dispatch_details == 'Cash')
			{	
				$cgst = 0;
				$sgst = 0;
				$igst = 0;
				$grand_total = $sub_total + $igst;
			}

			$query ="select * from tbl_international_rate_master where courier_company_id='".$courier_company_id."' AND zone_id='".$reciever_zone_id."' AND customer_id='".$customer_id."' AND DATE(`from_date`)<='".$current_date."' AND type_export_import='".$type_export_import."'  AND doc_type='".$doc."' AND ('".$fin_chargable_weight1."' BETWEEN `weight_from` AND `weight_to`) ORDER BY from_date DESC LIMIT 1 ";

		$data = array(
			'query'=>$query,
			'result'=>$result,			
			'chargable_weight'=>ceil($chargable_weight),		 	
			'frieht' => $frieht,
			'amount' => $amount,
			'final_fuel_charges'=>$final_fuel_charges,
			'sub_total'=>number_format($sub_total, 2, '.', ''),
            'cgst'=>number_format($cgst, 2, '.', ''),
            'sgst'=>number_format($sgst, 2, '.', ''),
			'igst'=>number_format($igst, 2, '.', ''),
			'grand_total'=>number_format($grand_total, 2, '.', ''),
		);
		
		echo json_encode($data);
		exit;
    }
	
    public function add_international_shipment() 
	{
		$data			= array();
        $result 		= $this->db->query('select max(booking_id) AS id from tbl_international_booking')->row();
        $id 			= $result->id + 1;
        
		if (strlen($id) == 2) 
		{
            $id = 'BS1000'.$id;
        }
		elseif (strlen($id) == 3) 
		{
            $id = 'BS100'.$id;
        }
		elseif (strlen($id) == 1) 
		{
            $id = 'BS10000'.$id;
        }
		elseif (strlen($id) == 4) 
		{
            $id = 'BS10'.$id;
        }
		elseif (strlen($id) == 5) 
		{
            $id = 'BS1'.$id;
        }
        
        $resAct 	= $this->db->query("select * from setting");
        $setting 	= $resAct->result();
		
        foreach ($setting as $value)
		{
            $data[$value->key] = $value->value;
		}
       
		
        $data['transfer_mode']		 	= $this->basic_operation_m->get_query_result('select * from `transfer_mode`');
        $data['cities']	= $this->basic_operation_m->get_all_result('city', '');        
        $data['states']	= $this->basic_operation_m->get_all_result('state', '');
       
	    $customer_id 						= $this->session->userdata("customer_id");
        $data['customers'] =$this->basic_operation_m->get_all_result('tbl_customers', "customer_id = '$customer_id'");
        
        
        $data['payment_method']  = $this->basic_operation_m->get_all_result('payment_method', '');
      
		$data['bid']= $id;

        $current_date = date("Y-m-d");       

        $whr2 = array('from <=' => $current_date,'to >=' => $current_date);
        $data['gst_details'] = $this->basic_operation_m->get_table_row('tbl_gst_setting', $whr2);


		$whr_d= array("company_type"=>"International");
		$data['courier_company'] = $this->basic_operation_m->get_all_result("courier_company",$whr_d);		
		//$data['zone_list']		 = $this->basic_operation_m->get_all_result("zone_master","");
		$data['currency_list']		 = $this->basic_operation_m->get_all_result("tbl_currency","");
		$this->load->view('user/international_shipment/view_add_international_shipment', $data);
	}


	public function insert_internatioanl_shipment()
	{
		
		$all_Data 	= $this->input->post();	
		if(!empty($all_Data)) 
		{
			if($all_Data['doc_type'] == 0)
			{
				$doc_nondoc			= 'Document';
			}
			else
			{
				$doc_nondoc			= 'Non Document';
			}		
			
			$username  = $this->session->userdata("userName");
			$user_id   = $this->session->userdata("userId");
			$user_type = $this->session->userdata("userType");
			
			$result 		= $this->db->query('select max(booking_id) AS id from tbl_international_booking')->row();
	        $id = $result->id + 1;
	        
			if (strlen($id) == 2) 
			{
	            $id = 'BS1000'.$id;
	        }
			elseif (strlen($id) == 3) 
			{
	            $id = 'BS100'.$id;
	        }
			elseif (strlen($id) == 1) 
			{
	            $id = 'BS10000'.$id;
	        }
			elseif (strlen($id) == 4) 
			{
	            $id = 'BS10'.$id;
	        }
			elseif (strlen($id) == 5) 
			{
	            $id = 'BS1'.$id;
	        }

	        $pod_no =trim($this->input->post('awn'));
	        if($pod_no!="")
	        {
	        	$awb_no = $pod_no;
	        }else{
	        	$awb_no =$id;
	        }
		
		
			$whr = array('username' => $username);
			$res = $this->basic_operation_m->getAll('tbl_users', $whr);
			$branch_id = $res->row()->branch_id;

			$date = date('Y-m-d',strtotime( $this->input->post('booking_date')));
			//$date = $this->input->post('booking_date');
			//booking details//
			$data = array(
				'doc_type'=>$this->input->post('doc_type'),
				//'freight_val'=>$this->input->post('freight_val'),
				'export_import_type'=>$this->input->post('export_import_type'),
				'doc_nondoc'=>$doc_nondoc,
				'courier_company_id'=>$this->input->post('courier_company'),
				'company_type'=>'International',
				'mode_dispatch' => 'Air',
				'pod_no' => $awb_no,
				'forwording_no' => $this->input->post('forwording_no'),
				'forworder_name' => $this->input->post('forworder_name'),
				'customer_id' => $this->input->post('customer_account_id'),
				'sender_name' => $this->input->post('sender_name'),
				'sender_address' => $this->input->post('sender_address'),
				'sender_city' => $this->input->post('sender_city'),
				'sender_state'=> $this->input->post('sender_state'),
				'sender_pincode' => $this->input->post('sender_pincode'),
				'sender_contactno' => $this->input->post('sender_contactno'),
				'type_of_doc'=>$this->input->post('type_of_doc'),
				'sender_gstno' => $this->input->post('sender_gstno'),
				'currency'=>$this->input->post('currency'),
				'invoice_no'=>$this->input->post('invoice_no'),
				'invoice_value' => $this->input->post('invoice_value'),
				'eway_no' => $this->input->post('eway_no'),

				'reciever_name' => $this->input->post('reciever_name'),
				'contactperson_name' => $this->input->post('contactperson_name'),				
				'reciever_address' => $this->input->post('reciever_address'),
				'reciever_contact' => $this->input->post('reciever_contact'),
				'reciever_email' => $this->input->post('reciever_email'),
				'reciever_country_id' => $this->input->post('reciever_country_id'),
				'reciever_city' => $this->input->post('reciever_city'),
				'reciever_zone_id' => $this->input->post('reciever_zone_id'),				
				'reciever_zipcode' => $this->input->post('reciever_zipcode'),								
				'special_instruction' => $this->input->post('special_instruction'),
				//'type_of_pack' => $this->input->post('type_of_pack'),
				'booking_date' =>$date,
				'dispatch_details' => $this->input->post('dispatch_details'),
                'payment_method' => $this->input->post('payment_method'),
				'frieht' => $this->input->post('frieht'),
				'transportation_charges' => $this->input->post('transportation_charges'),
				'destination_charges' => $this->input->post('destination_charges'),
				'clearance_charges' => $this->input->post('clearance_charges'),
				'ecs' => $this->input->post('ecs'),
				'other_charges' => $this->input->post('other_charges'),
				
				'total_amount' => $this->input->post('amount'),
				'fuel_subcharges' => $this->input->post('fuel_subcharges'),	
				'sub_total' => $this->input->post('sub_total'),
                'cgst' => $this->input->post('cgst'),
                'sgst' => $this->input->post('sgst'),
				'igst' => $this->input->post('igst'),			
				'grand_total' => $this->input->post('grand_total'),	
				'user_id' =>$user_id,
				'user_type' =>$user_type,				
				'branch_id' => $branch_id,
				'booking_type'=>1,
				
				);
			
			$query = $this->basic_operation_m->insert('tbl_international_booking', $data);
		
				$lastid = $this->db->insert_id();
				if(empty($lastid))
				{
					
					$data['error'][] = "Already Exist ". $this->input->post('awn').'<br>';	
				}
				else
				{	
					$lastid = $this->db->insert_id();
						
						$data2 = array(
						'booking_id' => $lastid,
						'actual_weight' => $this->input->post('actual_weight'),
						'valumetric_weight' => $this->input->post('valumetric_weight'),
						'length' => $this->input->post('length'),
						'breath' => $this->input->post('breath'),
						'height' => $this->input->post('height'),					
						'chargable_weight' => $this->input->post('chargable_weight'),
						'per_box_weight' => $this->input->post('per_box_weight'),						
						'no_of_pack' => $this->input->post('no_of_pack'),
						'actual_weight_detail' => json_encode($this->input->post('actual_weight_detail[]')),
						'valumetric_weight_detail' => json_encode($this->input->post('valumetric_weight_detail[]')),
						'chargable_weight_detail' => json_encode($this->input->post('chargable_weight_detail[]')),	
						'length_detail' => json_encode($this->input->post('length_detail[]')),
						'breath_detail' => json_encode($this->input->post('breath_detail[]')),
						'height_detail' => json_encode($this->input->post('height_detail[]')),						
						'no_pack_detail' => json_encode($this->input->post('no_pack_detail[]')),
						'per_box_weight_detail' =>json_encode($this->input->post('per_box_weight_detail[]')),						
						);

				$query2 = $this->basic_operation_m->insert('tbl_international_weight_details', $data2);
							
				$username = $this->session->userdata("userName");
				$whr = array('username' => $username);
				$res = $this->basic_operation_m->getAll('tbl_users', $whr);
				$branch_id = $res->row()->branch_id;
				
				$whr = array('branch_id' => $branch_id);
				$res = $this->basic_operation_m->getAll('tbl_branch', $whr);
				$branch_name = $res->row()->branch_name;
							
				$whr = array('booking_id' => $lastid);
				$res = $this->basic_operation_m->getAll('tbl_international_booking', $whr);
				$podno = $res->row()->pod_no;
				$customerid= $res->row()->customer_id;
				$data3 = array('id' => '',
					'pod_no' => $podno,
					'status' => 'Booked',
					'branch_name' => $branch_name,
					'tracking_date' => $date,
					'booking_id' => $lastid,
					'forworder_name' => $data['forworder_name'],
					'forwording_no' => $data['forwording_no'],
					'is_spoton' => ($data['forworder_name'] == 'spoton_service') ? 1 : 0,
					'is_delhivery_b2b' => ($data['forworder_name'] == 'delhivery_b2b') ? 1 : 0,
					'is_delhivery_c2c' => ($data['forworder_name'] == 'delhivery_c2c') ? 1 : 0
				);
				
				$result3 = $this->basic_operation_m->insert('tbl_international_tracking', $data3);
				
				if($this->input->post('customer_account_id')!="")
				{
					$whr = array('customer_id'=>$customerid);
					$res=$this->basic_operation_m->getAll('tbl_customers',$whr);
					$email= $res->row()->email;
				}
				$message='Your Shipment '.$podno.' status:Boked  At Location: '.$branch_name;
			}


					if(!empty($data))
					{						
						$msg			= 'Internal Shipment inserted successfully';
						$class			= 'alert alert-success alert-dismissible';		
					}else{
						$msg			= 'Internal Shipment not inserted successfully';
						$class			= 'alert alert-danger alert-dismissible';	
					}	
					$this->session->set_flashdata('notify',$msg);
					$this->session->set_flashdata('class',$class);
			
			redirect('admin/view-international-shipment');
		}
	}
	
	
	public function getsenderdetails() {
		$data = [];  
		$customer_name = $this->input->post('customer_name');

		$whr1 = array('customer_id' => $customer_name);
		$res1 = $this->basic_operation_m->selectRecord('tbl_customers', $whr1);
		$result1 = $res1->row();
		$data['user'] = $result1;
		echo json_encode($data);
		exit;
	}
	public function check_duplicate_forwording_no() {
        $data = [];  
        $forwording_no = $this->input->post('forwording_no');
        $whr = array('forwording_no' => $forwording_no);
        $result = $this->basic_operation_m->get_table_row('tbl_international_booking', $whr);

        $forwording_no = $result->forwording_no;
        if($forwording_no!="")
        {
            $data['msg'] = "Forwording number is duplicate ";
        }else{
            $data['msg'] = "";
        }

        echo json_encode($data);
        exit;
    }

	public function getRateMasterDetails() 
	{
    
		$data			= [];       
		
		$customer_name 	= $this->input->post('customer_name');
		$sender_city 	= $this->input->post('sender_city');
		$receiver_city 	= $this->input->post('receiver_city');
		$mode_dispatch 	= ucfirst($this->input->post('mode_dispatch'));
		
		$region_query 	= $this->db->query("SELECT `state`.`region_id`,`state`.`id` as state_id,`state`.`edd_train`,`state`.`edd_air`, `state`.`edd_air` FROM `state` join city ON `city`.`state_id` = `state`.`id` WHERE `city`.`id` = ".$receiver_city);
		
		if ($region_query->num_rows() > 0) 
		{
			$regionData 	= $region_query->row();
			$region_id 		= $regionData->region_id;
			$state_id 		= $regionData->state_id;
			$eod 			= ($mode_dispatch == 'air') ? $regionData->edd_air : $regionData->edd_air;
			$eod 			= $this->addBusinessDays(date("d-m-Y"),!empty($regionData->eod) ? $regionData->eod : 4);
		}

		if (!empty($region_id)) 
		{
			$data['rate_master'] = new \stdClass();
			
			$res = $this->db->query("select * from tbl_rate_master where customer_id=".$customer_name." AND mode_of_transport='".$mode_dispatch."' AND region_id=".$region_id." LIMIT 1");
			if ($res->num_rows() > 0) 
			{
				$data['rate_master'] = $res->row();
			  
				// check rate available for state table
				$stateMasterRes = $this->db->query("select * from tbl_rate_state where rate_master_id=".$data['rate_master']->rate_master_id." AND state_id =".$state_id." LIMIT 1");
				
				if($stateMasterRes->num_rows() > 0){
					$stateMasterData = $stateMasterRes->row();
					$data['rate_master']->rate = $stateMasterData->rate;
					$data['rate_master']->to_pay_charges = $stateMasterData->to_pay_charges;
					$data['rate_master']->cod = $stateMasterData->cod;
					$data['rate_master']->edd = $stateMasterData->edd;
				}
				
				
				//check rate available for city table
				$cityMasterRes = $this->db->query("select * from tbl_rate_city where rate_master_id=".$data['rate_master']->rate_master_id." AND city_id =".$receiver_city." LIMIT 1");
				if ($cityMasterRes->num_rows() > 0) {
					$cityMasterData = $cityMasterRes->row();
					$data['rate_master']->rate = $cityMasterData->rate;
					$data['rate_master']->to_pay_charges = $cityMasterData->to_pay_charges;
					$data['rate_master']->cod = $cityMasterData->cod;
					$data['rate_master']->edd = $cityMasterData->edd;
				}
				
				if($this->input->post('no_of_pack') > 0 && $this->input->post('rate_type') == 'no_of_pack') 
				{
					$rate_master_id 	= $data['rate_master']->rate_master_id;
					$no_of_pack 		= $this->input->post('no_of_pack');
					$rate_master_query 	= $this->db->query("SELECT * FROM `tbl_rate_pack` WHERE rate_master_id = ".$rate_master_id." AND $no_of_pack BETWEEN `from` AND `to` LIMIT 1");
				
					if($rate_master_query->num_rows() > 0) 
					{
						$data['rate_master_pack'] = $rate_master_query->row();
					}
				   
				}
			}
         $data['rate_master']->eod = $eod;
      //echo '<pre>';  print_r($data);exit;
		}
		echo json_encode($data);
		exit;
	}
	
	
	public function getFuelcharges() {
		$customer_id = $this->input->post('customer_id');
		$dispatch_details = $this->input->post('dispatch_details');
		$courier_id = $this->input->post('courier_id');
		$sub_amount = $this->input->post('sub_amount');
		$booking_date = $this->input->post('booking_date');
        $type_export_import = $this->input->post('type_export_import');

	    $current_date = date("Y-m-d",strtotime($booking_date));
		$whr1 = array('courier_id' => $courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date);
		$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);
		if($res1){$fuel_per = $res1->fuel_price; }else{$fuel_per ='0';}

		$final_fuel_charges =($sub_amount * $fuel_per/100);
			
		$sub_total =($sub_amount + $final_fuel_charges);
		

        $whr2 = array('from <=' => $current_date,'to >=' => $current_date);
        $gst_details = $this->basic_operation_m->get_table_row('tbl_gst_setting', $whr2);

            //echo $this->db->last_query();

           
			 $tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
			if($tbl_customers_info->gst_charges == 1)
			{
				 if($gst_details){
                $cgst_per = $gst_details->cgst; 
                $sgst_per = $gst_details->sgst; 
                $igst_per = $gst_details->igst; 
            }else{
                $cgst_per = '0'; 
                $sgst_per = '0'; 
                $igst_per = '0'; 
            }    
            if($type_export_import=="Export")
            {
                $cgst = 0;
                $sgst = 0;
                $igst = ($sub_total*$igst_per/100);
                $grand_total = $sub_total + $igst;

            }else if($type_export_import=="Import")
            {
               $cgst = ($sub_total*$cgst_per/100);
               $sgst = ($sub_total*$sgst_per/100);
               $igst = 0;
               $grand_total = $sub_total + $cgst + $sgst + $igst;
            }
			
				
			}
			else
			{
				$cgst = 0;
			   $sgst = 0;
			   $igst = 0;
			   $grand_total = $sub_amount + $cgst + $sgst + $igst;
			}
			
			if($dispatch_details == 'Cash')
			{	
				$cgst = 0;
			   $sgst = 0;
			   $igst = 0;
			   $grand_total = $sub_amount + $cgst + $sgst + $igst;
			}

		$result2= array('final_fuel_charges'=>$final_fuel_charges,
						'sub_total'=>number_format($sub_total, 2, '.', ''),
                        'cgst'=>number_format($cgst, 2, '.', ''),
                        'sgst'=>number_format($sgst, 2, '.', ''),
						'igst'=>number_format($igst, 2, '.', ''),
						'grand_total'=>number_format($grand_total, 2, '.', ''),
					);
		echo json_encode($result2);
		
	}
    public function getGstCharges() {
        $sub_amount = $this->input->post('sub_amount');
        $booking_date = $this->input->post('booking_date');
        $type_export_import = $this->input->post('type_export_import');
		$customer_id = $this->input->post('customer_id');
		$dispatch_details = $this->input->post('dispatch_details');

        $current_date = date("Y-m-d",strtotime($booking_date));       

        $whr2 = array('from <=' => $current_date,'to >=' => $current_date);
        $gst_details = $this->basic_operation_m->get_table_row('tbl_gst_setting', $whr2);

           
			
			
			 $tbl_customers_info 		= $this->basic_operation_m->get_query_row("select gst_charges from tbl_customers where customer_id = '$customer_id'");
			
			if($tbl_customers_info->gst_charges == 1)
			{
				 if($gst_details)
				 {
					$cgst_per = $gst_details->cgst; 
					$sgst_per = $gst_details->sgst; 
					$igst_per = $gst_details->igst; 
				}else{
					$cgst_per = '0'; 
					$sgst_per = '0'; 
					$igst_per = '0'; 
				}    
				if($type_export_import=="Export")
				{
					$cgst = 0;
					$sgst = 0;
					$igst = ($sub_amount*$igst_per/100);
					$grand_total = $sub_total + $igst;

				}else if($type_export_import=="Import")
				{
				   $cgst = ($sub_amount*$cgst_per/100);
				   $sgst = ($sub_amount*$sgst_per/100);
				   $igst = 0;
				   $grand_total = $sub_amount + $cgst + $sgst + $igst;
				}
				
			}
			else
			{
				$cgst = 0;
			   $sgst = 0;
			   $igst = 0;
			   $grand_total = $sub_amount + $cgst + $sgst + $igst;
			}
			
			if($dispatch_details == 'Cash')
			{	
				$cgst = 0;
			   $sgst = 0;
			   $igst = 0;
			   $grand_total = $sub_amount + $cgst + $sgst + $igst;
			}
		   

        $result2= array(
                        'sub_total'=>number_format($sub_amount, 2, '.', ''),
                        'cgst'=>number_format($cgst, 2, '.', ''),
                        'sgst'=>number_format($sgst, 2, '.', ''),
                        'igst'=>number_format($igst, 2, '.', ''),
                        'grand_total'=>number_format($grand_total, 2, '.', ''),
                    );
        echo json_encode($result2);
        
    }
	public function available_Fuelcharges() {
		$courier_id = $this->input->post('courier_id');
		$booking_date = $this->input->post('booking_date');
		
		$current_date = date("Y-m-d",strtotime($booking_date));
		$whr1 = array('courier_id' => $courier_id,'fuel_from <=' => $current_date,'fuel_to >=' => $current_date);
		$res1 = $this->basic_operation_m->get_table_row('courier_fuel', $whr1);

		if($res1){$fuel_per = $res1->fuel_price; }else{$fuel_per ='0';}

		$result2= array('fuel_charges'=>$fuel_per,);
		echo json_encode($result2);
	} 
	
	public function print_label($id) 
	{
	    // Load library
	    $this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		$whr = array('booking_id' => $id);
		$user_id = $this->session->userdata("userId");
		$user_type = $this->session->userdata("userType");
		if ($id != "") {			
			$data['booking'] = $this->basic_operation_m->get_all_result('tbl_international_booking', $whr);
			$where =array('id'=>1);
		    $data['company_details'] = $this->basic_operation_m->get_table_row('tbl_company',$where);
			$this->load->view('admin/international_shipment/print_shipment', $data);
		}
	}


// *************************FTL Request********************************************************

public function ftl_request_data(){
	$customer_id = $this->session->userdata('customer_id');
	$customer_name = $this->session->userdata('customer_name');
	$date = $this->input->post('date');
	$time1 = $this->input->post('time');
	$time = date('H:i:sA', strtotime($time1));
	$request_date_time = $date." ".$time;
	//print_r($request_date_time);exit;

	if(isset($_POST['submit'])){
	

		       $data = array(

		        'order_date' => $this->input->post('order_date'),
		        'vehicle_temperature_log' => $this->input->post('temperature_log'),
		        'maintain_temperature_time' => $this->input->post('maintain_temperature_time'),
				'customer_id'=>$customer_id,
				'customer_name'=>$customer_name,
		        'ftl_request_id' => $this->input->post('ftl_request_id'),
		        // 'risk_type' => $this->input->post('risk_type'),
		        'descrption' => $this->input->post('descrption'),
				'request_date_time' =>$request_date_time,				
				'origin_city' => $this->input->post('origin_city'),
				'origin_pincode' => $this->input->post('origin_pincode'),
				'origin_state' => $this->input->post('origin_state'),
				'destination_state' => $this->input->post('destination_city'),
				'destination_city' => $this->input->post('destination_state'),
				'destination_pincode' => $this->input->post('destination_pincode'),
				'type_of_vehicle' => $this->input->post('type_of_vehicle'),				
				'vehicle_capacity' => $this->input->post('vehicle_capacity'),								
				'vehicle_body_type' => $this->input->post('vehicle_body_type'),								
				'vehicle_gps' => $this->input->post('vehicle_gps'),								
				'vehicle_floor_type' => $this->input->post('vehicle_floor_type'),								
				'vehicle_wheel_type' => $this->input->post('vehicle_wheel_type'),								
				'goods_type' => $this->input->post('goods_type'),								
				'goods_weight' => $this->input->post('goods_weight'),								
				'goods_weight' => $this->input->post('goods_weight'),								
				'weight_type' => $this->input->post('weight_type'),								
				'amount' => $this->input->post('amount'),
				'goods_value' => $this->input->post('goods_value'),
				'customer_type' => $this->input->post('customer_type'),
				'pickup_address' => $this->input->post('pickup_address'),
				'loading_type' => $this->input->post('loading_type'),
				'unloading_type' => $this->input->post('unloading_type'),
				'contact_number' => $this->input->post('contact_number'),
				'delivery_address' => $this->input->post('delivery_address'),
				'delivery_contact_no' => $this->input->post('delivery_contact_no'),
				'type_parcel' => $this->input->post('type_parcel'),
                'insurance_by' => $this->input->post('insurance_by'),
                'cfo_charges' => $this->input->post('cfo_charges'),
				'consignee_name'=>$this->input->post('consignee_name'),
		        'consignee_address' => $this->input->post('consignee_address'),
		        'consignee_pincode' => $this->input->post('consignee_pincode'),
		        'consignee_state' => $this->input->post('consignee_state'),
				'consignee_city' => $this->input->post('consignee_city'),				
				'consignee_contact_no' => $this->input->post('consignee_contact_no'),
				'delivery_contact_person_name' => $this->input->post('delivery_contact_person_name')
				
			   );
			//    print_r($data);exit;
			   $result = $this->db->insert('ftl_request_tbl',$data);
     //  echo $this->db->last_query();exit;
        
            //    $last_id = $this->db->insert_id();
			//    $data2 = array(
		    //     'ftl_id' => $last_id,
			// 	'consignee_name'=>$this->input->post('consignee_name'),
		    //     'consignee_address' => $this->input->post('consignee_address'),
		    //     'consignee_pincode' => $this->input->post('consignee_pincode'),
		    //     'consignee_state' => $this->input->post('consignee_state'),
			// 	'consignee_city' => $this->input->post('consignee_city'),				
			// 	'consignee_contact_no' => $this->input->post('consignee_contact_no'),

			//    );
			//    $result = $this->db->insert('ftl_consignee_tbl',$data2);

				if(!empty($result))
					{						
						$msg			= 'FTL Request inserted successfully';
						$class			= 'alert alert-success alert-dismissible';	

					}else{
						$msg			= 'FTL Request not added';
						$class			= 'alert alert-danger alert-dismissible';	
					}	
					$this->session->set_flashdata('notify',$msg);
					$this->session->set_flashdata('class',$class);
			
			   redirect('User_panel/show_ftl_request');
			}else{


				$result 		= $this->db->query('select max(id) AS id from ftl_request_tbl')->row();
				$id = $result->id + 1;
				
				if (strlen($id) == 2) 
				{
					$id = 'FTLR1000'.$id;
				}
				elseif (strlen($id) == 3) 
				{
					$id = 'FTLR100'.$id;
				}
				elseif (strlen($id) == 1) 
				{
					$id = 'FTLR10000'.$id;
				}
				elseif (strlen($id) == 4) 
				{
					$id = 'FTLR10'.$id;
				}
				elseif (strlen($id) == 5) 
				{
					$id = 'FTLR1'.$id;
				}
				$data['FTTLR_id'] = $id;
				$data['vehicle_type'] = $this->db->query('SELECT * FROM vehicle_type_master')->result();
				$data['goods_name'] = $this->db->query('SELECT * FROM goods_type_tbl')->result();
				$data['goods_name'] = $this->db->query('SELECT * FROM goods_type_tbl')->result();
				$this->load->view('user/ftl_request/add_ftl_request',$data);
			}
       }

	   public function getVehicleCapicty()
	   {
		  $vehicle_id = $this->input->post('vehicle_id');
		  $data = $this->db->query("SELECT * FROM vehicle_type_master where id = '$vehicle_id'")->result_array();
		 // echo $this->db->last_query();
		  echo json_encode($data);
	   }

			public function show_ftl_request($offset='0')
			{
				//print_r($this->session->all_userdata());exit;
				$customer_id = $this->session->userdata('customer_id');
				$ftl_list = $this->db->query("SELECT ftl_request_tbl.* ,vehicle_type_master.vehicle_name,ftl_document_image_tbl.eway_image  FROM ftl_request_tbl left join vehicle_type_master ON vehicle_type_master.id = ftl_request_tbl.type_of_vehicle  left join ftl_document_image_tbl ON ftl_document_image_tbl.ftl_id = ftl_request_tbl.ftl_request_id  where  customer_id = '$customer_id' order by ftl_request_id  DESC limit ".$offset.",10");// echo $this->db->last_query();die;
				$resActt = $this->db->query("SELECT ftl_request_tbl.* ,vehicle_type_master.vehicle_name,ftl_document_image_tbl.eway_image  FROM ftl_request_tbl left join vehicle_type_master ON vehicle_type_master.id = ftl_request_tbl.type_of_vehicle left join ftl_document_image_tbl ON ftl_document_image_tbl.ftl_id = ftl_request_tbl.ftl_request_id  where  customer_id = '$customer_id'");
				$this->load->library('pagination');
			
				$data['total_count']			= $resActt->num_rows();
				$config['total_rows'] 			= $resActt->num_rows();
				$config['base_url'] 			= 'users/ftl-list/';
				//	$config['suffix'] 				= '/'.urlencode($filterCond);
				
				$config['per_page'] 			= 10;
				$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
				$config['full_tag_close'] 		= '</ul></nav>';
				$config['first_link'] 			= '&laquo; First';
				$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
				$config['first_tag_close'] 		= '</li>';
				$config['last_link'] 			= 'Last &raquo;';
				$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
				$config['last_tag_close'] 		= '</li>';
				$config['next_link'] 			= 'Next';
				$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
				$config['next_tag_close'] 		= '</li>';
				$config['prev_link'] 			= 'Previous';
				$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
				$config['prev_tag_close'] 		= '</li>';
				$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
				$config['cur_tag_close'] 		= '</a></li>';
				$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
				$config['reuse_query_string'] 	= TRUE;
				$config['num_tag_close'] 		= '</li>';
				$config['attributes'] = array('class' => 'page-link');
				
				if($offset == '')
				{
					$config['uri_segment'] 			= 3;
					$data['serial_no']				= 1;
				}
				else
				{
					$config['uri_segment'] 			= 3;
					$data['serial_no']		= $offset + 1;
				}
				
				
				$this->pagination->initialize($config);
				if($ftl_list->num_rows() > 0) 
				{
					$data['ftl_request_data']	= $ftl_list->result_array();
				}
				else
				{
					$data['ftl_request_data']	= array();
				}
				
				$this->load->view('user/ftl_request/View_ftl_request',$data);
			}

			public function goods_type()
			{   if(isset($_POST['submit'])){

				$data['goods_name'] = $_POST['goods_name'];
				$this->db->insert('goods_type_tbl',$data);
				redirect(base_url().'User_panel/goods_type');

			 }else{
			    $data['goods_name'] = $this->db->query("select * from goods_type_tbl")->result();
				$this->load->view('user/ftl_request/add_goods',$data);    
			 }
				
			}

			public function update_goods_type($id)
			{
				if(isset($_POST['submit'])){

					$data['goods_name'] = $_POST['goods_name'];
					$this->db->where('id', $id);
					$this->db->update('goods_type_tbl', $data);
					//echo $this->db->last_query();exit;
					redirect(base_url().'User_panel/goods_type');
	
				 }else{
					$data['update'] = $this->db->query("select * from goods_type_tbl where id = '$id'")->row_array();
					$this->load->view('user/ftl_request/update_goods',$data);    
				 }
			}


    
	 public function getOriginCityList()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

      $city_id = $res1->row()->city_id;

      $whr2 = array('id' => $city_id);
      $data = $this->db->query("select * from city where id = '$city_id'")->row();

      echo json_encode($data);
   }
   public function getOriginState()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
      $state_id = $res1->row()->state_id;
      $data = $this->db->query("select * from state where id = '$state_id'")->row();
     // echo $this->db->last_query();
      echo json_encode($data);
   }

   public function getDestinationCityList()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);

      $city_id = $res1->row()->city_id;

      $whr2 = array('id' => $city_id);
      $data = $this->db->query("select * from city where id = '$city_id'")->row();

      echo json_encode($data);
   }
   public function getDestinationState()
   {
      $pincode = $this->input->post('pincode');
      $whr1 = array('pin_code' => $pincode);
      $res1 = $this->basic_operation_m->selectRecord('pincode', $whr1);
      $state_id = $res1->row()->state_id;
      $data = $this->db->query("select * from state where id = '$state_id'")->row();
     // echo $this->db->last_query();
      echo json_encode($data);
   }

   public function upload_ewaybill($id){

	if(isset($_POST['submit'])){

		$v = $this->input->post('eway_bill');
        if (isset($_FILES) && !empty($_FILES['eway_bill']['name'])) {
            $ret = $this->basic_operation_m->fileUpload($_FILES['eway_bill'], 'assets/ftl_documents/eway_bill/');
            //file is uploaded successfully then do on thing add entry to table
            if ($ret['status'] && isset($ret['image_name'])) {
                $eway_bill = $ret['image_name'];
            }
        }
        // ********************************* Invoice upload ****************     


        $v = $this->input->post('invoice');
        if (isset($_FILES) && !empty($_FILES['invoice']['name'])) {
            $ret = $this->basic_operation_m->fileUpload($_FILES['invoice'], 'assets/ftl_documents/invoice/');
            //file is uploaded successfully then do on thing add entry to table
            if ($ret['status'] && isset($ret['image_name'])) {
                $invoice = $ret['image_name'];
            }
        }

		$data = array(
			'ftl_id'=>$this->input->post('ftl_id'),
			'eway_image'=>$eway_bill,
			'invoice_image'=>$invoice,
		);
		//print_r($data);exit;
		$this->db->insert('ftl_document_image_tbl',$data);
	//	echo $this->db->last_query();exit;
		$this->session->Set_flashdata('msg','Images Uploaded Successfully!!');
		redirect(base_url().'User_panel/show_ftl_request');
	}else{
	 $data['get_ftl_document']	   = $this->db->query("select * from ftl_document_image_tbl")->result_array();
     $data['get_ftl_data'] = $this->db->query("select * from ftl_request_tbl where id ='$id'")->row_array();
	 $this->load->view('user/ftl_request/add_ewaybill',$data);    
   }
 }

 public function cancel_ftl_request(){
	$id = $this->input->post('cancel_ftl_id');
	$msg = $this->input->post('cancel_ftl_msg');
	$result = $this->db->query("UPDATE ftl_request_tbl set cancel_ftl_reason ='$msg',ftl_booking_status = '2'  where id = '$id'");
	// echo $this->db->last_query();die;
	if($result){
		$this->session->set_flashdata('msg', 'Order Cancelled  !');
		redirect(base_url().'User_panel/show_ftl_request');
	}else{
	$this->session->set_flashdata('msg', 'Something went wrong!');
	redirect(base_url().'User_panel/show_ftl_request');
	}
}

 public function view_ewaybill_list($offset ='0'){
	   $c_id = $this->session->userdata('customer_id');
	     $resActt   = $this->db->query("select * from ftl_document_image_tbl left join ftl_request_tbl ON ftl_request_tbl.ftl_request_id = ftl_document_image_tbl.ftl_id where ftl_request_tbl.customer_id = '$c_id' ");
		 $resAct   = $this->db->query("select * from ftl_document_image_tbl left join ftl_request_tbl ON ftl_request_tbl.ftl_request_id = ftl_document_image_tbl.ftl_id where ftl_request_tbl.customer_id = '$c_id'  limit ".$offset.",10");
	$this->load->library('pagination');
			
		$data['total_count']			= $resActt->num_rows();
		$config['total_rows'] 			= $resActt->num_rows();
		$config['base_url'] 			= 'users/ewaybill-list/';
		//	$config['suffix'] 				= '/'.urlencode($filterCond);
		
		$config['per_page'] 			= 10;
		$config['full_tag_open'] 		= '<nav aria-label="..."><ul class="pagination">';
		$config['full_tag_close'] 		= '</ul></nav>';
		$config['first_link'] 			= '&laquo; First';
		$config['first_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['first_tag_close'] 		= '</li>';
		$config['last_link'] 			= 'Last &raquo;';
		$config['last_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['last_tag_close'] 		= '</li>';
		$config['next_link'] 			= 'Next';
		$config['next_tag_open'] 		= '<li class="next paginate_button page-item">';
		$config['next_tag_close'] 		= '</li>';
		$config['prev_link'] 			= 'Previous';
		$config['prev_tag_open'] 		= '<li class="prev paginate_button page-item">';
		$config['prev_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '<li class="paginate_button page-item active"><a href="javascript:void(0);" class="page-link">';
		$config['cur_tag_close'] 		= '</a></li>';
		$config['num_tag_open'] 		= '<li class="paginate_button page-item">';
		$config['reuse_query_string'] 	= TRUE;
		$config['num_tag_close'] 		= '</li>';
		$config['attributes'] = array('class' => 'page-link');
		
		if($offset == '')
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']				= 1;
		}
		else
		{
			$config['uri_segment'] 			= 3;
			$data['serial_no']		= $offset + 1;
		}
		
		
		$this->pagination->initialize($config);
		if($resAct->num_rows() > 0) 
		{
			$data['get_ftl_document']	= $resAct->result_array();
		}
		else
		{
			$data['get_ftl_document']	= array();
		}
	$this->load->view('user/ftl_request/eway_bill_list',$data);

 }

 public function gat_rfq_customer_data(){
	
	 $current_date12 = date('Y-m-d');
	//  $current_date12 = $this->input->post('current_date');
	 $current_date = date("Y-m-d",strtotime($current_date12));
	 $customer_id = $this->input->post('customer_id');
	 $vehicle_id = $this->input->post('vehicle_id');
	 $origin_city = $this->input->post('origin_city_id');
	 $destination_city = $this->input->post('destination_city_id');
	//  print_r($destination_city);exit;
	 $data =  $this->db->query("select * from  ftl_customer_rate_tbl where ftl_customer_id = '$customer_id' AND vehicle_type ='$vehicle_id' AND origin = '$origin_city' AND destination ='$destination_city' AND to_date>= '".$current_date."' ")->row_array();
	 //echo $this->db->last_query();
	 echo json_encode($data);
       
 }



}






