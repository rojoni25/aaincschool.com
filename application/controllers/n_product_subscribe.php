<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_subscribe extends CI_Controller {
	
	protected $loginname		=	"86erJQ3k";
	protected $transactionkey	=	"47xPSvp5F54332J3";
	protected $host 			= 	"api.authorize.net";
	protected $path 			= 	"/xml/v1/request.api";
	
	
	
		
	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('n_product_subscribe_model','ObjM',TRUE);
		$this->load->library('email');
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
 	}


	function success(){
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_subscribe_true');
		$this->load->view('comman/footer');
	}
	
	function subscription_create(){
		
		$this->check_subscription_record();
		
		$member_dt	=	$this->ObjM->get_member_dt();
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		if($_POST['product']=='2')
		{
			$amount	=	100;
			$length	 =  6;
			$totalOccurrences='4';
			
		}else
		{
			$amount	=	15;
			$length	 =  1;
			$totalOccurrences='24';
			
		}
		
		$amount 			= 	$amount;
		$refId 				= 	$_POST["refId"];
		$name 				= 	'product monthly';
		$length 			= 	$length;
		$unit 				= 	'months';
		$startDate 			= 	date('Y-m-d');
		$totalOccurrences 	= 	$totalOccurrences;
		$trialOccurrences 	= 	0;
		$trialAmount 		= 	0;
		$cardNumber 		= 	$_POST["cardNumber"];
		$expirationDate 	= 	$_POST["expirationDate"];
		$firstName 			= 	$member_dt[0]['fname'];
		$lastName 			= 	$member_dt[0]['lname'];
	
//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			"<merchantAuthentication>".
			"<name>" . $this->loginname . "</name>".
			"<transactionKey>" . $this->transactionkey . "</transactionKey>".
			"</merchantAuthentication>".
			"<refId>" . $refId . "</refId>".
			"<subscription>".
			"<name>" . $name . "</name>".
			"<paymentSchedule>".
			"<interval>".
			"<length>". $length ."</length>".
			"<unit>". $unit ."</unit>".
			"</interval>".
			"<startDate>" . $startDate . "</startDate>".
			"<totalOccurrences>". $totalOccurrences . "</totalOccurrences>".
			"<trialOccurrences>". $trialOccurrences . "</trialOccurrences>".
			"</paymentSchedule>".
			"<amount>". $amount ."</amount>".
			"<trialAmount>" . $trialAmount . "</trialAmount>".
			"<payment>".
			"<creditCard>".
			"<cardNumber>" . $cardNumber . "</cardNumber>".
			"<expirationDate>" . $expirationDate . "</expirationDate>".
			"</creditCard>".
			"</payment>".
			"<billTo>".
			"<firstName>". $firstName . "</firstName>".
			"<lastName>" . $lastName . "</lastName>".
			"</billTo>".
			"</subscription>".
			"</ARBCreateSubscriptionRequest>";
		
		//send the xml via curl
		$response = $this->send_request_via_curl($this->host,$this->path,$content);
		
		$info=$this->parse_return($response);
		$data=array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['inputf']		=	json_encode($_POST);
		$data['resultf']	=	json_encode($info);
		$data['timedt']		=	time();
		$this->ObjM->addItem($data,'card_payment_history');
		
		if(isset($info['subscriptionId']) && $info['code']=='I00001'){
			
			$this->insert_subscription($info);
			$this->insert_member($info);
			
			$this->session->set_flashdata('show_msg', '<strong>Subscription Successfully</strong>');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/success");
			exit;
			
		}
		else{
			
			$this->session->set_flashdata('show_msg','<strong>Transaction Failed :</strong> '.$info['text'].'');
			header('Location: '.base_url().'index.php/n_product/subscription/'.$_POST['product']."/");
			exit;
			
		}
			
	}
	
	
	protected function insert_subscription($info){
		
		$data=array();
		
		$data['usercode']				=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['subscription_time']		=	time();
		$data['subscription_id']		=	$info['subscriptionId'];
		$data['subscription_detail']	=	json_encode($info);
		$data['subscription_input']		=	json_encode($_POST);
		$id = $this->ObjM->addItem($data,'n_product_subscription');
		
	}
	
		
	protected function insert_member($info){
		
		if($_POST['product']=='2')
		{
			$due_date	=	strtotime('+6 month',time());
			$product_type	=	'2';
		}else
		{
			$due_date	=	strtotime('+1 month',time());
			$product_type	=	'1';
		}
		
		$data=array();
		$data['usercode']				=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['join_time']				=	time();
		$data['join_date']				=	strtotime(date('d-m-Y'));
		$data['due_time']				=	$due_date;
		$data['product_type']			=	$product_type;
		$data['subscription_id']		=	$info['subscriptionId'];
			
		$id = $this->ObjM->addItem($data,'n_product_member');
		
	}
		
		
		//function to send xml request via curl
		function send_request_via_curl($host,$path,$content)
		{
			$posturl = "https://" . $host . $path;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $posturl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			return $response;
		}
		
		
		//function to parse Authorize.net response
		function parse_return($content)
		{
			$info['refId'] 			= 	$this->substring_between($content,'<refId>','</refId>');
			$info['resultCode'] 	=	$this->substring_between($content,'<resultCode>','</resultCode>');
			$info['code'] 			=   $this->substring_between($content,'<code>','</code>');
			$info['text'] 			=   $this->substring_between($content,'<text>','</text>');
			$info['subscriptionId'] =   $this->substring_between($content,'<subscriptionId>','</subscriptionId>');
			return $info;
		}
		
		//helper function for parsing response
		function substring_between($haystack,$start,$end) 
		{
			if (strpos($haystack,$start) === false || strpos($haystack,$end) === false) 
			{
				return false;
			} 
			else 
			{
				$start_position = strpos($haystack,$start)+strlen($start);
				$end_position = strpos($haystack,$end);
				return substr($haystack,$start_position,$end_position-$start_position);
			}
		}
		
		
		function check_subscription_record(){
			
			if($this->asm_class->check_in_tree())
			{
				header('Location: '.base_url().'index.php/n_product');
				exit;
			}
			
		}
		
	
}

