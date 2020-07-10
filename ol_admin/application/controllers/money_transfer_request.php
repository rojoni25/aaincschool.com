<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class money_transfer_request extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('withdrawal_request_model','ObjM',TRUE);
		
 	}
	
	public function index()
	{
		$data['result']=$this->ObjM->get_money_transfer_request();	
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	function approve_req($eid){
			$result=$this->ObjM->get_money_transfer_request_by_id($eid);
			
			if(isset($result[0])){
				$amount_dt=$this->get_balance_dt($result[0]);	
				if($result[0]['wallet_type']=='1'){
				$arr['wallet_minus']		=	'main_balance';
				$arr['wallet_plus']			=	'personal_wallet';
				if($amount > $amount_dt['max_withdrawal']){
					$this->session->set_flashdata('show_msg','transfer failed ! Insufficent Amount in your account.');
					$this->session->set_flashdata('cls_class','alert-error');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
					exit;
				}
			}
			if($result[0]['wallet_type']=='2'){	
				$arr['wallet_minus']		=	'personal_wallet';
				$arr['wallet_plus']			=	'main_balance';
				if($amount > $amount_dt['personal_wallet']){
					$this->session->set_flashdata('show_msg','transfer failed ! Insufficent Amount in your account.');
					$this->session->set_flashdata('cls_class','alert-error');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
					exit;
				}
			}
				
				$this->move_money($arr,$result[0]);	
				
				$this->session->set_flashdata('show_msg','Successfully');
			$this->session->set_flashdata('cls_class','alert-success');
				
			}
			else{
				$this->session->set_flashdata('show_msg','transfer failed ! Invaid Request.');
				$this->session->set_flashdata('cls_class','alert-error');
			}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
		exit;	
		
	}
	
	
	protected function move_money($arr,$result)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$data['request_code']	=	$result['id'];
		$data['usercode']		=	$result['usercode'];
		$data['amount']			=	$result['amount'];
		$data['type']			=	'5';
		$data['description']	=	'Transfer';
		$data['wallet_type']	=	$arr['wallet_minus'];
		$data['create_date']	=	$nowdt;
		$data['timedt']			=	time();
		
		
		$this->ObjM->addItem($data,'withdrawal_balance');
		
		$this->ObjM->master_balance_update($arr['wallet_minus'],$result['amount'],'minus',$result['usercode']);
		$this->ObjM->master_balance_update($arr['wallet_plus'],$result['amount'],'plus',$result['usercode']);
		return true;
		
	}
	
	
	protected function get_balance_dt($result){
	
		$main_balance		=	(float)$result['main_balance'];
		$personal_wallet	=	(float)$result['personal_wallet'];
		$max_withdrawal	=	$main_balance-CW_MIN;
		$arr=array(
		 'main_balance'		=>	$main_balance,
		 'personal_wallet'	=>	$personal_wallet,
		 'max_withdrawal'	=>	$max_withdrawal
		);
		return $arr;
	}
	
	function delete_req($eid){
		$this->ObjM->delete('money_transfer_request',array('id'=>$eid));
		$this->session->set_flashdata('show_msg','Delete Successfully.');
		$this->session->set_flashdata('cls_class','alert-error');
			
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
		exit;	
	}
	
	
}

