<?php
Class r_matrix_notification_model extends CI_Model
{
	

	function get_member_by_code($eid)
	{		
		$this -> db -> select("CONCAT(fname,' ',SUBSTRING(lname,1,1)) as name, username, emailid, usercode, email_verification, subscribe", FALSE);
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
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
