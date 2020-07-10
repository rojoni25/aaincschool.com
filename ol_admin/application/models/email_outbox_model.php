<?php
Class email_outbox_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('send_mail_master');
   		$this -> db -> where('status !=','Delete');
		$this -> db -> where('sender_code','-1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('send_mail_master');
   		$this -> db -> where('send_mail_code',''.$this->uri->segment(4).'');
		$this -> db -> where('sender_code','-1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_send_member(){
		$this -> db -> select('send_mail_master.*');
		$this -> db -> select('send_mail_dt.*');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.emailid');
   		$this -> db -> from('send_mail_dt');
		$this -> db -> join('membermaster','send_mail_dt.receiver_code = membermaster.usercode','left');
		$this -> db -> join('send_mail_master','send_mail_master.send_mail_code = send_mail_dt.send_mail_code','left');
		$this -> db -> where('send_mail_dt.send_mail_code', ''.$this->uri->segment(4).'');
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
