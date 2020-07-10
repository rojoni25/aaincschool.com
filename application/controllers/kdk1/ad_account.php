<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_account extends CI_Controller {
	
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
	
	function payment()
	{
		$data['result']=$this->ObjM->get_online_payment_list();
		$data['total']=$this->ObjM->sum_payment();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_account_payment',$data);
		$this->load->view('comman/footer');	
	}
	
	function member_ac($eid)
	{
		
		$data['result']		=  	$this->ObjM->get_member_record($eid);
		$data['credit']		=	$this->ObjM->member_transaction($eid,'credit');
		$data['debit']		=	$this->ObjM->member_transaction($eid,'debit');
		$data['position']	=	$this->get_postion_detail($eid);
		$data['summary']	=	$this->account_summary($eid);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/member_ac_view',$data);
		$this->load->view('comman/footer');	
	}
	
	protected function get_postion_detail($eid)
	{
		$result	=	$this->ObjM->get_position($eid);
		
		for($i=0;$i<count($result);$i++)
		{
			$arr=$this->account_summary($eid,$result[$i]['idcode']);
			$result[$i]['credit']		=	$arr['credit'];
			$result[$i]['debit']		=	$arr['debit'];
			$result[$i]['balance']		=	$arr['balance'];
			
		}
		return $result;
	}
	
	
	function transaction(){
		
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
		
			$this->load->library('form_validation');
			
        	$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric|callback_check_amount');
			$this->form_validation->set_rules('uid', 'Usercode', 'required|trim|numeric');
			$this->form_validation->set_rules('type', 'Type', 'required|trim');
        	
			
			
        	if($this->form_validation->run() == FALSE)
        	{
				
            	$this->member_ac($_POST['uid']);
        	}
        	else
        	{
			
            	$this->_transaction();
				$this->session->set_flashdata("show_msg", " Transaction (".$_POST['type'].") Successfully..");
				header('location: '.MATRIX_BASE.'ad_account/member_ac/'.$_POST['uid'].'');
				exit;
       	 	}
		}else
		{
			$this->member_ac();
		}
		
	}
	
	function check_amount()
	{
		
   		$summary	=	$this->account_summary($_POST['uid']);
		
		$amount=((float)$_POST['amount']);
		
		if($_POST['type']=='debit'){
			if($amount > $summary['balance'] || $amount <= 0){
      			$this->form_validation->set_message('check_amount', 'Invailed Amount');
      			return FALSE;
   			} 
			return TRUE;
		}
   		if($_POST['type']=='credit'){
			if($amount <= 0){
      			$this->form_validation->set_message('check_amount', 'Invailed Amount');
      			return FALSE;
   			}
			return TRUE;
		}
		
		$this->form_validation->set_message('check_amount', 'Invailed Request');
		
   		return false;	
	}
	
	protected function _transaction(){
		$data=array();
		$data['usercode']		=	$_POST['uid'];
		$data['amount']			=	$_POST['amount'];
		$data['type']			=	$_POST['type'];
		$data['description']	=	$_POST['description'];
		$data['position_code']	=	$_POST['position_code'];
		$data['time_dt']		=	date('Y-m-d H:i:s');		
		$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'member_account');
	}
	
	function transaction_report($eid)
	{
		if($eid=='credit')
		{
			$type='credit';
			$data['title']='Credit';
		}else{
			$type='debit';
			$data['title']='Debit';
		}	
		
		$data['result']=$this->ObjM->transaction_report($type);
		$data['summary']	=	$this->transaction_summary();

		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_transaction_report',$data);
		$this->load->view('comman/footer');
		
	}	
	
	
	protected function transaction_summary($eid)
	{
		$credit		=	$this->ObjM->transaction_report_total('credit');
		$debit		=	$this->ObjM->transaction_report_total('debit');
		$balance	=   $credit-$debit;
		
		$arr=array();
		$arr['credit']		=	$credit;
		$arr['debit']		=	$debit;
		$arr['balance']		=	$balance;
		return $arr;
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
	
	function transaction_report_by_position($eid)
	{
		$credit 	= $this->ObjM->transaction_report_by_position($eid,'credit');
		$debit 		= $this->ObjM->transaction_report_by_position($eid,'debit');
		$balance	=   $credit - $debit;
		
		$arr=array();
		$arr['credit']		=	$credit;
		$arr['debit']		=	$debit;
		$arr['balance']		=	$balance;
		echo json_encode($arr);
	}
	
	
		 
}

