<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_message extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_message_model','ObjM',TRUE);
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
	
	public function inbox()
	{
	
		$data['title']			=	'Inbox';
		$data['html']			=	$this->get_receive();
		
		$info=array();
		$info['read_status']	=	1;
		$this->ObjM->change_read_status($info);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_message_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function get_receive()
	{
		$rt 	=	$this->ObjM->get_messsage_receive();
		$arr=array('alert-error','alert-success','alert-info');
		$html='';
		for($i=0;$i<count($rt);$i++)
		{
			
			$html.='<div class="alert noto-div read_status'.$rt[$i]['read_status'].'">
					<p class="noti-date">'.date('jS F Y',$rt[$i]['time_dt']).' <sub>'.ago_time(date('d-m-Y H:i:s',$rt[$i]['time_dt'])).'</sub></p>
					<button type="button" class="close btn-delete" data-dismiss="alert" value="'.$rt[$i]['id'].'">&times;</button>
					'.$rt[$i]['msg'].'<br>
					<ul class="list_um">
						<li>Member Name :<strong>'.$rt[$i]['name'].'</strong></li>
						<li>Member ID :<strong>'.$rt[$i]['send_from'].'</strong></li>
						
						<li><a class="show-pop-event" href="'.MATRIX_BASE.$this->uri->rsegment(1).'/popover_form/'.$rt[$i]['id'].'/receive"><i class="icon-share-alt"></i></a></li>
						 
					</ul>
					<div style="clear:both;overflow:hidden;"></div>
			</div>';
		}
		return $html;			

	}
	
	
	public function outbox()
	{
		$data['title']	=	'Outbox';
		$data['html']	=	$this->get_send_msg();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_message_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function get_send_msg()
	{
		$rt 	=	$this->ObjM->get_send_msg();
		$arr=array('alert-error','alert-success','alert-info');
		$html='';
		for($i=0;$i<count($rt);$i++)
		{
			
			$html.='<div class="alert noto-div">
					<p class="noti-date">'.date('jS F Y',$rt[$i]['time_dt']).' <sub>'.ago_time(date('d-m-Y H:i:s',$rt[$i]['time_dt'])).'</sub></p>
					<button type="button" class="close btn-delete" data-dismiss="alert" value="'.$rt[$i]['id'].'">&times;</button>
					'.$rt[$i]['msg'].'<br>
					<ul class="list_um">
						<li>Member Name :<strong>'.$rt[$i]['name'].'</strong></li>
						<li>Member ID :<strong>'.$rt[$i]['send_to'].'</strong></li>
						
						<li><a class="show-pop-event" href="'.MATRIX_BASE.$this->uri->rsegment(1).'/popover_form/'.$rt[$i]['id'].'/send"><i class="icon-share-alt"></i></a></li>
						 
					</ul>
					<div style="clear:both;overflow:hidden;"></div>
			</div>';
		}
		return $html;			

	}
	
	function compose(){
		$data['title']	=	'Compose';
		$data['member']	=	$this->ObjM->get_all_member();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_message_send',$data);
		$this->load->view('comman/footer');	
	
	}
	
	function popover_form($eid,$send)
	{
		$result=$this->ObjM->get_message_by_id($eid);
		$id=($send=='receive')?$result[0]['send_from']:$result[0]['send_to'];
		$html='<div class="pop-div-main">
		<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/message_insert" method="POST" id="fpay">
		<input type="hidden" value="'.$id.'" name="send_to">
		<table class="table table-striped table-bordered dataTable">
		<tr><td colspan="3"><h4>Send Message<h4></td></tr>
		<tr><td>Message</td><td></td><td><textarea name="txtmsg" id="txtmsg"></textarea></td></tr>
		<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Send</strong></button></td></tr>
		<tr><td></td><td></td><td class="submit_process"></td></tr>
		</table>
		</form><div>';
		echo $html;
	}
	
	function message_insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$data['send_from']	=	'-1';
			$data['send_to']	=	$_POST['send_to'];
			$data['time_dt']	=	time();
			$data['msg']		=	$_POST['txtmsg'];
			$data['status_to']	=	'Active';
			$data['status_from']=	'Active';
			$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'message');
				
			$json['vali']		=	'true';
			$json['msg']		=	'<h4>Successfully Send</h4>';
			
			if($_POST['send_form']=='compose'){
				header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/outbox/');
				exit;
			}	
			echo json_encode($json);	
		}	
		
	}
	
	
	protected function email_to_member($result){
	
			// $message='<p>Hello, '.$result['name'].' Approve Your Withdrawal Request <br />Withdrawal Amount $'.$result['amount'].' <br />Time '.date('d-m-Y H:i').'</p>';
			$message = get_email_cms_page_master('withdrawal-request-approve')->result()[0]->textdt;
			$message = str_replace("[name]",$result['name'],$message);
			$message = str_replace("[amount]",$result['amount'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			
			$e_array=array("heading"=>"withdrawal Request Approve","msg"=>$message,"contain"=>'');
			
			$message=email_template_one($e_array);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($result['emailid']);
			// $this->email->subject('withdrawal Request Approve');
			// $this->email->message($message);
			// $p=$this->email->send();
			$resp_code = sendemail(FROM_EMAIL,'withdrawal Request Approve',$result['emailid'],$message);
			$p=($resp_code>=200 && $resp_code<=299);

	}
	
	protected function withdrawal_balance($result){
		
		$data['usercode']		=	$result['usercode'];
		$data['amount']			=	$result['amount'];
		$data['wallet_type']	=	'COIN';
		$data['type']			=	'1';
		$data['timedt']			=	time();
		$data['textdt']			=	'Request Withdrawal';
		$data['req_id']			=	$result['req_id'];
		
		$data['uby']			=	$this->session->userdata['logged_ol_member']['usercode'];
				
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_withdrawal');
		
	}
	
	
	
	 protected function get_payment($eid){
		$coin_pay			=	$this->ObjM->get_payment_sum_by_type($eid);
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type($eid);
		$arr=array(		
			'coin_pay'			=>	$coin_pay,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
		);
		
		return $arr;	
		
	}	
	
	function delete_inbox($eid){
		$data=array();
		$data['status_to']	=	'Delete';
		$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'message','id',$eid);	
	}
	
	
	
	
	
	
	
}

