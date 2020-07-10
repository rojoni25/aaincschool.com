<?php
Class pdl_subscribe_module extends CI_Model
{
	
	function get_member_dt()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_in_true()
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_member');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function check_subscription()
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_subscription');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	
	function get_subscription()
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_subscription');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_payment_flase()
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_payment_false');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
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
	
	function get_admin_email()
	{
		$this -> db -> select('emailid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.PDL_SYSTEM_USER.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}

	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function last_card_update()
	{
		$time=time()-86400;
		$this -> db -> select('*');
   		$this -> db -> from('pdl_card_update');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('timedt >=',''.$time.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	

}
?>
