<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class calculate_bonus extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model','',TRUE); 
		error_reporting(E_ALL);
 	}
	
	public function index()
	{
		$uplinememberlevelArr = $this->cornjob_daily_model->get_reverse_upling_chain_free(29,'uplingmember5_3');
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();	
		
		$all_payment 		= 	$this->cornjob_daily_model->get_all_reverse_payment_free('5_3');
		if(count($all_payment)>0){
			foreach ($all_payment as $pay) {
				$usercode = $pay['usercode'];
				$payment_check=$this->cornjob_daily_model->check_reverse_payment_date('5by3','free',$usercode);
				if(count($payment_check)>0)
				{
					//echo 'Today '.date('d-m-Y').'free daily payment 5 x 3 is done';
					//exit;
				}else{
					$pay_level_one		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_5x3_level1');
					$pay_level_two		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_5x3_level2');
					$pay_level_three	=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_5x3_level3');
					
					$total_payment=(float)$pay_level_one[0]['setting_value'] + (float)$pay_level_two[0]['setting_value'] + (float)$pay_level_three[0]['setting_value'];
					
					$remainwallet = $this->cornjob_daily_model->get_reverse_remain_wallet($usercode,'5_3');

					$newremain = $remainwallet - $total_payment;
					$rdata['remain_5_3'] = $newremain;
					$this->cornjob_daily_model->update($rdata,'tbl_free_reverse_wallet','usercode',$usercode);
					
					$uplinememberlevelArr = $this->cornjob_daily_model->get_reverse_upling_chain_free($usercode,'uplingmember5_3');
					



					$data2['pay_day']		=	date('d');
					$data2['pay_month']		=	date('m');
					$data2['pay_year']		=	date('Y');
					$data2['pay_type']		=	'5by3';
					$data2['timedt']		=	$nowdt;
					$data2['type']			=	'free';
					$data2['usercode']		=	$usercode;
					$datecode=$this->cornjob_daily_model->addItem($data2,'payment_reverse_daily_date_entry');
				
				}			
			}
		}
	}
}