<?php
Class email_verification_model extends CI_Model
{
 	
	function get_member_dt()
 	{
		
   		$this -> db -> select('membermaster.*');
        $this -> db -> select('membermaster1.fname As sponser');
   		$this -> db -> from('membermaster');
        $this -> db -> join('membermaster membermaster1','membermaster1.usercode = membermaster.referralid','left');
   		$this -> db -> where('membermaster.usercode', ''.$this->session->userdata['email_verification']['usercode'].'');
		
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function check_email_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('emailid', ''.$eid.'');
   		$this -> db -> where('usercode !=', ''.$this->session->userdata['email_verification']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0])) ? true : false;
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
