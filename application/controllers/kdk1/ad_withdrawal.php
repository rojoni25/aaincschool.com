<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_withdrawal extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('kdk1/ad_account_model','ObjM',TRUE);
		$this->load->library('email');
			
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
	
	function view()
	{
		$data['result']=$this->request_list();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_withdrawal_request',$data);
		$this->load->view('comman/footer');	
	}
	
	protected function request_list(){
		$result=$this->ObjM->get_withdrawal_request();
		for($i=0;$i<count($result);$i++){
			$arr	=	$this->account_summary($result[$i]['usercode'],false);
			$result[$i]['balance']	= 	$arr['balance'];
			
		}
		return $result;
	}
	
	protected function account_summary($eid,$position=false)
	{
		$credit		=	$this->ObjM->member_transaction_total($eid,'credit',$position);
		$debit		=	$this->ObjM->member_transaction_total($eid,'debit',$position);
		$balance	=   $credit-$debit;
		
		$arr=array();
		$arr['credit']		=	$credit;
		$arr['debit']		=	$debit;
		$arr['balance']		=	$balance;
		return $arr;
	}
	
	
	
	function approve_request($eid){
		
		$result=$this->ObjM->get_withdrawal_request_id($eid);
		if(isset($result[0])){
			
	
			
			$main_balance=$this->account_summary($result[0]['usercode'],false);	
			
			$request_amount=(float)$result[0]['amount'];
			
			if($request_amount > $main_balance){
				$msg='Not Enough Balance';	
			}
			else{
				$msg='Approve Successfully';	
				$this->_approve_request($result[0]);
			}
		}
		
		$this->session->set_flashdata("show_msg",$msg);
		header('location: '.MATRIX_BASE.'ad_withdrawal/view');
		exit;
	}
	
	protected function _approve_request($result){
		$data=array();
		$data['usercode']		=	$result['usercode'];
		$data['amount']			=	$result['amount'];
		$data['type']			=	'debit';
		$data['time_dt']		=	date('Y-m-d H:i:s');	
		$data['request_code	']	=	$result['req_id'];	
		$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'member_account');
	}
	
	function approve_cancel($eid){
		$data['status']='C';
		$this->ObjM->update($data,'kdk1_withdrawal_request','req_id',$eid);
		
		$this->session->set_flashdata("show_msg",'Reject Successfully');
		header('location: '.MATRIX_BASE.'ad_withdrawal/view');
		exit;
	}
	 
}

