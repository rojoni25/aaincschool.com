<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_online_payment extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $first_pay		=	false;
	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->model('n_product_online_payment_module','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	
	
	
	function monthly_subscription_rep()
	{
		$data=array();
		
		$data['datadt']		=	json_encode($_POST);
		
		$data['type']		=	"Real_Req";
		
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
	
	protected function subscription_flase(){
		
		$detail=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);
		
		$data['usercode']			=	$detail[0]['usercode'];
		
		$data['x_response_code']	=	$_POST['x_response_code'];
		
		$data['post_data']			=	json_encode($_POST);
		
		$data['time_dt']			=	time();
		
		$this->ObjM->addItem($data,'pdl_payment_false');
	}
	
	
	
	//****Member Payment Intry****//
	protected function member_payment_insert($arr){	
		
		$detail=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);
		
		$data=array();
		$data['usercode']			=	$detail[0]['usercode'];
		$data['amount']				=	$_POST['x_amount'];
		$data['txn_id']				=	$_POST['x_trans_id'];
		$data['date_dt']			=	strtotime(date('d-m-Y'));
		$data['time_dt']			=	strtotime('+1 month',time());
		$data['option']				=	json_encode($_POST);
		$data['pay_type']			=	'Monthly Subscription';
		
		$amount		=	(int)$_POST['x_amount'];
		
		
		
		$id = $this->ObjM->addItem($data,'n_product_monthly_payment');
		
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
	
	
	
	
	
	
	
	
	
}

