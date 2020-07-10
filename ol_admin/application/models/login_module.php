<?php
Class login_module extends CI_Model
{
 	function loginsub($username, $password)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('username', ''.$username.'');
   		$this -> db -> where('password',''.$password.'');
		
		
   		$this -> db -> limit(1);
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
