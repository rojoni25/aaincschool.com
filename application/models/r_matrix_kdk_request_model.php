<?php
Class r_matrix_kdk_request_model extends CI_Model
{
	
	function get_request_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code_request.*'); 
   		$this -> db -> from('rm_kdk_code_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code_request.usercode','left');
		$this -> db -> where('rm_kdk_code_request.status','Active');
		$this -> db -> where('rm_kdk_code_request.usercode NOT IN (select usercode from rm_kdk_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_by_id($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code_request.*'); 
   		$this -> db -> from('rm_kdk_code_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code_request.usercode','left');
		$this -> db -> where('rm_kdk_code_request.status','Active');
		$this -> db -> where('rm_kdk_code_request.usercode NOT IN (select usercode from rm_kdk_code)');
		$this -> db -> where('rm_kdk_code_request.id',''.$id.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function check_kdk_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
   		$this -> db -> where('kdk_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_kdk_code_by_usercode($eid){
		$this -> db -> select("membermaster.*", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
		$this -> db -> where('rm_kdk_code.id',''.$eid.'');
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
	
	function get_unuse_kdk_list($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
		$this -> db -> where('rm_kdk_code.kdk_code NOT IN (select kdk_code from rm_kdk_code_use GROUP BY kdk_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pending_request($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
		$this -> db -> where('rm_kdk_code.usercode NOT IN (select usercode from rm_matrix_request GROUP BY kdk_code)');
		$this -> db -> where('rm_kdk_code.usercode NOT IN (select usercode from rm_matrix GROUP BY kdk_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	
}
?>
