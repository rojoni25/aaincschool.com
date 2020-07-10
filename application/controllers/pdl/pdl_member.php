<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_member extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('pdl/member/pdl_withdrawal_model','ObjM',TRUE);		
		if($this->session->userdata["pdl_matrix_join"]['join']!='true'){ echo 'Access Denied '; }
		$this->load->library('pdl_member_class');	
 	}
	

	function withdrawal(){
			
			$data['wallet1_pending']	=	$this->ObjM->get_pending_request('pdl_1');
			$data['wallet2_pending']	=	$this->ObjM->get_pending_request('pdl_2');
			$data['wallet3_pending']	=	$this->ObjM->get_pending_request('opp_wallet');
			
			$data['withdrawal_list']	=	$this->ObjM->get_withdrawal();
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('pdl_member/withdrawal_add',$data);
			$this->load->view('comman/footer');
	}
	
	function withdrawal_insertrecord(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		
			$amount	=	(float)$_POST['amount'];
			
			$submit=true;
			
			if($_POST['wallet_type']=='pdl_1'){
				
				if($this->ObjM->check_pending_request('pdl_1')){
					$msg='One Request Already Pending';
					$submit=false;
				}
				
				if($amount > $this->pdl_member_class->get_value('max_withdrawal_1')){	
					$msg	=	'Invalid Amount';
					$submit=false;
				}
			}
			
			elseif($_POST['wallet_type']=='pdl_2'){
				
				if($this->ObjM->check_pending_request('pdl_2')){
					$msg='One Request Already Pending';
					$submit=false;
				}
				
				if($amount > $this->pdl_member_class->get_value('max_withdrawal_2')){	
					$msg	=	'Invalid Amount';
					$submit=false;
				}
			}
			
			elseif($_POST['wallet_type']=='opp_wallet'){
				
				if($this->ObjM->check_pending_request('opp_wallet')){
					$msg='Referral Wallet One Request Already Pending';
					$submit=false;
				}
				
				if($amount > $this->pdl_member_class->get_value('max_withdrawal_3')){	
					$msg	=	'Invalid Amount';
					$submit=false;
				}
			}
			
			else{
				$msg	=	'Invalid Request';
				$submit =    false;
			}
		
			if($submit){
				$data=array();
				$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['amount']		=	$amount;
				$data['msg']		=	$_POST['textdt'];
				$data['time_dt']	=	time();
				$data['wallet_type']=	$_POST['wallet_type'];
				$data['status']		=	'pending';
				$this->ObjM->addItem($data,'pdl_withdrawal_request');
				$msg	=	'Request Send Successfully';
			}
			
			$this->session->set_flashdata('show_msg',$msg);
		}
		
		header('Location: '.base_url().'index.php/pdl/pdl_member/withdrawal');
		exit;
		
	}
	
	function request_delete($eid)
	{
		$this->session->set_flashdata('show_msg','Request Delete');
		
		$this->ObjM->request_delete($eid);
		
		header('Location: '.base_url().'index.php/pdl/pdl_member/withdrawal');
		
		exit;
		
	}
	
	function product()
	{
		$data['contain'] = $this->ObjM->get_cms_page();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_member/product_page_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	

		
	
	
	
}

