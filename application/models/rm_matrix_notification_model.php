<?php
Class rm_matrix_notification_model extends CI_Model
{
	

	function get_notification($eid)
	{		
		$this -> db -> select('*');
   		$this -> db -> from('rm_notification');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status_receiver !=','Delete');
		$this -> db -> order_by('id','DESC');
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
	
	function read_notification(){
		$data=array();
		$data['status_receiver']='Read';
		$this->db->where('usercode', $this->session->userdata['logged_ol_member']['usercode']);
		$this->db->where('status_receiver','Unread');
		$this->db->update('rm_notification', $data); 
	}
	
	
}
?>
