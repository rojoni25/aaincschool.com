<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_test extends CI_Controller {

	protected $loginname="3N6u5uK49HxD";
	protected $transactionkey="28e897sNj583NwS9";
	protected $host = "api.authorize.net";
	protected $path = "/xml/v1/request.api";
	
	
	//protected $loginname="9gKRH3q33sC";
//	protected $transactionkey="9A63uyZ269dU99fs";
//	protected $host = "apitest.authorize.net";
//	protected $path = "/xml/v1/request.api";
	
	
	
	function subscriptionInactive()
	{

		$content['ARBGetSubscriptionListRequest']=array(
			'merchantAuthentication'=>array(
				'name'=>$this->loginname,
				'transactionKey'=>$this->transactionkey
			),	
			//'searchType'=>'subscriptionInactive',
			'searchType'=>'subscriptionActive',
			'sorting'=>array(
				'orderBy'=>'id',
				'orderDescending'=>'false'
			),	
			'paging'=>array(
				'limit'=>'1000',
				'offset'=>'1'
			),	
		);
		

				
		$response = $this->send_request_via_curl($this->host,$this->path,$content);
		
	
		
	    $response=$this->removeBOM($response);
		
		$response=json_decode($response,true);
		
		var_dump($response);
	
		
		//$info=$this->parse_return($response);	
	}
	
	
	function removeBOM($str=""){
    	if(substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
        	$str=substr($str, 3);
   	 	}
    	return $str;
	}

	
	//function to send xml request via curl
		function send_request_via_curl($host,$path,$content)
		{
			$posturl = "https://" . $host . $path;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $posturl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_HEADER,false);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($content));
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
		
		
		

	
	
	
}


