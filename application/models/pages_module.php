<?php
Class pages_module extends CI_Model
{
 	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	function get_after_reg_contain($eid)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where('capture_page_code',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	//-------------------dfsm----------------------------
	function get_pages_dfsm_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	
	function get_after_reg_dfsm_contain($pagecode)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('m2m_capture_master');
		$this -> db -> where('page_code',''.$pagecode.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	//-------------------dfsm----------------------------
	
	function get_reg_preview($eid)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('capture_page_preview');
		$this -> db -> where('capture_page_code',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function addItem($data,$table){
		
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
		
	}
	
	function getSoftwareLicenseAmount()
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
		$this -> db -> where('lable_acces_nm','software_license');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}
	
}
?>
