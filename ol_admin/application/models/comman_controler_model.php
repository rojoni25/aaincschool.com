<?php
Class comman_controler_model extends CI_Model
{
	

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
		$this -> db -> select('master_balance_sheet.3by3, master_balance_sheet.5by3, master_balance_sheet.10by3');
		$this -> db -> select('member_node_master.uplingmember3_3, member_node_master.uplingmember5_3, member_node_master.uplingmember10_3');
   		$this -> db -> from('membermaster');
		$this -> db -> join('member_node_master','membermaster.usercode = member_node_master.usercode','left');
		$this -> db -> join('master_balance_sheet','master_balance_sheet.usercode = membermaster.usercode','left');
		$this -> db -> where('membermaster.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_all_detail_by_username($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> select('member_node_master_free.uplingmember3_3, member_node_master_free.uplingmember5_3, member_node_master_free.uplingmember10_3');
   		$this -> db -> from('membermaster');
		$this -> db -> join('member_node_master_free','membermaster.usercode = member_node_master_free.usercode','left');
		$this -> db -> where('membermaster.username', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_paid_tree_detail($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_total_referral($eid){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('referralid', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_detail_by_id($eid)
	{
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member($eid)
	{
		$this -> db -> select('*');
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
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		if(isset($eid[1])){
			$this->db->where('(fname="'.$eid[0].'" and lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('usercode', ''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%")');
			}	
		}
		
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_filter_active($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		if(isset($eid[1])){
			$this->db->where('(fname="'.$eid[0].'" and lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('usercode', ''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%")');
			}	
		}
		$this -> db -> where('status','Active');
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
	
	function get_level_summary($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_level_track_master_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_level_summary_free($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_level_track_master_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_coded_residual_id($eid, $usercode)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('coded_residual');
		$this -> db -> where('type',''.$eid.'');
   		$this -> db -> where('usercode_by',''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_daily_payment_paid($usercode)
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function sum_monthly_pay_by_type($type, $usercode){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}

	function sum_daily_pay_by_type($pay_type, $usercode)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> where('pay_type',''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}

	function sum_withdrawal_balance_by_type($type, $usercode){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}

	function sum_withdrawal_balance($wallet_type, $usercode){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type !=','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}

	function get_daily_payment_free($usercode)
	{
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
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
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$this->db->group_by('level');
		$this->db->order_by("level","asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function yesterday_payment_sum($usercode, $field){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function sum_by_pay_type($usercode, $field){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('pay_type', ''.$field.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function payment_monthly_by_type($usercode, $field)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode', ''.$usercode.'');
		if($field!=''){
			$this -> db -> where('type', ''.$field.'');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;

  //   	$this -> db -> select("*");
  //  		$this -> db -> from('master_balance_sheet_free');
		// $this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		// $query = $this -> db -> get();
  //   	$the_content = $query->result_array();
  //   	return $the_content;

	}
	function get_main_balance($usercode){
		$this -> db -> select("main_balance as total",false);
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function login_user_count()
	{
		$timestamp= time().'<br>';
		$timestamp=strtotime('-40 second', $timestamp);
		
		$this -> db -> select("count(*) as tot");
   		$this -> db -> from('login_info');
		$this -> db -> where('last_event >', ''.$timestamp.'');
		$this -> db -> where('availeble','Y');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function login_user_in_day()
	{
		$timestamp= time().'<br>';
		$timestamp=strtotime('-1 day', $timestamp);
		$this->	 db -> distinct();
		$this -> db -> select("usercode");
   		$this -> db -> from('login_info');
		$this -> db -> where('last_event >', ''.$timestamp.'');
		$this -> db -> where('usercode NOT IN (0,1)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function check_paid_request($eid){
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function count_withdrawal_request(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('withdrawal_request_master');
		$this -> db -> where('status','pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
  	
  
	
}
?>
