<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_notification extends CI_Controller { 
		
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["r_matrix_admin"]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_notification_model','ObjM',TRUE);
		
		$this->load->library('email');
 	}
	
	function popup($usercode)
	{
		$result=$this->ObjM->get_member_by_code($usercode);
		$html='<div class="pop-div-main">
		<form action="'.base_url().'index.php/r_matrix_notification/insert" method="POST" id="notification_send">
		<input type="hidden" value="'.$result[0]['usercode'].'" name="usercode">
		<table class="table table-striped table-bordered dataTable">
		<tr><td colspan="3"><h4>Notification<h4></td></tr>
		<tr><td width="34%">Member Name</td><td width="1%"></td><td width="65%">'.$result[0]['name'].' ('.$result[0]['usercode'].')</td></tr>
		<tr><td>Subject</td><td></td><td><input type="text" name="noti_subject" id="noti_subject" placeholder="Enter Subject" value="" /></td></tr>
		<tr><td>Message</td><td></td><td><textarea name="noti_description" id="noti_description" style="width:90%;height:180px;resize:none;"  placeholder="Enter Message"></textarea></td></tr>
		<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Approve</strong></button></td></tr>
		<tr><td></td><td></td><td class="submit_process"></td></tr>
		</table>
		</form><div>';
		echo $html;
		exit;	
	}
	
	function insert(){
		
		if($_POST['usercode']=='' || $_POST['noti_description']==''){
			$arr['msg']='Invailed Request';
			echo json_encode($arr);
			exit;
		}
		
		$data=array();
		$data['usercode']		=	$_POST['usercode'];
		$data['title']			=	$_POST['noti_subject'];
		$data['description']	=	$_POST['noti_description'];
		$data['time_dt']		=	time();
		$data['date_dt']		=	strtotime(date('d-m-Y'));
		$data['status_receiver']=	'Unread';
		$data['status_sender']	=	'Active';
	
		$this->ObjM->addItem($data,'rm_notification');
		
		$this->send_email();
			
		$arr['msg']='Notification Send';
		echo json_encode($arr);
		exit;
	
		
	}
	
	
	protected function send_email()
	{
		
		$result		=	$this->ObjM->get_member_by_code($_POST['usercode']);
		
		$subject	=	($_POST['noti_subject']!='') ? $_POST['noti_subject'] : 'Admin Notification KDK';	
	
		$message='<p>'.$_POST['noti_description'].'</p>';
		$e_array=array("heading"=>$subject,"msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
	
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($result[0]['emailid']);
		// $this->email->subject($subject);
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,$subject,$result[0]['emailid'],$message);
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

