<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_free_member_set_default extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		//if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('cornjob_daily_model','',TRUE); 
 	}
	
	public function free()
	{
		$today_stam = 	strtotime(date('d-m-Y'));
		$result		=	$this->cornjob_daily_model->get_free_member_default_set();
		$ch_date	=	$this->cornjob_daily_model->check_default_set_date($today_stam,'free_member');
		if(isset($ch_date[0])){
			$entrycode	=	$ch_date[0]['idcode'];
		}
		else{
			$ent['type']		=	'free_member';
			$ent['create_date']	=	$today_stam;
			$entrycode	=	$this->cornjob_daily_model->addItem($ent,'default_set_entry');
		}
		
		for($i=0;$i<count($result);$i++)
		{
			$data=array();
			$data['3by3']			=	$result[$i]['exp3by3'];
			$data['5by3']			=	$result[$i]['exp5by3'];
			$data['10by3']			=	$result[$i]['exp10by3'];
			$data['3by3daily']		=	'0';
			$data['5by3daily']		=	'0';
			$data['10by3daily']		=	'0';
			$data['3by3level1']		=	'0';
			$data['3by3level2']		=	'0';
			$data['3by3level3']		=	'0';
			$data['5by3level1']		=	'0';
			$data['5by3level2']		=	'0';
			$data['5by3level3']		=	'0';
			$data['10by3level1']	=	'0';
			$data['10by3level2']	=	'0';
			$data['10by3level3']	=	'0';
			$this->cornjob_daily_model->update($data,'master_balance_sheet_free','usercode',$result[$i]['usercode']);
			
			$ent=array();
			$ent['record']=$i+1;
			$this->cornjob_daily_model->update($ent,'default_set_entry','idcode',$entrycode);
			
		}
	}
	
	
	
	
}

