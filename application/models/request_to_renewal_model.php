<?php
Class request_to_renewal_model extends CI_Model
{
 	function getAll(){
		$this -> db -> select('membermaster.*');
		$this -> db -> select('request_to_renewal.request_status, request_to_renewal.request_send_time, request_to_renewal.request_code');
   		$this -> db -> from('request_to_renewal');
		$this -> db -> join('membermaster','membermaster.usercode = request_to_renewal.renewal_usercode','left');
   		$this -> db -> where('request_to_renewal.usercode = '.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('request_to_renewal.request_status IN ("Pending", "Done")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_current_balance()
	{
		$this -> db -> select('main_balance,personal_wallet');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		$arr=array(
			'main_balance'=>(float)$the_content[0]['main_balance'],
			'personal_wallet'=>(float)$the_content[0]['personal_wallet']
		);
    	return $arr;
	}
	
	function find_member($key){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode = "'.$key.'" OR username = "'.$key.'" )');
		$this -> db -> where('status !=','Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_member_by_usercode($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function check_request_send($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function check_request($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('request_to_renewal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('renewal_usercode',''.$eid.'');
		$this -> db -> where('request_status','Pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function master_balance_update($field, $amount){
			$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
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
		return $this->db->affected_rows();
	}
 
 	
  	
  
	
}
?>
