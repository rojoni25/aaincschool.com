<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_detail extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('pdl/admin/member_tree_model','ObjM',TRUE);
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
		
 	}
	

	function view($eid){
		
	
		
		$data['result']				=	$this->ObjM->get_subscribe_member($eid);
		
		$data['subscribe']			=	$this->ObjM->get_all_subscribe($eid);
		
		$data['payment']			=	$this->get_payment_detail($eid);
		
		$data['payment_list']		=	$this->ObjM->get_payment_record($eid);
		
		$data['withdrawal_list']	=	$this->ObjM->get_all_withdrawal($eid);
		
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/member_detail',$data);
		$this->load->view('comman/footer');
	}
	
	
	protected function get_payment_detail($id){
		
		$payment_1		=	$this->ObjM->get_payment_sum_by_type($id,'pdl_1');	
		$withdrawal_1	=	$this->ObjM->get_withdrawal_sum_by_type($id,'pdl_1');
		$balance_1		=	$payment_1 - $withdrawal_1;		
		
		
		$payment_2		=	$this->ObjM->get_payment_sum_by_type($id,'pdl_2');	
		$withdrawal_2	=	$this->ObjM->get_withdrawal_sum_by_type($id,'pdl_2');
		$balance_2		=	$payment_2 - $withdrawal_2;	
		
		$payment_3		=	$this->ObjM->get_payment_sum_by_type($id,'opp_wallet');	
		$withdrawal_3	=	$this->ObjM->get_withdrawal_sum_by_type($id,'opp_wallet');
		$balance_3		=	$payment_3 - $withdrawal_3;		
		
		$arr=array(
			'payment_1'		=>	$payment_1,
			'withdrawal_1'	=>	$withdrawal_1,
			'balance_1'		=>	$balance_1,
			
			'payment_2'		=>	$payment_2,
			'withdrawal_2'	=>	$withdrawal_2,
			'balance_2'		=>	$balance_2,
			
			'payment_3'		=>	$payment_3,
			'withdrawal_3'	=>	$withdrawal_3,
			'balance_3'		=>	$balance_3
		);
		
		return $arr;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

