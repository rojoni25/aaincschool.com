<?php
Class ad_account_model extends CI_Model
{

	function get_online_payment_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'account.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'account');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'account.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_payment()
	{
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'account');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['total'];
	}
	
	function member_transaction($eid,$type,$position=false)
	{
		$this -> db -> select('*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('type',''.$type.'');
		$this -> db -> where('usercode',''.$eid.'');
		if($position){
			$this -> db -> where('position_code',''.$position.'');	
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_transaction_total($eid,$type,$position=false)
	{
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('type',''.$type.'');
		$this -> db -> where('usercode',''.$eid.'');
		if($position){
			$this -> db -> where('position_code',''.$position.'');	
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function get_member_record($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode',''.$eid.'');
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
	
	function transaction_report($type)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'member_account.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'member_account.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_account.type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function transaction_report_total($type)
	{
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	
	function transaction_report_by_position($eid,$type){
		
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('position_code',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	
	function get_position($usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> order_by('idcode','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal_request()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'withdrawal_request.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'withdrawal_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'withdrawal_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'withdrawal_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'withdrawal_request.req_id NOT IN (SELECT request_code from '.MATRIX_TABLE_PRE.'member_account)');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'withdrawal_request.req_id','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_withdrawal_request_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'withdrawal_request');
		$this -> db -> where('status !=','C');
		$this -> db -> where('req_id',''.$eid.'');
		$this -> db -> where('req_id NOT IN (SELECT request_code from '.MATRIX_TABLE_PRE.'member_account)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	

	
}
?>
