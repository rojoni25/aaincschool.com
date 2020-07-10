<?php
Class cms_pages_model extends CI_Model
{
 	function getAll($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('status !=', 'Delete');
		if($this->session->userdata['logged_in_visa']['user_type_id']=='2'){
			$this -> db -> where('is_subaccess', '1');
		}
		if($eid!=''){
			$this -> db -> where('page_type',''.$eid.'');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('cms_pages_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_page_type()
	{
		$this -> db -> select('page_type');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> group_by('page_type'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_custom_page()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('custom_cms_page');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_custom_page_by_id($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('custom_cms_page');
   		$this -> db -> where('status !=', 'Delete');
		$this -> db -> where('pagecode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_permition_member_list($eid){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('custom_cms_page_permission.*'); 
   		$this -> db -> from('custom_cms_page_permission');
		$this -> db -> join('membermaster','membermaster.usercode = custom_cms_page_permission.usercode','left');
		$this -> db -> where('custom_cms_page_permission.pagecode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function search_member($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode="'.$eid.'" OR username="'.$eid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_member($eid,$pagecode){
		$this -> db -> select('*');
   		$this -> db -> from('custom_cms_page_permission');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pagecode',''.$pagecode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function remove_permission($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete('custom_cms_page_permission'); 
	}
	
	function addItem($data,$table)
	{
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue)
	{
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
  	
 
 	
  	
  
	
}
?>
