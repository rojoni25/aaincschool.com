<?php
Class n_product_online_payment_module extends CI_Model
{
 	
	
	function get_member_usercode($eid)
 	{	
   		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
		$this -> db -> where('usercode', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content[0];
 	}
	

	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function get_subscription_record($eid)
	{
   		$this -> db -> select('*');
   		$this -> db -> from('n_product_subscription');
		$this -> db -> where('subscription_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	
	
 
	
}
?>
