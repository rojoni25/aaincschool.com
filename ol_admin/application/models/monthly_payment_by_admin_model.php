<?php
Class monthly_payment_by_admin_model extends CI_Model
{
 	
	
	function get_member_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_member_by_username($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$eid.'');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_payment_level($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_current_balance($usercode){
		$this -> db -> select('main_balance');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode',''.$usercode.'');
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
