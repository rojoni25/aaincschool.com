<?php
Class rm_martix_module extends CI_Model
{
 	function get_pages_contain($page_key)
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page');
   		$this -> db -> where('page_key', ''.$page_key.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}

	function get_pages_cms($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_sdk_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_in_tree(){
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	} 
	
	function check_request()
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status !=','C');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_rm_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from('rm_matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
	}
	
	function addItem($data,$table)
	{
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue)
	{
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function get_payment_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_payment');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_cms_page($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
		$this -> db -> where('pagelable',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function count_notification()
	{
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('rm_notification');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status_receiver','Unread');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
}
?>
