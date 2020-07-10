<?php
Class pdl_member_home_model extends CI_Model
{
	
	function check_in_tree(){
		$this -> db -> select('*');
   		$this -> db -> from('pdl_member');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
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
	
	
	function count_unread_message(){
		
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_message');
		$this -> db -> where('send_to', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('read_status', '0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
		
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
