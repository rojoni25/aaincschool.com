<?php
Class email_inbox_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('send_mail_master.subject,send_mail_master.timedt,send_mail_master.sender_code');
		$this -> db -> select('send_mail_dt.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('send_mail_dt');
		$this -> db -> join('send_mail_master','send_mail_master.send_mail_code = send_mail_dt.send_mail_code','left');
		$this -> db -> join('membermaster','membermaster.usercode = send_mail_master.sender_code','left');
   		$this -> db -> where('send_mail_dt.status !=','Delete');
		$this -> db -> where('send_mail_dt.receiver_code','-1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid)
	{
		$this -> db -> select('send_mail_master.*');
		$this -> db -> select('send_mail_dt.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.emailid');
   		$this -> db -> from('send_mail_dt');
		$this -> db -> join('send_mail_master','send_mail_master.send_mail_code = send_mail_dt.send_mail_code','left');
		$this -> db -> join('membermaster','membermaster.usercode = send_mail_master.sender_code','left');
   		$this -> db -> where('send_mail_dt.status !=','Delete');
		$this -> db -> where('send_mail_dt.receiver_code','-1');
		$this -> db -> where('send_mail_dt.send_mail_dtcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
		
	}

	function get_send_member(){
		$this -> db -> select('send_mail_dt.*');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.emailid');
	
   		$this -> db -> from('send_mail_dt');
		$this -> db -> join('membermaster','send_mail_dt.receiver_code = membermaster.usercode','left');
	
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
