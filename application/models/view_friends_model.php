<?php
Class view_friends_model extends CI_Model
{
 	function getAll($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	// function getAllByStatus($eid){
	// 	$this -> db -> select('status');
 //   		$this -> db -> from('membermaster');
 //   		$this -> db -> where('referralid',''.$this->session->userdata['logged_ol_member']['usercode'].'');
	// 	$query = $this -> db -> get();
 //    	$result = $query->result_array();
 //    	return $result;
	// }

	function getEmailId($eid){
		$this -> db -> select('emailId');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$result = $query->result_array();
    	return $result[0];
	}

	function invite_friends_history()
	{
		$this -> db -> select('invite_friend_master.*, count(invite_analytics.invite_code) as total_count');
   		$this -> db -> from('invite_friend_master');
   		$this->db->join('invite_analytics', 'invite_analytics.invite_code = invite_friend_master.invite_friend_code', 'left');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$this->db->group_by('invite_analytics.invite_code'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}	

	function invite_friends_history_id($id){
		$this -> db -> select('*');
   		$this -> db -> from('invite_friend_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$this -> db -> where('invite_friend_code',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	if(count($the_content)){
    		return $the_content[0];
    	} else{
    		return array();
    	}
	}

	function invite_friends_analytics_list($id){
		$this -> db -> select('*');
   		$this -> db -> from('invite_analytics');
   		$this -> db -> where('invite_code',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_email_contain()
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable','send_request_email');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_email_contain_ref()
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable','send_email_template_join_ref');
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
 	
	function test_demo()
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_monthly_payment');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	
  	
  	function get_invite_friend_master($id)
	{
		$this -> db -> select('*');
   		$this -> db -> from('invite_friend_master');
	  	$this -> db -> where('invite_friend_code', ''.$id.'');
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
}
?>
