<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rm_page extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('rm_page_module','ObjM',TRUE);
   		$this->load->library('email');
 	}
	
	
	
	public function view()
	{
	
		if(isset($_REQUEST['kdk_code'])){
			$data['page_msg']	=	$this->skd_code_check();
		}	
		$data['contain']	=	$this->ObjM->get_pages_contain($_REQUEST['page_key']);
		$data['rm_check']	=	$this->check_r_matrix_position();
		
		if(isset($data['contain'][0])){
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('r_matrix_member/rm_member_page',$data);
			$this->load->view('comman/footer');	
		}
		
	}
	
	
	
	
	
    protected function skd_code_check(){
		
		$result=$this->ObjM->get_kdk_code($_REQUEST['kdk_code']);
	
		if(isset($result[0]))
		{
			$this->insert_ksd_code_use();
			header('Location: '.base_url().'index.php/rm_martix/view/');
			exit;			
		}
		else{
			
			$sdk_msg="Invalid Code";
			return $sdk_msg;
			
		}
	
	}
	
	protected function insert_ksd_code_use(){
			$data=array();
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']			=	time();
			$data['kdk_code']		=	$_POST['kdk_code'];
			$this->ObjM->addItem($data,'rm_kdk_code_use');	
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
	
	function edit_page($secret_page_code){
		$permission=$this->ObjM->get_permission($secret_page_code);
		if(!isset($permission[0])){
			header('Location: '.base_url().'index.php/scompany');
			exit;
		}
		$data['result']=$this->ObjM->get_pages_contain_by_id($secret_page_code);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('scompany_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$permission=$this->ObjM->get_permission($this->input->post('eid'));
			if(isset($permission[0]))
			{
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$data = array();
		
				$data['page_title']		=	$this->input->post('page_title');
				$data['video_link']		=	$this->input->post('video_link');
				$data['contain']		=	$this->input->post('contain');
			
				$data['update_date']	=	$nowdt;	
				$data['update_by']		=	$this->session->userdata['logged_ol_member']['usercode'];
			
				$this->ObjM->update($data,'compay_secret_page','secret_page_code',$this->input->post('eid'));	
			}
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/show/'.$this->input->post('page_key'));
			exit;	
			
		}
	}
	
	
	function r_matrix()
	{
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$result=$this->ObjM->get_kdk_code($_POST['kdk_code']);
		
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
		
		$kdk_code	=	$this->ObjM->check_kdk_code();
		
		$inter_code	=	$this->ObjM->check_code_intered();
	
		$arr		=	array('in_tree' => $in_tree,'in_kdk' => $kdk_code,'code'=>$inter_code[0]['kdk_code']);
		
		return $arr;
	}
	
	
	function request_kdk_popup(){
		if($this->ObjM->check_kdk_code_request()){
			$html	=	'<h4>Your Request Is Aready Send</h5>';
			echo $html;
			exit;
		}
		if($this->ObjM->check_member_email()){
			$html='<div class="pop-div-main">
			<form action="'.base_url().'index.php/'.$this->uri->segment(1).'/request_for_kdk_code" method="POST" id="send_request_frm">
			<table class="table table-striped table-bordered dataTable">
			<tr><td colspan="3"><h4>Request For KDK Code</h4></td></tr>
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
	
	
	function request_for_kdk_code(){
		
		if($this->ObjM->check_kdk_code_request()){
			$arr['msg']='<h4>Your Request Is Aready Send</h5>';
			echo json_encode($arr);
			exit;
		}
		
		if($this->ObjM->check_member_email()){
			
			$member_dt=$this->session->userdata['logged_ol_member'];
			$admin_email_list=$this->ObjM->get_rm_admin_email();
			
			// $message='<p>Name	:'.$member_dt['fullname'].' ('.$member_dt['usercode'].') Is Send Request For KDK Code</p>';
			// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
			$message = get_email_cms_page_master('kdk_code_request')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$member_dt['usercode'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			$e_array=array("heading"=>"KDK Code Request","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			
		
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email_list);
			// $this->email->subject('KDK Code Request');
			// $this->email->message($message);
			// $p=$this->email->send();

			sendemail(FROM_EMAIL,'KDK Code Request',$admin_email_list,$message);
	
		
			$data=array();
			$data['usercode']	=	$member_dt['usercode'];
			$data['msg']		=	$_POST['txtmsg'];
			$data['timedt']		=	time();
			$data['status']		=	'Active';
			$this->ObjM->addItem($data,'rm_kdk_code_request');
			$arr['msg']='<h4>KDK Code Request Is Send Successfully</h4>';
			
		}
		else{			
			$arr['msg']='<h4>Please Verify Your Email Account !</h4>';
		}	
		
		echo json_encode($arr);	
		exit;
	}
	
	
	
	
	
	
	
	
}


