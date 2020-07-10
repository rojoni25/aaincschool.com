<?php
Class profile_model extends CI_Model
{
 	
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode', '1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_country(){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
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
