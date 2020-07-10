<?php
Class upgrade_membership_model extends CI_Model
{
 	function get_upling_member($eid)
 	{	
   		$this -> db -> select('membermaster.emailid');
		$this -> db -> select('member_node_master_free.*');
   		$this -> db -> from('member_node_master_free');
		$this -> db -> join('membermaster','membermaster.usercode = member_node_master_free.usercode','left');
		$this -> db -> where('member_node_master_free.usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 // 	function get_status($eid){
	// 	$this -> db -> select('type');
 //   		$this -> db -> from('affiliate_confirm_message');
	// 	$this -> db -> where('usercode',''.$eid.'');
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
 //    	return $the_content;
	// }
	
	function get_status($eid){
		$this -> db -> select('status');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_upling_ref_member($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function check_request_send()
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_admin_email()
	{
		$this -> db -> select("emailid");
   		$this -> db -> from('admin_login');
		$this -> db -> where('usercode','1');
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

	function getPaymentData()
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_gateway_stripe');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function ConfirmPaymentData()
	{
		$this -> db -> select('*');
   		$this -> db -> from('affiliate_confirm_message');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

}
?>
