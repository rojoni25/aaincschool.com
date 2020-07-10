<?php
Class loginsucess_model extends CI_Model
{
	function getAll_capturepages()
 	{	
   		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('member_pending.fname, member_pending.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('member_pending','member_pending.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.usercode', ''.$this->session->userdata['logged_ol_member_free']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_free_page(){
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where("(page_for='both' || page_for='free')");
   		$this -> db -> where('status !=', 'Delete');
		$this -> db -> where('change', 'N');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_page_code(){
		$this -> db -> select('capture_page_master.*');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where("capture_page_code NOT IN (select capture_page_code from capture_page_detail where usercode='".$this->session->userdata['logged_ol_member_free']['usercode']."')", NULL, FALSE);
   		$this -> db -> where('capture_page_master.change', 'Y');
		$this -> db -> where('capture_page_master.page_for !=', 'registered');
		$this -> db -> where('capture_page_master.usercode', '0');
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
