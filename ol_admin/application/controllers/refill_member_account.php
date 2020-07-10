<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refill_member_account extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('refill_member_account_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['result']	=	$this->ObjM->getAll();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			
			$ac_type=($_POST['account_type']=='personal_wallet') ? "PW" : "CW";
			
    		$data['usercode']	=	$_POST['usercode'];	 
			$data['amount']		=	$_POST['refill_amount'];
			$data['option']		=	'refill_by_admin';
			$data['timedt']		=	time();
			$data['ac_type']	=	$ac_type;
			$id=$this->ObjM->addItem($data,'refill_account');
			
			if($ac_type=='PW'){
				$data=array();
				$data['paymentcode'] = 	$id;
				$data['usercode']    = 	$_POST['usercode'];	 
				$data['amount']      = 	$_POST['refill_amount'];
				$data['timedt']		 =	$nowdt;
				$data['type']		 =	'refill';
				$this->ObjM->addItem($data,'personal_wallet_payment');
				$this->ObjM->master_balance_update('personal_wallet',$_POST['usercode'],$_POST['refill_amount'],'plus');
				$msg='Member Refill Is Successfully Done In Personal  Account';
			}else{
				
				$data=array();
				$data['paymentcode'] = 	$id;
				$data['usercode']    = 	$_POST['usercode'];	 
				$data['amount']      = 	$_POST['refill_amount'];
				$data['timedt']		 =	$nowdt;
				$data['type']		 =	'refill';
				$this->ObjM->addItem($data,'payment_monthly');
				$this->ObjM->master_balance_update('main_balance',$_POST['usercode'],$_POST['refill_amount'],'plus');
				$msg='Member Refill Is Successfully Done In Company  Account';
			}
			
			
			$this->session->set_flashdata('show_msg',$msg);
			
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	
	
	
	
	
}

