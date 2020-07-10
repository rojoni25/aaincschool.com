<?php
Class money_transfer_model extends CI_Model
{
 	function get_balance()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal_request()
	{
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_request_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status','pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pending_request(){
		$this -> db -> select('*');
   		$this -> db -> from('money_transfer_request');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('id NOT IN (select request_code from withdrawal_balance where type="5" and usercode="'.$this->session->userdata['logged_ol_member']['usercode'].'")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function master_balance_update($field, $amount, $opration){

			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
			$this->db->update('master_balance_sheet');
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
