<?php
Class ad_product_model extends CI_Model
{
 	
	
 	function get_all($status){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'product.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'product');
		if($status)
		{
			$this -> db -> where(''.MATRIX_TABLE_PRE.'product.status','Active');	
		}
		
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_record_by_id($eid,$status)
	{
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'product.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'product');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'product.product_code',''.$eid.'');	
		if($status){
			$this -> db -> where(''.MATRIX_TABLE_PRE.'product.status','Active');	
		}
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
