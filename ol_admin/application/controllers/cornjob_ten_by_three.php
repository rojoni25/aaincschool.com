<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_ten_by_three extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model','',TRUE); 
 	}
	
	public function index()
	{
		
		$today_stam = strtotime(date('d-m-Y'));
	    
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$payment_check=$this->cornjob_daily_model->check_payment_date('10by3','paid');
		
		if(count($payment_check)>0){
			echo 'Today '.date('d-m-Y').' daily payment 10 x 3 is done';
			exit;
		}	
		
		$all_payment = $this->cornjob_daily_model->get_all_payment('10by3');
		
		$pay_level_one		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level1');
		$pay_level_two		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level2');
		$pay_level_three	=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level3');
		$total_payment=(float)$pay_level_one[0]['setting_value'] + (float)$pay_level_two[0]['setting_value'] + (float)$pay_level_three[0]['setting_value'];
		  
		$data2['pay_day']		=	date('d');
		$data2['pay_month']		=	date('m');
		$data2['pay_year']		=	date('Y');
		$data2['pay_type']		=	'10by3';
		$data2['timedt']		=	$nowdt;
		$data2['type']			=	'paid';
		$datecode=$this->cornjob_daily_model->addItem($data2,'payment_daily_date_entry');
		
		$pay['pay_day']		=	date('d');
		$pay['pay_month']	=	date('m');
		$pay['pay_year']	=	date('Y');
		$pay['pay_type']	=	'10by3';
		$pay['timedt']		=	$nowdt;
		$pay['timestm']		=	$today_stam;
		
		for($i=0;$i<count($all_payment);$i++)
		{
				$one_level=$this->cornjob_daily_model->tree_upling($all_payment[$i]['usercode'],'uplingmember10_3');
				$two_level=$this->cornjob_daily_model->tree_upling($one_level,'uplingmember10_3');
				$three_level=$this->cornjob_daily_model->tree_upling($two_level,'uplingmember10_3');
				
				
				$this->auto_load_model->master_balance_update_paid('10by3daily','main_balance',$one_level,$pay_level_one[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$one_level;
				$pay['level']		=	'1';
				$pay['amount']		=	$pay_level_one[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily');
				
			
				
				$this->auto_load_model->master_balance_update_paid('10by3daily','main_balance',$two_level,$pay_level_two[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$two_level;
				$pay['level']		=	'2';
				$pay['amount']		=	$pay_level_two[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily');
				
			
				
				$this->auto_load_model->master_balance_update_paid('10by3daily','main_balance',$three_level,$pay_level_three[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$three_level;
				$pay['level']		=	'3';
				$pay['amount']		=	$pay_level_three[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily');
				
				
				$this->auto_load_model->master_balance_update('10by3',$all_payment[$i]['usercode'],$total_payment,'minus');
				
				$withdrawal['usercode']			=	$all_payment[$i]['usercode'];
			  	$withdrawal['balance_type']		=	'10by3';
				$withdrawal['amount']			=	$total_payment;
			  	$withdrawal['withdrawal_type']	=	'DailyPayment';
			  	$withdrawal['time_dt']			=	$nowdt;
				$withdrawal['time_stm']			=	strtotime(date('d-m-Y'));
				$this->cornjob_daily_model->addItem($withdrawal,'master_withdrawal_sheet');
				
				$dt['last_entry']=$i+1;
				$this->cornjob_daily_model->update($dt,'payment_daily_date_entry','payment_daily_date_code',$datecode);
		
		}
		
	}
	
	
	
}

