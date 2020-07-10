<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal_request extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		$this->load->model('pdl/admin/withdrawal_request_model','ObjM',TRUE);
		
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
 	}
	
	public function view($eid)
	{
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/withdrawal_request_view',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		
		$result=$this->ObjM->get_all_pending_request();
		$html='';
		for($i=0;$i<count($result);$i++){
		
			$btn='<a href="'.$result[$i]['request_code'].'" class="show-pop-event"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;&nbsp;';
			$btn.='<a class="delete_request" href="'.base_url().'index.php/pdl/'.$this->uri->rsegment(1).'/delete_request/'.$result[$i]['request_code'].'" class="show-pop-event"><span class="label label-important">Delete</span></a>';
			
			
			if($result[$i]['wallet_type']=='pdl_1'){
				$wallet_nm="Wallet-1";
			}
			
			elseif($result[$i]['wallet_type']=='pdl_2'){
				$wallet_nm="Wallet-2";
			}
			
			elseif($result[$i]['wallet_type']=='opp_wallet'){
				$wallet_nm="Referral Wallet";
			}
			
			
			
			$html.='<tr>
				<td>'.$result[$i]['request_code'].'</td>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['amount'].'</td>
				<td>'.$wallet_nm.'</td>
				<td>'.date('d-M-Y', $result[$i]['time_dt']).'</td>
				<td>'.$result[$i]['msg'].'</td>
				<td>'.$btn.'</td>
			</tr>';
		}
		echo $html;
	}
	
	function popover_form($eid){
		
		$this->load->library('pdl_admin_class');
		
		$result		=	$this->ObjM->get_pending_request_by_code($eid);
		
		$amount=(float)$result[0]['amount'];
		
		if(isset($result[0]))
		{	
			$this->pdl_admin_class->set_payment($result[0]['usercode']);
			
			
			
			if($result[0]['wallet_type']=='pdl_1'){
				$wallet_nm="Wallet-1";
				$max_lable='max_withdrawal_1';
			}
			
			elseif($result[0]['wallet_type']=='pdl_2'){
				$wallet_nm="Wallet-2";
				$max_lable='max_withdrawal_2';
			}
			
			elseif($result[0]['wallet_type']=='opp_wallet'){
				$wallet_nm="Referral Wallet";
				$max_lable='max_withdrawal_3';
			}
			
			if($amount > $this->pdl_admin_class->get_value($max_lable)){
					$html='<h5>Not Enough Balance ('.$wallet_nm.') <br><br>Wallet Balance : <font style="color:#AE1919;">$'.number_format($this->pdl_admin_class->get_value($max_lable),2).'</font></h5> ';
					echo $html;
					exit;
			}	
			
			
			
			///////////
			$html='<div class="pop-div-main">
				<form action="'.base_url().'index.php/pdl/'.$this->uri->rsegment(1).'/payment_insert" method="POST" id="frm_pay">
				<input type="hidden" value="'.$result[0]['request_code'].'" name="request_code">
				<table class="table table-striped table-bordered dataTable">
				<tr><td colspan="3"><h4>Member Withdrawal Request<h4></td></tr>
				<tr><td>Wallet</td><td></td><td>'.$wallet_nm.'</td></tr>
				<tr><td width="34%">Member Name</td><td width="1%"></td><td width="65%">'.$result[0]['name'].'</td></tr>
				<tr><td>Usercode</td><td></td><td>'.$result[0]['usercode'].'</td></tr>
				<tr><td>Current Balance ('.$wallet_nm.')</td><td></td><td>$'.number_format($this->pdl_admin_class->get_value($max_lable),2).'</td></tr>
				<tr><td>Withdrawal Request</td><td></td><td>$'.number_format($amount,2).'</td></tr>
				<tr><td>Message</td><td></td><td>'.$result[0]['msg'].'</td></tr>
				<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Approve</strong></button></td></tr>
				<tr><td></td><td></td><td class="submit_process"></td></tr>
				</table>
				</form><div>';
			echo $html;
			exit;
			///////////
			
			
			
		}
		
		
	}
	

	
	function payment_insert(){
		
		$this->load->library('pdl_admin_class');
		$result		=	$this->ObjM->get_pending_request_by_code($_POST['request_code']);
		$amount		=	(float)$result[0]['amount'];
		if(isset($result[0]))
		{
			$this->pdl_admin_class->set_payment($result[0]['usercode']);
			
			
			if($result[0]['wallet_type']=='pdl_1'){
				$wallet_nm="Wallet-1";
				$max_lable='max_withdrawal_1';
			}
			
			elseif($result[0]['wallet_type']=='pdl_2'){
				$wallet_nm="Wallet-2";
				$max_lable='max_withdrawal_2';
			}
			
			elseif($result[0]['wallet_type']=='opp_wallet'){
				$wallet_nm="Referral Wallet";
				$max_lable='max_withdrawal_3';
			}
			
			
			if($this->pdl_admin_class->get_value($max_lable)>=$amount){
				
				$this->withdrawal_balance($result[0]);		
				
		
				$json['vali']		=	'true';
				$json['msg']		=	'<h5>Successfully</h5>';
			}
			else{
				$json['vali']		=	'false';
				$json['msg']		=	'<h5>Not Enough Wallet Balance <br><br>Wallet Balance : <font style="color:#AE1919;">$'.number_format($this->pdl_admin_class->get_value($max_lable),2).'</font></h5>';
			}
		}else
		{
			$json['vali']		=	'false';
			$json['msg']		=	'<h5>Invalid</h5>';		
		}
		
		echo json_encode($json);
	}
	
	protected function withdrawal_balance($result){
		
		$data=array();
		$data['usercode']		=	$result['usercode'];
		$data['amount']			=	$result['amount'];
		$data['wallet_type']	=	$result['wallet_type'];
		$data['type']			=	'1';
		$data['timedt']			=	time();
		$data['textdt']			=	'Request Withdrawal';
		$data['request_code']	=	$result['request_code'];
		$data['uby']			=	$this->session->userdata['logged_ol_member']['usercode'];	
		$this->ObjM->addItem($data,'pdl_withdrawal');
		
	}
	
	function delete_request($eid){
		$data=array();
		$data['status']		=	'delete';
		$this->ObjM->update($data,'pdl_withdrawal_request','request_code',$eid);	
	}
	
	function pdl_to_opp_payment()
	{
		$data['result']=$this->ObjM->pdl_to_opp_payment();	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/auto_payment_report_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

