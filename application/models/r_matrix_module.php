<?php
Class r_matrix_module extends CI_Model
{
 	function get_pages_contain($page_key)
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page');
   		$this -> db -> where('page_key', ''.$page_key.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}

	function get_pages_cms($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	

	function get_sdk_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_in_tree(){
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	} 
	
	function check_request()
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status !=','C');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_record_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('idcode', ''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_recycle_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_member_payment');
		$this -> db -> where('position', ''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (!isset($the_content[0])) ? true : false; 
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
