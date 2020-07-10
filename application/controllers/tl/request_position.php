<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_position extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/request_position_module','ObjM',TRUE);
			
   		
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

		$data['pending_request']=	$this->get_panding_request();
		$data['accept_result']	=	$this->ObjM->get_all_accept_request();
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/request_position_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	public function extra_position_popup()
	{
		$html='<div class="pop-div-main">
		<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/add_extra_postion" method="POST" id="frequest">
		<table class="table table-striped table-bordered dataTable">
		<tr><td colspan="3"><h4>Request Send For Extra Position</h4></td></tr>
		<tr><td>Message</td><td></td><td><textarea id="txtmsg" name="txtmsg"></textarea></td></tr>
		<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Send</strong></button></td></tr>
		<tr><td></td><td></td><td class="submit_process"></td></tr>
		</table>
		</form><div>';
		echo $html;
	}
	
	function add_extra_postion()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		
				
			$data['usercode']		=	$this->session->userdata["logged_ol_member"]['usercode'];
			$data['msg']			=	$_POST['txtmsg'];
			$data['request_time']	=	time();
			$data['status']			=	"P";
			$data['req_type']		=	"Multi";

			$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'matrix_request');
			
			$json['html']		=	$this->get_panding_request();
			$json['msg']		=	'<h4>Successfully Send</h4>';
				
			echo json_encode($json);
		}	
	}
	
	function get_panding_request(){
		$pending_result	=	$this->ObjM->get_all_pending_request();	
		$html='';
		
		for($i=0;$i<count($pending_result);$i++){
			$status=($pending_result[$i]['status']=='C') ? "Request Cancel" : "Request Pending";
			$no=$i+1;
			$html.='<tr><th>'.$no.'</th><th>'.date('d-m-Y',$pending_result[$i]['request_time']).'</th><th>'.$pending_result[$i]['msg'].'</th><th>'.$status.'</th></tr>';
		}
		return $html;
	}
	

	
	
}


