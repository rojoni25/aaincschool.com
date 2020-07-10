<?php
Class home_module extends CI_Model
{
 	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_email_verification_by_key($key)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('email_verification');
   		$this -> db -> where('v_key',''.$key.'');
	//	$this -> db -> where('status','N');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_member_by_username($id)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username',''.$id.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_member_by_usercode($id)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$id.'');
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
		$arr_return['admin_contain']	=	$the_content[0]['admin_contain'];
    	return $arr_return;
		
	}

	function get_slider()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('slider_gallery');
   		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
}
?>
