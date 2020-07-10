<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		$this->load->model('matrix_comman/page_module','ObjM',TRUE);
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
	
		if(isset($_REQUEST['access_code'])){
			$data['page_msg']	=	$this->access_code_check();
		}	
		$data['contain']		=	$this->ObjM->get_pages_contain($_REQUEST['page_key']);
		$data['check']			=	$this->check_r_matrix_position();	
		$data['permission']		=	$this->ObjM->get_permission($data['contain'][0]['secret_page_code']);
		
		if(isset($data['contain'][0])){
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view(''.MATRIX_FOLDER.'/member/member_page',$data);
			$this->load->view('comman/footer');	
		}
		
	}
	
	
	
	
	
    protected function access_code_check(){
		
		$result=$this->ObjM->get_access_code($_REQUEST['access_code']);
	
		if(isset($result[0]))
		{
			$this->insert_access_code_use();
			header('Location: '.MATRIX_BASE.'martix/view/');
			exit;			
		}
		else{
			
			$sdk_msg="Invalid Code";
			return $sdk_msg;
			
		}
	
	}
	
	protected function insert_access_code_use(){
			$data=array();
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']			=	time();
			$data['access_code']		=	$_POST['access_code'];
			$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'access_code_use');	
	}
	
	public function show($page_key)
	{
		$data['contain']=$this->ObjM->get_pages_contain($page_key);
		
		if(!isset($data['contain'][0])){
			header('Location: '.base_url().'index.php/scompany');
			exit;
		}
		else{
			$data['permission']=$this->ObjM->get_permission($data['contain'][0]['secret_page_code']);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('scompany_view',$data);
		$this->load->view('comman/footer');
	
	}
	

	function r_matrix()
	{
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$result=$this->ObjM->get_access_code($_POST['access_code']);
		
			if(isset($result[0]))
			{
				header('Location: '.base_url().'index.php/r_matrix/view/');
				exit;			
			}
			else{
				$this->session->set_flashdata('show_msg_sdk', 'Invalid Page Code');
				header('Location: '.base_url().'index.php/scompany');
				exit;
			}
		
		}
	}
	
	function check_r_matrix_position(){
		
		$in_tree	=	$this->ObjM->check_in_tree();
		
		$access_code	=	$this->ObjM->check_access_code();
		
		$inter_code	=	$this->ObjM->check_code_intered();
	
		$arr		=	array('in_tree' => $in_tree,'in_access' => $access_code,'code'=>$inter_code[0]['access_code']);
		
		return $arr;
	}
	
	
	function request_access_popup(){
		if($this->ObjM->check_access_code_request()){
			$html	=	'<h4>Your Request Is Aready Send</h5>';
			echo $html;
			exit;
		}
		if($this->ObjM->check_member_email()){
			$html='<div class="pop-div-main">
			<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/request_for_access_code" method="POST" id="send_request_frm">
			<table class="table table-striped table-bordered dataTable">
			<tr><td colspan="3"><h4>Request For '.MATRIX_CODE_LLB.' Code</h4></td></tr>
			<tr><td>Message</td><td></td><td><textarea id="txtmsg" name="txtmsg"></textarea></td></tr>
			<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Send Request</strong></button></td></tr>
			<tr><td></td><td></td><td class="submit_process"></td></tr>
			</table>
			</form>
			<div>';
			echo $html;
			exit;
		}
		else{
			$html	=	'<h4>Please Verify Your Email Account</h4>';
			echo $html;
		}
		
		
	}
	
	
	function request_for_access_code(){
		
		if($this->ObjM->check_access_code_request()){
			$arr['msg']='<h4>Your Request Is Aready Send</h5>';
			echo json_encode($arr);
			exit;
		}
		
		if($this->ObjM->check_member_email()){
			
			$member_dt=$this->session->userdata['logged_ol_member'];
			$admin_email_list=$this->ObjM->get_admin_email();
			
			// $message='<p>Name	:'.$member_dt['fullname'].' ('.$member_dt['usercode'].') Is Send Request For  Code</p>';
			// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
			$message = get_email_cms_page_master('request_for_access_code')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$member_dt['usercode'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			$e_array=array("heading"=>"".MATRIX_CODE_LLB." Code Request","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			
		
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email_list);
			// $this->email->subject(''.MATRIX_CODE_LLB.' Code Request');
			// $this->email->message($message);
			// $p=$this->email->send();
			$resp_code = sendemail(FROM_EMAIL,''.MATRIX_CODE_LLB.' Code Request',$admin_email_list,$message);
			$p=($resp_code>=200 && $resp_code<=299);
	
		
			$data=array();
			$data['usercode']	=	$member_dt['usercode'];
			$data['msg']		=	$_POST['txtmsg'];
			$data['timedt']		=	time();
			$data['status']		=	'Active';
			$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'access_code_request');
			$arr['msg']='<h4>'.MATRIX_CODE_LLB.' Code Request Is Send Successfully</h4>';
			
		}
		else{			
			$arr['msg']='<h4>Please Verify Your Email Account !</h4>';
		}	
		
		echo json_encode($arr);	
		exit;
	}
	
	
	
	
	
	
	
	
}


