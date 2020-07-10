<?php
Class comman_controler_free_model extends CI_Model
{
 	function __construct()
 	{
   		$this->coded_residual				=	'coded_residual_free';
		$this->member_level_track_master	=	'member_level_track_master_free';
		$this->member_node_master			=	'member_node_master_free';
		$this->referralid					=	'referralid';
		$this->payment_daily				=	'payment_daily_free';
 	}
	
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 	function get_member_all_detail_by_id($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> select(''.$this->member_node_master.'.uplingmember3_3, '.$this->member_node_master.'.uplingmember5_3, '.$this->member_node_master.'.uplingmember10_3');
   		$this -> db -> from('membermaster');
		$this -> db -> join(''.$this->member_node_master.'','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> where('membermaster.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_member_all_detail_by_username($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> select(''.$this->member_node_master.'.uplingmember3_3, '.$this->member_node_master.'.uplingmember5_3, '.$this->member_node_master.'.uplingmember10_3');
   		$this -> db -> from('membermaster');
		$this -> db -> join(''.$this->member_node_master.'','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> where('membermaster.username', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_total_referral($eid){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where(''.$this->referralid.'', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_member_detail_by_id($eid)
	{
		$this -> db -> select('usercode,fname,lname,username');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_email_address()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('emailid', ''.$this->uri->segment(3).'');
		if($this->uri->segment(4)=='Edit'){
			$this -> db -> where('usercode !=', ''.$this->uri->segment(5).'');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_email_address_panding_member()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_pending');
   		$this -> db -> where('emailid', ''.$this->uri->segment(3).'');
		if($this->uri->segment(4)=='Edit'){
			$this -> db -> where('usercode !=', ''.$this->uri->segment(5).'');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function check_username()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$this->uri->segment(3).'');
		if($this->uri->segment(4)=='Edit'){
			$this -> db -> where('usercode !=', ''.$this->uri->segment(5).'');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function check_username_panding_member()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_pending');
   		$this -> db -> where('username', ''.$this->uri->segment(3).'');
		if($this->uri->segment(4)=='Edit'){
			$this -> db -> where('usercode !=', ''.$this->uri->segment(5).'');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		$this->db->where('(fname  LIKE "%'.$eid.'%" or lname  LIKE "%'.$eid.'%"  or usercode  LIKE "%'.$eid.'%")');
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
  	
	function get_level_summary($eid='')
	{
		if($eid==''){
			if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
				$eid=$this->session->userdata['logged_in_visa']['usercode'];
			} elseif(isset($this->session->userdata['logged_ol_member']['usercode'])){
				$eid=$this->session->userdata['logged_ol_member']['usercode'];
			}
		}
		$this->db->select('*');
   		$this->db->from(''.$this->member_level_track_master.'');
		$this->db->where('usercode', $eid);
		$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_setting_value_by_lable($value){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function yesterday_payment_sum_by_level($usercode, $field){
		
		$today_stam = strtotime(date('d-m-Y'));
	    $timestamp = strtotime('-1 days',$today_stam);
		
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from($this->payment_daily);
   		$this -> db -> where('pay_type', ''.$field.'');

   		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
   		// 	$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
   		// }
   		// elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
   		// {
   		// 	$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		// }
		$this -> db -> where('usercode', $usercode);
		$this -> db -> where('timestm', ''.$timestamp.'');
		
		$this->db->group_by('level');
		$this->db->order_by("level","asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function yesterday_payment_sum($usercode, $field)
	{
		$today_stam = strtotime(date('d-m-Y'));
	    $timestamp = strtotime('-1 days',$today_stam);
		
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from($this->payment_daily);
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('usercode', $usercode);

		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}

		$this -> db -> where('timestm', ''.$timestamp.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_by_pay_type($field)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_daily_payment_free()
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_daily_payment_paid()
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function sum_monthly_pay_by_type($type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
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
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$this -> db -> where('pay_type',''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function sum_withdrawal_balance($wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
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
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function sum_by_pay_type_free($field)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily_free');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
    
    function payment_monthly_by_type($field)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		if($field!=''){
			$this -> db -> where('type', ''.$field.'');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
    
    function get_main_balance(){
		$this -> db -> select("main_balance as total",false);
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_residual_id($eid)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.$this->coded_residual.'');
		$this -> db -> where('type',''.$eid.'');
   		$this -> db -> where('usercode_by',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
   		// 	$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
   		// }
   		// elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
   		// {
   		// 	$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		// }
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function free_daily_payment_level()
	{
		$this -> db -> select("*");
   		$this -> db -> from('free_daily_payment_level');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_check_upgrade_request()
	{
		$this -> db -> select("*");
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_notification()
	{
		$this -> db -> select("count(*) as tot");
   		$this -> db -> from('notification_master');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// if (isset($this->session->userdata['logged_in_visa']['usercode'])) {
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
  //  		}
  //  		elseif(isset($this->session->userdata['logged_ol_member']['usercode']))
  //  		{
  //  			$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
  //  		}
		$this -> db -> where('status', 'Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function cms_by_lable($eid)
	{
		$this -> db -> select("*");
   		$this -> db -> from('cms_pages_master');
		$this -> db -> where('pagelable',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
  	
  
	
}
