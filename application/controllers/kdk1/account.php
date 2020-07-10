<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('kdk1/account_module','ObjM',TRUE);
			
   		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function position()
	{

		$data['accept_result']		=	$this->get_position_report();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/position_report',$data);
		$this->load->view('comman/footer');
	}
	
	public function withdrawal()
	{

		$data['position']			=	$this->get_position_report();
		$data['account_summary']	= 	$this->transaction_detail();
		$data['p_request']			= 	$this->ObjM->get_withdrawal_request();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/withdrawal',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	protected function get_position_report()
	{
		$result		=	$this->ObjM->get_position();
		
		for($i=0;$i<count($result);$i++){
			$arr		=	$this->transaction_detail($result[$i]['idcode']);
			$result[$i]['credit']	=	$arr['credit'];
			$result[$i]['debit']	=	$arr['debit'];
			$result[$i]['balance']	=	$arr['balance'];
		}
		return  $result;
	}
	
	function transaction_detail($eid){
		
		$credit			=	$this->ObjM->transaction_sum_amount($eid,'credit');
		$debit			=	$this->ObjM->transaction_sum_amount($eid,'debit');
		$balance		=	$credit-$debit;
		
		$arr	=	array();	
		$arr['credit']	=	$credit;
		$arr['debit']	=	$debit;
		$arr['balance']	=	$balance;
		return $arr;
		

	}
	
	function withdrawal_insert(){
		
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
		
			$this->load->library('form_validation');
			
        	$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric|callback_check_amount');
				
        	if($this->form_validation->run() == FALSE)
        	{
				
            	$this->withdrawal();
        	}
        	else
        	{
			
            	$this->_withdrawal_insert();
				$this->session->set_flashdata("show_msg", "Withdrawal Request Sent");
				header('location: '.MATRIX_BASE.'account/withdrawal/');
				exit;
       	 	}
		}else
		{
			$this->withdrawal();
		}
		
	}
	
	protected function _withdrawal_insert()
	{
		$data=array();
		$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['amount']			=	$_POST['amount'];
		$data['description']	=	$_POST['description'];
		$data['time_dt']		=	date('Y-m-d H:i:s');
		$data['status']			=	'P';
		$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'withdrawal_request');	
	}
	
	function check_amount()
	{
		
   	
		$main_balance		=	$this->transaction_detail(false);
		$pending_request	=	$this->ObjM->get_withdrawal_request($_POST['position_code']);
		$amount				=	((float)$_POST['amount']);
		if(isset($pending_request[0])){
			$this->form_validation->set_message('check_amount', 'One Request Is Already Pending');
      		return FALSE;	
		}
		
		if($amount > $main_balance['balance'] || $amount <= 0){
      		$this->form_validation->set_message('check_amount', 'not enough balance');
      		return FALSE;
   		}
   		return true;	
	}
	
	
	
	
	
	

	
	
}


