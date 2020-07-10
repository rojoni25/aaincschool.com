<?php
Class martix_message_module extends CI_Model
{
 	
	
 	function get_messsage_receive($eid){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'message.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'message.send_from','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.status_to','Active');	
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.send_to',''.$this->session->userdata['logged_ol_member']['usercode'].'');	
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'message.time_dt','desc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_send_msg($eid){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'message.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'message.send_to','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.status_to','Active');	
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.send_from',''.$this->session->userdata['logged_ol_member']['usercode'].'');	
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'message.time_dt','desc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_message_by_id($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'message.id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
		
	function change_read_status($data)
	{
		$this->db->where('send_to',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this->db->update(''.MATRIX_TABLE_PRE.'message',$data); 
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
