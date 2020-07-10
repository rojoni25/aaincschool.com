<?php
Class member_inactive_model extends CI_Model
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
	
	function get_child_member_by_code($eid){
		$this -> db -> select('member_node_master.*');
		$this -> db -> select('membermaster.fname,membermaster.lname');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('member_node_master.uplingmember3_3', ''.$eid.'');
		$this -> db -> join('membermaster','membermaster.usercode = member_node_master.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_all_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_monthly');
   		$this -> db -> where('ref_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_upling_level($field,$usercode)
	{
		$this -> db -> select(''.$field.' as code');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode',''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_level_update($field, $field2, $usercode){
			$this->db->set(''.$field.'', '`'.$field.'`- 1', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`- 1', FALSE);
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('member_level_track_master');
	}
	
	function get_all_payment_paid($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function balance_update($field, $usercode, $amount){
		$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
		$this->db->where('usercode',''.$usercode.'');
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
	
	function row_delete($wf,$wv,$tbl)
  	{
      $this->db->where($wf, $wv);
      $this->db->delete($tbl); 
	  
  	}
  	
  
	
}
?>
