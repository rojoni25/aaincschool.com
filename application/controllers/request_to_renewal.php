<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_to_renewal extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('request_to_renewal_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	public function index()
	{
		$data['balance'] = $this->ObjM->get_current_balance();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result		=	$this->ObjM->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.date('d-m-Y',$result[$i]['request_send_time']).'</td>
						<td>'.$result[$i]['request_status'].'</td>
						
              		</tr>';
		}
		
			echo $html;
		
	}
	
	
	function send_request(){
		
		if($_POST['send_request']=='1'){
			if($_POST['renewal_usercode']!=''){
				$this->insert_request();	
			}
		}
		
		if(isset($_POST['find_key'])){
			$data['member'] = $this->ObjM->find_member($_POST['find_key']);
			if(!isset($data['member'][0])){
				$data['msg']='Invailed Key';
			}
			else{
				$data['pending_req'] = $this->ObjM->check_request($data['member'][0]['usercode']);
			}	
		}
		
		
		
		$data['balance'] = $this->ObjM->get_current_balance();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function insert_request(){
		
			
		$member=$this->ObjM->get_member_by_usercode($_POST['renewal_usercode']);
		$balance = $this->ObjM->get_current_balance();
		
		
		if($_POST['account_type']=='main_balance'){
			if($balance['main_balance'] < CW_MIN){
				echo 'company wallet have not enough balance';
				exit;
			}
		}
		
		if($_POST['account_type']=='personal_wallet'){
			if($balance['personal_wallet'] < PW_MIN){
				echo 'personal wallet have not enough balance';
				echo 'Balance not enough';
				exit;
			}
		}
		
	
		if($member[0]['status']=='Pending'){
			$check_request	 =	$this->ObjM->check_request_send($_POST['renewal_usercode']);
			$request['request_status']		=	'Done';
			if(!isset($check_request[0])){
				$this->send_request_upgrade($_POST['renewal_usercode']);
			}
			else{
				$data['payment']='Y';
				$data['payment_dt'] =	date('Y-m-d');
				$data['option']		=	'Request_Pay_Friend';
				$data['txn_id']		=	$this->session->userdata['logged_ol_member']['usercode'];
				$this->ObjM->update($data,'paid_request_master','requestcode',$check_request[0]['requestcode']);
				
			}
		}
		else{
				$request['request_status']		=	'Pending';
		}
		
		///Insert Request///
	
		$request['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
		$request['renewal_usercode']	=	$_POST['renewal_usercode'];
		$request['request_send_time']	=	time();
		
		$request_code=$this->ObjM->addItem($request,'request_to_renewal');
		
		///Withdrawal Balance///
		$this->ObjM->master_balance_update($_POST['account_type'],59);
		///Add Withdrawal Record///
		$data=array();
		$data['usercode'] 		= $this->session->userdata['logged_ol_member']['usercode'];
		$data['amount']   		= 59;
		$data['type']   		= 3;
		$data['option']   		= $request_code;
		$data['description']   	= 'renewed request to friend';
		$data['wallet_type']   	= $_POST['account_type'];
		$data['create_date']   	= date('Y-m-d');
		$data['timedt']			= time();
		$this->ObjM->addItem($data,'withdrawal_balance');
			
		$this->send_email($member);
		$this->session->set_flashdata('msg','Request Send Succesfuilly');
		header('Location: '.base_url().'index.php/request_to_renewal');
		exit;
		
	}
	
	protected function send_email($member){
		
		//**Email For Admin**//	
		// $message='<p>'.$this->session->userdata['logged_ol_member']['fullname'].' Send Request Payment for Reward Friend  <strong>'.$member[0]['fname'].' '.$member[0]['lname'].'</strong></p>';
		// $message.='<p>'.$this->session->userdata['logged_ol_member']['fullname'].' Usercode is <strong>'.$this->session->userdata['logged_ol_member']['usercode'].'</strong> and username <strong>'.$this->session->userdata['logged_ol_member']['username'].'</strong></p>';
		// $message.='<p>'.$member[0]['fname'].' '.$member[0]['lname'].' Usercode is <strong> '.$member[0]['usercode'].'</strong> and username <strong>'.$member[0]['username'].'</strong></p>';
		$message = get_email_cms_page_master('payment-for-reward-friend')->result()[0]->textdt;
		$message = str_replace("[ol-member-fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
		$message = str_replace("[member-fname]",$member[0]['fname'],$message);
		$message = str_replace("[member-lname]",$member[0]['lname'],$message);
		$message = str_replace("[ol-member-username]",$this->session->userdata['logged_ol_member']['username'],$message);
		$message = str_replace("[ol-member-usercode]",$this->session->userdata['logged_ol_member']['usercode'],$message);
		$message = str_replace("[member-username]",$member[0]['username'],$message);
		$message = str_replace("[member-usercode]",$member[0]['usercode'],$message);
	
		$e_array=array("heading"=>"Payment For Reward Friend","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($this->session->userdata['logged_ol_member']['admin_email']);
		// $this->email->subject('Payment For Reward Friend');
		// $this->email->message($message);
		// $this->email->send();
			sendemail(FROM_EMAIL,'Payment For Reward Friend',$this->session->userdata['logged_ol_member']['admin_email'],$message);
		
		
		//**Email For Member Self**//	
		if($this->session->userdata['logged_ol_member']['email_verification']=='Y'){
			$message='<p>You Are Send Request To Payment For  Reward Your Friend  <strong>'.$member[0]['fname'].' '.$member[0]['lname'].'</strong></p>';
			$e_array=array("heading"=>"Payment For Reward Friend","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($this->session->userdata['logged_ol_member']['emailid']);
			// $this->email->subject('Payment For Reward Friend');
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,'Payment For Reward Friend',$this->session->userdata['logged_ol_member']['emailid'],$message);
		}
		
		//**Email For Member**//	
		if($member[0]['email_verification']=='Y'){
			$message='<p>'.$this->session->userdata['logged_ol_member']['fullname'].' Send Request Payment for Reward You  <strong>('.$member[0]['fname'].' '.$member[0]['lname'].')</strong></p>';
			$e_array=array("heading"=>"Payment For Reward Friend","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($member[0]['emailid']);
			// $this->email->subject('Payment For Reward Friend');
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,'Payment For Reward Friend',$member[0]['emailid'],$message);
		}
		
		
		
	}
	
	
	protected function send_request_upgrade($usercode){
		$data=array();
		$data['usercode']	=	$usercode;
		$data['status']		=	'Active';
		$data['st_view']	=	'N';
		$data['payment']	=	'Y';
		$data['timedt']		=	strtotime(date('d-m-Y H:i:s'));
		$this->ObjM->addItem($data,'paid_request_master');
	}
	
	function remove_record($eid){
		$data=array();
		$data['request_status']	=	'Cancel';
		$data['update_time']	=	time();
		$this->ObjM->update($data,'request_to_renewal','request_code',$eid);
	}
	
		
	
}

