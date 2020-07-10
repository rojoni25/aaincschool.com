<?php
Class page_module extends CI_Model
{
	
	function __construct()
 	{
   	
 	}
	
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
	
	function get_pages_contain_by_id($secret_page_code){
		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page');
   		$this -> db -> where('secret_page_code', ''.$secret_page_code.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_page_notfound($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_permission($secret_page_code){
		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page_permission');
   		$this -> db -> where('secret_page_code', ''.$secret_page_code.'');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_access_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
   		$this -> db -> where('access_code', ''.$eid.'');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_in_tree(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return ($the_content[0]['tot']>0) ? true : false;
	}
	
	function check_access_code(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return ($the_content[0]['tot']>0) ? true : false;
	}
	
	function check_code_intered(){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('usercode IN (select usercode from '.MATRIX_TABLE_PRE.'access_code_use where usercode ="'.$this->session->userdata['logged_ol_member']['usercode'].'")');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	
	function check_access_code_request(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code_request');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status', 'Active');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return ($the_content[0]['tot']>0) ? true : false;
	}
	
	function check_member_email()
	{
		$this -> db -> select('emailid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('email_verification','Y');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0])) ? true : false;
	}
	
	function get_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
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
