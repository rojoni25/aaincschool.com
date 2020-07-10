<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daily_payment extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('vma/daily_payment_model','ObjM',TRUE);
		$this->load->library('vma_class');
 	}
	
	public function view($eid)
	{
		$timedt = strtotime(date('d-m-Y'));
		
		$result = $this->ObjM->get_list();
		
		if(!isset($result[0])){
			echo 'Today Payment Is Done';
			exit;
		}
		
		for($i=0;$i<count($result);$i++){
			
			$member=$this->tree_upling_level($result[$i]['usercode']);
			
			
			//****Level One Payment****//
			$level_member=$member[0];
			$data=array();
			$data['usercode']	=	$level_member['payto'];
  			$data['EndCode'] 	=	$result[$i]['usercode'];
  			$data['level'] 		=	'1';
  			$data['amount']		=	'1.66';
  			$data['timedt'] 	=	strtotime(date('d-m-Y'));
  			$data['date_dt'] 	=	date('Y-m-d');
			$data['type'] 		=	$level_member['type'];
			if($level_member['type']=='unqulified'){$data['option']	=	$level_member['option'];}
			$this->comman_fun->addItem($data,'vma_daily_payment');
			
			
			//****Level Two Payment****//
			$level_member=$member[1];
			$data=array();
			$data['usercode']	=	$level_member['payto'];
  			$data['EndCode'] 	=	$result[$i]['usercode'];
  			$data['level'] 		=	'2';
  			$data['amount']		=	'1.66';
  			$data['timedt'] 	=	strtotime(date('d-m-Y'));
  			$data['date_dt'] 	=	date('Y-m-d');
			$data['type'] 		=	$level_member['type'];
			if($level_member['type']=='unqulified'){$data['option']	=	$level_member['option'];}
			$this->comman_fun->addItem($data,'vma_daily_payment');
			
			//****Level Three Payment****//
			$level_member=$member[2];
			$data=array();
			$data['usercode']	=	$level_member['payto'];
  			$data['EndCode'] 	=	$result[$i]['usercode'];
  			$data['level'] 		=	'3';
  			$data['amount']		=	'1.66';
  			$data['timedt'] 	=	strtotime(date('d-m-Y'));
  			$data['date_dt'] 	=	date('Y-m-d');
			$data['type'] 		=	$level_member['type'];
			if($level_member['type']=='unqulified'){$data['option']	=	$level_member['option'];}
			$this->comman_fun->addItem($data,'vma_daily_payment');
			
			
		}

	}
	
	 function tree_upling_level($eid)
	{
		$result = $this->ObjM->tree_upling_level($eid);
		$main_arr=array();
		
		
		//**Level One**//
		$arr=array();
		if(isset($result[0]['lv1'])){
			if($this->vma_class->check_unqulified($result[0]['lv1'])){
				$arr['payto'] =	$result[0]['lv1'];	
				$arr['type'] =	'none';				
			}else{
				$arr['payto'] 	=		'1';	
				$arr['type'] 	=		'unqulified';
				$arr['option'] 	=		$result[0]['lv1'];	
			}
		}else{
			$arr['payto'] 	=		'1';	
			$arr['type'] 	=		'nolevel';
		}
		array_push($main_arr,$arr);
		
		
		//**Level Two**//
		$arr=array();
		if(isset($result[0]['lv2'])){
			
			if($this->vma_class->check_unqulified($result[0]['lv2'])){
				$arr['payto'] =	$result[0]['lv2'];	
				$arr['type'] =	'none';				
			}else{
				$arr['payto'] 	=		'1';	
				$arr['type'] 	=		'unqulified';
				$arr['option'] 	=		$result[0]['lv2'];	
			}
		}else{
			$arr['payto'] 	=		'1';	
			$arr['type'] 	=		'nolevel';
		}
		array_push($main_arr,$arr);
		
		//**Level Three**//
		$arr=array();
		if($this->vma_class->check_unqulified($result[0]['lv3'])){
			if($result[0]['due3'] > time() || $result[0]['lv3']=='1'){
				$arr['payto'] =	$result[0]['lv3'];	
				$arr['type'] =	'none';				
			}else{
				$arr['payto'] 	=		'1';	
				$arr['type'] 	=		'unqulified';
				$arr['option'] 	=		$result[0]['lv3'];	
			}
		}else{
			$arr['payto'] 	=		'1';	
			$arr['type'] 	=		'nolevel';
		}
		array_push($main_arr,$arr);
		
		return $main_arr;
		
	}
	
	
	
	
	
	
	
	
}

