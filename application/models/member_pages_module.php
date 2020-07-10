<?php
Class member_pages_module extends CI_Model
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
	
	function getAll($page_section)
 	{	
   		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('capture_page_master.page_section',''.$page_section.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_record($eid){
		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.capture_page_code', ''.$eid.'');
		$this -> db -> where('capture_page_master.usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function delete_capture_page_preview()
	{
		$this->db->where('usercode','0');
		$this->db->delete('capture_page_preview');
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function table_fildld_name($tbl)
	{
		$result = $this->db->list_fields($tbl);
		foreach($result as $field)
		{
			$data[] = $field;
			
		}
		return $data;
	}
	
}
?>
