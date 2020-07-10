<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_payment extends CI_Controller {
		protected $paymentcode		=	'';
		protected $ref_code			=	'';
		protected $usercode			=	'';
		protected $amount			=	'';
		protected $type				=	'';
		protected $master_type		=	'';
		protected $real_field		=	'';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('member_payment_model','',TRUE);
 	}
	
	function insertrecord(){
			
			session_start();
			
			if(!isset($_SESSION['payment_usercode']) || $_SESSION['payment_usercode']==''){
				header('Location: '.base_url().'index.php/');
				exit;
			}
			
			if(isset($_SESSION['back_url'])){$back_url		=	$_SESSION['back_url'];}
			else{$back_url='';}
			
			$pay_usercode	=	$_SESSION['payment_usercode'];
			unset($_SESSION['payment_usercode']);
			unset($_SESSION['back_url']);
			
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$package_amount = $this->member_payment_model->get_setting_value_by_lable('package_amount');
			
			$data['usercode']		=	$pay_usercode;	
			$data['amount']			=	$package_amount[0]['setting_value'];
			$data['paydate']		=	$nowdt;
			$data['pay_day']		=	date('d');
			$data['pay_month']		=	date('m');
			$data['pay_year']		=	date('Y');
			$data['timedt']			=	time();
			$data['due_time']		=	strtotime('+1 month',time());
			$data['status']			=	'Open';
			$paymentcode			=	$this->member_payment_model->addItem($data, 'payment_master');	
			
			$d_level_one			=	$this->member_payment_model->tree_upling($pay_usercode,'uplingmember3_3');
			$d_level_two			=	$this->member_payment_model->tree_upling($d_level_one[0]['uplingmember3_3'],'uplingmember3_3');	
			$d_level_three			=	$this->member_payment_model->tree_upling($d_level_two[0]['uplingmember3_3'],'uplingmember3_3');	
			
			$virtual_five_one		=	$this->member_payment_model->tree_upling($pay_usercode,'uplingmember5_3');	
			$virtual_five_two		=	$this->member_payment_model->tree_upling($virtual_five_one[0]['uplingmember5_3'],'uplingmember5_3');	
			$virtual_five_three		=	$this->member_payment_model->tree_upling($virtual_five_two[0]['uplingmember5_3'],'uplingmember5_3');	
			
			$virtual_ten_one		=	$this->member_payment_model->tree_upling($pay_usercode,'uplingmember10_3');
			$virtual_ten_two		=	$this->member_payment_model->tree_upling($virtual_ten_one[0]['uplingmember10_3'],'uplingmember10_3');
			$virtual_ten_three		=	$this->member_payment_model->tree_upling($virtual_ten_two[0]['uplingmember10_3'],'uplingmember10_3');
			
			$commission1			=	$this->member_payment_model->get_setting_value_by_lable('commission_level1');
			$commission2			=	$this->member_payment_model->get_setting_value_by_lable('commission_level2');
			$commission3			=	$this->member_payment_model->get_setting_value_by_lable('commission_level3');
			
			$pay1					=	$this->member_payment_model->get_setting_value_by_lable('virtual_balance_level1');
			$pay2					=	$this->member_payment_model->get_setting_value_by_lable('virtual_balance_level2');
			$pay3					=	$this->member_payment_model->get_setting_value_by_lable('virtual_balance_level3');
			
			
			
			//********************Direct Payment************************//
			$this->paymentcode		=	$paymentcode;
			$this->ref_code			=	$pay_usercode;
			$d_data['paymentcode']	=	$paymentcode;
			$d_data['ref_code']		=	$pay_usercode;
			//****************Level One Update***************//
			$payment_level['usercode']=$pay_usercode;
			if($d_level_one[0]['uplingmember3_3']!='' && isset($d_level_one[0]))
			{	
				$payment_level['tree3_1']=$d_level_one[0]['uplingmember3_3'];
				
				$this->usercode		=	$d_level_one[0]['uplingmember3_3'];
				$this->amount		=	$commission1[0]['setting_value'];
				$this->type			=	'monthly';
				$this->master_type	=	'main_balance';
				$this->payment_insert();
				
				$this->type			=	'3by3';
				$this->master_type	=	'3by3';
				$this->amount		=	$pay1[0]['setting_value'];
				$this->real_field	=	'3by3_real';
				
				$this->payment_insert(true);
			}
			if($virtual_five_one[0]['uplingmember5_3']!='' && isset($virtual_five_one[0]))
			{
				$payment_level['tree5_1']=$virtual_five_one[0]['uplingmember5_3'];
	
			}
			if($virtual_ten_one[0]['uplingmember10_3']!='' && isset($virtual_ten_one[0]))
			{
				$payment_level['tree10_1']=$virtual_ten_one[0]['uplingmember10_3'];
				
			}
			
			//****************Level two Update***************//
			
			
			if($d_level_two[0]['uplingmember3_3']!='' && isset($d_level_two[0]))
			{
				$payment_level['tree3_2']=$d_level_two[0]['uplingmember3_3'];
				
				$this->usercode		=	$d_level_two[0]['uplingmember3_3'];
				$this->amount		=	$commission2[0]['setting_value'];
				$this->type			=	'monthly';
				$this->master_type	=	'main_balance';
				$this->payment_insert();
					
				$this->amount			=	$pay2[0]['setting_value'];
				$this->type				=	'5by3';
				$this->master_type		=	'5by3';
				$this->real_field		=	'5by3_real';
				$this->payment_insert(true);		
			}
			if($virtual_five_two[0]['uplingmember5_3']!='' && isset($virtual_five_two[0]))
			{
				$payment_level['tree5_2']=$virtual_five_two[0]['uplingmember5_3'];
			}
			if($virtual_ten_two[0]['uplingmember10_3']!='' && isset($virtual_ten_two[0]))
			{
				$payment_level['tree10_2']=$virtual_ten_two[0]['uplingmember10_3'];
			}
			
			//****************Level Three Update***************//
			
			if($d_level_three[0]['uplingmember3_3']!='' && isset($d_level_three[0]))
			{
				$payment_level['tree3_3']=$d_level_three[0]['uplingmember3_3'];
				$this->usercode		=	$d_level_three[0]['uplingmember3_3'];
				$this->amount		=	$commission3[0]['setting_value'];
				$this->type			=	'monthly';
				$this->master_type	=	'main_balance';
				$this->payment_insert();
				
				$this->amount		=	$pay3[0]['setting_value'];
				$this->type			=	'10by3';
				$this->master_type	=	'10by3';
				$this->real_field	=	'10by3_real';
				$this->payment_insert(true);
					
			}
			if($virtual_five_three[0]['uplingmember5_3']!='' && isset($virtual_five_three[0]))
			{
				$payment_level['tree5_3']=$virtual_five_three[0]['uplingmember5_3'];
			
			}
			if($virtual_ten_three[0]['uplingmember10_3']!='' && isset($virtual_ten_three[0]))
			{	
				$payment_level['tree10_3']=$virtual_ten_three[0]['uplingmember10_3'];
			}
			
			$this->member_payment_model->addItem($payment_level,'daily_payment_level');
			
			$pay_value	=	$this->member_payment_model->get_setting_value_by_lable('default_commission_to_admin');
			$d_data['usercode']		=	'0';
			$d_data['amount']		=	$pay_value[0]['setting_value'];
			$d_data['adminfee']		=	'1';
			$d_data['type']			=	'monthly';
			$d_data['timedt']		=	$nowdt;
			$this->member_payment_model->addItem($d_data, 'payment_monthly');
			$this->auto_load_model->master_balance_update('main_balance',0,$pay_value[0]['setting_value'],'plus');
			//********************Direct Payment End************************//
			
			//********************Virtual Payment End************************//
			$this->coded_residual($pay_usercode,$paymentcode);
			
			
			
		header('Location: '.base_url().'index.php/'.$back_url);
		exit;
	}
	
	function payment_insert($real=false)
	{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$data['paymentcode']	=	$this->paymentcode;
			$data['ref_code']		=	$this->ref_code;
			$data['timedt']			=	$nowdt;
			$data['usercode']		=	$this->usercode;
			$data['amount']			=	$this->amount;
			$data['type']			=	$this->type;		
			$this->member_payment_model->addItem($data,'payment_monthly');
			$this->auto_load_model->master_balance_update($this->master_type,$this->usercode,$this->amount,'plus');
			if($real==true){
				$this->auto_load_model->master_balance_update($this->real_field,$this->usercode,$this->amount,'plus');	
			}
	}
	
	
	function coded_residual($usercode, $paymentcode)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$ref_user	=	$this->member_payment_model->get_user_reffral($usercode);
		$referralid =	$ref_user[0]['referralid'];
			
		$coded					=	$this->member_payment_model->get_setting_value_by_lable('enrollment_code');
		$coded_match			=	$this->member_payment_model->get_setting_value_by_lable('enrollment_code_match');
		$residual_amount		=	$this->member_payment_model->get_setting_value_by_lable('codded_residual');
		$residual_match_amount	=	$this->member_payment_model->get_setting_value_by_lable('coded_residual_match');
	
		$d_data['paymentcode']	=	$paymentcode;
		$d_data['ref_code']		=	$usercode;
		$d_data['timedt']		=	$nowdt;
		
		
		
		$tot=$this->member_payment_model->get_total_reffral($referralid);
		if($tot[0]['tot'] > 2)
		{
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded';
			$data['usercode_by']	=	$referralid;
			$data['adminfee']		=	'0';
			$this->member_payment_model->addItem($data,'coded_residual');
			
			$d_data['usercode']		=	$referralid;
			$d_data['amount']		=	$coded[0]['setting_value'];
			$d_data['type']			=	'coded';
			$this->member_payment_model->addItem($d_data, 'payment_monthly');
			$this->auto_load_model->master_balance_update('main_balance',$referralid,$coded[0]['setting_value'],'plus');
			
			$coded_match_usercode	=	$this->member_payment_model->get_user_reffral($referralid);
			$coded_match_usercode 	=	$coded_match_usercode[0]['referralid'];
			
			if($ref[0]['referralid']=='0'){
					$data['adminfee']			=	'1';
					$d_data['adminfee']			=	'1';
			}
			else{
					$data['adminfee']			=	'0';
			}
			
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded_match';
			$data['usercode_by']	=	$coded_match_usercode;
			$this->member_payment_model->addItem($data,'coded_residual');
			
			$d_data['usercode']		=	$coded_match_usercode;
			$d_data['amount']		=	$coded_match[0]['setting_value'];
			$d_data['type']			=	'coded_match';
			$this->member_payment_model->addItem($d_data, 'payment_monthly');
			$this->auto_load_model->master_balance_update('main_balance',$coded_match_usercode,$coded_match[0]['setting_value'],'plus');
				
		}//end if
		else{
			$ref=$this->member_payment_model->get_coded_residual($referralid); 
			
			if(isset($ref[0])){
				if($ref[0]['type']=='residual'){
					$data['level']		=	$ref[0]['level']+1;
				}
				
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual';
				$data['usercode_by']	=	$ref[0]['ucode'];
				
				$this->member_payment_model->addItem($data,'coded_residual');
				
				$d_data['usercode']		=	$ref[0]['ucode'];
				$d_data['amount']		=	$residual_amount[0]['setting_value'];
				$d_data['type']			=	'residual';
				$this->member_payment_model->addItem($d_data, 'payment_monthly');
				$this->auto_load_model->master_balance_update('main_balance',$ref[0]['ucode'],$residual_amount[0]['setting_value'],'plus');
			}
			
			$ref=$this->member_payment_model->get_coded_match_residual_match($referralid);
			if(isset($ref[0]))
			{
				if($ref[0]['type']=='residual_match'){
					$data['level']		=	$ref[0]['level']+1;
				}
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual_match';
				$data['usercode_by']	=	$ref[0]['ucode'];
				
				$this->member_payment_model->addItem($data,'coded_residual');

				$d_data['usercode']		=	$ref[0]['ucode'];
				$d_data['amount']		=	$residual_match_amount[0]['setting_value'];
				$d_data['type']			=	'residual_match';
				$this->member_payment_model->addItem($d_data, 'payment_monthly');
				$this->auto_load_model->master_balance_update('main_balance',$ref[0]['ucode'],$residual_match_amount[0]['setting_value'],'plus');
			}
	
			//exit;
		}//end else
	}
	
	
	
	
}

