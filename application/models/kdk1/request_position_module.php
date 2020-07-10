<?php
Class request_position_module extends CI_Model
{
 	
	 
 	function get_all_pending_request($eid)
	{
		$this -> db -> select('*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('req_type','Multi');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_all_accept_request($eid)
	{
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*');
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.idcode, '.MATRIX_TABLE_PRE.'matrix.add_time'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join(''.MATRIX_TABLE_PRE.'matrix',''.MATRIX_TABLE_PRE.'matrix.request_code = '.MATRIX_TABLE_PRE.'matrix_request.request_code','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','Multi');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function transaction_report_by_position($eid,$type){
		
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('position_code',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
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
