<?php
Class email_send_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=', 'Delete');
		$this -> db -> where('referralid', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 	function get_all_member()
	{
		$this -> db -> select('fname,lname,emailid,usercode');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> or_where('(usercode="1" or usercode="'.$this->session->userdata['logged_ol_member']['ref_by'].'")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_email_list($list){
		$this -> db -> select('emailid');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN ('.$list.')');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
 	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function addItem($data,$table)
	{
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue)
	{
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
  	
  
	
}
?>
