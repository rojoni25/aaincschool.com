<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		$this->load->model('kdk1/member_module','ObjM',TRUE);
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
		
		$check_sdk	=	$this->ObjM->get_access_code();
		if(!isset($check_sdk[0]))
		{
			header('Location: '.base_url().'index.php/scompany/');
			exit;	
		}

		$check_in=$this->ObjM->check_in_list();
		if(isset($check_in[0]))
		{
			$this->r_joined_member_view();
		}
		else{
			$this->r_join_view();
		}
	}
	
	function dashboard(){
		$check_in=$this->ObjM->check_in_list();
		
		if(isset($check_in[0])){
			$this->r_joined_member_view();
		}
		else{
			header('Location: '.base_url().'index.php/scompany/');
			exit;
		}
	}
	
	
	protected function r_join_view(){
		
		$data['result']=$this->ObjM->check_request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/member_join',$data);
		$this->load->view('comman/footer');
	}
	
	protected function r_joined_member_view(){
		
		$data['account']			=	$this->account_summury();
		$data['cms']				=	$this->ObjM->get_cms_page(MATRIX_TABLE_PRE.'matrix');
		$data['count_position']		=	$this->ObjM->count_position();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/member_home',$data);
		$this->load->view('comman/footer');
	}
	
	protected function account_summury(){
		
		$credit=$this->ObjM->member_transaction_total('credit');
		$debit=$this->ObjM->member_transaction_total('debit');
		
		$arr=array();
		$arr['credit']=$credit;
		$arr['debit']=$debit;
		$arr['balance']=$credit-$debit;
		return $arr;
	}
	
	
	function insert_request_pop(){
		$html='<div class="pop-div-main">
			<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/insert_request" method="POST" id="send_request_join">
			<table class="table table-striped table-bordered dataTable">
			<tr><td colspan="3"><h4>Send Request To Join '.MATRIX_CODE_LLB.' </h4></td></tr>
			<tr><td>Message</td><td></td><td><textarea id="txtmsg" name="txtmsg"></textarea></td></tr>
			<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Send Request</strong></button></td></tr>
			<tr><td></td><td></td><td class="submit_process"></td></tr>
			</table>
			</form>
			<div>';
			echo $html;
			exit;
	}
	
	
	function insert_request(){
			
		
			$result=$this->ObjM->check_request();
			if(!isset($result[0]))
			{
				$data = array();
				$data['status']			=	'P';
				$data['msg']			=	$_POST['txtmsg'];
				$data['request_time']	=	time();
				$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
				$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'matrix_request');
				$this->send_email_to_admin();
			}
			
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/view/');
			exit;	
			
		
	}
	
	
	function send_email_to_admin()
	{
	
			$member_dt=$this->session->userdata['logged_ol_member'];
			$admin_email_list=$this->ObjM->get_admin_email();		
			// $message='<p>Name	:'.$member_dt['fullname'].' ('.$member_dt['usercode'].') Is Send Request To Join R-Matrix</p>';
			// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
			$message = get_email_cms_page_master('join-r-matrix')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$member_dt['usercode'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			$e_array=array("heading"=>"Join R-Matrix","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email_list);
			// $this->email->subject('Join R-Matrix');
			// $this->email->message($message);
			// $p=$this->email->send();
			sendemail(FROM_EMAIL,'Join R-Matrix',$admin_email_list,$message);

	}
	

	
}


