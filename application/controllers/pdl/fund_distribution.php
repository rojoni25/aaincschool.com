<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fund_distribution extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		$this->load->model('pdl/admin/fund_distribution_model','ObjM',TRUE);
		
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
 	}
	
	public function view($eid)
	{
		$data['html']	=	$this->listing();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/fund_distribution_view',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result=$this->ObjM->get_all_payment();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
			
			$payment=$this->ObjM->member_by_payment_get($result[$i]['id']);
			$row=$i+1;
			$html.='<tr>
						<td>'.$result[$i]['id'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['txn_id'].'</td>
						<td>'.date('d-m-Y H:i a',$result[$i]['time_dt']).'</td>
						<td>'.$payment[0]['name'].'</td>
						<td>'.$payment[1]['name'].'</td>
						<td>'.$payment[2]['name'].'</td>
						<td>'.$payment[3]['name'].'</td>
			</tr>';
		}
		
		return $html;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

