<?php
Class payment_confirm_model extends CI_Model
{
 	
	
	
	
	function get_upling_ref_member($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_admin_email()
	{
		$this -> db -> select("emailid");
   		$this -> db -> from('admin_login');
		$this -> db -> where('usercode','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
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
	
	function get_confirmation_report()
	{
		$this -> db -> select('*');
   		$this -> db -> from('admin_message');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
 
	
}
?>
