<?php
Class rm_request_position_module extends CI_Model
{
 	
 
 	function get_all_pending_request($eid)
	{
		$this -> db -> select('*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('request_code NOT IN (select request_code from rm_matrix)');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('req_type','Multi');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_all_accept_request($eid)
	{
		$this -> db -> select('rm_matrix_request.*');
		$this -> db -> select('rm_matrix.idcode, rm_matrix.add_time'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('rm_matrix','rm_matrix.request_code = rm_matrix_request.request_code','left');
		$this -> db -> where('rm_matrix_request.request_code IN (select request_code from rm_matrix)');
		$this -> db -> where('rm_matrix_request.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('rm_matrix_request.req_type','Multi');
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
