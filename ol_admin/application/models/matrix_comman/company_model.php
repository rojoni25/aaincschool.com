<?php
Class company_model extends CI_Model
{
 	
	
 	function get_all($status,$arr){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'company.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'company');
		if($status)
		{
			$this -> db -> where(''.MATRIX_TABLE_PRE.'company.status','Active');	
		}
		
		if($arr['section']!='')
		{
			$this -> db -> where(''.MATRIX_TABLE_PRE.'company.section',''.$arr['section'].'');	
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_record_by_id($eid,$status){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'company.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'company');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'company.company_code',''.$eid.'');	
		if($status){
			$this -> db -> where(''.MATRIX_TABLE_PRE.'company.status','Active');	
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	
	}
	

	function get_message_by_id($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
	function company_page_hit($eid)
	{
			$this->db->set('page_hit', 'page_hit + 1', FALSE);	
			$this->db->where('company_code',''.$eid.'');
			$this->db->update(MATRIX_TABLE_PRE.'company');
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
