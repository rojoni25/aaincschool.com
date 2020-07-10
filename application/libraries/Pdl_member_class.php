<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pdl_member_class {

	protected $CI;
	protected $payment=array();
	protected $max_withdrawal_1=25;
	protected $max_withdrawal_2=59;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->set_payment();
	}

	function set_payment()
	{
		
		$payment_1		=	$this->get_total_amount('pdl_1');	
		$withdrawal_1	=	$this->get_total_withdrawal('pdl_1');
		$balance_1		=	$payment_1 - $withdrawal_1;		
		
		
		$payment_2		=	$this->get_total_amount('pdl_2');	
		$withdrawal_2	=	$this->get_total_withdrawal('pdl_2');
		$balance_2		=	$payment_2 - $withdrawal_2;	
		
		
		$this->payment['payment_1']		=	$payment_1;	
		$this->payment['withdrawal_1']	=	$withdrawal_1;	
		$this->payment['balance_1']		=	$balance_1;
	
		
		if($balance_1 > $this->max_withdrawal_1)
		{		
			$this->payment['max_withdrawal_1']	=	$balance_1	-	$this->max_withdrawal_1;	
		}
		
		else
		{
			$this->payment['max_withdrawal_1']	=	0;
		}
		
		
		$this->payment['payment_2']		=	$payment_2;	
		$this->payment['withdrawal_2']	=	$withdrawal_2;	
		$this->payment['balance_2']		=	$balance_2;
		
		
		if($balance_2 > $this->max_withdrawal_2)
		{	
			$this->payment['max_withdrawal_2']	=	$balance_2	-	$this->max_withdrawal_2;	
		}
		else
		{
			$this->payment['max_withdrawal_2']	=	0;
		}
		
		$payment_3		=	$this->get_total_amount('opp_wallet');	
		$withdrawal_3	=	$this->get_total_withdrawal('opp_wallet');
		$balance_3		=	$payment_3 - $withdrawal_3;	
		
		$this->payment['payment_3']			=	$payment_3;	
		$this->payment['withdrawal_3']		=	$withdrawal_3;	
		$this->payment['balance_3']			=	$balance_3;
		$this->payment['max_withdrawal_3']	=	$balance_3;
	}
	
 	function get_total_amount($wallet_type)
	{
		$this->CI->db-> select('SUM(amount) as tot');
   		$this->CI->db-> from('pdl_member_payment');
		$this->CI->db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
		$this->	CI->db ->where('wallet_type',''.$wallet_type.'');
		$query = $this->CI-> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_total_withdrawal($wallet_type)
	{
		$this->CI-> db -> select('SUM(amount) as tot');
   		$this->CI-> db -> from('pdl_withdrawal');
		$this->CI-> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
		$this->CI-> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this->CI-> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_value($field)
	{
		return $this->payment[$field];
	}
	
	

	
	
}
