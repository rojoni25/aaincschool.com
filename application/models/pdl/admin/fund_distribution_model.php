<?php
Class fund_distribution_model extends CI_Model
{
	

	function get_all_payment(){
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('pdl_monthly_payment.*');
   		$this -> db -> from('pdl_monthly_payment');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_monthly_payment.usercode','left');
		$this -> db -> order_by('id','asc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_by_payment_get($eid)
	{
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('pdl_member_payment.*');
   		$this -> db -> from('pdl_member_payment');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_member_payment.usercode','left');
		$this -> db -> where('pdl_member_payment.paymentcode',''.$eid.'');
		$this -> db -> order_by('id','asc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('cms_pages_code',''.$eid.'');
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
