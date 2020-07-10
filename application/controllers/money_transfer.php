<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class money_transfer extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('money_transfer_model','ObjM',TRUE); 
 	}
	
	public function index()
	{
		$data['withdrawal']			=	$this->ObjM->get_withdrawal_request();
		$data['result']				=	$this->ObjM->get_balance();
		$data['pending_request']	= 	$this->ObjM->get_pending_request();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('money_transfer_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$amount_dt=$this->get_balance_dt();
			$now = time();
			
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$amount=(float)$_POST['amount'];
			$arr['amount']=$amount;
			
			$withdrawal=$this->ObjM->get_withdrawal_request();
			
			if($_POST['money_transfer']=='1'){
				$arr['wallet_minus']		=	'main_balance';
				$arr['wallet_plus']			=	'personal_wallet';
				if($amount > $amount_dt['max_withdrawal']){
					$this->session->set_flashdata('show_msg','transfer failed ! Insufficent Amount in your account.');
					$this->session->set_flashdata('cls_class','alert-error');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
					exit;
				}
				if(isset($withdrawal[0])){
					$this->session->set_flashdata('show_msg','transfer failed ! Withdrawal request is pending. Can not transfer to personal wallet.');
					$this->session->set_flashdata('cls_class','alert-error');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
					exit;
				}
			}
			if($_POST['money_transfer']=='2'){	
				$arr['wallet_minus']		=	'personal_wallet';
				$arr['wallet_plus']			=	'main_balance';
				if($amount > $amount_dt['personal_wallet']){
					$this->session->set_flashdata('show_msg','transfer failed ! Insufficent Amount in your account.');
					$this->session->set_flashdata('cls_class','alert-error');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
					exit;
				}
			}
			
			$rt=$this->send_request();
			
			$this->session->set_flashdata('show_msg','Request Send Successfully');
			$this->session->set_flashdata('cls_class','alert-success');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
			
			
		}
	}
	
	protected function get_balance_dt(){
		
		$result=$this->ObjM->get_balance();
		
		$main_balance		=	(float)$result[0]['main_balance'];
		$personal_wallet	=	(float)$result[0]['personal_wallet'];
		$max_withdrawal	=	$main_balance-CW_MIN;
		$arr=array(
		 'main_balance'		=>	$main_balance,
		 'personal_wallet'	=>	$personal_wallet,
		 'max_withdrawal'	=>	$max_withdrawal
		);
		return $arr;
	}
	
	protected function move_money($arr)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['amount']		=	$arr['amount'];
		$data['type']		=	'5';
		$data['description']=	'Transfer';
		$data['wallet_type']=	$arr['wallet_minus'];
		$data['create_date']=	$nowdt;
		$data['timedt']		=	time();
		$this->ObjM->addItem($data,'withdrawal_balance');
		
		$this->ObjM->master_balance_update($arr['wallet_minus'],$arr['amount'],'minus');
		$this->ObjM->master_balance_update($arr['wallet_plus'],$arr['amount'],'plus');
		return true;
		
	}
	
	
	function send_request(){
		$data['usercode']		=		$this->session->userdata['logged_ol_member']['usercode'];
		$data['wallet_type'] 	=		$_POST['money_transfer'];
		$data['amount'] 		=		$_POST['amount'];
		$data['date_time']		=		date('Y-m-d H:i:s');
		$this->ObjM->addItem($data,'money_transfer_request');
	}
	
	

}

