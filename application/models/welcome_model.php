<?php
Class welcome_model extends CI_Model
{
 	function get_page_contain(){
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('status !=','Delete');
		if($this->session->userdata['tbl']['current_account']=='Active'){
			$this -> db -> where('pagelable','welcome_for_paid');
		}
		if($this->session->userdata['logged_ol_member']['status']=='Pending'){
			$this -> db -> where('pagelable','welcome_for_free');
		}
	
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}	
	
	function get_account_send_link(){
		
		$date = strtotime(date('d-m-Y')." -7 day");
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('email_verification');
   		$this -> db -> where('usercode',''.$this->session->userdata["logged_ol_member"]["usercode"].'');
		$this -> db -> where('send_time >',''.$date.'');
		$this -> db -> where('status','N');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['tot'];
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	
	
	function get_email_html_by_access_name($arr){
		
		$this -> db -> select('email_html.*');
		$this -> db -> select('IFNULL(email_html_auto_responder.id, 0) AS ref_email, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject',FALSE);
   		$this -> db -> from('email_html');
		$this -> db -> join('email_html_auto_responder','email_html.email_code = email_html_auto_responder.email_code and email_html_auto_responder.usercode='.$arr['usercode'].'','left');
   		$this -> db -> where('email_html.access_name',''.$arr['access_name'].'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr_return = array();
		$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_subject'] : $the_content[0]['subject'];
		$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_text'] : $the_content[0]['email_html'];
    	return $arr_return;
	}

	// function get_email_html_by_access_name($arr){
	// 	$this -> db -> select('cms_pages_master.*');
		
 //   		$this -> db -> from('cms_pages_master');
		
 //   		$this -> db -> where('cms_pages_master.pagelable',''.$arr['pagelable'].'');
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
	// 	$arr_return = array();
	// 	$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['title'] : $the_content[0]['title'];

	// 	$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['textdt'] : $the_content[0]['textdt'];
	// 	// $arr_return['admin_contain']	=	$the_content[0]['admin_contain'];
 //    	return $arr_return;
		
	// }

	function get_master_page_by_pagecode($pagelable){
		$this->db->select('*');
   		$this->db->from('cms_pages_master');
   		$this->db->where('pagelable',$pagelable);
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	// for day_1
	
	function get_email_html_day_1(){
		$this->db->select('*');
   		$this->db->from('email_html');
   		$this->db->where('access_name','day_1');
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
	function getmemberDetails_1()
	{
		$date2 = date("Y-m-d H:i:s");
		$current_date = strtotime($date2);
		$query = $this->db->query('select * from membermaster where ('.$current_date.'-add_time)>86400*1 and day_1!= 1');
        $the_content = $query->result_array();
    	return $the_content;
	}

	// for day_7

	function get_email_html_day_7(){
		$this->db->select('*');
   		$this->db->from('email_html');
   		$this->db->where('access_name','day_7');
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
	function getmemberDetails_7()
	{
		$date2 = date("Y-m-d H:i:s");
		$current_date = strtotime($date2);
		$query = $this->db->query('select * from membermaster where ('.$current_date.'-add_time)>86400*7 and day_7!= 1');
        $the_content = $query->result_array();
    	return $the_content;
	}


	// for day_14

	function get_email_html_day_14(){
		$this->db->select('*');
   		$this->db->from('email_html');
   		$this->db->where('access_name','day_14');
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
	function getmemberDetails_14()
	{
		$date2 = date("Y-m-d H:i:s");
		$current_date = strtotime($date2);
		$query = $this->db->query('select * from membermaster where ('.$current_date.'-add_time)>86400*14 and day_14!= 1');
        $the_content = $query->result_array();
    	return $the_content;
	}

	function update_member_email_status($usercode, $field){
		$this->db->where('usercode', $usercode);
		$this->db->update('membermaster', array($field => '1'));
	}


	// for day_21

	function get_email_html_day_21(){
		$this->db->select('*');
   		$this->db->from('email_html');
   		$this->db->where('access_name','day_21');
    	$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
	function getmemberDetails_21()
	{
		$date2 = date("Y-m-d H:i:s");
		$current_date = strtotime($date2);
		$query = $this->db->query('select * from membermaster where ('.$current_date.'-add_time)>86400*21 and day_21!= 1');
        $the_content = $query->result_array();
    	return $the_content;
	}

	function getType()
	{
		$this->db->select('*');
		$this->db->from('affiliate_confirm_message');
		$this -> db -> where('usercode',''.$this->session->userdata["logged_ol_member"]["usercode"].'');
		$this->db->where('type','Done');
		$query = $this->db->get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	//========================Get capture page Subscription Status from "membermaster" table=================
	function getSubscriptionStatus(){
	    $this->db->select('*');
		$this->db->from('membermaster');
		$this -> db -> where('usercode',''.$this->session->userdata["logged_ol_member"]["usercode"].'');
		$query = $this->db->get();
    	$the_content = $query->result_array();
    	
    	return $the_content[0]["subscription_status"];
	}
}
