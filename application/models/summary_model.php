<?php
Class summary_model extends CI_Model
{
	protected $coded_residual;
	protected $member_level_track_master;
	protected $member_node_master;
	protected $referralid;
	protected $payment_daily;
	
	
	function __construct()
 	{
   		$this->coded_residual				=	$this->session->userdata['tbl']['coded_residual'];
		$this->member_level_track_master	=	$this->session->userdata['tbl']['member_level_track_master'];
		$this->member_node_master			=	$this->session->userdata['tbl']['member_node_master'];
		$this->referralid					=	$this->session->userdata['tbl']['referralid'];
		$this->payment_daily				=	$this->session->userdata['tbl']['payment_daily'];
 	}
 	function get_setting_value_by_lable($value)
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_residual_id($eid)
	{
		$this -> db -> select('count(*) as tot');
		$this -> db -> from(''.$this->session->userdata['tbl']['coded_residual'].'');
		$this -> db -> where('type',''.$eid.'');
   		$this -> db -> where('usercode_by',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_daily_payment_paid()
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function sum_monthly_pay_by_type($type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	function sum_daily_pay_by_type($pay_type)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('pay_type',''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	function sum_withdrawal_balance($wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type !=','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function sum_withdrawal_balance_by_type($type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	function get_level_summary()
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.$this->member_level_track_master.'');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_daily_payment_free()
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
	
}
?>
