<?php
Class join_friend_model extends CI_Model
{
 	function getAll($eid)
	{
		$this -> db -> select('company_master.*');
   		$this -> db -> from('company_join_dt');
		$this -> db -> join('company_master','company_master.company_code = company_join_dt.company_code','left');
   		$this -> db -> where('company_join_dt.usercode = '.$this->session->userdata['logged_ol_member']['referralid_free'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	function get_refcode($eid)
	{
		$this -> db -> select('referralid');
   		$this -> db -> from('company_join_dt');
		$this -> db -> where('company_code',''.$eid.'');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_refcode($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('company_join_dt');
		$this -> db -> where('company_code',''.$eid.'');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function self_company()
	{
		$this -> db -> select('*');
		$this -> db -> from('company_master');
   		$this -> db -> where('usercode = '.$this->session->userdata['logged_ol_member']['usercode'].'');
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
