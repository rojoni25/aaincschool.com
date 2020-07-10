<?php
Class r_matrix_report_model extends CI_Model
{

	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}

	function get_pif_report()
	{
		$this -> db -> select("CONCAT(membermaster1.fname,' ',SUBSTRING(membermaster1.lname,1,1)) as name, membermaster1.username", FALSE);
		$this -> db -> select("CONCAT(membermaster2.fname,' ',SUBSTRING(membermaster2.lname,1,1)) as pif_by_u, membermaster2.username as by_username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster membermaster1','membermaster1.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> join('membermaster membermaster2','membermaster2.usercode = '.MATRIX_TABLE_PRE.'matrix_request.pif_by','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','PIF');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	 
	 
	
	
	
	
	
}
?>
