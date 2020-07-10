<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auto_payment extends CI_Controller {

	protected $pay_usercode		=	'';
	protected $paymentcode		=	'';
	protected $usercode			=	'';
	protected $amount			=	'';
	protected $type				=	'';
	protected $master_type		=	'';
	protected $adminfee			=	'0';
		
	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('auto_payment_model','ObjM',TRUE); 
		$this->load->library('email');
 	}
	
	
	
	///this Function call auto (corn job file) by system //
	function renewed_corn(){
		$member = $this->ObjM->get_due_member();
		for($i=0;$i<count($member);$i++){
			$this->payment($member[$i]['usercode']);
		}
		echo 'total payment '.count($member);
	}
	
	
	///this function is use for manually pay by admin//
	function manually_pay($usercode)
	{
		$member	 =	$this->ObjM->get_due_member_by_usercode($usercode);
		if(!isset($member[0])){
			header('Location: '.base_url().'index.php/membership_renewed?status=fail&msg=Membership Renewed Process is Failed');
			exit;
		}
		else{
			$st=$this->payment($usercode);
			if($st){
				header('Location: '.base_url().'index.php/membership_renewed?status=true&msg=Membership Renewed Is Successfully');
				exit;
			}
			else{
				header('Location: '.base_url().'index.php/membership_renewed?status=fail&msg=Membership Renewed Process is Failed');
				exit;
			}
		}
	}
	
	
	
	
	
	///member payment process///
	protected function payment($usercode)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
			
		$member	 =	$this->ObjM->get_due_member_by_usercode($usercode);
		
		if(!isset($member[0])){
			return;
		}
		$this->pay_usercode=$usercode;
		if(time() > $member[0]['due_time']){
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$member[0]['due_time']);
		}
		
		
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$this->pay_usercode);
	
			//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$this->pay_usercode);
	
		$data = array();
		$data['usercode']		=	$this->pay_usercode;	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	$due_time;
		$data['status']			=	'Open';
		$data['payment_type']	=	'auto_pay';
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		$this->ObjM->master_balance_update('main_balance',$this->pay_usercode,59,'minus');
		
		//Balance Withdrawal//
		$info=array();
		$info['usercode']	=	$this->pay_usercode;
		$info['amount']		=	'59';
		$info['type']		=	'2';
		$info['option']		=	$this->paymentcode;
		$info['description']=	'Renewed membership';
		$info['timedt']		=	time();
		$info['create_date']=	$nowdt;
		$this->ObjM->addItem($info,'withdrawal_balance');
		
		$this->monthly_payment();
		$this->coded_residual();
		//****Update Due Time****//	
		$this->send_email_admin_member();
		$this->send_email_friend();
		return true;
	}
	
	
	function admin_payment($usercode)
	{
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
			
		$member	 =	$this->ObjM->get_active_member_by_usercode($usercode);
		
		if(!isset($member[0])){
			header('Location: '.base_url().'index.php/monthly_payment_by_admin?status=fail&msg=Invalid Member');
			exit;
		}
		
		
		$this->pay_usercode=$usercode;
		if(time() > $member[0]['due_time']){
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$member[0]['due_time']);
		}
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$this->pay_usercode);
	
		//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$this->pay_usercode);
	
		$data = array();
		$data['usercode']		=	$this->pay_usercode;	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	$due_time;
		$data['status']			=	'Open';
		$data['payment_type']	=	'manual';
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		
		$this->monthly_payment();
		$this->coded_residual();
		//****Update Due Time****//	
		$this->send_email_admin_member();
		$this->send_email_friend();
		
			header('Location: '.base_url().'index.php/monthly_payment_by_admin?status=true&msg='.$member[0]['fname'].' '.$member[0]['lname'].' Payment Successfully');
			exit;

	}
	
	
	
	function request_to_renewal(){
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$request 	=	$this->ObjM->get_renewal_request($_POST['request_code']);
		if(!isset($request[0])){
			$this->session->set_flashdata('show_msg', 'Invailed Request');
			header('Location: '.base_url().'index.php/renewed_request');
			exit;
		}
		
		
		
		$member	 =	$this->ObjM->get_active_member_by_usercode($request[0]['renewal_usercode']);
		if(!isset($member[0])){
			$this->session->set_flashdata('show_msg', 'Invailed Member');
			header('Location: '.base_url().'index.php/renewed_request');
			exit;
		}
		
		$this->pay_usercode	=	$member[0]['usercode'];
		
		if(time() > $member[0]['due_time']){
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$member[0]['due_time']);
		}
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$this->pay_usercode);
	
		//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$this->pay_usercode);
	
		$data = array();
		$data['usercode']		=	$this->pay_usercode;	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	$due_time;
		$data['status']			=	'Open';
		$data['payment_type']	=	'request_pay';
		$data['option']			=	$request[0]['request_code'];
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		
		//***Main Balance Minus***//
		
		$data=array();
		$data['request_status']	=	'Done';
		$data['update_time']	=	time();
		$this->ObjM->update($data,'request_to_renewal','request_code',$request[0]['request_code']);
		
		$this->monthly_payment();
		$this->coded_residual();
		
		$this->send_email_admin_member();
		$this->send_email_friend();
		
		$this->session->set_flashdata('show_msg', 'Member Renewed Successfully');
		header('Location: '.base_url().'index.php/renewed_request');
		exit;
		
		
	}
	
	protected function coded_residual()
	{
		$coded					=	$this->ObjM->get_setting_by_lable('enrollment_code');
		$coded_match			=	$this->ObjM->get_setting_by_lable('enrollment_code_match');
		$residual_amount		=	$this->ObjM->get_setting_by_lable('codded_residual');
		$residual_match_amount	=	$this->ObjM->get_setting_by_lable('coded_residual_match');
		
		
		
		$member	=	$this->ObjM->get_coded_residual($this->pay_usercode);
		
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
		$now 					= 	time();
		$nowdt					=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$admin_pay				=	$this->ObjM->get_setting_by_lable('default_commission_to_admin');
		
		$commission1			=	$this->ObjM->get_setting_by_lable('commission_level1');
		$commission2			=	$this->ObjM->get_setting_by_lable('commission_level2');
		$commission3			=	$this->ObjM->get_setting_by_lable('commission_level3');
		
		$virtual1				=	$this->ObjM->get_setting_by_lable('virtual_balance_level1');
		$virtual2				=	$this->ObjM->get_setting_by_lable('virtual_balance_level2');
		$virtual3				=	$this->ObjM->get_setting_by_lable('virtual_balance_level3');
		
		
		
		$level_one				=	$this->ObjM->tree_upling($this->pay_usercode);
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
		$adminfee['ref_code']		=	$this->pay_usercode;
		$this->ObjM->addItem($adminfee,'payment_monthly');
		$this->ObjM->master_balance_update('main_balance',0,$admin_pay[0]['setting_value'],'plus');		
	}
	
	
	
	protected function payment_insert()
	{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
			$data = array();
			$data['paymentcode']	=	$this->paymentcode;
			$data['ref_code']		=	$this->pay_usercode;
			$data['timedt']			=	$nowdt;
			$data['usercode']		=	$this->usercode;
			$data['amount']			=	$this->amount;
			$data['type']			=	$this->type;
			$this->ObjM->addItem($data,'payment_monthly');
			$this->ObjM->master_balance_update($this->master_type,$this->usercode,$this->amount,'plus');
			
	}
	
	
	
	protected function send_email_admin_member()
	{
		$member_dt	=	$this->ObjM->get_member_by_code($this->pay_usercode);
		$ref_dt		=	$this->ObjM->get_member_by_code($member_dt[0]['referralid']);
		$next_due	= date('d-m-Y', $member_dt[0]['due_time']);
		// $message="<p>thanks for Membership Renewal for the this month </p>";
		// $message.='<p>you next payment due on '.$next_due.'</p>';
		$message = get_email_cms_page_master('membership_renewal')->result()[0]->textdt;
		$message = str_replace("[date]",$next_due,$message);
		$e_array=array("heading"=>"Payment Received","msg"=>$message,"msg"=>$message,"contain"=>'');
		$message=email_template_one($e_array);
			
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member_dt[0]['emailid']);
		// $this->email->subject('Membership Renewal');
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,'Membership Renewal',$member_dt[0]['emailid'],$message);
	
		
		$admin_email=$this->ObjM->get_admin_email();
		// $message='<table>
		// 			<tr><td>Member Name</td><td>:</td><td>'.$member_dt[0]['fname'].' '.$member_dt[0]['fname'].'</td></tr>
		// 			<tr><td>Usercode</td><td>:</td><td>'.$this->pay_usercode.'</td></tr>
		// 			<tr><td>Username</td><td>:</td><td>'.$member_dt[0]['username'].'</td></tr>
		// 			<tr><td>Email Id</td><td>:</td><td>'.$member_dt[0]['emailid'].'</td></tr>
		// 			<tr><td>Referral Name</td><td>:</td><td>'.$ref_dt[0]['fname'].' '.$ref_dt[0]['lname'].' ('.$ref_dt[0]['usercode'].')</td></tr>
		// 			<tr><td>Next Due On</td><td>:</td><td>'.$next_due.'</td></tr>
		// 	</table>';
		$message = get_email_cms_page_master('admin_membership_renewal')->result()[0]->textdt;
		$message = str_replace("[fname]",$member_dt[0]['fname'],$message);
		$message = str_replace("[lname]",$member_dt[0]['fname'],$message);
		$message = str_replace("[usercode]",$this->pay_usercode,$message);
		$message = str_replace("[username]",$member_dt[0]['username'],$message);
		$message = str_replace("[email]",$member_dt[0]['emailid'],$message);
		$message = str_replace("[ref_fname]",$ref_dt[0]['fname'],$message);
		$message = str_replace("[ref_lname]",$ref_dt[0]['lname'],$message);
		$message = str_replace("[ref_usercode]",$ref_dt[0]['usercode'],$message);
		$message = str_replace("[nextdue]",$next_due,$message);
		
		$e_array=array("heading"=>"Membership Renewed","msg"=>$message,"msg"=>$message,"contain"=>'');
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($admin_email[0]['emailid']);
		// $this->email->subject('Membership Renewed');
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,'Membership Renewed',$admin_email[0]['emailid'],$message);
	}
	
	protected function send_email_friend()
	{
		$member_dt	=	$this->ObjM->get_member_by_code($this->pay_usercode);
		$arr=array();
		$arr_code=array();
		$code=$this->pay_usercode;
		
		$message	=	'<p><strong>'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].'</strong> Membership Renewal for the this month</p>';
		$e_array	=	array("heading"=>"Monthly Payment","msg"=>$message);
		$message	=	email_template_one($e_array);
		$noti_msg	=	$member_dt[0]['fname'].'  '.$member_dt[0]['lname'].' is Membership Renewal';
		
		$info['subject']	=	'Membership Renewal';
		$info['heading']	=	'Monthly Payment';
		$info['msg']		=	$message;
		
		while(1){
			$r	=	$this->ObjM->get_member_by_code($code);
			if(!isset($r[0])){
				break;
			}
			$info['usercode']		=	$r[0]['usercode'];
			$info['emailid']		=	$r[0]['emailid'];
			
			$this->ObjM->addItem($info,'email_auto_send');
			$this->send_notification($r[0]['usercode'],$noti_msg);
			if($r[0]['usercode']=='1'){
				break;
			}
			$code=$r[0]['referralid'];
		}
		
	
	}
	
	protected function send_notification($code,$msg)
	{
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$this->pay_usercode;
		$data['type']			=	'notification';
		$data['contain']		=	$msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->ObjM->addItem($data,'notification_master');
	}
	
	///member payment process (product wallet)///
	function pp_payment_corn(){
		
		$result=$this->ObjM->payment_from_pp();
		
		for($i=0;$i<count($result);$i++){
			
			$this->payment_from_pp_wallet($result[$i]['usercode']);
			
		}
		
	}
	
	///member payment process (product wallet)///
	protected function payment_from_pp_wallet($usercode)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
			
		$member	 =	$this->ObjM->payment_from_pp_member($usercode);
		
		if(!isset($member[0])){
			return;
		}
		
		$cw=(float)$member[0]['cp'];
		$pp=(float)$member[0]['pp'];
		
		if($cw > 0){
			$cw_pay 	=	$cw;
			$pp_pay 	= 	59-$cw;
		}else{
			$cw_pay 	=	0;
			$pp_pay 	= 	59;
		}
		
		
		
		$this->pay_usercode=$usercode;
		if(time() > $member[0]['due_time']){
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$member[0]['due_time']);
		}
		
		
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$this->pay_usercode);
	
			//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$this->pay_usercode);
	
		$data = array();
		$data['usercode']		=	$this->pay_usercode;	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	$due_time;
		$data['status']			=	'Open';
		$data['payment_type']	=	'auto_pay';
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		
		//Balance Withdrawal//
		$this->ObjM->master_balance_update('main_balance',$this->pay_usercode,$cw_pay,'minus');
		$info=array();
		$info['usercode']	=	$this->pay_usercode;
		$info['amount']		=	$cw_pay;
		$info['type']		=	'2';
		$info['option']		=	$this->paymentcode;
		$info['description']=	'Renewed membership';
		$info['timedt']		=	time();
		$info['create_date']=	$nowdt;
		$info['wallet_type']=	'main_balance';
		$this->ObjM->addItem($info,'withdrawal_balance');
		
		///Product Wallet Update///
		$this->ObjM->product_balance_update('wallet_balance',$this->pay_usercode,$pp_pay,'minus');
		$info=array();
		$info['usercode']	=	$this->pay_usercode;
		$info['amount']		=	$pp_pay;
		$info['type']		=	'1';
		$info['option']		=	$this->paymentcode;
		$info['description']=	'Renewed membership';
		$info['timedt']		=	time();
		$info['create_date']=	$nowdt;
		$info['wallet_type']=	'product_wallet';
		$this->ObjM->addItem($info,'withdrawal_balance');
		
		
		$this->monthly_payment();
		$this->coded_residual();
		//****Update Due Time****//	
		$this->send_email_admin_member();
		$this->send_email_friend();
		return true;
	}
	
	 function pdl_payment(){
		$result=$this->ObjM->pdl_due_member();
		for($i=0;$i<count($result);$i++){
			$rt=$this->pdl_member_account($result[$i]['usercode']);
			if($rt){
				$this->pdl_payment_process($result[$i]['usercode']);	
			}
		}
		
	 }
	 
	 protected function pdl_member_account($eid){
		$amount		=	$this->ObjM->pdl_total_amount($eid);
		$withdrawal	=	$this->ObjM->pdl_total_withdrawal($eid);
		$balance	=	$amount-$withdrawal;
		if($balance>=CW_MIN){
			return true;
		}else{
			return false;
		}
	 }
	 
	 
	 protected function pdl_payment_process($usercode)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
			
		
		$this->pay_usercode=$usercode;
		$due_time	=	strtotime('+1 month',time());
		
		
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$this->pay_usercode);
	
			//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$this->pay_usercode);
	
		$data = array();
		$data['usercode']		=	$this->pay_usercode;	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	$due_time;
		$data['status']			=	'Open';
		$data['payment_type']	=	'auto_pay_pdl';
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		
		
		//Balance Withdrawal//
		$info=array();
		$info['usercode']		=	$this->pay_usercode;
		$info['amount']			=	'59';
		$info['type']			=	'2';
		$info['option']			=	$this->paymentcode;
		
		$info['timedt']			=	time();
		$info['textdt']			=	'Auto Payment Opp ';
		$info['wallet_type']	=	'pdl_2';
		
		
		$this->ObjM->addItem($info,'pdl_withdrawal');
		
		$this->monthly_payment();
		$this->coded_residual();
		//****Update Due Time****//	
		$this->send_email_admin_member();
		$this->send_email_friend();
		return true;
	}
	
	
	public function nikimail()
	{
		$next_due	= date('d-m-Y', $member_dt[0]['due_time']);
		$massege = get_email_cms_page_master('membership_renewal')->result()[0]->textdt;
		echo str_replace("[date]",$next_due,$massege);
	}
	
}
