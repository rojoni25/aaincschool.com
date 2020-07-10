<?php
Class notification_module extends CI_Model
{
 	function get_notification()
 	{
   		$this -> db -> select('notification_master.*');
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS mem_nm, membermaster.username,membermaster.status,membermaster.referralid,membermaster.referralid_free",FALSE);
   		$this -> db -> from('notification_master');
		$this -> db -> join('membermaster','membermaster.usercode = notification_master.by_usercode','left');
		$this -> db -> where('notification_master.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('notification_master.status','Active');
		$this -> db -> order_by('notification_master.timedt','desc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	

	function member_detail($eid)
 	{
		$this -> db -> select("CONCAT(fname,' ',lname) as nm, username,usercode",FALSE);
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
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
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	function check_cloud_token_status($usercode){
	    $this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$usercode.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
}
?>
