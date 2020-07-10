<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_withdrawal extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_withdrawal_model','ObjM',TRUE);
		$this->load->library('email');
		$this->load->library('pagination');
			
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
	
	public function request($eid)
	{
		
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_withdrawal_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing(){
		
		$result=$this->ObjM->get_all_pending_request();
		$html='';
		for($i=0;$i<count($result);$i++){
		
			$btn='<a href="'.$result[$i]['req_id'].'" class="show-pop-event"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;&nbsp;';
			$btn.='<a class="delete_request" href="'.MATRIX_BASE.$this->uri->rsegment(1).'/delete_request/'.$result[$i]['req_id'].'" class="show-pop-event"><span class="label label-important">Delete</span></a>';
			$btn.='<a class="notification_link" href="'.MATRIX_BASE.'r_matrix_notification/popup/'.$result[$i]['usercode'].'"><i class="icon-bell-alt"></i></a>';
			
			$html.='<tr>
				<td>'.$result[$i]['req_id'].'</td>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['amount'].'</td>
				<td>'.date('d-M-Y', $result[$i]['time_dt']).'</td>
				<td>'.$result[$i]['msg'].'</td>
				<td>'.$btn.'</td>
			</tr>';
		}
		echo $html;
	}
	
	
	function report()
	{
		$data['html']		=	$this->report_html();
		$p=$this->ObjM->count_withdrawal_report();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_withdrawal_report',$data);
		$this->load->view('comman/footer');
	}
	
	function report_html(){
		
		$html='';
		
		$result		=	$this->ObjM->withdrawal_report();	
	//echo "<pre>";	print_r($result); exit();
		
		for($i=0;$i<count($result);$i++){
			$html.='<tr>
					<td>'.$result[$i]['id'].'</td>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
					<td>'.$result[$i]['amount'].'</td>
					<td>'.$result[$i]['timedt'].'</td>
				</tr>';	
		}
		return $html;
	}
	
	
	function popover_form($eid)
	{
		$result=$this->ObjM->get_pending_request_by_id($eid);
		
		$pay=$this->get_payment($result[0]['usercode']);
		
		$amount=(float)$result[0]['amount'];
		
		
		
		if(isset($result[0])){
			
			if($pay['coin_balance'] < $amount ){
				
				$html='<h5>Not Enough Wallet Balance <br><br>Wallet Balance : <font style="color:#AE1919;">$'.number_format($pay['coin_balance'],2).'</font></h5> ';
				echo $html;
				exit;
				
			}
			else{
					$html='<div class="pop-div-main">
					<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/payment_insert" method="POST" id="fpay">
					<input type="hidden" value="'.$result[0]['req_id'].'" name="req_id">
					<table class="table table-striped table-bordered dataTable">
					<tr><td colspan="3"><h4>Member Withdrawal Request<h4></td></tr>
					<tr><td width="34%">Member Name</td><td width="1%"></td><td width="65%">'.$result[0]['name'].'</td></tr>
					<tr><td>Usercode</td><td></td><td>'.$result[0]['usercode'].'</td></tr>
					<tr><td>Current Cash Wallet</td><td></td><td>$'.number_format($pay['coin_balance'],2).'</td></tr>
					<tr><td>Withdrawal Request</td><td></td><td>$'.number_format($amount,2).'</td></tr>
					<tr><td>Message</td><td></td><td>'.$result[0]['msg'].'</td></tr>
					<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Approve</strong></button></td></tr>
					<tr><td></td><td></td><td class="submit_process"></td></tr>
					</table>
					</form><div>';
				echo $html;
				exit;
			}
		
		}else{
				$html='invalid';
				echo $html;
				exit;
		}
		
	}
	
	function payment_insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$result=$this->ObjM->get_pending_request_by_id($_POST['req_id']);
			
			
			
			
			if(isset($result[0])){
				
				$pay=$this->get_payment($result[0]['usercode']);
				
				
				$amount=(float)$result[0]['amount'];
				
				if($pay['coin_balance'] >= $amount ){
						
					$this->withdrawal_balance($result[0]);
					
					if($this->ObjM->check_member_email($result[0]['usercode'])){
						$this->email_to_member($result[0]);
					}
					
					
					$data=array();
					$data['status']		=	'A';
					$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'member_withdrawal_request','req_id',$result[0]['req_id']);
					
					$json['vali']		=	'true';
					
					$json['msg']		=	'<h5>Successfully</h5>';
					
				}else{
					
					$json['vali']		=	'false';
					$json['msg']		=	'<h5>Not Enough Wallet Balance <br><br>Wallet Balance : <font style="color:#AE1919;">$'.number_format($pay['coin_balance'],2).'</font></h5>';	
					
				}	
				
				
			}else{
				$json['vali']		=	'false';
				$json['msg']		=	'<h5>Invalid</h5>';		
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
			sendemail(FROM_EMAIL,'withdrawal Request Approve',$result['emailid'],$message);


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
	
	function delete_request($eid){
		$data=array();
		$data['status']		=	'C';
		$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'member_withdrawal_request','req_id',$eid);	
	}
	
	
	
	
	
	
	
}

