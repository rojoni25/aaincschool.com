<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_there_by_three_free extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model','',TRUE); 
 	}
	
	public function index()
	{
		
		$today_stam = strtotime(date('d-m-Y'));
	    $timestamp = strtotime('-2 days',$today_stam);
		
		//$this->cornjob_daily_model->delete_pay_entry($timestamp,'payment_daily_free');
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();	
		$payment_check=$this->cornjob_daily_model->check_payment_date('3by3','free');
		$all_payment 		= 	$this->cornjob_daily_model->get_all_payment_free('3by3');
		
		if(count($payment_check)>0)
		{
			echo 'Today '.date('d-m-Y').'free daily payment 3 x 3 is done';
			exit;
		}
		
	
		$pay_level_one		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_3x3_level1');
		$pay_level_two		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_3x3_level2');
		$pay_level_three	=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_3x3_level3');
		
		$total_payment=(float)$pay_level_one[0]['setting_value'] + (float)$pay_level_two[0]['setting_value'] + (float)$pay_level_three[0]['setting_value'];
		
		$data2['pay_day']		=	date('d');
		$data2['pay_month']		=	date('m');
		$data2['pay_year']		=	date('Y');
		$data2['pay_type']		=	'3by3';
		$data2['timedt']		=	$nowdt;
		$data2['type']			=	'free';
		$datecode=$this->cornjob_daily_model->addItem($data2,'payment_daily_date_entry');
		
		$pay['pay_day']		=	date('d');
		$pay['pay_month']	=	date('m');
		$pay['pay_year']	=	date('Y');
		$pay['pay_type']	=	'3by3';
		$pay['timedt']		=	$nowdt;
		$pay['timestm']		=	$today_stam;
		
		
		for($i=0;$i<count($all_payment);$i++)
		{
				
				//****Level One Payment****//
				$result		=	$this->cornjob_daily_model->get_payment_level_free($all_payment[$i]['usercode']);
				
				if($result[0]['tree3_1']=='0'){	$usercode='1';}
				else{$usercode=$result[0]['tree3_1'];}
				$this->auto_load_model->master_balance_update_multi('3by3daily','3by3level1',$usercode,$pay_level_one[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$usercode;
				$pay['level']		=	'1';
				$pay['amount']		=	$pay_level_one[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily_free');
				//****Level Two Payment****//
				
				if($result[0]['tree3_2']=='0'){	$usercode='1';}
				else{$usercode=$result[0]['tree3_2'];}
				$this->auto_load_model->master_balance_update_multi('3by3daily','3by3level2',$usercode,$pay_level_two[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$usercode;
				$pay['level']		=	'2';
				$pay['amount']		=	$pay_level_two[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily_free');
				

			    //****Level Three Payment****//
				if($result[0]['tree3_3']=='0'){	$usercode='1';}
				else{$usercode=$result[0]['tree3_3'];}
				$this->auto_load_model->master_balance_update_multi('3by3daily','3by3level3',$usercode,$pay_level_three[0]['setting_value']);
				$pay['paymentcode']	=	$all_payment[$i]['usercode'];
				$pay['usercode']	=	$usercode;
				$pay['level']		=	'3';
				$pay['amount']		=	$pay_level_three[0]['setting_value'];
				$this->cornjob_daily_model->addItem($pay,'payment_daily_free');
				
				
				$dt['last_entry']=$i+1;
				$this->cornjob_daily_model->update($dt,'payment_daily_date_entry','payment_daily_date_code',$datecode);
				
				$this->auto_load_model->master_balance_update_free('3by3',$all_payment[$i]['usercode'],$total_payment,'minus');
					  	
		 }
			
	}
	
	
}



