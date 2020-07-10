<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class three_test extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model_t','ObjM',TRUE); 
 	}
	
	
	
	
	function test2()
	{
		$result=$this->ObjM->get_dummy();
		
		for($i=0;$i<count($result);$i++){
			$inning_sum			=	$this->ObjM->get_inning_payment_sum($result[$i]['usercode'],'10by3');
			$daily_payment_sum	=	$this->ObjM->get_daily_payment_sum($result[$i]['usercode'],'10by3');	
			$balance			=	$inning_sum - $daily_payment_sum;
			$data=array();
			$data['10by3']=$balance;
			$this->ObjM->update($data,'master_balance_sheet','usercode',$result[$i]['usercode']);
		}
		
	}
	
	
}

