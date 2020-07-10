<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class re_payment extends CI_Controller {

	protected $paymentcode		=	'';
	protected $usercode			=	'';
	protected $amount			=	'';
	protected $type				=	'';
	protected $master_type		=	'';
	protected $adminfee			=	'0';
		
	function __construct()
 	{
   		parent::__construct(); 
   		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->session->userdata('ses_pay')){header('Location: '.base_url().'');exit;}
		$this->load->model('re_payment_model','ObjM',TRUE); 
		$this->load->library('email');
 	}

	public function index()
	{
		
		if($this->session->userdata['ses_pay']['payment_status']!='Completed'){
			header('Location: '.base_url().'');
			exit;	
		}
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
			
		$online_pay 	= $this->ObjM->get_online_payment_record();
		$package_amount = $this->ObjM->get_setting_by_lable('package_amount');
		
		if(!isset($online_pay[0]))
		{
			exit;
		}
		
		if(time() > $this->session->userdata['logged_ol_member']['due_time']){
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$this->session->userdata['logged_ol_member']['due_time']);
		}
		
		$pay_option		=	json_decode($online_pay[0]['option'],TRUE);
		
		if($pay_option['mc_gross'] == 63 && $pay_option['payment_status']=='Completed')
		{
			//close old payment
			$data = array();
			$data['status']	=	'Close';
			$this->ObjM->update($data,'payment_master','usercode',$this->session->userdata['logged_ol_member']['usercode']);
			
			//update due date
			$data = array();
			$data['due_time']	=	$due_time;
			$this->ObjM->update($data,'membermaster','usercode',$this->session->userdata['logged_ol_member']['usercode']);
			
			$data = array();
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];	
			$data['amount']			=	$package_amount;
			$data['paydate']		=	$nowdt;
			$data['pay_day']		=	date('d');
			$data['pay_month']		=	date('m');
			$data['pay_year']		=	date('Y');
			$data['timedt']			=	time();
			$data['due_time']		=	strtotime('+1 month',time());
			$data['status']			=	'Open';
			$data['txn_id']			=	$pay_option['txn_id'];
			$data['option']			=	$online_pay[0]['option'];
			$data['payment_type']	=	'paypal';
			$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
			$this->monthly_payment();
			$this->coded_residual();
			//***Update Due Time****//
			$usersession	=	$this->session->userdata['logged_ol_member'];
			$usersession['due_time']		=	$due_time;
			$usersession['payment_done']	=	'Y';
			$this->session->set_userdata('logged_ol_member', $usersession);
			
			//***Unset payment array****//
			
			$this->session->unset_userdata('ses_pay');
			$this->send_email_admin_member();
			$this->send_email_friend();
			header('Location: '.base_url().'index.php/show_msg/payment_done');
			exit;
			
		}
	}
	
	protected function coded_residual()
	{
		$coded					=	$this->ObjM->get_setting_by_lable('enrollment_code');
		$coded_match			=	$this->ObjM->get_setting_by_lable('enrollment_code_match');
		$residual_amount		=	$this->ObjM->get_setting_by_lable('codded_residual');
		$residual_match_amount	=	$this->ObjM->get_setting_by_lable('coded_residual_match');
		
		
		
		$member	=	$this->ObjM->get_coded_residual($this->session->userdata['logged_ol_member']['usercode']);
		
		for($i=0;$i<count($member);$i++){
			
			$this->usercode		=	$member[$i]['usercode_by'];
			$this->master_type	=	'main_balance';
			if($member[$i]['type']=='residual'){
				$this->amount		=	$residual_amount;
				$this->type			=	'residual';
			}
			elseif($member[$i]['type']=='residual_match'){
				$this->amount		=	$residual_match_amount;
				$this->type			=	'residual_match';
			}
			elseif($member[$i]['type']=='coded'){
				$this->amount		=	$coded;
				$this->type			=	'coded';
			}
			elseif($member[$i]['type']=='coded_match'){
				$this->amount		=	$coded_match;
				$this->type			=	'coded_match';
			}
			$this->payment_insert();
		}
		
	}
	
	protected function monthly_payment()
	{
		$now 	= 	time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$admin_pay				=	$this->ObjM->get_setting_by_lable('default_commission_to_admin');
		
		$commission1			=	$this->ObjM->get_setting_by_lable('commission_level1');
		$commission2			=	$this->ObjM->get_setting_by_lable('commission_level2');
		$commission3			=	$this->ObjM->get_setting_by_lable('commission_level3');
		
		$virtual1				=	$this->ObjM->get_setting_by_lable('virtual_balance_level1');
		$virtual2				=	$this->ObjM->get_setting_by_lable('virtual_balance_level2');
		$virtual3				=	$this->ObjM->get_setting_by_lable('virtual_balance_level3');
		
		
		
		$level_one				=	$this->ObjM->tree_upling($this->session->userdata['logged_ol_member']['usercode']);
		$level_two				=	$this->ObjM->tree_upling($level_one[0]['ucode']);
		$level_three			=	$this->ObjM->tree_upling($level_two[0]['ucode']);
		
		
	
		//*******Level One Payment*******//
		$ucode=(isset($level_one[0]['ucode']) ? $level_one[0]['ucode'] : '0');
		
		$this->usercode		=	$ucode;
		$this->amount		=	$commission1[0]['setting_value'];
		$this->type			=	'monthly';
		$this->master_type	=	'main_balance';
		$this->payment_insert();
				
		$this->type			=	'3by3';
		$this->master_type	=	'3by3';
		$this->amount		=	$virtual1[0]['setting_value'];
		$this->payment_insert();
		
		//*******Level Two Payment*******//
		$ucode=(isset($level_two[0]['ucode']) ? $level_two[0]['ucode'] : '0');
		$this->usercode		=	$ucode;
		$this->amount		=	$commission2[0]['setting_value'];
		$this->type			=	'monthly';
		$this->master_type	=	'main_balance';
		$this->payment_insert();
				
		$this->type			=	'5by3';
		$this->master_type	=	'5by3';
		$this->amount		=	$virtual2[0]['setting_value'];
		$this->payment_insert();
		
		//*******Level Two Payment*******//
		$ucode=(isset($level_three[0]['ucode']) ? $level_three[0]['ucode'] : '0');
		$this->usercode		=	$ucode;
		$this->amount		=	$commission3[0]['setting_value'];
		$this->type			=	'monthly';
		$this->master_type	=	'main_balance';
		$this->payment_insert();
				
		$this->type			=	'10by3';
		$this->master_type	=	'10by3';
		$this->amount		=	$virtual3[0]['setting_value'];
		$this->payment_insert();
		
		//*******Admin Fee*******//
		$adminfee['usercode']		=	'0';
		$adminfee['amount']			=	$admin_pay[0]['setting_value'];
		$adminfee['adminfee']		=	'1';
		$adminfee['type']			=	'monthly';
		$adminfee['timedt']			=	$nowdt;
		$adminfee['paymentcode']	=	$this->paymentcode;
		$adminfee['ref_code']		=	$this->session->userdata['logged_ol_member']['usercode'];
		$this->ObjM->addItem($adminfee,'payment_monthly');
		$this->ObjM->master_balance_update('main_balance',0,$admin_pay[0]['setting_value'],'plus');		
	}
	
	
	
	protected function payment_insert()
	{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
			$data = array();
			$data['paymentcode']	=	$this->paymentcode;
			$data['ref_code']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']			=	$nowdt;
			$data['usercode']		=	$this->usercode;
			$data['amount']			=	$this->amount;
			$data['type']			=	$this->type;
			$this->ObjM->addItem($data,'payment_monthly');
			$this->ObjM->master_balance_update($this->master_type,$this->usercode,$this->amount,'plus');
	}
	
	function due_set()
	{
		$mem=$this->ObjM->get_active_member();
		for($i=0;$i<count($mem);$i++){
			$data=array();
			$data['due_time']=strtotime('+1 month',$mem[$i]['active_dt']);
			$this->ObjM->update($data,'membermaster','usercode',$mem[$i]['usercode']);
		}
	}
	
	protected function send_email_admin_member()
	{
		
		$ref_dt=$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['ref_by']);
		
		// $message='<p><h3>'.$this->session->userdata['logged_ol_member']['fullname'].' Your Payment Received Successfully</h3></p>';
		// $message.='<p><a href="'.base_url().'index.php/login" style="color:#00F;">Click Here To Login</a></p>';
		$message = get_email_cms_page_master('payment_received_member')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
		$message = str_replace("[baseurl]",base_url(),$message);

		$e_array=array("heading"=>"Payment Received","msg"=>$message,"msg"=>$message,"contain"=>'');
		$message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($this->session->userdata['logged_ol_member']['emailid']);
		// $this->email->subject('Payment Successfully');
		// $this->email->message($message);
		// $this->email->send();
			sendemail(FROM_EMAIL,'Payment Successfully',$this->session->userdata['logged_ol_member']['emailid'],$message);
	
		
		$admin_email=$this->ObjM->get_admin_email();
		// $message='<table>
		// 			<tr><td>Member Name</td><td>:</td><td>'.$this->session->userdata['logged_ol_member']['fullname'].'</td></tr>
		// 			<tr><td>Usercode</td><td>:</td><td>'.$this->session->userdata['logged_ol_member']['usercode'].'</td></tr>
		// 			<tr><td>Username</td><td>:</td><td>'.$this->session->userdata['logged_ol_member']['username'].'</td></tr>
		// 			<tr><td>Email Id</td><td>:</td><td>'.$this->session->userdata['logged_ol_member']['emailid'].'</td></tr>
		// 			<tr><td>Referral Name</td><td>:</td><td>'.$ref_dt[0]['fname'].' '.$ref_dt[0]['lname'].' ('.$ref_dt[0]['usercode'].')</td></tr>
		// 	</table>';
		$message = get_email_cms_page_master('payment_received_admin')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
		$message = str_replace("[usercode]",$this->session->userdata['logged_ol_member']['usercode'],$message);
		$message = str_replace("[username]",$this->session->userdata['logged_ol_member']['username'],$message);
		$message = str_replace("[email]",$this->session->userdata['logged_ol_member']['emailid'],$message);
		$message = str_replace("[ref-fname]",$ref_dt[0]['fname'],$message);
		$message = str_replace("[ref-lname]",$ref_dt[0]['lname'],$message);
		$message = str_replace("[ref-usercode]",$ref_dt[0]['usercode'],$message);


		$e_array=array("heading"=>"Payment Received Successfully","msg"=>$message,"msg"=>$message,"contain"=>'');
		$message=email_template_one($e_array);
		
	
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($admin_email[0]['emailid']);
		// $this->email->subject('Payment Received Successfully');
		// $this->email->message($message);
			sendemail(FROM_EMAIL,'Payment Received Successfully',$admin_email[0]['emailid'],$message);
	}
	
	protected function send_email_friend()
	{
		$arr=array();
		$arr_code=array();
		$code=$this->session->userdata['logged_ol_member']['usercode'];
		while(1){
			$r	=	$this->ObjM->get_member_by_code($code);
			
			if($r[0]['usercode']=='1'){
				$arr[]=$r[0]['emailid'];
				$arr_code[]=$r[0]['referralid'];
				break;	
			}
			if(!isset($r[0])){
				break;
			}
			if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y'){
				$arr[]=$r[0]['emailid'];
			}
			$arr_code[]=$r[0]['referralid'];
			$code=$r[0]['referralid'];
		}
		
		
		// $message='<p><strong>'.$this->session->userdata['logged_ol_member']['fullname'].'</strong></p>';
		// $message.='<p>Monthly Payment Successfully</p>';
		$message = get_email_cms_page_master('monthly_payment')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);

		$e_array=array("heading"=>"Monthly Payment","msg"=>$message);
		$message=email_template_one($e_array);
		
		$noti_msg		=	$this->session->userdata['logged_ol_member']['fullname'].' is monthly payment successfully';
		
	
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('Monthly Payment');
		// $this->email->message($message);
		for($i=0;$i<count($arr);$i++)
		{

			// $this->email->to($arr[$i]);
			// $this->email->send();
			
			sendemail(FROM_EMAIL,'Monthly Payment',$arr[$i],$message);
			$this->send_notification($arr_code[$i],$noti_msg);
		}
	
	}
	
	protected function send_notification($code,$msg)
	{
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']			=	'notification';
		$data['contain']		=	$msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->ObjM->addItem($data,'notification_master');
	}
	
	
	
}
