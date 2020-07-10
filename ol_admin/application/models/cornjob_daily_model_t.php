<?php
Class cornjob_daily_model_t extends CI_Model
{
 	
 
 function get_setting_value_by_lable($value){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function referral_user($eid)
	{
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if($the_content[0]['referralid']=='0'){
			$the_content[0]['referralid']='';
		}
    	return $the_content;
	}
	function tree_upling($eid, $field)
	{
		$this -> db -> select($field.' as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content=($the_content[0]['upling']=='0') ? "1" : $the_content[0]['upling'];
	}
	
	function get_payment_level($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('daily_payment_level');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_level_free($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('daily_payment_level_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_payment_date($field, $type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_daily_date_entry');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$this -> db -> where('type', ''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_all_payment($field)
	{
		$this -> db -> select('usercode');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where(''.$field.' >=', '1',FALSE);
		$this -> db -> where('usercode NOT IN (0,1)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_all_payment_free($field)
	{
		$this -> db -> select('usercode');
   		$this -> db -> from('master_balance_sheet_free');
   		$this -> db -> where(''.$field.' >=', '1',FALSE);
		$this -> db -> where('usercode !=', '1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_free_member_default_set()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db ->or_where('exp3by3 >=','1');
		$this -> db ->or_where('exp5by3 >=','1');
		$this -> db ->or_where('exp10by3 >=','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_paid_member_default_set()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
		$this -> db ->or_where('3by3_real >=','1');
		$this -> db ->or_where('5by3_real >=','1');
		$this -> db ->or_where('10by3_real >=','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function check_default_set_date($eid,$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('default_set_entry');
		$this -> db -> where('create_date',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_pay($arr)
	{
		
		$this -> db -> select('master_balance_sheet.usercode,master_balance_sheet.10by3');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
		$this -> db -> where('membermaster.active_dt <=',''.$arr['active_dt'].'');
		$this -> db -> where('master_balance_sheet.10by3 >=','3');
		//$this -> db -> where("master_balance_sheet.usercode NOT IN (select usercode from master_withdrawal_sheet where time_dt LIKE '%".$arr['like']."%' and balance_type='10by3')");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	  
	}
	
	function get_dummy()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode NOT IN (0,1)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	  
	}
	
	function get_wit_balance()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_withdrawal_sheet');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_inning_payment_sum($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
		
	} 
	
	function get_daily_payment_sum($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('master_withdrawal_sheet');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('balance_type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	} 
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	function update_pay_select($val){
		$this -> db -> select('*');
   		$this -> db -> from('payment_daily');
		$this -> db ->where('timestm',$val['timestm']);
		//$this -> db ->where('level',$val['level']);
		$this -> db ->where('pay_type',$val['pay_type']);
		$this -> db ->where('usercode',$val['usercode']);
		$this -> db ->where('paymentcode','0');
		$this -> db ->order_by("daily_pay_code", "asc");
		$this -> db ->limit(1);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function update_pay($data,$val)
	{
		$this->db->where('daily_pay_code',$val);
		$this->db->update('payment_daily',$data); 
	}	
  	
	
	
	function delete_pay_entry($time, $table)
	{
		$this->db->where('timestm <=',''.$time.'');
		$this->db->delete($table);
	}
  
	
}
?>
