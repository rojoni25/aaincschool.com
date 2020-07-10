<?php
Class account_module extends CI_Model
{
 	
	function get_position()
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> order_by('idcode','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal_request($position)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'withdrawal_request');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status !=','C');
		if($position!='')
		{
			$this -> db -> where('position_code',''.$position.'');
		}
		$this -> db -> where('req_id NOT IN (SELECT request_code from '.MATRIX_TABLE_PRE.'member_account)');
		$this -> db -> order_by('req_id','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_withdrawal()
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('type','debit');
		$this -> db -> order_by('id','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function transaction_sum_amount($eid,$type)
	{	
		$this -> db -> select('SUM(amount) as total'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_account');
		
		if($eid!=false)
		{
			$this -> db -> where('position_code',''.$eid.'');
		}
		
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
