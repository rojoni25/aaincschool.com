<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_subscribe extends CI_Controller {

	protected $loginname="3N6u5uK49HxD";
	protected $transactionkey="28e897sNj583NwS9";
	protected $host = "api.authorize.net";
	protected $path = "/xml/v1/request.api";
	
	
	//protected $loginname="9gKRH3q33sC";//	protected $transactionkey="9A63uyZ269dU99fs";//	protected $host = "apitest.authorize.net";//	protected $path = "/xml/v1/request.api";
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		
		$this->load->model('pdl_subscribe_module','ObjM',TRUE);
		
		$this->load->library('email');
   		
 	}
	
	function add()
	{
		$this->check_join();
		
		$this->new_subscribe();
	}
	
	function success()
	{
		
		$data['title']		=	'Subscription Successfully';
		$data['msg']		=	'Your Subscribe is Successfully';
		$data['contain']	=	$this->ObjM->get_pages_contain('subscribe_successfully');
			
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_member/pdl_show_msg',$data);
		$this->load->view('comman/footer');	
	}
	
	protected function new_subscribe()
	{
		
		$data['contain']=$this->ObjM->get_pages_contain('subscribe_page');
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header');
		
		$this->load->view('pdl_member/pdl_subscribe_add',$data);
		
		$this->load->view('comman/footer');	
		
	}
	
	protected function check_join()
	{
		if($this->ObjM->check_in_true())
		{
			header('Location: '.base_url().'index.php/pdl/pdl_member_home/view');
			exit;				
		}
		
		if($this->ObjM->check_subscription()){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/subscription_pending");
			exit;
		}
	}
	
	function subscription_pending(){
		
		
		if($this->ObjM->check_subscription())
		{
			if($this->ObjM->check_payment_flase())
			{
				if(!$this->ObjM->last_card_update())
				{
					$this->card_update();	
						
				}else
				{
					$this->under_review();
				}
				
				
			}else
			{
				$this->under_review();
			}
		}
		
	}
	
	
	
	
	protected function under_review(){
		
		$data['title']			=		'Subscribe';
		$data['contain']		=		$this->ObjM->get_pages_contain('under_review');	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');	
		$this->load->view('pdl_member/pdl_show_msg',$data);
		$this->load->view('comman/footer');	
		
	}
	
	protected function card_update()
	{
		$data['card_update']	=	true;
		$data['title']			=	'Card Update';
		$data['contain']		=	$this->ObjM->get_pages_contain('pdl_card_update_payment_false');
		
	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');	
		$this->load->view('pdl_member/pdl_card_update',$data);
		$this->load->view('comman/footer');
	}
	
	
	function subscription_create(){
		
		
		$this->check_join();
		
		$member_dt	=	$this->ObjM->get_member_dt();
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$amount 			= 	25;
		$refId 				= 	$_POST["refId"];
		$name 				= 	'product monthly';
		$length 			= 	'1';
		$unit 				= 	'months';
		$startDate 			= 	date('Y-m-d');
		$totalOccurrences 	= 	'24';
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
		 $data['inputf']	=	json_encode($_POST);
		 $data['resultf']	=	json_encode($info);
		 $data['timedt']	=	time();
		 $this->ObjM->addItem($data,'pdl_card_history');
		

		if(isset($info['subscriptionId']) && $info['code']=='I00001'){
			
			$this->insert_subscription($info);
			$this->send_email_to_admin($info);
			$this->session->set_flashdata('show_msg', '<strong>Subscription Successfully</strong>');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/success");
			exit;
		}
		else{
			$this->session->set_flashdata('show_msg','<strong>Transaction Failed :</strong> '.$info['text'].'');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/add");
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
		$id = $this->ObjM->addItem($data,'pdl_subscription');
		
		
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
		
		
		function send_email_to_admin($info)
		{
			$member_dt	=	$this->session->userdata['logged_ol_member'];
			$admin_email=$this->ObjM->get_admin_email();
		
			// $message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Name	:'.$member_dt['fullname'].' ('.$member_dt['usercode'].')Subscription Id	:'.$info['subscriptionId'].'<br>Subscription Id	:'.$info['subscriptionId'].' <br>Date :'.date('d-m-Y H:i:s').'</p>';
			// $message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Above Member has applied for PDL Subsription and status is under Review.</p>';
			$message = get_email_cms_page_master('pdl_subscribe')->result()[0]->textdt;
			$message = str_replace("[fullname]",$member_dt['fullname'],$message);
			$message = str_replace("[usercode]",$member_dt['usercode'],$message);
			$message = str_replace("[subscriptionId]",$info['subscriptionId'],$message);
			$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
			
			$e_array=array("heading"=>"PDL Subscribe","msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
		
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email);
			// $this->email->subject('PDL Subscribe');
			// $this->email->message($message);
			// $p=$this->email->send();
			sendemail(FROM_EMAIL,'PDL Subscribe',$admin_email,$message);
			
			if($member_dt['email_verification']=='Y'){
				
				$message='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Hello,	'.$member_dt['fullname'].' Thanks for your Subscription</p>';
				$message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">You subsription is under review till 24 hrs and We will Update you soon as it has been Approved By system.</p>';
				
				$e_array=array("heading"=>"PDL Subscribe","msg"=>$message,"contain"=>'');	
				$message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($admin_email);
				// $this->email->subject('PDL Subscribe');
				// $this->email->message($message);
				// $p=$this->email->send();
			sendemail(FROM_EMAIL,'PDL Subscribe',$admin_email,$message);					
			}
			
		}
		
		
		function subscription_update(){		
			
			if(!$this->ObjM->check_payment_false())
			{
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/subscription_pending");
				exit;	
			}
			
			
			$refId 				= 	$this->session->userdata['logged_ol_member']['usercode'];
			$cardNumber 		= 	$_POST["cardNumber"];
			$expirationDate 	= 	$_POST["expirationDate"];
	
			$subscription_dt	=	$this->ObjM->get_subscription();
			
			$content='<?xml version="1.0" encoding="utf-8"?>
			<ARBUpdateSubscriptionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
			<merchantAuthentication>
			<name>'.$this->loginname.'</name>
			<transactionKey>'.$this->transactionkey.'</transactionKey>
			</merchantAuthentication>
			<refId>Sample</refId>
			<subscriptionId>'.$subscription_dt[0]['subscription_id'].'</subscriptionId>
			<subscription>
			<payment>
			<creditCard>
			<cardNumber>'.$cardNumber.'</cardNumber>
			<expirationDate>'.$expirationDate.'</expirationDate>
			</creditCard>
			</payment>
			</subscription>
			</ARBUpdateSubscriptionRequest>';
			
			
		
			$response = $this->send_request_via_curl($this->host,$this->path,$content);
		
		 	$info=$this->parse_return($response);
			
			$data=array();
		 	$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		 	$data['inputf']		=	json_encode($_POST);
		 	$data['resultf']	=	json_encode($info);
		 	$data['timedt']		=	time();
		 	$this->ObjM->addItem($data,'pdl_card_history');
			
			if($info['code']=='I00001')
			{
				$data=array();
				$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['inputf']		=	json_encode($_POST);
				$data['timedt']		=	time();
				$this->ObjM->addItem($data,'pdl_card_update');
					
				$this->session->set_flashdata('show_msg', '<strong>Card Update Successfully</strong>');
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/success");
				exit;
			}
			else{
				$this->session->set_flashdata('show_msg','<strong> Failed :</strong> '.$info['text'].'');
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1)."/subscription_pending");
				exit;
			}
			
			
		}
		
		

}


