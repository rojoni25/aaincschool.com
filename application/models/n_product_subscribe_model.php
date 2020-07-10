<?php
Class n_product_subscribe_model extends CI_Model
{
	
	function get_member_dt()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_usercode_by_tree($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count_by_tree($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_subscription()
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_subscription');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function n_product_member_by_usercode($eid){
		$this -> db -> select('upling');
   		$this -> db -> from('n_product_member');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('upling !=','0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		if(isset($the_content[0]['upling'])){
			
			return $the_content[0]['upling'];		
		
		}
		else{
			
			return 1;	
				
		}
    		
	}
	
	function product_balance_update($field,$usercode,$amount){

		$this->db->set(''.$field.'', ''.$field.'+ '.$amount.'', FALSE);
		$this->db->where('usercode',''.$usercode.'');
		$this->db->update('n_product_member');
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	
	function check_subscribe()
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_subscription');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function n_product_member_hold(){
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member_hold');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function check_in_true()
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	

}
?>
