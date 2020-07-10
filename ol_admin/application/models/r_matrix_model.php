<?php
Class r_matrix_model extends CI_Model
{
	

	function userdt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> where('rm_matrix.idcode', ''.$eid.'');
		$this -> db -> order_by('rm_matrix.side', 'asc');
		
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
	
	
	
	
	//Get Product member record by usercode//
	function kdk_member_dt($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	

	 //Member Serch//
	function search_member($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode="'.$eid.'" OR username="'.$eid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_kdkcode_list(){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_request_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_request.usercode','left');
		$this -> db -> where('rm_matrix_request.status !=','C');
		$this -> db -> where('rm_matrix_request.usercode NOT IN (select usercode from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function remove_kdk_code($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete('rm_kdk_code'); 
	}
	
	function check_kdk_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
   		$this -> db -> where('kdk_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_dt_by_id($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_request.usercode','left');
		$this -> db -> where('rm_matrix_request.request_code',''.$eid.'');
		$this -> db -> where('rm_matrix_request.status','P');
		$this -> db -> where('rm_matrix_request.usercode NOT IN (select usercode from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_member_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('idcode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_member_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix.*'); 
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> group_by('rm_matrix.usercode'); 
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_postion($id){
		
		$this -> db -> select("CONCAT(user1.fname,' ',user1.lname) AS name1", FALSE);
		$this -> db -> select("CONCAT(user2.fname,' ',user2.lname) AS name2", FALSE);
		
		$this -> db -> select('rm_matrix.*',FALSE);
   		
		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		
	
		$this -> db -> where('rm_matrix.usercode',''.$id.'');
	
	
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_downline_record($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_countdownline($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('idcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	 
	 
	
	
	
	
	
}
?>
