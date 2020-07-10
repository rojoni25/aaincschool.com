<?php
Class capture_model extends CI_Model
{
 	function get_page_contain()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('capture_page_master');
	  	$this -> db -> where('capture_page_code', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_reg_preview()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('capture_page_preview');
	  	$this -> db -> where('capture_page_code', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	
	function get_page_capture_request()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('capture_page_request');
	  	$this -> db -> where('request_code', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_page_contain_priview(){
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_preview');
	  	$this -> db -> where('capture_page_code', ''.$this->uri->segment(3).'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	$the_content[0]['headline_text']=str_replace(array("\n", '\n'), '<br>', $the_content[0]['headline_text']);
    	$the_content[0]['main_body_text']=str_replace(array("\n", '\n'), '<br>', $the_content[0]['main_body_text']);
    	return $the_content;
	}
	function get_user_by_username($eid=''){
		$this -> db -> select('usercode,fname,lname,username,status');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_master_page_recore($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
	  	$this -> db -> where('pagecode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_master_page_by_name($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
	  	$this -> db -> where('pagename', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_page_text($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
	  	$this -> db -> where('pagelable', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_currect_add_member()
	{
		$this -> db -> select("CONCAT(fname,' ',SUBSTRING(lname, 1, 1)) AS name, usercode", FALSE);
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=','Delete');
		$this -> db -> order_by("add_time","desc"); 
		$this -> db -> order_by("usercode","desc");  	
		$this -> db -> limit(200);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_product_access_permission($eid){
		$this -> db -> select('*');
   		$this -> db -> from('product_access_permission');
	  	$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}

	function addInviteAnalytics($table,$invite_data)
	{
		$this->db->insert($table,$invite_data);
		return $this->db->insert_id();
	}

	
	function invite_friends_analytics_list_emailId($id){

		$this -> db -> select('invite_analytics.*, membermaster.emailId, invite_friend_master.invite_emailid, invite_friend_master.send_url,invite_friend_master.timedt, invite_friend_master.pagecode');
   		$this -> db -> from('invite_analytics');
   		$this->db->join('invite_friend_master', 'invite_analytics.invite_code = invite_friend_master.invite_friend_code', 'left');
   		$this -> db -> join('membermaster','invite_friend_master.usercode = membermaster.usercode','left');
   		$this -> db -> where('invite_analytics.id',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;

		
	}


	function get_email_contain_visit_invitation_link()
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable','visit_invite_link');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
		
}
?>
