<?php
Class rm_martix_message_module extends CI_Model
{
 	
 	function get_messsage_receive($eid){
		
		$this -> db -> select('rm_message.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = rm_message.send_from','left');
   		$this -> db -> from('rm_message');
		$this -> db -> where('rm_message.status_to','Active');	
		$this -> db -> where('rm_message.send_to',''.$this->session->userdata['logged_ol_member']['usercode'].'');	
		$this -> db -> order_by('rm_message.time_dt','desc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_send_msg($eid){
		
		$this -> db -> select('rm_message.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = rm_message.send_to','left');
   		$this -> db -> from('rm_message');
		$this -> db -> where('rm_message.status_to','Active');	
		$this -> db -> where('rm_message.send_from',''.$this->session->userdata['logged_ol_member']['usercode'].'');	
		$this -> db -> order_by('rm_message.time_dt','desc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_message_by_id($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from('rm_message');
		$this -> db -> where('rm_message.id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
		
	function change_read_status($data)
	{
		$this->db->where('send_to',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this->db->update('rm_message',$data); 
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
