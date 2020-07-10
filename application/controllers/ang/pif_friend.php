<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pif_friend extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
			$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/pif_friend_module','ObjM',TRUE);
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

		$data['html']=	$this->get_all_pif();
		
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/pif_friend_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	public function extra_position_popup()
	{
		$pay=$this->get_payment();
		
		if($pay['coin_balance']>=110){
			$html='<div class="pop-div-main">
			<form action="'.MATRIX_BASE.$this->uri->rsegment(1).'/add_request" method="POST" id="frequest">
			<table class="table table-striped table-bordered dataTable">
			<tr><td colspan="3"><h4>PIF For Friend</h4></td></tr>
			<tr><td>Find Friend</td><td></td><td><input type="text" name="meberserch" id="meberserch" placeholder="Usercode, Name" style="margin-bottom:0px;"/>  <a href="#" class="btnsearch"><span class="label label-important">Find</span></a></td></tr>
			<tr><td>Friend</td><td></td><td class="tr_result">No Select</td></tr>
			<tr><td>Message</td><td></td><td><textarea id="txtmsg" name="txtmsg"></textarea></td></tr>
			<tr class="tr_submit_tr"><td></td><td></td><td><button type="submit" class="btn btn-success btnsubmit"><strong>Send</strong></button></td></tr>
			<tr><td></td><td></td><td class="submit_process"></td></tr>
			</table>
			</form><div>';
		}else{
			$html='<h4>Not Enough Balance</h4>';
		}
		echo $html;
	}
	
	
	
	function add_request()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
				$pay=$this->get_payment();
				if($pay['coin_balance']>=110)
				{
					if(isset($_POST['sel_user']) && $_POST['sel_user']!=''){
						
						$this->insert_request();
						
						$this->withdrawal_balance();
						
						$this->pif_email_to_admin();
						
						
						$json['html']		=	$this->get_all_pif();
						$json['msg']		=	'<h4>PIF Successfully</h4>';
						echo json_encode($json);
					}
					
				}else{
					$json['msg']		=	'<h4>Not Enough Balance</h4>';
				}
				
		}	
	}
	
	function get_all_pif(){
		$result	=	$this->ObjM->get_all_pif();	
		$html='';
		
		for($i=0;$i<count($result);$i++){
			$no=$i+1;
			$html.='<tr>
						<th>'.$no.'</th>
						<th>'.$result[$i]['name'].'</th>
						<th>'.$result[$i]['usercode'].'</th>
						<th>'.date('d-m-Y',$result[$i]['request_time']).'</th>
						<th>'.$result[$i]['msg'].'</th>
					</tr>';
		}
		return $html;
	}
	
	function find_member($filter)
	{
		$filter=urldecode($filter);
		$filter = preg_replace('/\s\s+/', ' ',$filter);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->member_search($filter);
	
		if(isset($user[0])){
			$html='<strong>'.$user[0]['name'].' ('.$user[0]['usercode'].')</strong><input type="hidden" name="sel_user" id="sel_user" value="'.$user[0]['usercode'].'">';
		}
		else{
			$html='Not Found';
		}
		echo $html;
	}
	
	
	 protected function get_payment(){
	
		$coin_pay			=	$this->ObjM->get_payment_sum_by_type();
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type();
		
		$arr=array(
			'coin_pay'			=>	$coin_pay,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
		);
	
		return $arr;	
	
	}
	
	
	protected function insert_request($pif_id){
		
		$data['usercode']		=	$_POST['sel_user'];
		$data['msg']			=	$_POST['txtmsg'];
		$data['request_time']	=	time();
		$data['status']			=	"P";
		$data['req_type']		=	"PIF";
		$data['pif_by']			=	$this->session->userdata["logged_ol_member"]['usercode'];
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'matrix_request');
		
	}
	
	
	protected function pif_email_to_admin(){
		
	
			$admin_email_list	=	$this->ObjM->get_admin_email();
			$member_dt			=	$this->session->userdata['logged_ol_member'];
			$result				=	$this->ObjM->get_member_by_code($_POST['sel_user']);
			// $message='<p>'.$member_dt['fullname'].' is R-Matrix PIF For '.$result['fname'].' '.$result['lname'].' ('.$result['usercode'].')</p>';
			// $message.='<p>'.$_POST['txtmsg'].'</p>';
			// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
			$message = get_email_cms_page_master('pif_email_to_admin')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$result['usercode'],$message);
			$message = str_replace("[fname]",$result['fname'],$message);
			$message = str_replace("[lname]",$result['lname'],$message);
			$message = str_replace("[textmsg]",$_POST['txtmsg'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			
			$e_array=array("heading"=>"PIF R-Matrix","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email_list);
			// $this->email->subject('PIF R-Matrix');
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,'PIF R-Matrix',$admin_email_list,$message);

	}
	
	protected function withdrawal_balance(){
		
		$data['usercode']		=	$this->session->userdata["logged_ol_member"]['usercode'];
		$data['amount']			=	110;
		$data['wallet_type']	=	'COIN';
		$data['option']			=	$_POST['sel_user'];
		$data['timedt']			=	time();
		$data['textdt']			=	'PIF For Friend';
		$data['uby']			=	$this->session->userdata['logged_ol_member']['usercode'];
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_withdrawal');
		
	}

	
	
}


