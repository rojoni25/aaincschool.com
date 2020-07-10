<?php
Class general_message_model extends CI_Model
{
 	

	function get_gen_msg($eid){
		$this -> db -> select('admin_message.*');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.emailid,membermaster.username,membermaster.status');
   		$this -> db -> from('admin_message');
		$this -> db -> join('membermaster','admin_message.usercode = membermaster.usercode','left');
		$this -> db -> where('admin_message.type', ''.$eid.'');
		$this -> db -> order_by('admin_message.id', 'DESC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_msg_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('admin_message');
		$this -> db -> where('id', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function delete($table,$where){
		$this->db->where($where);
		$this->db->delete($table); 
	}
	
  
	
}
?>
