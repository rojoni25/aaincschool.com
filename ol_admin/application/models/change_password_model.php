<?php
Class change_password_model extends CI_Model
{
 	function chack_old_pass()
 	{	
   		$this -> db -> select('password');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_in_visa']['usercode'].'');
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
