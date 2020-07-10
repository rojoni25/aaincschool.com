<?php
Class profile_model extends CI_Model
{
 	
 	
 	function getPaymentRecord(){
		$this -> db -> select('*');
   		$this -> db -> from('squareup_payment');
   		// $this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_email($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('emailid',''.$eid.'');
   		$this -> db -> where('usercode !=',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_country(){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_pages_contain_two($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
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
