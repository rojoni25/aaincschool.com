<?php
Class change_password_model extends CI_Model
{
 	function chack_old_pass()
 	{	
   		$this -> db -> select('password');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function chack_username($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$eid.'');
		$this -> db -> where('usercode !=', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function chack_email($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('emailid', ''.$eid.'');
		$this -> db -> where('usercode !=', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_email_html_by_access_name($eid){
		$this -> db -> select('*');
   		$this -> db -> from('email_html');
   		$this -> db -> where('access_name',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
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
