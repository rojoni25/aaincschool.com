<?php
Class cms_model extends CI_Model
{
 	
	
 	function get_all($status,$arr){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'cms.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'cms');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_record_by_id($eid)
	{
		$this -> db -> select(''.MATRIX_TABLE_PRE.'cms.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'cms');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'cms.page_code',''.$eid.'');	
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_page_by_lable($eid)
	{
		$this -> db -> select(''.MATRIX_TABLE_PRE.'cms.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'cms');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'cms.pagelable',''.$eid.'');	
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
