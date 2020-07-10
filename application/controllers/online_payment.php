<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class online_payment extends CI_Controller {
	
	protected $paymentcode		=	'';
	protected $usercode			=	'';
	protected $amount			=	'';
	protected $type				=	'';
	protected $master_type		=	'';
	protected $adminfee			=	'0';
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	
	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('online_payment_module','ObjM',TRUE);
 	}
	
	function success()
	{
		
	
		$this->api_call();
		
		if($_POST['x_response_code']!='1'){
			
			$this->transaction_flase();
			echo'<p style="text-align:center;">'.$_POST['x_response_reason_text'].'</p><p style="text-align:center;"><a href="'.base_url().'index.php/login/logout">Click Here To Back</a></p>';
			exit;
			
		}
		
		
		//***Refill***//
		$invoice_num = explode("_",$_POST['x_invoice_num']);
		
		if($invoice_num[0]=='101'){
			$this->upgrade_payment();
			$this->show_msg();
			exit;
		}
		if($invoice_num[0]=='102'){
			$this->refill_account();
			exit;	
		}
		if($invoice_num[0]=='104')
		{
			$this->show_msg();
			exit;
		}
		
		if($invoice_num[0]=='105')
		{
			$this->kdk1_payment();
			$this->show_msg();
			exit;
		}
		if($invoice_num[0]=='106')
		{
			$this->tl_diamond_payment();
			$this->show_msg();
			exit;
		}
		
		if($invoice_num[0]=='107'){
			$this->marketing_product_payment();
			$this->show_msg();
			exit;
		}
		
	}
	
	
	protected function api_call()
	{
		$data=array();
		
		if($_POST){
			$data['option']			=	json_encode($_POST);
			$data['x_invoice_num']	=	(isset($_POST['x_invoice_num'])) ? $_POST['x_invoice_num'] : "";
			$this->ObjM->addItem($data,'api_call');	
		}
		
	}
	
	protected function upgrade_payment(){
		
		$member_dt = $this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		
		$info=array();
		$info['usercode']	=	$_POST['x_cust_id'];
		$info['timedt']		=	time();	
		$info['txn_id']		=	$_POST['x_invoice_num'];
		$info['option']		=	json_encode($_POST);
		$info['status']		=	'Completed';
		$this->ObjM->addItem($info,'online_payment');
		
		
		if(isset($member_dt[0])){
			if($member_dt[0]['status']=='Active'){
				$this->active_member_payment();
			}
			if($member_dt[0]['status']=='Pending'){
				
				$this->pending_member_payment($member_dt);
			}		
		}
		else{
			echo 'Invailed Member Request';
			exit;
		}
			
	}
	
	protected function refill_account(){
		
		$invoice_num = explode("_",$_POST['x_invoice_num']);
		$ac_type=$invoice_num[1];
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$member_dt = $this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		$data=array();
		$data['usercode']	=	$_POST['x_cust_id'];
		$data['amount']		=	$_POST['x_amount'];
		$data['option']		=	json_encode($_POST);
		$data['timedt']		=	time();
		$data['ac_type']	=	$ac_type;
		$id = $this->ObjM->addItem($data,'refill_account');
		
		if($ac_type=='PW'){
			$data=array();
			$data['paymentcode'] = 	$id;
			$data['usercode']    = 	$_POST['x_cust_id'];
			$data['amount']      = 	$_POST['x_amount'];
			$data['timedt']		 =	$nowdt;
			$data['type']		 =	'refill';
			$this->ObjM->addItem($data,'personal_wallet_payment');
			$this->ObjM->master_balance_update('personal_wallet',$_POST['x_cust_id'],$_POST['x_amount'],'plus');
			$msg='Your Refill Is Successfully Done In Personal  Account';
			
		}else{
			$data=array();
			$data['paymentcode'] = 	$id;
			$data['usercode']    = 	$_POST['x_cust_id'];
			$data['amount']      = 	$_POST['x_amount'];
			$data['timedt']		 =	$nowdt;
			$data['type']		 =	'refill';
			$this->ObjM->addItem($data,'payment_monthly');
			$this->ObjM->master_balance_update('main_balance',$_POST['x_cust_id'],$_POST['x_amount'],'plus');
			$msg='Your Refill Is Successfully Done In Company Account';
		}
		
		
		
		
		echo '<h2 style="text-align:center;">Hello,'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' </h2>
			  <p style="text-align:center;">'.$msg.'</p>
			  <p style="text-align:center;">Thanks for your refill.</p>
		     <p style="text-align:center;"><a href="'.base_url().'index.php/login/logout">Click Here To Back</a></p>';
		exit;	 
	}
	
	protected function pending_member_payment(){
		
		
		$info	=	array();
		$info['usercode']	=	$_POST['x_cust_id'];
		$info['timedt']		=	time();
		$info['create_by']	=	$_POST['x_cust_id'];
		$this->ObjM->addItem($info,'product_access_permission');
		
		$info=array();
		$info['payment']		=	'Y';
		$info['txn_id']			=	$_POST['x_invoice_num'];
		$info['option']			=	json_encode($_POST);
		$info['payment_dt']		=	date('Y-m-d h:i');
		$this->ObjM->update($info,'paid_request_master','usercode',$_POST['x_cust_id']);
		$this->send_email_paid();
				
	}
	protected function active_member_payment(){
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
		$member_dt	=	$this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		
		if(time() > $member_dt[0]['due_time'])
		{
			$due_time	=	strtotime('+1 month',time());
		}
		else{
			$due_time	=	strtotime('+1 month',$member_dt[0]['due_time']);
		}
		
		//close old payment
		$data = array();
		$data['status']	=	'Close';
		$this->ObjM->update($data,'payment_master','usercode',$member_dt[0]['usercode']);
			
		//update due date
		$data = array();
		$data['due_time']	=	$due_time;
		$this->ObjM->update($data,'membermaster','usercode',$member_dt[0]['usercode']);
		
		$data = array();
		$data['usercode']		=	$member_dt[0]['usercode'];	
		$data['amount']			=	59;
		$data['paydate']		=	$nowdt;
		$data['pay_day']		=	date('d');
		$data['pay_month']		=	date('m');
		$data['pay_year']		=	date('Y');
		$data['timedt']			=	time();
		$data['due_time']		=	strtotime('+1 month',time());
		$data['status']			=	'Open';
		$data['txn_id']			=	$_POST['x_invoice_num'];
		$data['option']			=	json_encode($_POST);
		$data['payment_type']	=	'Online';
		$this->paymentcode 		=	$this->ObjM->addItem($data,'payment_master');
		$this->monthly_payment();
		$this->coded_residual();	
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
		
		
		
		$level_one				=	$this->ObjM->tree_upling($_POST['x_cust_id']);
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
		$adminfee['ref_code']		=	$_POST['x_cust_id'];
		$this->ObjM->addItem($adminfee,'payment_monthly');
		$this->ObjM->master_balance_update('main_balance',0,$admin_pay[0]['setting_value'],'plus');		
	}
	
	protected function coded_residual()
	{
		$coded					=	$this->ObjM->get_setting_by_lable('enrollment_code');
		$coded_match			=	$this->ObjM->get_setting_by_lable('enrollment_code_match');
		$residual_amount		=	$this->ObjM->get_setting_by_lable('codded_residual');
		$residual_match_amount	=	$this->ObjM->get_setting_by_lable('coded_residual_match');
		
		
		
		$member	=	$this->ObjM->get_coded_residual($_POST['x_cust_id']);
		
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
	
	protected function payment_insert()
	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
		$data = array();
		$data['paymentcode']	=	$this->paymentcode;
		$data['ref_code']		=	$_POST['x_cust_id'];
		$data['timedt']			=	$nowdt;
		$data['usercode']		=	$this->usercode;
		$data['amount']			=	$this->amount;
		$data['type']			=	$this->type;
		$this->ObjM->addItem($data,'payment_monthly');
		$this->ObjM->master_balance_update($this->master_type,$this->usercode,$this->amount,'plus');
	}
	
	protected function send_email_paid()
	{
		$member_dt	=	$this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		
		$message =	'<p><strong>'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].'</strong></p>';
		$message.=	'<p>Paid For Upgrade Membership </p>';
		
		$e_array = array("heading"=>"Paid For Upgrade Membership","msg"=>$message);
		
		$data['msg'] 		=	email_template_one($e_array);
		$data['heading']	=	'NLLSYS Paid Membership';
		$data['subject']  	=	'Paid Membership';
		$data['subject']  	=	'Paid Membership';
		$data['status']  	=	'pending';
		$data['create_dt']  =	time();
		$data['usercode']  	=	'-1';
		$this->ObjM->addItem($data,'email_auto_send');
		
		
		$noti_msg	=	$member_dt[0]['fname'].' '.$member_dt[0]['lname'] .' is paid for upgrade membership';
		$code		=	$_POST['x_cust_id'];
		while(1){
			$r	=	$this->ObjM->get_member_by_usercode($code);
			
			if($r[0]['usercode']=='1'){
				$data['usercode']  	=	$r[0]['usercode'];
				$this->ObjM->addItem($data,'email_auto_send');
				$this->send_notification($r[0]['referralid_free'],$noti_msg,$member_dt);
				break;	
			}
			if(!isset($r[0])){
				break;
			}
			$data['usercode']  	=	$r[0]['usercode'];
			$this->ObjM->addItem($data,'email_auto_send');
			$this->send_notification($r[0]['referralid_free'],$noti_msg,$member_dt);
			$code=$r[0]['referralid_free'];
		}
		
	}
	
	
	protected function send_notification($code, $noti_msg, $member)
	{
		
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$member[0]['fname'].' '.$member[0]['lname'];
		$data['type']			=	'notification';
		$data['contain']		=	$noti_msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->ObjM->addItem($data,'notification_master');
	}
	
	

	
	protected function show_msg(){
		
		$member_dt = $this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		echo '<h2 style="text-align:center;">Hello,'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' </h2>
		<p style="text-align:center;">Your Payment Is Successfully Done</p>
		<p style="text-align:center;">Thanks for your payment.</p>
		<p style="text-align:center;"><a href="'.base_url().'index.php/login/logout">Click Here To Back</a></p>';
		
	}
	
	protected function transaction_flase()
	{
		///**TL Diamond Payment False Entry**///
		$invoice_num = explode("_",$_POST['x_invoice_num']);
		if($invoice_num[0]=='106')
		{
			$this->tl_diamond_payment();
		}
		
		
		$data=array();
		$data['datadt']		=	json_encode($_POST);
		$this->ObjM->addItem($data,'transaction_flase');	
	}
	
	function monthly_subscription_rep()
	{
		$data=array();
		$data['datadt']		=	json_encode($_POST);
		$data['type']		=	"Real_Req_";
		$this->ObjM->addItem($data,'api_test');
		
		if($_POST)
    	{
        	if(isset($_POST['x_subscription_id'])){
				
				if($_POST['x_response_code']=='1'){
					
					$this->member_payment_insert();	
				
				}
				else{
					
					$this->subscription_flase();
					
				}
			}	
    	}		
	}
	
	protected function subscription_flase()
	{
		$detail=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);	
		$data['usercode']			=	$detail[0]['usercode'];
		$data['x_response_code']	=	$_POST['x_response_code'];
		$data['post_data']			=	json_encode($_POST);
		$data['time_dt']			=	time();		
		$this->ObjM->addItem($data,'n_product_payment_false');
	}
	
	
	//****Member Payment Intry****//
	protected function member_payment_insert($arr){	
		
		$detail						=	$this->ObjM->get_subscription_record($_POST['x_subscription_id']);	
		$data						=	array();
		$data['usercode']			=	$detail[0]['usercode'];
		$data['amount']				=	$_POST['x_amount'];
		$data['txn_id']				=	$_POST['x_trans_id'];
		$data['date_dt']			=	strtotime(date('d-m-Y'));
		$data['time_dt']			=	strtotime('+1 month',time());
		$data['option']				=	json_encode($_POST);
		$data['pay_type']			=	'Monthly Subscription';
		
		$id = $this->ObjM->addItem($data,'n_product_monthly_payment');
		
		$amount		=	(int)$_POST['x_amount'];
		$info=array();
		if($amount=='100')
		{
			$info['due_time']		=	strtotime('+6 month',time());
			$info['product_type']	=	'2';
			
		}else
		{
			$info['due_time']		=	strtotime('+1 month',time());
			$info['product_type']	=	'1';
		}
		$this -> ObjM -> update($info,'n_product_member','usercode',$detail[0]['usercode']);
		return $id;
	}
	
	protected function kdk1_payment()
	{
		$data=array();
		$data['usercode']	=	$_POST['x_cust_id'];
		$data['amount']		=	$_POST['x_amount'];
		$data['txn_id']		=	$_POST['x_trans_id'];
		$data['timedt']		=	date('Y-m-d h:i:s');
		$data['option']		=	json_encode($_POST);
		$data['pay_method']	=	'Online';
		$this->ObjM->addItem($data,'kdk1_account');
		
	}
	
	protected function tl_diamond_payment(){
	
		$data=array();
			
		if($_POST['x_response_code']=='1'){
			$data['status']='True';	
		}else{
			$data['status']='False';	
		}
	
	
		$data['usercode']	=	$_POST['x_cust_id'];
		$data['amount']		=	$_POST['x_amount'];
		$data['txn_id']		=	$_POST['x_trans_id'];
		$data['timedt']		=	date('Y-m-d h:i:s');
		$data['option']		=	json_encode($_POST);
		$this->ObjM->addItem($data,'tl_diamond');
		
	}
	
	protected function marketing_product_payment()
	{
		$invoice_num = explode("_",$_POST['x_invoice_num']);
		
		$data['usercode']		=	$_POST['x_cust_id'];
		$data['amount']			=	$_POST['x_amount'];
		$data['type']			=	$invoice_num[3];
		$data['txn_id']			=	$_POST['x_trans_id'];
		$data['x_invoice_num']	=	$_POST['x_invoice_num'];
		$data['timedt']			=	date('Y-m-d h:i:s');
		$data['option']			=	json_encode($_POST);
		$this->ObjM->addItem($data,'marketing_onetime_payment');
	}
	
}

