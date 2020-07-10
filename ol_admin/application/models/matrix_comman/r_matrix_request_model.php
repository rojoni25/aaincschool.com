<?php
Class r_matrix_request_model extends CI_Model
{
	
	
	
	function get_request_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code_request.status','Active');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code_request.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_by_id($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code_request.status','Active');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code_request.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'access_code)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code_request.id',''.$id.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function check_access_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
   		$this -> db -> where('access_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_access_code_by_usercode($eid){
		$this -> db -> select("membermaster.*", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.id',''.$eid.'');
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
	
	function get_unuse_list($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.access_code NOT IN (select access_code from '.MATRIX_TABLE_PRE.'access_code_use GROUP BY access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pending_request($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix_request GROUP BY access_code)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix GROUP BY access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	
}
?>
