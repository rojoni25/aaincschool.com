<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_upgrade_pay extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_upgrade_pay_model','ObjM',TRUE);
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
	
	public function pif_remaining($eid)
	{
		
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_upgrade_pay_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing_active(){
		
		$result=$this->ObjM->list_for_no_send();
		$count=$this->ObjM->get_tot_count_no_send();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
		
			$btn='<a href="'.$result[$i]['idcode'].'" class="show-pop-event"><span class="label label-important">Pay</span></a>';
			
			$balance		=	'';
			$coin_balance	=	'';
			
			$row = array(
					$result[$i]['idcode'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					date('d-M-Y', $result[$i]['add_time']),
					$btn,
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	
	public function pif_send_report($eid)
	{
		
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_pif_send_report',$data);
		$this->load->view('comman/footer');
	}
	
	function listing_pif_report(){
		
		$result=$this->ObjM->pif_report_get();
		
		$count=$this->ObjM->get_tot_pif_report();
		
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => $count[0]['tot'],
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			$status=($result[$i]['active_id']=='0') ? "<span style='color:#F00;font-weight:bold'>Pending</span>" : "<span style='color:#690;font-weight:bold'>Active</span>";
			
			$row = array(
					$result[$i]['id'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					date('d-M-Y', $result[$i]['time_dt']),
					$result[$i]['msg'],
					$status,
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function upgrade_payment_form($idcode)
	{
		$result=$this->ObjM->member_for_pif($idcode);
		if(isset($result[0])){
			$html='<div class="pop-div-main">
					<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/payment_insert" method="POST" id="fpay">
					<input type="hidden" value="'.$result[0]['usercode'].'" name="usercode">
					<input type="hidden" value="'.$idcode.'" name="idcode">
					<table class="table table-striped table-bordered dataTable">
						<tr><td colspan="3"><h4>PIF For Member<h4></td></tr>
						<tr><td>Member Name</td><td></td><td>'.$result[0]['name'].'</td></tr>
						<tr><td>Usercode</td><td></td><td>'.$result[0]['usercode'].'</td></tr>
						<tr><td>Message</td><td></td><td><textarea id="txtmsg" name="txtmsg"></textarea></td></tr>
						<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Payment</strong></button></td></tr>
						<tr><td></td><td></td><td class="submit_process"></td></tr>
					</table>
			</form><div>';
		
		}else{
			$html='invalid';
		}
		echo $html;
		
	}
	
	function payment_insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$result=$this->ObjM->member_for_pif($_POST['idcode']);
			if(isset($result[0])){
				
				$data['usercode']	=	$result[0]['usercode'];
				$data['time_dt']	=	time();
				$data['msg']		=	$_POST['txtmsg'];
				
				$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_upgrade_pay');
				$this->withdrawal_balance($result[0]);
				$this->pif_email_to_admin($result[0]);
				
				$json['vali']		=	'true';
				$json['msg']		=	'<h5>Successfully Send PIF For <font style="color:#F00;">'.$result[0]['name'].'</font></h5>';
				
			}else{
				
				$json['vali']		=	'false';
				$json['msg']		=	'invalid request';
				
			}	
			echo json_encode($json);
		}	
		
		
	}
	
	
	protected function pif_email_to_admin($result){
		
	
			$admin_email_list=$this->ObjM->get_admin_email();
			$member_dt=$this->session->userdata['logged_ol_member'];
			
			// $message='<p>'.$member_dt['fullname'].' is PIF For '.$result['name'].' ('.$result['usercode'].')</p>';
			// $message.='<p>'.$_POST['txtmsg'].'</p>';
			// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
			$message = get_email_cms_page_master('pif_email_to_admin')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$result['usercode'],$message);
			$message = str_replace("[fname]",$member_dt['name'],$message);
			$message = str_replace("[lname]","",$message);
			$message = str_replace("[textmsg]",$_POST['txtmsg'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			$e_array=array("heading"=>"PIF R-Matrix","msg"=>$message,"contain"=>'');	
			
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email_list);
			// $this->email->subject('PIF R-Matrix');
			// $this->email->message($message);
			// $p=$this->email->send();
			sendemail(FROM_EMAIL,'PIF R-Matrix',$admin_email_list,$message);

	}
	
	protected function withdrawal_balance($result){
		
		$data['usercode']		=	$result['usercode'];
		$data['amount']			=	59;
		$data['wallet_type']	=	'RM';
	
		$data['timedt']			=	time();
		$data['textdt']			=	'PIF';
		$data['uby']			=	$this->session->userdata['logged_ol_member']['usercode'];
				
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_withdrawal');
		
	}
	
	
	
	
	
	
	
	
}

