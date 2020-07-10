<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_reverse_ten_by_three extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model','',TRUE); 
		$this->load->model('user_model','',TRUE); 
 	}
	
	public function index()
	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();	
		
		$all_payment 		= 	$this->cornjob_daily_model->get_all_reverse_payment('10_3');
		if(count($all_payment)>0){
			foreach ($all_payment as $pay) {
				$usercode = $pay['usercode'];
				$payment_check=$this->cornjob_daily_model->check_paid_reverse_payment_date('10by3','free',$usercode);
				if(count($payment_check)>0)
				{
					echo 'Today '.date('d-m-Y').'free daily payment 5 x 3 is done';
					exit;
				}else{
					$pay_level_one		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level1');
					$pay_level_two		=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level2');
					$pay_level_three	=	$this->cornjob_daily_model->get_setting_value_by_lable('daily_commission_10x3_level3');
					
					$total_payment=(float)$pay_level_one[0]['setting_value'] + (float)$pay_level_two[0]['setting_value'] + (float)$pay_level_three[0]['setting_value'];
					
					$remainwallet = $this->cornjob_daily_model->get_paid_reverse_remain_wallet($usercode,'10_3');

					$newremain = $remainwallet - $total_payment;
					$rdata['remain_10_3'] = $newremain;
					$this->cornjob_daily_model->update($rdata,'tbl_reverse_wallet','usercode',$usercode);
					
					$uplinememberlevelArr = $this->cornjob_daily_model->get_reverse_upling_chain($usercode,'uplingmember10_3');
					//level 1
					$L1data['receiverid'] = $uplinememberlevelArr['lev1'];
					$L1data['senderid'] = $usercode;
					$L1data['amount'] = $pay_level_one[0]['setting_value'];
					$L1data['type'] = '10by3';
					$L1data['date'] = date('Y-m-d');
					$this->cornjob_daily_model->addItem($L1data,'tbl_bonus_wallet');
					$data = array();
					$data['receiverid'] =  $uplinememberlevelArr['lev1'];
			        $data['senderid'] =  $usercode;
			        $data['amount'] =  $pay_level_one[0]['setting_value'];
			        $data['plan'] =  '0';
			        $data['type'] =  'reverse';
			        $data['date'] =  date('Y-m-d H:i:s');
			        $this->user_model->addItem($data,'tbl_visible_wallet');
					//level 2
					$L2data['receiverid'] = $uplinememberlevelArr['lev2'];
					$L2data['senderid'] = $usercode;
					$L2data['amount'] =$pay_level_two[0]['setting_value'];
					$L2data['type'] = '10by3';
					$L2data['date'] = date('Y-m-d');
					$this->cornjob_daily_model->addItem($L2data,'tbl_bonus_wallet');
					$data = array();
			        $data['receiverid'] =  $uplinememberlevelArr['lev2'];
			        $data['senderid'] =  $usercode;
			        $data['amount'] =  $pay_level_two[0]['setting_value'];
			        $data['plan'] =  '0';
			        $data['type'] =  'reverse';
			        $data['date'] =  date('Y-m-d H:i:s');
			        $this->user_model->addItem($data,'tbl_visible_wallet');
					//level 3  
					$L3data['receiverid'] = $uplinememberlevelArr['lev3'];
					$L3data['senderid'] = $usercode;
					$L3data['amount'] = $pay_level_three[0]['setting_value'];
					$L3data['type'] = '10by3';
					$L3data['date'] = date('Y-m-d');
					$this->cornjob_daily_model->addItem($L3data,'tbl_bonus_wallet');
					$data = array();
			        $data['receiverid'] =  $uplinememberlevelArr['lev3'];
			        $data['senderid'] =  $usercode;
			        $data['amount'] =  $pay_level_three[0]['setting_value'];
			        $data['plan'] =  '0';
			        $data['type'] =  'reverse';
			        $data['date'] =  date('Y-m-d H:i:s');
			        $this->user_model->addItem($data,'tbl_visible_wallet');


					$data2['pay_day']		=	date('d');
					$data2['pay_month']		=	date('m');
					$data2['pay_year']		=	date('Y');
					$data2['pay_type']		=	'10by3';
					$data2['timedt']		=	$nowdt;
					$data2['type']			=	'free';
					$data2['usercode']		=	$usercode;
					$datecode=$this->cornjob_daily_model->addItem($data2,'payment_paidreverse_daily_date_entry');
				
				}			
			}
		}
	}
}