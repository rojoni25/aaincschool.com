<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class monthly_payment_active_member extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('re_payment_model','ObjM',TRUE);
		if($this->uri->segment(2)=='marketing_product'){
			header('location: '.base_url().'index.php/auto_pages/page/payment_info_'.$this->uri->segment(3));
			exit;	
		}else{
			header('location: '.base_url().'index.php/auto_pages/page/payment_info');
			exit;
		}
		
		
 	}
	
	
	function pay()
	{
		$this->load->view('active_member_payment');	
	}

	
	function product_pay()
	{
		$this->load->view('product_payment_online');	
	}
	
	function ams_pay($product){
		
	
		if($product=='1'){
			$data['amount']	=	'15';
		}else{
			
			$data['amount']	=	'100';
		}
		
		
		$data['option']			=	$this->option_value();
		$data['decription'] 	= 	"ONE TIME PAYMENT";
		$data['result']			=	$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);
		
		$data['sequence']		= 	rand(1, 1000);
		$data['invoice']		= 	'103_'.time().'_'.$this->session->userdata['logged_ol_member']['usercode'];

		$data['timeStamp']	= time();
		
		if(phpversion() >= '5.1.2')
		{ 
			$data['fingerprint'] = hash_hmac("md5", $data['option']['loginID'] . "^" . $data['sequence']. "^" . $data['timeStamp'] . "^" . $data['amount'] . "^", $data['option']['transactionKey']); 
		}
		else 
		{ 
			$data['fingerprint'] = bin2hex(mhash(MHASH_MD5, $data['option']['loginID'] . "^" . $data['sequence'] . "^" . $data['timeStamp'] . "^" . $data['amount'] . "^", $data['option']['transactionKey'])); 
		}
		
			
		$this->load->view('payment_form/ams_payment_online',$data);	
		
	}
	
	
	function ltpay()
	{
		$data['result']=$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('payment_form/lt_payment_online',$data);		
	}
	
	function gcppay()
	{
		$data['result']=$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('payment_form/gcp_payment_online',$data);		
	}
	
	function clubpay()
	{
		$data['result']=$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('payment_form/club_payment_online',$data);		
	}
	
	function kdk1pay()
	{
		$data['result']=$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('payment_form/kdk_payment_online',$data);		
	}
	
	
	function option_value(){
		
		$option['loginID']			= 	"86erJQ3k";
		$option['transactionKey'] 	= 	"47xPSvp5F54332J3";
		$option['label'] 			= 	"Submit Payment"; 
		$option['testMode']			= 	"false";
		$option['url']				= 	"https://secure.authorize.net/gateway/transact.dll";
		$option['url_succes']		= 	base_url().'index.php/online_payment/success/';
		$option['url_cancel']		= 	base_url().'index.php/upgrade_membership/payment/cancel/';
		return $option;
	}
	
	function marketing_product($eid){
		
		$data['eid']		=	$eid;
		$data['result']		=	$this->ObjM->get_member_by_code($this->session->userdata['logged_ol_member']['usercode']);
		$this->load->view('payment_form/marketing_product_online',$data);		
			
	}
	
}


