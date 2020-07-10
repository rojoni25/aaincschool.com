<?php
Class auto_responder_email_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('email_html');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_record($eid)
	{
		$this -> db -> select('email_html.*');
		$this -> db -> select('email_html_auto_responder.id, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject');
   		$this -> db -> from('email_html');
		$this -> db -> join('email_html_auto_responder','email_html.email_code = email_html_auto_responder.email_code and email_html_auto_responder.usercode='.$this->session->userdata['logged_ol_member']['usercode'].'','left');
   		$this -> db -> where('email_html.email_code',''.$eid.'');
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
	
	function delete_record($eid)
	{
		$this->db->where('email_code',$eid);
		$this->db->where('usercode',$this->session->userdata['logged_ol_member']['usercode']);
		$this->db->delete('email_html_auto_responder'); 
	}
  	
 
 	function get_user_by_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
  	
  	function get_email_html_by_access_name($eid){
		$this -> db -> select('*');
   		$this -> db -> from('email_html');
   		$this -> db -> where('access_name',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
  
	
}
?>
