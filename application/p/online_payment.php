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
		
		if(!isset($_POST['x_cust_id']) || !isset($_POST['x_invoice_num'])){
			echo 'Invailed Request';
			exit;
			
		}
		
		if($_POST['x_response_code']!='1'){
			if($_POST['x_response_code']=='2'){
				$html='Your Payment Is Declined';
			}
			
			elseif($_POST['Error']=='3'){
				$html='Your Payment Is Held for review';
			}
			else{
				$html='Error';
			}
			echo'<p style="text-align:center;">'.$html.'</p>
				 <p style="text-align:center;"><a href="'.base_url().'index.php/login/logout">Click Here To Back</a></p>';
			exit;
			
		}
		
		$check_invoice=$this->ObjM->check_invoice_number($_POST['x_invoice_num']);
		if(isset($check_invoice[0])){
			echo 'This Payment Is Already Done';
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
		$data['heading']	=	'Nllsys Paid Membership';
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
	
	protected function paid_product_purchase(){
		
		$result = $this->ObjM->check_paid_wallet_member($_POST['x_cust_id']);
		
		if(!isset($result[0]))
		{
			$this->first_time_paid_product();
		}
		
		//****member payment insert****//
		$paymentcode = $this->member_payment_insert();
		
		//****Three Level Member Payment****//
		$this->upling_member_payment_for_product($paymentcode);
		
	}
	
	
	
	//****Entry In Tree****//
	protected function first_time_paid_product(){
		
		//****get tree level****//
		
		$this->first_lavel_set();
		$data=array();
		$data['usercode']	=	$_POST['x_cust_id'];
		$data['join_time']	=	time();
		$data['join_date']	=	strtotime(date('d-m-Y'));
		$data['due_time']	=	strtotime('+1 month',time());
		$data['upling']		=	$this->upling_user;
		$data['side']		=	$this->upling_posi;
		$this->ObjM->addItem($data,'n_product_member');	
		
	}
	
	
	
	protected function first_lavel_set(){
		
		$result			=	$this->ObjM->get_usercode_by_tree(1);
		
		//****Level First Check****//
		if(count($result)< 3){
			
			$this->upling_user = 1;
			
			$this->upling_posi = count($result)+1;
			
			return;	
		}
		
		//****Set Member For Second Level****//
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['usercode'];
			
		}
		//****Call Function To Check Next Level****//
		$this->tree_check_postion($arr);
	}
	
	
	//****Check Position******//
	protected function tree_check_postion($arr_mem){
		
		//****Check Position******//
		
		for($pos=0;$pos<3;$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
			
				$result=$this->ObjM->get_count_by_tree($arr_mem[$i]);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					
					$this->upling_posi = $result[0]['tot']+1;
					
					return;		
					
				}
			
			}
		}
		
		
		//****Next Level Member Get******//
		$child_mem=array();
		
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->ObjM->get_usercode_by_tree($arr_mem[$i]);			
			
		}
		
		
		//****Next Level Member Set By Position******//
		$re_arr=array();
		
		for($pos=0;$pos<3;$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		
		//****Function Call To Check Again******//
		$this->tree_check_postion($re_arr);
		
	}
	
	
	
	protected function show_msg(){
		
		$member_dt = $this->ObjM->get_member_by_usercode($_POST['x_cust_id']);
		echo '<h2 style="text-align:center;">Hello,'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' </h2>
		<p style="text-align:center;">Your Payment Is Successfully Done</p>
		<p style="text-align:center;">Thanks for your payment.</p>
		<p style="text-align:center;"><a href="'.base_url().'index.php/login/logout">Click Here To Back</a></p>';
		
	}
	
	function monthly_subscription_rep()
	{
		$data=array();
		
		$data['api_test']	=	json_encode($_POST);
		$data['type']		=	"Real_Req";
		$this->ObjM->addItem($data,'api_test');
		
		if($_POST)
    	{
        	if(isset($_POST['x_subscription_id'])){
				$this->monthly_subscription_payment();	
			}	
    	}		
	}
	
	protected function monthly_subscription_payment()
	{
			$record=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);	
			
			$paymentcode	=	$this->member_payment_insert($record[0]);
				
			$this->upling_member_payment_for_product($record[0],$paymentcode);
				
			exit;
			
				
	}
	
	//****Member Payment Intry****//
	protected function member_payment_insert($record){	
		$data=array();
		$data['usercode']			=	$record['usercode'];
		$data['amount']				=	$_POST['x_amount'];
		$data['txn_id']				=	$_POST['x_trans_id'];
		$data['date_dt']			=	strtotime(date('d-m-Y'));
		$data['time_dt']			=	strtotime('+1 month',time());
		$data['option']				=	json_encode($_POST);
		$data['pay_type']			=	'Monthly Subscription';
		$id = $this->ObjM->addItem($data,'n_product_monthly_payment');
		return $id;
	}
	
	//****Three Level Member Payment****//
	protected function upling_member_payment_for_product($record, $paymentcode)
	{	
		$usercode	= $record['usercode'];
		for($i=1;$i<=3;$i++)
		{
			$upling	=	$this->ObjM->n_product_member_by_usercode($usercode);
			$data['paymentcode']	=	$paymentcode;
			$data['usercode']		=	$upling;
			$data['ref_code']		=	$usercode;
			$data['amount']			=	5;
			$data['timedt']			=	time();
			$data['type']			=	'monthly';
			$data['level_pay']		=	$i;
			$this->ObjM->addItem($data,'n_product_member_payment');
			$this->ObjM->product_balance_update('wallet_balance',$upling,5);
			$usercode=$upling;
		}
	}
	
	
	
	
	
	
}

