<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class martix_withdrawal extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/martix_withdrawal_module','ObjM',TRUE);
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
	
	public function view()
	{
		
		$data['payment']			=	$this->get_payment();
		
	
		
		$data['withdrawal_record']	=	$this->ObjM->get_withdrawal_record();
		
		
		
		$data['pending_request']	=	$this->ObjM->get_pending_request();
		
			
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/martix_withdrawal_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	 protected function get_payment(){
		$coin_pay			=	$this->ObjM->get_payment_sum_by_type('COIN');
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type('COIN');
		$arr=array(
			
			'coin_pay'			=>	$coin_pay,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
		);
	
		return $arr;	
	
	}
	
	function insert_request(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$pay=$this->get_payment();
			$amount=(float)$POST['amount'];
			if($amount > $pay['coin_balance']){
				$arr=array('class'=>'alert alert-error','text'=>'Error : Invalid  Request','sign'=>'icon-exclamation-sign');
			}
			else{
				$data['usercode']	=	$this->session->userdata["logged_ol_member"]['usercode'];
				$data['amount']		=	$_POST['amount'];
				$data['time_dt']	=	time();
				$data['msg']		=	$_POST['txtmsg'];
				$data['status']		=	'P';			
				$id=$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_withdrawal_request');
				$this->send_email_to_admin($id);
				$show_msg='Request Send Successfully';
				$arr=array('class'=>'alert alert-success','text'=>'Request Send Successfully','sign'=>'icon-ok-sign');
			}
			
			
			$this->session->set_flashdata('show_msg',$arr);	
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/view/');
			exit;
			
			
		}	
	}
	
	
	function send_email_to_admin($id)
	{
		$member_dt=$this->session->userdata['logged_ol_member'];
		$admin_email_list=$this->ObjM->get_admin_email();		
		
		// $message='<table style="border:#000 solid 1px;width:100%;" cellpadding="4" cellspacing="4">
		// <tr><td>Member Name</td><td></td><td>'.$member_dt['fullname'].'</td></tr>
		// <tr><td>Usercode</td><td></td><td>'.$member_dt['usercode'].'</td></tr>
		// <tr><td>Request Amount</td><td></td><td>$'.$_POST['amount'].'</td></tr>
		// <tr><td>Date</td><td></td><td>'.date('d-m-Y H:i:s').'</td></tr>
		// <tr><td>Request Code</td><td></td><td>'.$id.'</td></tr>
		// </table>';
		$message = get_email_cms_page_master('withdrawal-request')->result()[0]->textdt;
		$message = str_replace("[fullname]",$member_dt['fullname'],$message);
		$message = str_replace("[usercode]",$member_dt['usercode'],$message);
		$message = str_replace("[amount]",$_POST['amount'],$message);
		$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
		$message = str_replace("[requestcode]",$id,$message);
		
		$e_array=array("heading"=>"Withdrawal Request","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($admin_email_list);
		// $this->email->subject('Withdrawal Request');
		// $this->email->message($message);
		// $p=$this->email->send();
		sendemail(FROM_EMAIL,'Withdrawal Request',$admin_email_list,$message);
	}
	
	
	
	
	
	
	
	
}


