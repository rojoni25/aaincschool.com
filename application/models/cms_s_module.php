<?php
Class cms_s_module extends CI_Model
{
 	function get_pages_cms($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	
	function get_custom_page($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('custom_cms_page');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function ger_permistion($eid){
		
		
   		$this -> db -> select('*');
   		$this -> db -> from('custom_cms_page_permission');
   		$this -> db -> where('pagecode', ''.$eid.'');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
}
?>
