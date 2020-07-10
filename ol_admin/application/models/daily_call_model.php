<?php
Class daily_call_model extends CI_Model
{
 	
	
	function get_setting_value_by_lable($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_member_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_send_request_member($eid)
	{
		$this -> db -> select('paid_request_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.emailid');
   		$this -> db -> from('paid_request_master');
		$this -> db -> join('membermaster','membermaster.usercode = paid_request_master.usercode','left');
   		$this -> db -> where('paid_request_master.timedt >=',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function check_request_by_usercode($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode',''.$eid.'');
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
	
	
	
 
 
	
}
?>
