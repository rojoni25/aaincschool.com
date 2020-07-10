<?php
Class withdrawal_request_model extends CI_Model
{
	

	function get_all_pending_request(){
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('pdl_withdrawal_request.*');
   		$this -> db -> from('pdl_withdrawal_request');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_withdrawal_request.usercode','left');
		$this -> db -> where('pdl_withdrawal_request.status !=', 'delete');
		$this -> db -> where('pdl_withdrawal_request.request_code NOT IN (select request_code from pdl_withdrawal)');
		$this -> db -> order_by('pdl_withdrawal_request.request_code','asc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_pending_request_by_code($eid){
			
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('pdl_withdrawal_request.*');
   		$this -> db -> from('pdl_withdrawal_request');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_withdrawal_request.usercode','left');
		$this -> db -> where('pdl_withdrawal_request.status !=', 'delete');
		$this -> db -> where('pdl_withdrawal_request.request_code NOT IN (select request_code from pdl_withdrawal)');
		$this -> db -> where('pdl_withdrawal_request.request_code', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function pdl_to_opp_payment()
	{
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('pdl_withdrawal.*');
   		$this -> db -> from('pdl_withdrawal');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_withdrawal.usercode','left');
		$this -> db -> where('pdl_withdrawal.type','2');
		$this -> db -> where('pdl_withdrawal.wallet_type','pdl_2');
		$this -> db -> order_by('pdl_withdrawal.id','desc');
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
