<?php
Class cms_model extends CI_Model
{
	

	function ger_pdl_pages(){
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
		$this -> db -> where('status','Active');
		$this -> db -> where('page_type','PDL_Page');
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
