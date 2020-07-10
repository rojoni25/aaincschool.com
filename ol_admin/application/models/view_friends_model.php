<?php
Class view_friends_model extends CI_Model
{
 	function getAll($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid',''.$this->session->userdata['logged_in_visa']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_admin_dt(){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function invite_friends_history()
	{
		$this -> db -> select('*');
   		$this -> db -> from('invite_friend_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_in_visa']['usercode'].'');
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
