<?php
Class login_module extends CI_Model
{
 	function loginsub($username, $password)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$username.'');
   		$this -> db -> where('password',''.$password.'');
		$this -> db -> where('status !=','Delete');
   		$this -> db -> limit(1);
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_record_by_email($eid)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('emailid', ''.$eid.'');
		$this -> db -> where('status !=','Delete');
		$this -> db -> limit(1);
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function check_paid_product($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('usercode',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function n_product_permission($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_permission');
   		$this -> db -> where('usercode',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_email_contain()
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable','forgot_password_email');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_product_access($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('product_access_permission');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_admin_email_id(){
		$this -> db -> select('*');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode','2');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function delete_login($eid)
	{
		$this->db->where('usercode',''.$eid.'');
		$this->db->delete('login_user_info');
	}
 	
	function get_payment_level($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$usercode.'');
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
		$this -> db -> limit(65);
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
	

	function get_table_record($tbl,$usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from($tbl);
   		$this -> db -> where('usercode',''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_kdk_code_intered($id){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> where('usercode', ''.$id.'');
		$this -> db -> where('usercode IN (select usercode from rm_kdk_code_use where usercode ="'.$id.'")');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		if(isset($the_content[0])){
			return true;
		}else{
			return false;
		}
		
	}

	function update_today_popup($eid){
		$this->db->where('usercode', $eid);
		$this->db->update('membermaster', array('popup_date'=>date('Y-m-d')));
	}

	function get_master_page_by_pagecode($pagelable){
		$this->db->select('*');
   		$this->db->from('cms_pages_master');
   		$this->db->where('pagelable',$pagelable);
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
}
