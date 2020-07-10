<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Diamond_class {

	function main_balance($eid)
	{
	  $arr=array();		
	  $arr['in']		=	$this->main_income($eid);
	  $arr['out']		=	$this->main_payment($eid);
	  $arr['balance']	=	 $arr['in']-$arr['out'];
	  return $arr;
	}
	
	function main_income($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('diamond_payment');
		$CI -> db  -> where('usercode',''.$CI->session->userdata['logged_ol_member']['usercode'].'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	function main_payment($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('diamond_withdrawal');
		$CI -> db  -> where('usercode',''.$CI->session->userdata['logged_ol_member']['usercode'].'');
		$CI -> db  -> where('status !=','Cancel');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	
}
